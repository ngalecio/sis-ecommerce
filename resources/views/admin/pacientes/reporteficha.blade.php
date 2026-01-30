<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha Médica - {{ $paciente->nombres }} {{ $paciente->apellidos }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            font-size: 11px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* ========== ENCABEZADO ========== */
        .header {
            background: linear-gradient(135deg, #D8CAAB 0%, #c9b895 100%);
            padding: 30px;
            border-bottom: 4px solid #b8a37f;
            position: relative;
        }

        .header-top {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2d2d2d;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 11px;
            color: #555;
            margin-top: 5px;
        }

        .document-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #2d2d2d;
            margin-top: 10px;
            letter-spacing: 1px;
        }

        .document-number {
            text-align: right;
            font-size: 10px;
            color: #666;
            margin-top: 10px;
        }

        /* ========== INFORMACIÓN DEL PACIENTE ========== */
        .patient-info {
            background: #f8f9fa;
            padding: 25px 30px;
            border-bottom: 2px solid #e9ecef;
        }

        .patient-name {
            font-size: 18px;
            font-weight: bold;
            color: #2d2d2d;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #D8CAAB;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 15px;
        }

        .info-row {
            width: 100%;
            margin-bottom: 12px;
            clear: both;
        }

        .info-row:after {
            content: "";
            display: table;
            clear: both;
        }

        .info-col {
            float: left;
            width: 48%;
            margin-right: 2%;
        }

        .info-col:nth-child(2n) {
            margin-right: 0;
        }

        .info-col-third {
            float: left;
            width: 31.33%;
            margin-right: 2%;
        }

        .info-col-third:nth-child(3n) {
            margin-right: 0;
        }

        .info-col-full {
            width: 100%;
            clear: both;
        }

        .field-label {
            display: block;
            font-size: 9px;
            font-weight: bold;
            color: #8b7a52;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .field-value {
            display: block;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-left: 3px solid #D8CAAB;
            padding: 8px 12px;
            font-size: 11px;
            color: #2d2d2d;
            min-height: 28px;
        }

        /* ========== SECCIÓN ========== */
        .section {
            padding: 25px 30px;
            border-bottom: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2d2d2d;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #D8CAAB;
            background: linear-gradient(to right, rgba(216, 202, 171, 0.1), transparent);
            padding-left: 10px;
        }

        .section-title:before {
            content: "▪";
            color: #D8CAAB;
            margin-right: 8px;
            font-size: 16px;
        }

        /* ========== TABLA DE DATOS ========== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table th {
            background: #D8CAAB;
            color: #2d2d2d;
            padding: 10px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #c9b895;
        }

        .data-table td {
            padding: 8px 10px;
            border: 1px solid #dee2e6;
            font-size: 10px;
        }

        .data-table tr:nth-child(even) {
            background: #f8f9fa;
        }

        /* ========== BADGES ========== */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* ========== PIE DE PÁGINA ========== */
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        .footer-info {
            margin-bottom: 10px;
        }

        .footer-date {
            font-weight: bold;
            color: #2d2d2d;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
        }

        /* ========== FIRMA ========== */
        .signature-section {
            margin-top: 30px;
            text-align: center;
        }

        .signature-line {
            width: 300px;
            border-top: 2px solid #2d2d2d;
            margin: 0 auto;
            padding-top: 5px;
            font-size: 10px;
            color: #666;
        }

        /* ========== ALERT BOX ========== */
        .alert {
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid;
        }

        .alert-warning {
            background: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        .alert-info {
            background: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        /* ========== UTILIDADES ========== */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- ENCABEZADO -->
        <div class="header">
            <div class="header-top">
                <div class="logo">CENTRO MÉDICO</div>
                <div class="subtitle">Sistema de Gestión de Pacientes</div>
            </div>
            <div class="document-title">FICHA MÉDICA DEL PACIENTE</div>
            <div class="document-number">
                N° {{ str_pad($paciente->id ?? '001', 6, '0', STR_PAD_LEFT) }} |
                {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>

        <!-- INFORMACIÓN DEL PACIENTE -->
        <div class="patient-info">
            <div class="patient-name">
                {{ strtoupper($paciente->nombres ?? 'N/A') }} {{ strtoupper($paciente->apellidos ?? 'N/A') }}
            </div>

            <div class="info-grid">
                <!-- Fila 1 -->
                <div class="info-row">
                    <div class="info-col-third">
                        <span class="field-label">Cédula / DNI</span>
                        <span class="field-value">{{ $paciente->cedula ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-col-third">
                        <span class="field-label">Fecha de Nacimiento</span>
                        <span class="field-value">
                            {{ $paciente->fecha_nacimiento ?
                            \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') : 'No registrada' }}
                        </span>
                    </div>
                    <div class="info-col-third">
                        <span class="field-label">Edad</span>
                        <span class="field-value">
                            {{ $paciente->fecha_nacimiento ? \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age . '
                            años' : 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="info-row">
                    <div class="info-col-third">
                        <span class="field-label">Género</span>
                        <span class="field-value">{{ $paciente->genero ?? 'No especificado' }}</span>
                    </div>
                    <div class="info-col-third">
                        <span class="field-label">Teléfono</span>
                        <span class="field-value">{{ $paciente->telefono ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-col-third">
                        <span class="field-label">Celular</span>
                        <span class="field-value">{{ $paciente->celular ?? 'No registrado' }}</span>
                    </div>
                </div>

                <!-- Fila 3 -->
                <div class="info-row">
                    <div class="info-col">
                        <span class="field-label">Email</span>
                        <span class="field-value">{{ $paciente->email ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-col">
                        <span class="field-label">Estado Civil</span>
                        <span class="field-value">{{ $paciente->estado_civil ?? 'No especificado' }}</span>
                    </div>
                </div>

                <!-- Fila 4 -->
                <div class="info-row">
                    <div class="info-col-full">
                        <span class="field-label">Dirección Completa</span>
                        <span class="field-value">{{ $paciente->direccion ?? 'No registrada' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMACIÓN MÉDICA -->
        <div class="section">
            <div class="section-title">Información Médica</div>

            <div class="info-grid">
                <div class="info-row">
                    <div class="info-col">
                        <span class="field-label">Grupo Sanguíneo</span>
                        <span class="field-value">
                            <strong>{{ $paciente->grupo_sanguineo ?? 'No registrado' }}</strong>
                        </span>
                    </div>
                    <div class="info-col">
                        <span class="field-label">Factor RH</span>
                        <span class="field-value">
                            <strong>{{ $paciente->factor_rh ?? 'No registrado' }}</strong>
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col-full">
                        <span class="field-label">Alergias Conocidas</span>
                        <span class="field-value">
                            @if(isset($paciente->alergias) && !empty($paciente->alergias))
                            <span class="badge badge-warning">⚠ {{ $paciente->alergias }}</span>
                            @else
                            <span class="badge badge-success">✓ Ninguna alergia registrada</span>
                            @endif
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col-full">
                        <span class="field-label">Enfermedades Crónicas</span>
                        <span class="field-value">{{ $paciente->enfermedades_cronicas ?? 'Ninguna registrada' }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col-full">
                        <span class="field-label">Medicamentos Actuales</span>
                        <span class="field-value">{{ $paciente->medicamentos_actuales ?? 'Ninguno registrado' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTACTO DE EMERGENCIA -->
        <div class="section">
            <div class="section-title">Contacto de Emergencia</div>

            <div class="info-grid">
                <div class="info-row">
                    <div class="info-col">
                        <span class="field-label">Nombre Completo</span>
                        <span class="field-value">{{ $paciente->contacto_emergencia_nombre ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-col">
                        <span class="field-label">Parentesco</span>
                        <span class="field-value">{{ $paciente->contacto_emergencia_parentesco ?? 'No especificado'
                            }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col">
                        <span class="field-label">Teléfono de Emergencia</span>
                        <span class="field-value">{{ $paciente->contacto_emergencia_telefono ?? 'No registrado'
                            }}</span>
                    </div>
                    <div class="info-col">
                        <span class="field-label">Teléfono Alternativo</span>
                        <span class="field-value">{{ $paciente->contacto_emergencia_alternativo ?? 'No registrado'
                            }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- OBSERVACIONES -->
        @if(isset($paciente->observaciones) && !empty($paciente->observaciones))
        <div class="section">
            <div class="section-title">Observaciones Generales</div>
            <div class="field-value">{{ $paciente->observaciones }}</div>
        </div>
        @endif

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <div class="footer-info">
                Este documento es confidencial y contiene información médica protegida.<br>
                Su uso está limitado exclusivamente al personal médico autorizado.
            </div>
            <div class="footer-date">
                Documento generado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i:s') }}
            </div>

            <div class="signature-section mt-20">
                <div class="signature-line">
                    Firma del Médico Tratante
                </div>
            </div>
        </div>
    </div>
</body>

</html>