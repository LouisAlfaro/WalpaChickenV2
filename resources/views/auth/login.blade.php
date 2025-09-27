<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Walpa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --color-fondo-primario: #210303;
            --color-fondo-secundario: #d03336;
            --color-fondo-terciario: #fec601;
            --color-fondo-cuaternario: #ffffff;
            --color-fondo-quinario: #e9e9e9;
            --color-fondo-senario: #b18322;
            --color-texto-primario: #210303;
            --color-texto-cuaternario: #ffffff;
        }
        
        body {
            background: linear-gradient(135deg, var(--color-fondo-primario) 0%, #3a0808 50%, var(--color-fondo-primario) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }
        
        .login-container {
            background: var(--color-fondo-cuaternario);
            border-radius: 25px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 0 1rem;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--color-fondo-terciario), var(--color-fondo-senario));
            padding: 3rem 2rem;
            text-align: center;
            color: var(--color-texto-primario);
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff" opacity="0.1"/><circle cx="60" cy="40" r="1.5" fill="%23ffffff" opacity="0.1"/><circle cx="80" cy="70" r="2.5" fill="%23ffffff" opacity="0.1"/></svg>');
            background-size: 200px 200px;
        }
        
        .login-header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .login-header p {
            margin: 1rem 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .login-body {
            padding: 3rem 2.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--color-texto-primario);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-control {
            border: 2px solid var(--color-fondo-quinario);
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }
        
        .form-control:focus {
            border-color: var(--color-fondo-terciario);
            box-shadow: 0 0 0 0.2rem rgba(254, 198, 1, 0.15);
            background-color: var(--color-fondo-cuaternario);
            transform: translateY(-1px);
        }
        
        .form-control.is-invalid {
            border-color: var(--color-fondo-secundario);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--color-fondo-primario), #3a0808);
            color: var(--color-texto-cuaternario);
            border: none;
            font-weight: bold;
            padding: 1rem;
            border-radius: 12px;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #3a0808, var(--color-fondo-primario));
            color: var(--color-texto-cuaternario);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(33,3,3,0.3);
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 2rem;
        }
        
        .alert-danger {
            background-color: #ffe6e6;
            color: var(--color-fondo-secundario);
        }
        
        .form-check {
            margin: 1.5rem 0;
        }
        
        .form-check-input:checked {
            background-color: var(--color-fondo-terciario);
            border-color: var(--color-fondo-terciario);
        }
        
        .form-check-label {
            color: #6c757d;
            font-size: 0.95rem;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--color-fondo-quinario);
        }
        
        .auth-links a {
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            margin: 0 0.5rem;
        }
        
        .auth-links a:hover {
            color: var(--color-fondo-primario);
            text-decoration: underline;
        }
        
        .back-to-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 1000;
        }
        
        .back-to-home a {
            background: rgba(255,255,255,0.1);
            color: var(--color-texto-cuaternario);
            padding: 0.8rem 1.2rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .back-to-home a:hover {
            background: rgba(255,255,255,0.2);
            color: var(--color-texto-cuaternario);
            transform: translateY(-2px);
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="back-to-home">
        <a href="{{ route('home') }}">
            <i class="fas fa-arrow-left me-2"></i>
            Volver al inicio
        </a>
    </div>

    <div class="login-container">
        <div class="login-header">
            <h1>Walpa</h1>
            <p>Accede a tu cuenta</p>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>
                        Correo Electrónico
                    </label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email"
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus
                           placeholder="Ingresa tu correo electrónico">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>
                        Contraseña
                    </label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password"
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Ingresa tu contraseña">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" 
                           type="checkbox" 
                           name="remember" 
                           id="remember" 
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Mantener sesión iniciada
                    </label>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Iniciar Sesión
                </button>
            </form>
            
            <div class="auth-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <i class="fas fa-key me-1"></i>
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
                
                @if (Route::has('register'))
                    <br><br>
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>
                        ¿No tienes cuenta? Regístrate
                    </a>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>