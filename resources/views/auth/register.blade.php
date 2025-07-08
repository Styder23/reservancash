<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Turismo Natural</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --color-primary: #7e22ce;
            /* Morado principal */
            --color-primary-light: #a855f7;
            --color-primary-dark: #581c87;
            --color-secondary: #9333ea;
            --color-accent: #e879f9;
            --color-jade: #00a86b;
            /* Verde jade */
            --color-jade-light: #00c27a;
            --color-jade-dark: #007a4d;
            --color-white: #f8f8ff;
            /* Blanco perlado */
            --color-light: #e2e8f0;
            --color-dark: #1e1b4b;
            --color-darker: #0f172a;
            --color-text: #1e1b4b;
            --color-text-light: #64748b;
            --color-success: #10b981;
            --color-error: #ef4444;
            --color-bg: #f9fafb;
            /* Fondo claro */
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }

        .auth-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: linear-gradient(135deg, var(--color-white) 0%, var(--color-light) 100%);
        }

        .auth-card {
            width: 100%;
            max-width: 900px;
            background-color: var(--color-white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(126, 34, 206, 0.1);
            display: flex;
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Panel izquierdo con imagen */
        .auth-card-left {
            flex: 1;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-card-left::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .auth-card-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .logo-container {
            margin-bottom: 2rem;
            z-index: 1;
        }

        .logo-icon {
            font-size: 3rem;
            color: white;
            background: rgba(255, 255, 255, 0.15);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.25);
        }

        .auth-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: white;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .auth-features {
            margin-top: 2rem;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .feature-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        /* Panel derecho con formulario */
        .auth-card-right {
            flex: 1.5;
            padding: 3rem 2.5rem;
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            font-size: 1.2rem;
        }

        .user-type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .user-type-option {
            flex: 1;
            padding: 1.2rem 0.8rem;
            text-align: center;
            background-color: rgba(126, 34, 206, 0.05);
            border: 1px solid rgba(126, 34, 206, 0.15);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-type-option:hover {
            background-color: rgba(126, 34, 206, 0.1);
            border-color: var(--color-primary-light);
        }

        .user-type-option.active {
            background-color: rgba(126, 34, 206, 0.15);
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(167, 139, 250, 0.2);
        }

        .user-type-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--color-primary);
        }

        .user-type-label {
            font-weight: 500;
            color: var(--color-text);
            font-size: 0.9rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--color-text);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            background-color: var(--color-white);
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: var(--color-text);
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary-light);
            box-shadow: 0 0 0 2px rgba(167, 139, 250, 0.2);
        }

        .input-group {
            display: flex;
            align-items: center;
            background-color: var(--color-white);
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        .input-group-prepend {
            padding: 0.65rem 0.8rem;
            background-color: rgba(126, 34, 206, 0.05);
            color: var(--color-primary);
            font-size: 0.9rem;
        }

        .input-group .form-control {
            border: none;
            border-radius: 0;
            background-color: transparent;
        }

        .form-file {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .form-file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .form-file-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.65rem 1rem;
            background-color: var(--color-white);
            border: 1px dashed #e2e8f0;
            border-radius: 6px;
            color: var(--color-text-light);
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .form-file-label:hover {
            border-color: var(--color-primary-light);
            color: var(--color-text);
        }

        .form-file-label i {
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .auth-card-footer {
            padding: 1.5rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
            margin-top: 1.5rem;
        }

        .auth-link {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-link:hover {
            color: var(--color-primary-dark);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.7rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--color-jade);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-jade-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 168, 107, 0.2);
        }

        /* Alertas */
        .alert {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #059669;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-content i {
            font-size: 1rem;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: inherit;
            margin-left: auto;
            padding: 0;
            line-height: 1;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                max-width: 100%;
            }

            .auth-card-left {
                padding: 2rem 1.5rem;
            }

            .auth-card-right {
                padding: 2rem 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .user-type-selector {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .auth-card-left {
                display: none;
            }
        }


        /* */





        /* */
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="auth-container">
        <div class="auth-card animate-fade-in">
            <!-- Panel izquierdo con información -->
            <div class="auth-card-left">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-mountain"></i>
                    </div>
                </div>
                <h1 class="auth-title">Turismo Natural</h1>
                <p class="auth-subtitle">Descubre los mejores destinos con nosotros</p>

                <div class="auth-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <span>Destinos exclusivos</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span>Reservas seguras</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <span>Soporte 24/7</span>
                    </div>
                </div>
            </div>

            <!-- Panel derecho con formulario -->
            <div class="auth-card-right">
                <h2 class="auth-title" style="color: var(--color-primary); margin-bottom: 1.5rem; text-align: left;">
                    Crear Cuenta</h2>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <!-- Tipo de Usuario -->
                    <div class="form-section">
                        <h3 class="section-title"><i class="fas fa-user-tag"></i> Tipo de Usuario</h3>
                        <div class="user-type-selector">
                            <div class="user-type-option active" data-target="client-section">
                                <div class="user-type-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-type-label">Cliente</div>
                                <input type="hidden" name="user_type" value="3">
                            </div>
                            <div class="user-type-option" data-target="company-section">
                                <div class="user-type-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="user-type-label">Empresa</div>
                                <input type="hidden" name="user_type" value="2">
                            </div>
                        </div>
                    </div>

                    <!-- Sección para Cliente -->
                    <div id="client-section" class="form-section">
                        <h3 class="section-title"><i class="fas fa-id-card"></i> Información Personal</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="document_type">Tipo de Documento</label>
                                <select class="form-control" id="document_type" name="document_type" required>
                                    <option value="dni">DNI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="document_number">Número de Documento</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <input class="form-control" type="text" id="document_number"
                                        name="document_number" maxlength="8" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nombres">Nombres</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" id="nombres" name="nombres" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="apellidos">Apellidos</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" id="apellidos" name="apellidos"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="telefono">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input class="form-control" type="tel" id="telefono" name="telefono"
                                        maxlength="9" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección para Empresa (oculta inicialmente) -->
                    <div id="company-section" class="form-section" style="display: none;">
                        <h3 class="section-title"><i class="fas fa-building"></i> Información de la Empresa</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="nombre_empresa">Nombre de la Empresa</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-trademark"></i>
                                    </span>
                                    <input class="form-control" type="text" id="nombre_empresa"
                                        name="nombre_empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ruc">RUC</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-hashtag"></i>
                                    </span>
                                    <input class="form-control" type="text" id="ruc" name="ruc"
                                        maxlength="11">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="razon_social">Razón Social</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                                    <input class="form-control" type="text" id="razon_social"
                                        name="razon_social">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="direccion_empresa">Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input class="form-control" type="text" id="direccion_empresa"
                                        name="direccion_empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="telefono_empresa">Teléfono Empresa</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <input class="form-control" type="tel" id="telefono_empresa"
                                        name="telefono_empresa" maxlength="9">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="logo_empresa">Logo de la Empresa</label>
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="logo_empresa"
                                        name="logo_empresa" accept="image/*">
                                    <label class="form-file-label" for="logo_empresa">
                                        <i class="fas fa-cloud-upload-alt"></i> Subir Logo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h3 class="section-title"><i class="fas fa-user-tie"></i> Representante Legal</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="doc_type_representante">Tipo de Documento</label>
                                <select class="form-control" id="doc_type_representante"
                                    name="doc_type_representante">
                                    <option value="dni">DNI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="doc_number_representante">Número de Documento</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <input class="form-control" type="text" id="doc_number_representante"
                                        name="doc_number_representante" maxlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nombres_representante">Nombres</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" id="nombres_representante"
                                        name="nombres_representante">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="apellidos_representante">Apellidos</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" id="apellidos_representante"
                                        name="apellidos_representante">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de la Cuenta -->
                    <div class="form-section">
                        <h3 class="section-title"><i class="fas fa-key"></i> Datos de Acceso</h3>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="email">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input class="form-control" type="email" id="email" name="email"
                                        required>
                                </div>
                            </div>
                            {{-- --}}
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="verifyEmailButton">
                                    <i class="fas fa-check" id=""></i> Verificar
                                </button>
                            </div>
                            {{-- --}}
                            <div class="form-group">
                                <label class="form-label" for="password">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input class="form-control" type="password" id="password" name="password"
                                        required disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" required disabled>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="auth-card-footer">
                        <a class="auth-link" href="{{ route('login') }}">
                            <i class="fas fa-arrow-left"></i> ¿Ya tienes cuenta? Inicia sesión
                        </a>
                        <button type="submit" class="btn btn-primary" id="registerButton">
                            <i class="fas fa-user-plus"></i> Registrarse
                        </button>
                    </div>
                </form>

                @if (session('error'))
                    <div id="errorAlert" class="alert alert-error">
                        <div class="alert-content">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>{{ session('error') }}</span>
                            <button onclick="closeAlert('errorAlert')" class="alert-close">&times;</button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="validationAlert" class="alert alert-error">
                        <div class="alert-content">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Errores en el formulario:</strong>
                                <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button onclick="closeAlert('validationAlert')" class="alert-close">&times;</button>
                        </div>
                    </div>
                @endif


                {{-- --}}
                <!-- Modal para verificación -->
                <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden"
                    id="verificationModal">
                    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
                        <div class="modal-header flex justify-between items-center p-4 border-b">
                            <h3 class="text-lg font-semibold">Verificación de Correo</h3>
                            <button type="button" class="text-gray-600 hover:text-gray-800"
                                id="closeModalButtonX"><i class="fas fa-window-close fa-2x"></i></button>
                        </div>
                        <div class="modal-body p-4">
                            <p>Se ha enviado un código de verificación a <strong id="modalEmailDisplay"></strong>. Por
                                favor, revisa tu bandeja de entrada (incluyendo spam).</p> <input type="text"
                                id="verificationCode" class="mt-2 p-2 border border-gray-300 rounded w-full"
                                placeholder="Código de verificación" maxlength="6">
                            <div id="modalAlerts" class="mt-3">
                            </div>
                        </div>
                        <div class="modal-footer flex justify-end p-4 border-t">
                            <button type="button"
                                class="bg-gray-300 text-gray-700 hover:bg-gray-400 rounded px-6 py-2 mr-2"
                                id="closeModalButtonFooter">Cerrar</button>
                            <button type="button"
                                class="bg-blue-500 text-white hover:bg-blue-600 rounded px-4 py-2 mr-2"
                                id="resendCodeButton">Reenviar Código</button>
                            <button type="button"
                                class="bg-green-500 text-white hover:bg-green-600 rounded px-6 py-2"
                                id="validateCodeButton">Validar</button>
                        </div>
                    </div>
                </div>
                {{-- --}}


            </div>
        </div>
    </div>


    <script>
        // Función para inicializar el toggle de tipo de usuario
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar cuando el DOM esté listo
            initializeUserTypeToggle();
            initializeFileUpload();
            initializeFormSubmission();
            initializeAlerts();
            updateRequiredFields();
        });

        /* */
        // Funcion al hacer clcik en verificar
        document.getElementById('verifyEmailButton').onclick = function(event) {
            event.preventDefault(); // Evita el envío del formulario

            // Verificar campos de información personal
            const documentType = document.getElementById('document_type').value;
            const documentNumber = document.getElementById('document_number').value;
            const nombres = document.getElementById('nombres').value;
            const apellidos = document.getElementById('apellidos').value;
            const telefono = document.getElementById('telefono').value;
            const email = document.getElementById('email').value;

            // Verificar que todos los campos estén completos
            /*if (documentType && documentNumber && nombres && apellidos && telefono && email) {
                // Aquí puedes agregar la lógica para enviar el código al correo
                console.log(`Enviando código a: ${email}`);*/

            // Abrir el modal


            document.getElementById('verificationModal').classList.remove('hidden');
            /* } else {
                 alert("Por favor, completa todos los campos de información personal.");
             }*/
        };

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById('verificationModal').classList.add('hidden');
            // Opcional: Limpiar el campo del código de verificación al cerrar
            document.getElementById('verificationCode').value = '';
            // Opcional: Limpiar los mensajes de alerta del modal al cerrar
            document.getElementById('modalAlerts').innerHTML = '';
        }
        // Asignar la función closeModal a ambos botones de cierre
        document.getElementById('closeModalButtonX').onclick = closeModal;
        document.getElementById('closeModalButtonFooter').onclick = closeModal;
        // Cerrar el modal al hacer clic fuera de él
        window.onclick = function(event) {
            if (event.target === document.getElementById('verificationModal')) {
                closeModal();
            }
        };
        // Model al centro
        window.onclick = function(event) {
            if (event.target === document.getElementById('verificationModal')) {
                document.getElementById('verificationModal').classList.add('hidden');
            }
        };

  
        

        /* --- Función para mostrar alertas dentro del modal --- */
        function showModalAlert(message, type = 'error') {
            const modalAlerts = document.getElementById('modalAlerts');
            modalAlerts.innerHTML = ''; // Limpiar alertas anteriores

            const alertDiv = document.createElement('div');
            alertDiv.className =
                `p-3 rounded-md text-sm ${type === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}`;
            alertDiv.textContent = message;
            modalAlerts.appendChild(alertDiv);
        }

        /* --- Función para cerrar el modal --- */
        function closeModal() {
            document.getElementById('verificationModal').classList.add('hidden');
            document.getElementById('verificationCode').value = ''; // Limpiar el campo del código
            document.getElementById('modalAlerts').innerHTML = ''; // Limpiar los mensajes de alerta
        }

        // Asignar la función closeModal a ambos botones de cierre
        document.getElementById('closeModalButtonX').onclick = closeModal;
        document.getElementById('closeModalButtonFooter').onclick = closeModal;

        // Cerrar el modal al hacer clic fuera de él
        window.onclick = function(event) {
            if (event.target === document.getElementById('verificationModal')) {
                closeModal();
            }
        };




        /* --- Función al hacer clic en verificar (ENVÍO DEL CÓDIGO) --- */
        document.getElementById('verifyEmailButton').onclick = function(event) {
            event.preventDefault(); // Evita el envío del formulario

            const emailInput = document.getElementById('email');
            const email = emailInput.value.trim(); // Captura el email y elimina espacios

            if (!email) {
                alert("Por favor, ingresa tu correo electrónico para verificar.");
                return;
            }

            if (!/\S+@\S+\.\S+/.test(email)) { // Validación básica de formato de email
                alert("Por favor, ingresa un correo electrónico válido.");
                return;
            }

            // Aquí hacemos la solicitud al backend para enviar el código
            fetch('/send-verification-code', { // Esta será la nueva ruta en tu backend
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Si usas Laravel o similar
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si el backend dice que el correo se envió con éxito, mostramos el modal
                        document.getElementById('modalEmailDisplay').textContent = email;
                        document.getElementById('verificationModal').classList.remove('hidden');
                        showModalAlert('Se ha enviado un código de verificación a tu correo.', 'success');
                        // Opcional: Deshabilitar el botón de reenvío por un tiempo para evitar spam
                        const resendButton = document.getElementById('resendCodeButton');
                        resendButton.disabled = true;
                        setTimeout(() => {
                            resendButton.disabled = false;
                        }, 60000); // Habilitar después de 60 segundos
                    } else {
                        alert(data.message || 'Error al enviar el código de verificación.');
                        // showModalAlert(data.message || 'Error al enviar el código de verificación.', 'error'); // Si prefieres la alerta dentro del modal
                    }
                })
                .catch(error => {
                    console.error('Error al enviar el código:', error);
                    alert('Ocurrió un error en la comunicación. Intenta de nuevo más tarde.');
                    // showModalAlert('Ocurrió un error en la comunicación. Intenta de nuevo más tarde.', 'error');
                });
        };

        /* --- Función para validar código (ya existente, con mejoras) --- */
        document.getElementById('validateCodeButton').addEventListener('click', function() {
            const code = document.getElementById('verificationCode').value.trim();
            const email = document.getElementById('email').value.trim(); // Obtener el email del campo principal

            if (code.length !== 6 || !/^\d+$/.test(code)) { // Aseguramos 6 dígitos y que sean solo números
                showModalAlert('El código de verificación debe ser un número de 6 dígitos.', 'error');
                return;
            }

            fetch('/validate-verification-code', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email, // Envía el email también para validar
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('password').disabled = false;
                        document.getElementById('password_confirmation').disabled = false;
                        showModalAlert('Código verificado correctamente.', 'success');
                        setTimeout(() => {
                            closeModal(); // Cierra el modal
                        }, 1500);
                    } else {
                        showModalAlert(data.message ||
                            'Código de verificación incorrecto o expirado. Intenta de nuevo.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error en la validación:', error);
                    showModalAlert('Ocurrió un error al validar el código. Por favor, intenta más tarde.',
                        'error');
                });
        });

        /* --- Función para reenviar código (similar al envío inicial) --- */
        document.getElementById('resendCodeButton').addEventListener('click', function() {
            const email = document.getElementById('email').value.trim();

            if (!email || !/\S+@\S+\.\S+/.test(email)) {
                showModalAlert('No se puede reenviar el código sin un correo electrónico válido.', 'error');
                return;
            }

            fetch('/send-verification-code', { // Reutilizamos la misma ruta de envío
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showModalAlert('Se ha reenviado un nuevo código a tu correo.', 'success');
                        document.getElementById('verificationCode').value =
                        ''; // Limpiar el campo para el nuevo código
                        // Deshabilitar el botón de reenvío nuevamente
                        const resendButton = document.getElementById('resendCodeButton');
                        resendButton.disabled = true;
                        setTimeout(() => {
                            resendButton.disabled = false;
                        }, 60000); // Habilitar después de 60 segundos
                    } else {
                        showModalAlert(data.message ||
                            'No se pudo reenviar el código. Intenta de nuevo más tarde.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error al reenviar el código:', error);
                    showModalAlert('Ocurrió un error al reenviar el código. Por favor, intenta más tarde.',
                        'error');
                });
        });


        /* */


        // Cambiar entre tipo de usuario (Cliente/Empresa)
        function initializeUserTypeToggle() {
            document.querySelectorAll('.user-type-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Actualizar selección visual
                    document.querySelectorAll('.user-type-option').forEach(opt => {
                        opt.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Mostrar sección correspondiente
                    const targetId = this.getAttribute('data-target');
                    const clientSection = document.getElementById('client-section');
                    const companySection = document.getElementById('company-section');

                    if (clientSection) clientSection.style.display = 'none';
                    if (companySection) companySection.style.display = 'none';

                    const targetSection = document.getElementById(targetId);
                    if (targetSection) targetSection.style.display = 'block';

                    // Actualizar el valor del tipo de usuario
                    document.querySelectorAll('input[name="user_type"]').forEach(input => {
                        input.disabled = true;
                    });

                    const selectedInput = this.querySelector('input');
                    if (selectedInput) selectedInput.disabled = false;

                    updateRequiredFields();
                });
            });
        }

        // Actualizar texto del input file cuando se selecciona un archivo
        function initializeFileUpload() {
            const logoInput = document.getElementById('logo_empresa');
            if (logoInput) {
                logoInput.addEventListener('change', function() {
                    const fileName = this.files[0]?.name || 'Ningún archivo seleccionado';
                    const nextElement = this.nextElementSibling;
                    if (nextElement) {
                        nextElement.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;
                    }
                });
            }
        }

        // Función para manejar campos requeridos según el tipo de usuario
        function updateRequiredFields() {
            const activeOption = document.querySelector('.user-type-option.active');
            if (!activeOption) return;

            const isCompany = activeOption.getAttribute('data-target') === 'company-section';

            // Campos de cliente
            const clientFields = ['document_type', 'document_number', 'nombres', 'apellidos', 'telefono'];

            // Campos de empresa
            const companyFields = [
                'nombre_empresa', 'ruc', 'razon_social', 'direccion_empresa', 'telefono_empresa',
                'doc_type_representante', 'doc_number_representante', 'nombres_representante', 'apellidos_representante'
            ];

            if (isCompany) {
                // Hacer campos de empresa requeridos
                companyFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) input.required = true;
                });

                // Hacer campos de cliente opcionales
                clientFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) input.required = false;
                });
            } else {
                // Hacer campos de cliente requeridos
                clientFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) input.required = true;
                });

                // Hacer campos de empresa opcionales
                companyFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) input.required = false;
                });
            }
        }

        // Manejar el envío del formulario con AJAX
        function initializeFormSubmission() {
            const registerForm = document.getElementById('registerForm');
            if (!registerForm) return;

            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const button = document.getElementById('registerButton');

                if (!button) return;

                // Cambiar estado del botón
                setButtonLoading(button, true);

                fetch(form.action, {
                        method: form.method,
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.redirect) {
                            // Mostrar modal de éxito o mensaje
                            const successModal = document.getElementById('successModal');
                            if (successModal && typeof bootstrap !== 'undefined') {
                                const modal = new bootstrap.Modal(successModal);
                                modal.show();
                            } else {
                                // Mostrar mensaje de éxito si no hay modal
                                showSuccessMessage(data.message);
                            }

                            // Redirigir después de 3 segundos
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 3000);
                        } else if (!data.success && data.errors) {
                            // Manejar errores de validación
                            displayErrors(data.errors);
                            setButtonLoading(button, false);
                        } else if (!data.success) {
                            // Error general
                            showErrorMessage(data.message || 'Ha ocurrido un error');
                            setButtonLoading(button, false);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        setButtonLoading(button, false);

                        // Mostrar mensaje de error al usuario
                        showErrorMessage('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
                    });
            });
        }

        // Función para cambiar el estado del botón
        function setButtonLoading(button, isLoading) {
            if (isLoading) {
                button.disabled = true;
                button.classList.add('btn-loading');
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registrando...';
            } else {
                button.disabled = false;
                button.classList.remove('btn-loading');
                button.innerHTML = '<i class="fas fa-paper-plane"></i> Registrarse';
            }
        }

        // Función para mostrar errores
        function displayErrors(errors) {
            // Limpiar errores anteriores
            document.querySelectorAll('.error-message').forEach(error => {
                error.remove();
            });

            // Mostrar nuevos errores
            Object.keys(errors).forEach(field => {
                const input = document.getElementById(field);
                if (input) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message text-danger small mt-1';
                    errorDiv.textContent = errors[field][0]; // Primer error del campo
                    input.parentNode.appendChild(errorDiv);
                }
            });
        }

        // Función para mostrar mensaje de éxito
        function showSuccessMessage(message) {
            let successAlert = document.getElementById('dynamic-success-alert');
            if (!successAlert) {
                successAlert = document.createElement('div');
                successAlert.id = 'dynamic-success-alert';
                successAlert.className = 'alert alert-success';
                successAlert.innerHTML = `
                <div class="alert-content">
                    <i class="fas fa-check-circle"></i>
                    <span>${message}</span>
                    <button onclick="closeAlert('dynamic-success-alert')" class="alert-close">&times;</button>
                </div>
            `;

                const form = document.getElementById('registerForm');
                if (form) {
                    form.parentNode.insertBefore(successAlert, form);
                }
            } else {
                successAlert.querySelector('span').textContent = message;
                successAlert.style.display = 'block';
                successAlert.style.opacity = '1';
            }
        }

        // Función para mostrar mensaje de error general
        function showErrorMessage(message) {
            // Crear o actualizar alerta de error
            let errorAlert = document.getElementById('dynamic-error-alert');
            if (!errorAlert) {
                errorAlert = document.createElement('div');
                errorAlert.id = 'dynamic-error-alert';
                errorAlert.className = 'alert alert-error';
                errorAlert.innerHTML = `
                <div class="alert-content">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>${message}</span>
                    <button onclick="closeAlert('dynamic-error-alert')" class="alert-close">&times;</button>
                </div>
            `;

                const form = document.getElementById('registerForm');
                if (form) {
                    form.parentNode.insertBefore(errorAlert, form);
                }
            } else {
                errorAlert.querySelector('span').textContent = message;
                errorAlert.style.display = 'block';
                errorAlert.style.opacity = '1';
            }
        }

        // Función para cerrar alertas
        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }
        }

        // Inicializar manejo de alertas
        function initializeAlerts() {
            // Auto-cerrar alerts después de 5 segundos (excepto los dinámicos de error)
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    // No auto-cerrar alertas de error específicas
                    if (!alert.id.includes('error') && !alert.id.includes('Error')) {
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 300);
                    }
                });
            }, 5000);
        }

        // Exponer funciones globales necesarias
        window.closeAlert = closeAlert;
    </script>
</body>

</html>
