<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Taxi Réservation</title>
    @include('components.header-styles')
    
    <style>
        /* Main Content Styles */
        .main-content {
            padding: 60px 0;
            background-color: #f8f9fa;
        }
        
        /* Reservation Section */
        .reservation-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .reservation-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }
        
        .reservation-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
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
        
        .btn-reserve {
            background: var(--accent-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-reserve:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        /* Results Section */
        .results-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 30px;
        }
        
        .results-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 25px;
        }
        
        .taxi-item {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
            transition: background 0.3s;
        }
        
        .taxi-item:hover {
            background: rgba(58, 134, 255, 0.05);
        }
        
        .taxi-item:last-child {
            border-bottom: none;
        }
        
        .taxi-info {
            margin-bottom: 15px;
        }
        
        .taxi-info strong {
            color: var(--dark-color);
        }
        
        .btn-book {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-book:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: var(--secondary-color);
            color: white;
        }
        
        /* Alert Styles */
        .reservation-alert {
            border-radius: 10px;
            border-left: 5px solid #28a745;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .reservation-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    @include('components.header')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Reservation Section -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="reservation-card" id="reservation-card">
                        <h2 class="reservation-title">Réservez votre taxi maintenant</h2>
                        
                        <!-- Confirmation Alert -->
                        @if(session('reservation_confirmed'))
                            <div id="reservation-alert" class="alert alert-success reservation-alert alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading"><i class="fas fa-check-circle me-2"></i>Réservation Confirmée</h4>
                                <p>Votre réservation a été enregistrée avec succès !</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <!-- Search Form -->
                        @if(!isset($taxis))
                            <form action="{{ route('taxi.recherche') }}" method="GET">
                                @csrf
                                <div class="mb-3">
                                    <label for="adresse_dep" class="form-label">Adresse de départ :</label>
                                    <input type="text" class="form-control" name="adresse_dep" id="adresse_dep" placeholder="Entrez l'adresse de départ" required>
                                </div>
                                <div class="mb-3">
                                    <label for="adresse_arr" class="form-label">Adresse d'arrivée :</label>
                                    <input type="text" class="form-control" name="adresse_arr" id="adresse_arr" placeholder="Entrez l'adresse d'arrivée" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="date_res" class="form-label">Date de réservation :</label>
                                        <input type="date" class="form-control" name="date_res" id="date_res" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="heure_res" class="form-label">Heure de réservation :</label>
                                        <input type="time" class="form-control" name="heure_res" id="heure_res" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-reserve">
                                    <i class="fas fa-search me-2"></i>Chercher un taxi
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <!-- Results Section -->
                    @if(isset($taxis))
                        <div class="results-container">
                            <h3 class="results-title"><i class="fas fa-taxi me-2"></i>Résultats de la Recherche</h3>
                            @if($taxis->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Aucun taxi trouvé à l'adresse : {{ $adresse_dep }}.
                                </div>
                            @else
                                <div class="taxi-list">
                                    @foreach($taxis as $taxi)
                                        <div class="taxi-item">
                                            <div class="taxi-info">
                                                <p><strong><i class="fas fa-car me-2"></i>Matricule :</strong> {{ $taxi->matricule }}</p>
                                                <p><strong><i class="fas fa-tag me-2"></i>Modèle :</strong> {{ $taxi->modele }}</p>
                                                <p><strong><i class="fas fa-map-marker-alt me-2"></i>Adresse :</strong> {{ $taxi->adresse }}</p>
                                                <p>
                                                    <strong><i class="fas fa-circle me-2"></i>Disponibilité :</strong> 
                                                    <span class="badge bg-{{ $taxi->disponible ? 'success' : 'danger' }}">
                                                        {{ $taxi->disponible ? 'Disponible' : 'Indisponible' }}
                                                    </span>
                                                </p>
                                            </div>
                                            
                                            @if(Auth::check() && Auth::user()->role === 'client')
                                                <form action="{{ route('reservation.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="taxi_id" value="{{ $taxi->id }}">
                                                    <input type="hidden" name="adresse_dep" value="{{ $adresse_dep ?? '' }}">
                                                    <input type="hidden" name="adresse_arr" value="{{ $adresse_arr ?? '' }}">
                                                    <input type="hidden" name="date_res" value="{{ request('date_res') }}">
                                                    <input type="hidden" name="heure_res" value="{{ request('heure_res') }}">
                                                    <button type="submit" class="btn btn-book">
                                                        <i class="fas fa-calendar-check me-2"></i>Réserver
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-book btn-login">
                                                    <i class="fas fa-sign-in-alt me-2"></i>Connectez-vous pour réserver
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-dismiss alert after 5 seconds
        setTimeout(function() {
            var alert = document.getElementById('reservation-alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
</body>
</html>