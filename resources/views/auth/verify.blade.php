<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email - Walpa</title>
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
        
        .verify-container {
            background: var(--color-fondo-cuaternario);
            border-radius: 25px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            margin: 0 1rem;
        }
        
        .verify-header {
            background: linear-gradient(135deg, var(--color-fondo-terciario), var(--color-fondo-senario));
            padding: 3rem 2rem;
            text-align: center;
            color: var(--color-texto-primario);
            position: relative;
        }
        
        .verify-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff" opacity="0.1"/><circle cx="60" cy="40" r="1.5" fill="%23ffffff" opacity="0.1"/><circle cx="80" cy="70" r="2.5" fill="%23ffffff" opacity="0.1"/></svg>');
            background-size: 200px 200px;
        }
        
        .verify-header .icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .verify-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .verify-header p {
            margin: 1rem 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .verify-body {
            padding: 3rem 2.5rem;
            text-align: center;
        }
        
        .verify-message {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 2rem;
        }
        
        .btn-resend {
            background: linear-gradient(135deg, var(--color-fondo-primario), #3a0808);
            color: var(--color-texto-cuaternario);
            border: none;
            font-weight: bold;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            margin: 0.5rem;
        }
        
        .btn-resend::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-resend:hover {
            background: linear-gradient(135deg, #3a0808, var(--color-fondo-primario));
            color: var(--color-texto-cuaternario);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(33,3,3,0.3);
            text-decoration: none;
        }
        
        .btn-resend:hover::before {
            left: 100%;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 2rem;
        }
        
        .alert-success {
            background-color: #e8f5e8;
            color: #2d5a2d;
            border-left: 4px solid #28a745;
        }
        
        .email-icon {
            font-size: 5rem;
            color: var(--color-fondo-terciario);
            margin-bottom: 2rem;
            opacity: 0.8;
        }
        
        .steps {
            text-align: left;
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin: 2rem 0;
        }
        
        .steps h5 {
            color: var(--color-texto-primario);
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .steps ol {
            margin: 0;
            padding-left: 1.5rem;
        }
        
        .steps li {
            margin-bottom: 0.5rem;
            color: #666;
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
    </style>
</head>
<body>
    <div class="back-to-home">
        <a href="{{ route('home') }}">
            <i class="fas fa-arrow-left me-2"></i>
            Volver al inicio
        </a>
    </div>

    <div class="verify-container">
        <div class="verify-header">
            <div class="icon">
                <i class="fas fa-envelope-open"></i>
            </div>
            <h1>Walpa</h1>
            <p>Verifica tu correo electrónico</p>
        </div>
        
        <div class="verify-body">
            @if (session('resent'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                </div>
            @endif

            <div class="email-icon">
                <i class="fas fa-mail-bulk"></i>
            </div>

            <div class="verify-message">
                <p><strong>¡Casi terminamos!</strong></p>
                <p>Antes de continuar, por favor revisa tu correo electrónico y haz clic en el enlace de verificación que te hemos enviado.</p>
            </div>

            <div class="steps">
                <h5><i class="fas fa-list-check me-2"></i>Pasos a seguir:</h5>
                <ol>
                    <li>Revisa tu bandeja de entrada</li>
                    <li>Busca el correo de Walpa</li>
                    <li>Haz clic en el enlace de verificación</li>
                    <li>¡Listo! Ya podrás acceder a tu cuenta</li>
                </ol>
            </div>

            <p class="text-muted">¿No recibiste el correo?</p>
            
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn-resend">
                    <i class="fas fa-paper-plane me-2"></i>
                    Enviar nuevo enlace
                </button>
            </form>
            
            <div class="auth-links">
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>
                    Volver al inicio de sesión
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>