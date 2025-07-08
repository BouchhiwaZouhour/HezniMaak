<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Taxi Réservation</title>
    @include('components.header-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    
    <style>
         #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1;
        }

        .address-selector {
            display: flex;
            margin-bottom: 15px;
            gap: 10px;
        }

        .address-selector button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .address-selector button.active {
            background: #ff8200;
            color: white;
        }

        .address-selector button:not(.active) {
            background: #f0f0f0;
            color: #333;
        }

        .geo-info-container {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .geo-info-item {
            text-align: center;
            flex: 1;
        }

        .geo-info-item i {
            color: #ff8200;
            font-size: 1.5rem;
            margin-bottom: 5px;
            display: block;
        }

        .geo-info-value {
            font-weight: 600;
            color: #333;
        }

        .geo-info-label {
            font-size: 0.9rem;
            color: #666;
        }

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
            
            .geo-info-container {
                flex-direction: column;
                gap: 10px;
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
                            <form action="{{ route('taxi.recherche') }}" method="GET" id="reservation-form">
                                @csrf
                                <!-- Sélecteur d'adresse -->
                            <div class="address-selector">
                                <button type="button" id="select-departure" class="active">
                                    <i class="fas fa-map-marker-alt"></i> Sélectionner le départ
                                </button>
                                <button type="button" id="select-arrival">
                                    <i class="fas fa-flag"></i> Sélectionner l'arrivée
                                </button>
                            </div>
                            
                            <!-- Carte centrée sur la Tunisie -->
                            <div id="map"></div>
                            
                            <!-- Info trajet -->
                            <div class="geo-info-container">
                                <div class="geo-info-item">
                                    <i class="fas fa-road"></i>
                                    <div class="geo-info-value" id="distance">-- km</div>
                                    <div class="geo-info-label">Distance</div>
                                </div>
                                <div class="geo-info-item">
                                    <i class="fas fa-clock"></i>
                                    <div class="geo-info-value" id="duration">-- min</div>
                                    <div class="geo-info-label">Durée</div>
                                </div>
                            </div>
                            
                            <!-- Champs d'adresse -->
                            <div class="mb-3">
                                <label for="adresse_dep" class="form-label">Adresse de départ :</label>
                                <input type="text" class="form-control" name="adresse_dep" id="adresse_dep" required >
                                <input type="hidden" name="dep_lat" id="dep_lat">
                                <input type="hidden" name="dep_lng" id="dep_lng">
                            </div>
                            <div class="mb-3">
                                <label for="adresse_arr" class="form-label">Adresse d'arrivée :</label>
                                <input type="text" class="form-control" name="adresse_arr" id="adresse_arr" required readonly>
                                <input type="hidden" name="arr_lat" id="arr_lat">
                                <input type="hidden" name="arr_lng" id="arr_lng">
                            </div>
                            
                              <!-- Date et heure -->
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
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    
    <script>
    // Déclaration des variables globales
    let map, departureMarker, arrivalMarker, routeLayer;
    let currentSelection = 'departure';
    const geocoder = L.Control.Geocoder.nominatim();
    
    // Fonction pour obtenir une adresse détaillée avec Nominatim
    async function getDetailedAddress(latlng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}&zoom=18&addressdetails=1`);
            const data = await response.json();
            
            if (data.address) {
                const addr = data.address;
                // Construction de l'adresse avec les éléments les plus précis
                let addressParts = [];
                
                if (addr.road) addressParts.push(addr.road);
                if (addr.village) addressParts.push(addr.village);
                else if (addr.town) addressParts.push(addr.town);
                else if (addr.city) addressParts.push(addr.city);
                
                if (addr.state && !addr.city) addressParts.push(addr.state);
                
                // Pour la Tunisie, on peut vouloir inclure le gouvernorat
                if (addr.county && addr.county !== addr.city) addressParts.push(addr.county);
                
                // Ajouter le pays seulement si différent de Tunisie
                if (addr.country && addr.country !== "Tunisie") addressParts.push(addr.country);
                
                return addressParts.join(", ");
            }
            return `${latlng.lat.toFixed(4)}, ${latlng.lng.toFixed(4)}`;
        } catch (error) {
            console.error('Erreur de géocodage:', error);
            return `${latlng.lat.toFixed(4)}, ${latlng.lng.toFixed(4)}`;
        }
    }

    // Fonction pour mettre à jour l'interface
    function updateUI() {
        const departureBtn = document.getElementById('select-departure');
        const arrivalBtn = document.getElementById('select-arrival');
        
        if (departureBtn && arrivalBtn) {
            departureBtn.classList.toggle('active', currentSelection === 'departure');
            arrivalBtn.classList.toggle('active', currentSelection === 'arrival');
        }
    }

    // Fonction pour calculer l'itinéraire
    async function calculateRoute(start, end) {
        try {
            const response = await fetch(`https://router.project-osrm.org/route/v1/driving/${start.lng},${start.lat};${end.lng},${end.lat}?overview=full&geometries=geojson`);
            const data = await response.json();
            
            if (data.routes && data.routes.length > 0) {
                const route = data.routes[0];
                
                if (routeLayer) map.removeLayer(routeLayer);
                
                routeLayer = L.geoJSON(route.geometry, {
                    style: {
                        color: '#ff8200',
                        weight: 5,
                        opacity: 0.8
                    }
                }).addTo(map);
                
                // Mise à jour des infos de distance et durée
                document.getElementById('distance').textContent = (route.distance / 1000).toFixed(1) + ' km';
                document.getElementById('duration').textContent = Math.round(route.duration / 60) + ' min';
                
                const bounds = L.latLngBounds([start, end]);
                map.fitBounds(bounds, { padding: [50, 50] });
            }
        } catch (error) {
            console.error('Erreur de calcul d\'itinéraire:', error);
        }
    }

    // Fonction d'initialisation de la carte
    function initMap() {
        if (!document.getElementById('map')) {
            console.error("Le conteneur de la carte n'existe pas");
            return;
        }
        
        map = L.map('map').setView([33.8869, 9.5375], 7);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        setupMapClickHandler();
        setupUIEvents();
        locateUser();
    }
    
    // Fonction principale exécutée quand le DOM est chargé
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('reservation-form')) {
            initMap();
        }
        
        const alert = document.getElementById('reservation-alert');
        if (alert) {
            setTimeout(() => {
                new bootstrap.Alert(alert).close();
            }, 5000);
        }
    });

    // Fonction pour localiser l'utilisateur
    function locateUser() {
        map.locate({setView: false, maxZoom: 12});
        
        map.on('locationfound', function(e) {
            L.marker(e.latlng).addTo(map)
                .bindPopup("Votre position actuelle").openPopup();
        });
        
        map.on('locationerror', function(e) {
            console.warn("Erreur de géolocalisation:", e.message);
        });
    }
    
    // Fonction pour configurer les événements UI
    function setupUIEvents() {
        const departureBtn = document.getElementById('select-departure');
        const arrivalBtn = document.getElementById('select-arrival');
        
        if (departureBtn && arrivalBtn) {
            departureBtn.addEventListener('click', function() {
                currentSelection = 'departure';
                updateUI();
            });
            
            arrivalBtn.addEventListener('click', function() {
                currentSelection = 'arrival';
                updateUI();
            });
        }
    }
    
    // Fonction pour configurer le clic sur la carte
    function setupMapClickHandler() {
        map.off('click'); // Supprimer les anciens gestionnaires
        
        map.on('click', async function(e) {
            const detailedAddress = await getDetailedAddress(e.latlng);
            
            if (currentSelection === 'departure') {
                updateDeparture(e.latlng, detailedAddress);
                currentSelection = 'arrival';
            } else {
                updateArrival(e.latlng, detailedAddress);
                if (departureMarker) {
                    calculateRoute(departureMarker.getLatLng(), e.latlng);
                }
            }
            
            updateUI();
        });
    }
    
    // Fonction pour mettre à jour le point de départ
    function updateDeparture(latlng, address) {
        document.getElementById('adresse_dep').value = address;
        document.getElementById('dep_lat').value = latlng.lat;
        document.getElementById('dep_lng').value = latlng.lng;
        
        if (departureMarker) map.removeLayer(departureMarker);
        
        departureMarker = L.marker(latlng, {
            icon: L.divIcon({
                className: 'departure-marker',
                html: '<i class="fas fa-map-marker-alt" style="color: #ff8200; font-size: 32px;"></i>',
                iconSize: [32, 32],
                iconAnchor: [16, 32]
            })
        }).addTo(map).bindPopup(`Départ: ${address}`);
    }
    
    // Fonction pour mettre à jour le point d'arrivée
    function updateArrival(latlng, address) {
        document.getElementById('adresse_arr').value = address;
        document.getElementById('arr_lat').value = latlng.lat;
        document.getElementById('arr_lng').value = latlng.lng;
        
        if (arrivalMarker) map.removeLayer(arrivalMarker);
        
        arrivalMarker = L.marker(latlng, {
            icon: L.divIcon({
                className: 'arrival-marker',
                html: '<i class="fas fa-flag" style="color: #28a745; font-size: 32px;"></i>',
                iconSize: [32, 32],
                iconAnchor: [16, 32]
            })
        }).addTo(map).bindPopup(`Arrivée: ${address}`);
    }
</script>
</body>
</html>