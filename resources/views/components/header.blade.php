<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Réservation</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #8338ec;
            --accent-color: #ff006e;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        /* Gradient Animated Header */
        .header-container {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Top Bar */
        .top-bar {
            background: rgba(0, 0, 0, 0.1);
            padding: 8px 0;
            font-size: 14px;
        }
        
        .top-bar i {
            margin-right: 5px;
            color: var(--accent-color);
        }
        
        .social-icons a {
            color: white;
            margin-left: 12px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        /* Navbar */
        .navbar {
            padding: 15px 0;
            background: transparent !important;
        }
        
        .navbar-brand {
            font-size: 28px;
            font-weight: 700;
            color: white !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 8px;
            position: relative;
            padding: 8px 12px !important;
        }
        
        .nav-link:before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-color);
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover:before {
            visibility: visible;
            width: 100%;
        }
        
        .nav-link:hover {
            color: white !important;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        .dropdown-item:active {
            background-color: var(--primary-color);
        }
        
        /* Hero Text */
        .hero-text {
            padding: 100px 0 150px;
            text-align: center;
        }
        
        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .hero-text p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        /* Floating elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }
        
        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-text {
                padding: 80px 0 120px;
            }
            
            .hero-text h1 {
                font-size: 2.5rem;
            }
            
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                padding: 15px;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Container -->
    <div class="header-container">
        <!-- Floating background elements -->
        <div class="floating-elements">
            <div class="floating-element" style="width: 150px; height: 150px; top: 10%; left: 5%;"></div>
            <div class="floating-element" style="width: 80px; height: 80px; top: 70%; left: 80%;"></div>
            <div class="floating-element" style="width: 200px; height: 200px; top: 40%; left: 60%;"></div>
        </div>
        
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap">
                            <div class="me-4"><i class="fas fa-phone-alt"></i> 51025256</div>
                            <div class="me-4"><i class="fas fa-envelope"></i> Heznimaak@gmail.com</div>
                            <div><i class="fas fa-map-marker-alt"></i> Route de Djerba, Zarzis</div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="social-icons">
                            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <i class="fas fa-taxi"></i> Taxi Réservation
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Qui nous sommes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                        @if(Auth::check() && Auth::user()->role === 'chauffeur')
                            <li class="nav-item"><a class="nav-link" href="{{ route('chauffeur.dashbord') }}">Tableau de bord</a></li>
                        @elseif(!Auth::check() )
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Devenir Chauffeur</a></li>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'client')
                            <li class="nav-item"><a class="nav-link" href="{{ route('reservations.client',Auth::id()) }}">Historique</a></li>
                        @endif
                    </ul>
                    <ul class="navbar-nav">
                        @if(Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Se déconnecter</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Connexion</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>Inscription</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Text -->
        <div class="hero-text container">
            <h1>Bienvenue chez Taxi Réservation</h1>
            <p>Votre solution de transport personnalisée, rapide et sécurisée</p>
            <a href="reservation-card" class="btn btn-light btn-lg px-4 me-2" style="background-color: var(--accent-color); border-color: var(--accent-color); color: white;">
                <i class="fas fa-taxi me-2"></i>Réserver maintenant
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-user-plus me-2"></i>Devenir chauffeur
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>