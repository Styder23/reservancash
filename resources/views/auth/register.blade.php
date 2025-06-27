<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Turismo Natural</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #7e22ce;
            --color-primary-light: #a855f7;
            --color-primary-dark: #581c87;
            --color-secondary: #9333ea;
            --color-accent: #e879f9;
            --color-dark: #1e1b4b;
            --color-darker: #0f172a;
            --color-light: #cbd5e1;
            --color-lighter: #f1f5f9;
            --color-text: #e2e8f0;
            --color-text-dark: #94a3b8;
            --color-success: #10b981;
            --color-error: #ef4444;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-darker);
            color: var(--color-text);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.5;
        }

        .auth-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: radial-gradient(circle at 10% 20%, var(--color-primary-dark), var(--color-darker));
        }

        .auth-card {
            width: 100%;
            max-width: 900px;
            background-color: rgba(30, 27, 75, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(126, 34, 206, 0.3);
        }

        .auth-card-header {
            padding: 2rem;
            text-align: center;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            position: relative;
        }

        .auth-card-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            transform: skewY(-2deg);
            z-index: 1;
        }

        .logo-container {
            margin-bottom: 1.5rem;
        }

        .logo-icon {
            font-size: 3rem;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .auth-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: white;
            position: relative;
            z-index: 2;
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .auth-card-body {
            padding: 2.5rem;
            position: relative;
            z-index: 2;
        }

        .form-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(126, 34, 206, 0.2);
            padding-bottom: 1.5rem;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-accent);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            font-size: 1.4rem;
        }

        .user-type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .user-type-option {
            flex: 1;
            padding: 1.5rem 1rem;
            text-align: center;
            background-color: rgba(126, 34, 206, 0.1);
            border: 2px solid rgba(126, 34, 206, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-type-option:hover {
            background-color: rgba(126, 34, 206, 0.2);
            border-color: var(--color-primary-light);
        }

        .user-type-option.active {
            background-color: rgba(126, 34, 206, 0.3);
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.3);
        }

        .user-type-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--color-accent);
        }

        .user-type-label {
            font-weight: 500;
            color: var(--color-text);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--color-text);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(126, 34, 206, 0.3);
            border-radius: 8px;
            color: var(--color-text);
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary-light);
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.3);
            background-color: rgba(15, 23, 42, 0.7);
        }

        .input-group {
            display: flex;
            align-items: center;
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(126, 34, 206, 0.3);
            border-radius: 8px;
            overflow: hidden;
        }

        .input-group-prepend {
            padding: 0.75rem 1rem;
            background-color: rgba(126, 34, 206, 0.3);
            color: var(--color-accent);
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
            padding: 0.75rem 1rem;
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px dashed rgba(126, 34, 206, 0.5);
            border-radius: 8px;
            color: var(--color-text-dark);
            transition: all 0.3s;
        }

        .form-file-label:hover {
            background-color: rgba(15, 23, 42, 0.7);
            border-color: var(--color-primary-light);
            color: var(--color-text);
        }

        .form-file-label i {
            margin-right: 0.5rem;
        }

        .auth-card-footer {
            padding: 1.5rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(15, 23, 42, 0.5);
            border-top: 1px solid rgba(126, 34, 206, 0.2);
        }

        .auth-link {
            color: var(--color-accent);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-link:hover {
            color: var(--color-primary-light);
            text-decoration: underline;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-light);
            box-shadow: 0 4px 15px rgba(126, 34, 206, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-card {
                max-width: 100%;
                border-radius: 0;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .user-type-selector {
                flex-direction: column;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .full-width {
            grid-column: 1 / -1;
        }
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
            <div class="auth-card-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-mountain"></i>
                    </div>
                </div>
                <h1 class="auth-title">Turismo Natural</h1>
                <p class="auth-subtitle">Regístrate y empieza a explorar</p>
            </div>

            <div class="auth-card-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <!-- Tipo de Usuario -->
                    <div class="form-section delay-100">
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
                    <div id="client-section" class="form-section delay-200">
                        <h3 class="section-title"><i class="fas fa-id-card"></i> Información Personal</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="document_type">Tipo de Documento</label>
                                <select class="form-control" id="document_type" name="document_type" required>
                                    <option value="dni">DNI</option>
                                    {{-- <option value="ce">Carnet de Extranjería</option>
                                    <option value="passport">Pasaporte</option> --}}
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
                                    <input class="form-control" type="text" id="apellidos" name="apellidos" required>
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
                        <!-- Información de la Empresa -->
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

                        <!-- Representante Legal -->
                        <h3 class="section-title"><i class="fas fa-user-tie"></i> Representante Legal</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="doc_type_representante">Tipo de Documento</label>
                                <select class="form-control" id="doc_type_representante"
                                    name="doc_type_representante">
                                    <option value="dni">DNI</option>
                                    {{-- <option value="ce">Carnet de Extranjería</option>
                                    <option value="passport">Pasaporte</option> --}}
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

                    <!-- Datos de la Cuenta (comunes para ambos) -->
                    <div class="form-section delay-200">
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
                            <div class="form-group">
                                <label class="form-label" for="password">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input class="form-control" type="password" id="password" name="password"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="auth-card-footer">
                        <a class="auth-link" href="{{ route('login') }}">
                            <i class="fas fa-arrow-left"></i> ¿Ya tienes una cuenta? Inicia sesión
                        </a>
                        <button type="submit" class="btn btn-primary" id="registerButton">
                            <i class="fas fa-paper-plane"></i> Registrarse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de confirmación --}}
    {{-- <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Registro exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Usuario creado correctamente. Serás redirigido a la página de login.</p>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        // Cambiar entre tipo de usuario (Cliente/Empresa)
        document.querySelectorAll('.user-type-option').forEach(option => {
            option.addEventListener('click', function() {
                // Actualizar selección visual
                document.querySelectorAll('.user-type-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');

                // Mostrar sección correspondiente
                const targetId = this.getAttribute('data-target');
                document.getElementById('client-section').style.display = 'none';
                document.getElementById('company-section').style.display = 'none';
                document.getElementById(targetId).style.display = 'block';

                // Actualizar el valor del tipo de usuario
                document.querySelectorAll('input[name="user_type"]').forEach(input => {
                    input.disabled = true;
                });
                this.querySelector('input').disabled = false;
                updateRequiredFields();
            });
        });

        // Actualizar texto del input file cuando se selecciona un archivo
        document.getElementById('logo_empresa').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Ningún archivo seleccionado';
            this.nextElementSibling.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;
        });

        // Animación de carga
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.animate-fade-in').forEach(el => {
                el.style.opacity = '0';
            });
        });

        // Función para manejar campos requeridos según el tipo de usuario
        function updateRequiredFields() {
            const isCompany = document.querySelector('.user-type-option.active').getAttribute('data-target') ===
                'company-section';

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
        document.addEventListener('DOMContentLoaded', updateRequiredFields);

        // para el ajax del formulario
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const button = document.getElementById('registerButton');
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registrando...';

            fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        // Mostrar modal de éxito
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        // Redirigir después de 3 segundos
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-paper-plane"></i> Registrarse';
                });
        });
    </script>
</body>

</html>
