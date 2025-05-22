<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Turismo Natural</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #2E7D32;
            /* Verde bosque */
            --color-secondary: #66BB6A;
            /* Verde claro */
            --color-accent: #FFC107;
            /* Amarillo cálido */
            --color-light: #E8F5E9;
            /* Verde muy claro */
            --color-dark: #1B5E20;
            /* Verde oscuro */
            --color-water: #2196F3;
            /* Azul agua */
            --color-text: #212121;
            --color-white: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
                url('/api/placeholder/1600/900') no-repeat center center fixed;
            background-size: cover;
            color: var(--color-text);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .authentication-card {
            max-width: 800px;
            margin: 2rem auto;
            background-color: var(--color-white);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .authentication-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(to right, var(--color-primary), var(--color-accent), var(--color-water));
        }

        .card-header {
            padding: 1.5rem;
            text-align: center;
            background-color: var(--color-light);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .card-logo {
            margin-bottom: 1rem;
            display: inline-block;
        }

        .logo-icon {
            font-size: 3rem;
            color: var(--color-primary);
            background: var(--color-light);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid var(--color-primary);
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 1rem 0 0;
            color: var(--color-primary);
        }

        .card-subtitle {
            color: var(--color-dark);
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .validation-errors {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #FFEBEE;
            border-left: 4px solid #F44336;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--color-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #E0E0E0;
            border-radius: 6px;
            background-color: #FAFAFA;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
            background-color: var(--color-white);
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group-prepend {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background-color: var(--color-light);
            border: 1px solid #E0E0E0;
            border-right: none;
            border-radius: 6px 0 0 6px;
            color: var(--color-primary);
        }

        .input-group .form-control {
            border-radius: 0 6px 6px 0;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .form-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
        }

        .checkbox-text {
            font-size: 0.9rem;
        }

        .user-type-selection {
            display: flex;
            margin-bottom: 1.5rem;
        }

        .user-type-option {
            flex: 1;
            padding: 1rem;
            text-align: center;
            background-color: #F5F5F5;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            margin-right: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-type-option:last-child {
            margin-right: 0;
        }

        .user-type-option.active {
            background-color: var(--color-light);
            border-color: var(--color-primary);
        }

        .user-type-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--color-dark);
        }

        .user-type-option.active .user-type-icon {
            color: var(--color-primary);
        }

        .user-type-label {
            font-weight: 500;
            color: var(--color-dark);
        }

        .company-fields,
        .client-fields {
            display: none;
            padding: 1rem;
            background-color: var(--color-light);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .company-fields.active,
        .client-fields.active {
            display: block;
        }

        .form-row {
            display: flex;
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }

        .form-col {
            flex: 1;
            padding: 0 0.5rem;
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
            background-color: #F5F5F5;
            border: 1px dashed #9E9E9E;
            border-radius: 6px;
            text-align: center;
            color: #616161;
            transition: all 0.3s;
        }

        .form-file-label i {
            margin-right: 0.5rem;
        }

        .form-file-input:hover+.form-file-label {
            background-color: var(--color-light);
            border-color: var(--color-secondary);
            color: var(--color-primary);
        }

        .card-footer {
            padding: 1.5rem 2rem;
            background-color: #FAFAFA;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-link {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .text-link:hover {
            color: var(--color-dark);
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-dark);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .authentication-card {
                margin: 1rem;
                width: auto;
            }

            .form-row {
                flex-direction: column;
            }

            .form-col {
                margin-bottom: 1rem;
            }

            .user-type-selection {
                flex-direction: column;
            }

            .user-type-option {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="authentication-card">
        <div class="card-header">
            <div class="card-logo">
                <div class="logo-icon">
                    <i class="fas fa-mountain"></i>
                </div>
            </div>
            <h2 class="card-title">Turismo Natural</h2>
            <p class="card-subtitle">Regístrate y empieza a explorar</p>
        </div>

        <div class="card-body">
            <div class="validation-errors" style="display: none;">
                <!-- Aquí irían los errores de validación -->
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Tipo de Usuario -->
                <h3><i class="fas fa-user-circle"></i> Tipo de Usuario</h3>
                <div class="user-type-selection">
                    <div class="user-type-option active" data-target="client-fields">
                        <div class="user-type-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-type-label">Cliente</div>
                    </div>
                    <div class="user-type-option" data-target="company-fields">
                        <div class="user-type-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="user-type-label">Empresa</div>
                    </div>
                </div>

                <!-- Campos específicos para Cliente -->
                <div class="client-fields active">
                    <h3><i class="fas fa-id-card"></i> Información Personal</h3>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="document_type">Tipo de Documento</label>
                                <select class="form-control" id="document_type" name="document_type" required>
                                    <option value="dni">DNI</option>
                                    <option value="ce">Carnet de Extranjería</option>
                                    <option value="passport">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="document_number">Número de Documento</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <input class="form-control" type="text" id="document_number"
                                        name="document_number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campos específicos para Empresa -->
                <div class="company-fields">
                    <h3><i class="fas fa-building"></i> Información de la Empresa</h3>

                    <div class="form-group">
                        <label class="form-label" for="ruc">RUC</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <i class="fas fa-hashtag"></i>
                            </span>
                            <input class="form-control" type="text" id="ruc" name="ruc">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="business_name">Razón Social</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <i class="fas fa-trademark"></i>
                            </span>
                            <input class="form-control" type="text" id="business_name" name="business_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="company_logo">Logo de la Empresa</label>
                        <div class="form-file">
                            <input type="file" class="form-file-input" id="company_logo" name="company_logo"
                                accept="image/*">
                            <label class="form-file-label" for="company_logo">
                                <i class="fas fa-cloud-upload-alt"></i> Subir Logo
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Campos comunes para ambos tipos de usuario -->
                <h3><i class="fas fa-user-circle"></i> Datos de la Cuenta</h3>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="name">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input class="form-control" type="text" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="phone">Teléfono/Celular</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input class="form-control" type="tel" id="phone" name="phone" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="password">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
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

                {{-- <div class="form-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" class="form-checkbox" id="terms" name="terms" required>
                        <label class="checkbox-text" for="terms">
                            Acepto los <a href="{{ route('terms.show') }}" class="text-link" target="_blank">Términos
                                de Servicio</a> y la <a href="{{ route('policy.show') }}" class="text-link"
                                target="_blank">Política de Privacidad</a>
                        </label>
                    </div>
                </div> --}}

                <div class="card-footer">
                    <a class="text-link" href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> ¿Ya estás registrado?
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Cambiar entre tipo de usuario (Cliente/Empresa)
        document.querySelectorAll('.user-type-option').forEach(option => {
            option.addEventListener('click', function() {
                // Actualizar selección visual
                document.querySelectorAll('.user-type-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');

                // Mostrar campos correspondientes
                const targetId = this.getAttribute('data-target');
                document.querySelectorAll('.client-fields, .company-fields').forEach(field => {
                    field.classList.remove('active');
                });
                document.querySelector('.' + targetId).classList.add('active');
            });
        });

        // Actualizar texto del input file cuando se selecciona un archivo
        document.getElementById('company_logo').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Ningún archivo seleccionado';
            this.nextElementSibling.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;
        });
    </script>
</body>

</html>
