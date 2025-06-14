<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Réservation</title>
    <!-- Inclure votre CSS personnalisé -->
    <!-- Inclure Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    
 .header-merged {
    background-image: url('/images/header.png'); /* Chemin vers votre image */
    background-size: cover;
    background-position: center;
    color: white; /* Texte blanc pour la visibilité */
    position: relative;
    padding-top: 10px;
    padding-bottom: 150px; /* Ajoutez de l'espace pour le texte */
 }

/* Top-bar */
 .top-bar {
    background: rgba(0, 0, 0, 0.05); /* Fond semi-transparent */
    color: white;
    padding:0;
    font-size: 14px;
 }

/* Navbar */
 .navbar {
    background: rgba(0, 0, 0, 0.05); /* Fond semi-transparent */
    padding: 10px 0;
    box-shadow: none;
 } 

 .navbar .nav-link {
    color: white !important;
    font-weight: 500;
 }

 .navbar .nav-link:hover {
    color: #ffd700 !important;
    background-color:  rgba(0, 0, 0,0.2); /* Jaune lors du survol */
 }

 .navbar-brand {
    font-size: 24px;
    font-weight: bold;
    color: #ffd700 !important; /* Logo en jaune */
 }

/* Texte sur l'image */
 .header-text {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
 }

 .header-text h1 {
    font-size: 36px;
    font-weight: bold;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
 }

 .header-text p {
    font-size: 18px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
 }

    </style>
</head>
<body>
    <!-- Header Fusionné -->
    <header class="header-merged">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="me-3"><i class="fas fa-phone-alt"></i> <span>51025256</span></div>
                    <div class="me-3"><i class="fas fa-envelope"></i> <span>Heznimaak@gmail.com</span></div>
                    <div><i class="fas fa-map-marker-alt"></i> <span>Route de Djerba, Zarzis</span></div>
                </div>
                <div>
                    <a href="https://facebook.com" target="_blank" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">Taxi Réservation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Qui nous sommes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                        @if(Auth::check() && Auth::user()->role === 'chauffeur')
                            <li class="nav-item"><a class="nav-link" href="{{ route('chauffeur.dashbord') }}">Tableau de bord Chauffeur</a></li>
                        @elseif(!Auth::check())
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Devenir Chauffeur</a></li>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'client')
                        <li class="nav-item"><a class="nav-link" href="{{ route('reservations.client',Auth::id()) }}">Historique Reservation</a></li>
                        
                        @endif
                  
                    </ul>
                    <ul class="navbar-nav">
                        @if(Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Se déconnecter</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Se connecter</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">S'inscrire</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Texte dans l'image -->
        <div class="header-text container">
            <h1>Bienvenue chez Taxi Réservation</h1>
            <p>Votre solution de transport personnalisée</p>
        </div>
    </header>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
