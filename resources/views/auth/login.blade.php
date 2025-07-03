<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Taxi Réservation</title>
    @include('components.header-styles')
    
    <style>
        /* Auth Page Styles */
        .auth-container {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        
        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 40px;
        }
        
        .auth-left-content {
            max-width: 500px;
        }
        
        .auth-left h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .auth-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }
        
        .auth-title {
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2rem;
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .auth-logo i {
            font-size: 3rem;
            color: var(--accent-color);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
        }
        
        .btn-auth {
            background: var(--accent-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-auth:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 20px;
        }
        
        .auth-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .auth-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .remember-me input {
            margin-right: 10px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .auth-container {
                flex-direction: column;
            }
            
            .auth-left, .auth-right {
                padding: 30px 20px;
            }
            
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side (Illustration) -->
        <div class="auth-left">
            <div class="auth-left-content">
                <h2>Bienvenue à nouveau !</h2>
                <p>Connectez-vous pour accéder à votre compte et profiter de nos services de réservation de taxi.</p>
                <div>
                    <i class="fas fa-taxi fa-4x" style="opacity: 0.8;"></i>
                </div>
            </div>
        </div>
        
        <!-- Right Side (Form) -->
        <div class="auth-right">
            <div class="auth-card">
                <div class="auth-logo">
                    <i class="fas fa-taxi"></i>
                </div>
                <h2 class="auth-title">Connexion</h2>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Se souvenir de moi</label>
                    </div>
                    
                    <button type="submit" class="btn btn-auth mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </button>
                    
                    <div class="auth-footer">
                        <p>Pas encore de compte ? <a href="{{ route('register') }}" class="auth-link">Créer un compte</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>