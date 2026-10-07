@extends('layouts.paciente')

@section('title', 'Solicitar Cita - ConsultorioNutri')

@section('page-title', 'Solicitar Nueva Cita')

@section('page-description', 'Selecciona una fecha y un horario disponible para agendar tu consulta.')

@section('content')

@push('styles')
<style>
    .info-box {
        background: var(--verde-suave);
        border: 1px solid var(--borde);
        border-radius: var(--radio);
        padding: 18px;
        margin-bottom: 22px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .info-box-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-box-content strong {
        display: block;
        color: var(--texto);
        font-size: 13px;
        margin-bottom: 4px;
    }

    .info-box-content p {
        color: var(--texto-secundario);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: 4px;
    }

    .info-box-content p:last-child {
        margin-bottom: 0;
    }

    .header-acciones {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .boton-rojo {
        background: var(--cancelado-fondo);
        color: var(--cancelado);
        border: 1px solid #EACCCC;
    }

    .boton-rojo:hover {
        background: #F2DCDC;
    }
</style>
@endpush

<div class="header-acciones">
    <a href="{{ route('paciente.citas.index') }}" class="boton-secundario">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <path d="M19 12H5"/>
            <path d="m12 19-7-7 7-7"/>
        </svg>
        Regresar a mis citas
    </a>
</div>

{{-- CAJA DE INFORMACIÓN --}}
<div class="info-box">
    <div class="info-box-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 8v4"/>
            <path d="M12 16h.01"/>
        </svg>
    </div>
    <div class="info-box-content">
        <strong>Información sobre las consultas</strong>
        <p>El consultorio atiende de lunes a viernes, de 09:00 a 18:00 hrs.</p>
        <p>Las citas tienen una duración de 30 minutos. Selecciona una fecha para visualizar la disponibilidad de horarios. Tu solicitud quedará en estado pendiente hasta que el nutriólogo la confirme.</p>
    </div>
</div>

{{-- FORMULARIO DE SOLICITUD --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Datos de la Consulta</h2>
            <p class="card-description">Elige el momento de tu atención</p>
        </div>
    </div>

    <form action="{{ route('paciente.citas.store') }}" method="POST" class="form-grid">
        @csrf

        {{-- FECHA --}}
        <div class="campo">
            <label for="fecha">Fecha de la cita</label>
            <input 
                type="date" 
                id="fecha" 
                name="fecha" 
                min="{{ $fechaMinima }}" 
                value="{{ old('fecha') }}" 
                required
            >
            <small>No se brinda atención sábados, domingos ni días inhábiles.</small>
        </div>

        {{-- HORA --}}
        <div class="campo">
            <label for="hora">Horario disponible</label>
            <select id="hora" name="hora" required disabled>
                <option value="">Primero selecciona una fecha</option>
            </select>
            <small id="mensajeDisponibilidad" aria-live="polite">Selecciona una fecha para consultar la disponibilidad.</small>
        </div>

        {{-- MOTIVO --}}
        <div class="campo campo-completo">
            <label for="motivo">Motivo de la consulta</label>
            <textarea 
                id="motivo" 
                name="motivo" 
                maxlength="2000" 
                placeholder="Describe brevemente la razón de tu consulta (seguimiento, primera cita, ajuste de dieta...)" 
                required
            >{{ old('motivo') }}</textarea>
            <small>Máximo 2000 caracteres.</small>
        </div>

        {{-- ACCIONES --}}
        <div class="form-acciones">
            <a href="{{ route('paciente.citas.index') }}" class="boton-secundario">
                Cancelar
            </a>

            <button type="submit" class="boton" id="botonEnviar" disabled>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M22 2 11 13"/>
                    <path d="m22 2-7 20-4-9-9-4Z"/>
                </svg>
                Solicitar Cita
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    const horarios = @json($horarios);
    const diasNoLaborables = @json($diasNoLaborables);
    const citasOcupadas = @json($citasOcupadas);
    const fechaMinima = @json($fechaMinima);
    const horaActual = @json($horaActual);

    const campoFecha = document.getElementById('fecha');
    const campoHora = document.getElementById('hora');
    const mensaje = document.getElementById('mensajeDisponibilidad');
    const botonEnviar = document.getElementById('botonEnviar');
    const horaAnterior = @json(old('hora', ''));

    function obtenerDiaSemana(fecha) {
        return new Date(fecha + 'T12:00:00Z').getUTCDay();
    }

    function convertirMinutos(hora) {
        const partes = hora.substring(0, 5).split(':');
        return Number(partes[0]) * 60 + Number(partes[1]);
    }

    function formatoHora(minutos) {
        const horas = Math.floor(minutos / 60);
        const minutosRestantes = minutos % 60;
        return String(horas).padStart(2, '0') + ':' + String(minutosRestantes).padStart(2, '0');
    }

    function actualizarHorarios() {
        const fecha = campoFecha.value;
        campoHora.innerHTML = '';
        campoHora.disabled = true;
        botonEnviar.disabled = true;

        if (!fecha) {
            campoHora.add(new Option('Primero selecciona una fecha', ''));
            mensaje.textContent = 'Selecciona una fecha para consultar los horarios.';
            return;
        }

        if (fecha < fechaMinima) {
            campoHora.add(new Option('Fecha no válida', ''));
            mensaje.textContent = 'No puedes seleccionar una fecha pasada.';
            return;
        }

        const diaSemana = obtenerDiaSemana(fecha);

        if (diaSemana === 0 || diaSemana === 6) {
            campoHora.add(new Option('Consultorio cerrado', ''));
            mensaje.textContent = 'El consultorio no atiende los sábados ni domingos.';
            return;
        }

        if (diasNoLaborables.includes(fecha)) {
            campoHora.add(new Option('Día no laborable', ''));
            mensaje.textContent = 'El consultorio no atiende en esta fecha.';
            return;
        }

        const horarioDia = horarios.filter(horario => Number(horario.dia_semana) === diaSemana);

        if (horarioDia.length === 0) {
            campoHora.add(new Option('Sin horario configurado', ''));
            mensaje.textContent = 'No hay horario de atención configurado para este día.';
            return;
        }

        const opciones = [];

        horarioDia.forEach(horario => {
            const inicio = convertirMinutos(horario.hora_inicio);
            const fin = convertirMinutos(horario.hora_fin);

            for (let minutos = inicio; minutos + 30 <= fin; minutos += 30) {
                const hora = formatoHora(minutos);

                if (fecha === fechaMinima && minutos <= convertirMinutos(horaActual)) {
                    continue;
                }

                const ocupada = citasOcupadas.some(
                    cita => cita.fecha === fecha && cita.hora.substring(0, 5) === hora
                );

                if (!ocupada) {
                    opciones.push(hora);
                }
            }
        });

        opciones.sort();

        if (opciones.length === 0) {
            campoHora.add(new Option('Sin horarios disponibles', ''));
            mensaje.textContent = 'No quedan horarios disponibles para esta fecha. Selecciona otro día.';
            return;
        }

        campoHora.add(new Option('Selecciona una hora', ''));

        opciones.forEach(hora => {
            campoHora.add(new Option(hora, hora));
        });

        campoHora.disabled = false;
        mensaje.textContent = `Hay ${opciones.length} horario(s) disponible(s). Las citas duran 30 minutos.`;

        if (opciones.includes(horaAnterior)) {
            campoHora.value = horaAnterior;
        }

        botonEnviar.disabled = !campoHora.value;
    }

    campoFecha.addEventListener('change', () => {
        actualizarHorarios();
    });

    campoHora.addEventListener('change', () => {
        botonEnviar.disabled = !campoHora.value;
    });

    actualizarHorarios();
</script>
@endpush