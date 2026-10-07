<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DocumentoClinico;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentoClinicoController extends Controller
{
    public function guardar(Request $request, Cita $cita)
    {
        $paciente = auth()->user()->paciente;

        abort_unless(
            auth()->user()->esNutriologo()
            || ($paciente && $cita->paciente_id === $paciente->id),
            404
        );

        $datos = $request->validate([
            'archivo' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:10240',
            ],
        ]);

        $archivo = $datos['archivo'];

        $ruta = $archivo->store('documentos-clinicos', 'local');

        try {
            $documento = DB::transaction(function () use (
                $archivo,
                $ruta,
                $cita
            ) {
                $documento = DocumentoClinico::create([
                    'cita_id' => $cita->id,
                    'nombre_original' => $archivo->getClientOriginalName(),
                    'ruta_privada' => $ruta,
                    'tipo_mime' => $archivo->getMimeType(),
                    'tamano' => $archivo->getSize(),
                ]);

                RegistroActividad::create([
                    'user_id' => auth()->id(),
                    'accion' => 'subir_documento_clinico',
                    'entidad' => 'documentos_clinicos',
                    'entidad_id' => $documento->id,
                    'descripcion' => 'Se adjuntó un documento clínico.',
                    'creado_at' => now(),
                ]);

                return $documento;
            });
        } catch (\Throwable $error) {
            Storage::disk('local')->delete($ruta);

            throw $error;
        }

        return back()->with(
            'mensaje',
            'El documento clínico se guardó correctamente.'
        );
    }

    public function descargar(DocumentoClinico $documento)
    {
        $documento->load('cita.paciente');

        $usuario = auth()->user();
        $paciente = $usuario->paciente;

        $autorizado = $usuario->esNutriologo()
            || (
                $paciente
                && $documento->cita->paciente_id === $paciente->id
            );

        abort_unless($autorizado, 404);

        abort_unless(
            Storage::disk('local')->exists($documento->ruta_privada),
            404,
            'El archivo solicitado no existe.'
        );

        return Storage::disk('local')->download(
            $documento->ruta_privada,
            $documento->nombre_original
        );
    }

    public function eliminar(DocumentoClinico $documento)
    {
        abort_unless(auth()->user()->esNutriologo(), 403);

        $ruta = $documento->ruta_privada;

        DB::transaction(function () use ($documento) {
            RegistroActividad::create([
                'user_id' => auth()->id(),
                'accion' => 'eliminar_documento_clinico',
                'entidad' => 'documentos_clinicos',
                'entidad_id' => $documento->id,
                'descripcion' => 'Se eliminó un documento clínico.',
                'creado_at' => now(),
            ]);

            $documento->delete();
        });

        Storage::disk('local')->delete($ruta);

        return back()->with(
            'mensaje',
            'El documento clínico fue eliminado.'
        );
    }
}
