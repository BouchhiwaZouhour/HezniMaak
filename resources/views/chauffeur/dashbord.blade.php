<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Chauffeur | Taxi Réservation</title>
    @include('components.header-styles')
    @vite(['resources/css/taxi-crud.css']) <!-- Ajoutez cette ligne -->
    @vite(['resources/css/app.css']) <!-- Ajoutez cette ligne -->

    <style>
        
        /* Dashboard Styles */
        .dashboard-container {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        
        /* Navigation Tabs amélioré */
        .nav-tabs {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,0.98));
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
            border: none;
        }
        
        .nav-tabs .nav-link {
            padding: 15px 25px;
            font-weight: 600;
            color: var(--dark-color);
            border: none;
            position: relative;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--accent-color);
            background: linear-gradient(to right, rgba(255, 0, 110, 0.05), rgba(255, 0, 110, 0.03));
        }
        
        .nav-tabs .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            color: var(--primary-color);
            background: rgba(58, 134, 255, 0.05);
        }
        
        /* Tab Content amélioré */
        .tab-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            border-top: 5px solid var(--primary-color);
        }
        
        .tab-title {
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .tab-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }
        
        /* Taxi List amélioré */
        .taxi-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
            background: white;
            position: relative;
            overflow: hidden;
        }
        
        .taxi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(58, 134, 255, 0.1);
            border-color: var(--primary-color);
        }
        
        .taxi-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        }
        
        .taxi-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #eee;
        }
        
        /* Boutons améliorés */
        .btn-add-taxi {
            background: linear-gradient(135deg, var(--accent-color), #ff4d8d);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-add-taxi:hover {
            background: linear-gradient(135deg, #ff4d8d, var(--accent-color));
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 0, 110, 0.2);
        }
        
        .btn-action {
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 600;
            margin-right: 10px;
            transition: all 0.3s;
            border: none;
        }
        
        .btn-edit {
            background: var(--secondary-color);
            color: white;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        /* Reservations Table */
        .reservation-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .reservation-table th {
            background: var(--primary-color);
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        .reservation-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .reservation-table tr:hover td {
            background: rgba(58, 134, 255, 0.05);
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-confirmed {
            background: #28a74520;
            color: #28a745;
        }
        
        .status-pending {
            background: #ffc10720;
            color: #ffc107;
        }
        
        .btn-confirm {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .dashboard-container {
                padding-top: 20px;
            }
            
            .nav-tabs .nav-link {
                padding: 12px 15px;
                font-size: 14px;
            }
            
            .tab-content {
                padding: 20px;
            }
            
            .reservation-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    @include('components.header')
    
    <div class="dashboard-container">
        <div class="container">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="driverTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                        <i class="fas fa-user-circle me-2"></i>Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="taxis-tab" data-bs-toggle="tab" data-bs-target="#taxis" type="button" role="tab">
                        <i class="fas fa-taxi me-2"></i>Mes Taxis
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reservations-tab" data-bs-toggle="tab" data-bs-target="#reservations" type="button" role="tab">
                        <i class="fas fa-calendar-alt me-2"></i>Réservations
                    </button>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="driverTabsContent">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <h2 class="tab-title"><i class="fas fa-user-circle me-2"></i>Informations du profil</h2>
                    
                    <div class="profile-info mb-5">
                        <p><strong><i class="fas fa-user me-2"></i>Nom :</strong> {{ $chauffeur->name }}</p>
                        <p><strong><i class="fas fa-envelope me-2"></i>Email :</strong> {{ $chauffeur->email }}</p>
                        <p><strong><i class="fas fa-phone me-2"></i>Téléphone :</strong> {{ $chauffeur->telephone }}</p>
                        <p>
                            <strong><i class="fas fa-badge-check me-2"></i>Statut :</strong> 
                            <span class="badge bg-{{ $chauffeur->statut === 'actif' ? 'success' : 'warning' }}">
                                {{ ucfirst($chauffeur->statut) }}
                            </span>
                        </p>
                    </div>
                    
                    <!-- Update Profile Form -->
                    <div class="form-section">
                        <h3><i class="fas fa-edit me-2"></i>Modifier le profil</h3>
                        
                        <form method="post" action="{{ route('profile.update') }}" class="row g-3">
                            @csrf
                            @method('patch')
                            
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $chauffeur->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $chauffeur->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $chauffeur->telephone) }}">
                                @error('telephone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                </button>
                                
                                @if (session('status') === 'profile-updated')
                                    <span class="text-success ms-3">
                                        <i class="fas fa-check-circle me-2"></i>Modifications enregistrées
                                    </span>
                                @endif
                            </div>
                        </form>
                    </div>
                    
                    <!-- Delete Account Section -->
                    <div class="form-section">
                        <h3 class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Supprimer le compte</h3>
                        <p class="text-muted mb-4">
                            Une fois votre compte supprimé, toutes vos données seront définitivement effacées. 
                            Cette action est irréversible.
                        </p>
                        
                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('DELETE')
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirmez avec votre mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i>Supprimer définitivement mon compte
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Taxis Tab -->
                <div class="tab-pane fade" id="taxis" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="tab-title"><i class="fas fa-taxi me-2"></i>Mes taxis</h2>
                       <x-primary-button class="mb-4" onclick="window.location='{{ route('taxi.create') }}'">
                          <i class="fas fa-plus mr-2"></i> Ajouter un taxi
                       </x-primary-button>
                    </div>
                    
                    @if($taxis->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Vous n'avez aucun taxi enregistré.
                        </div>
                    @else
                        <div class="row">
                            @foreach($taxis as $taxi)
                                <div class="col-md-6 col-lg-4">
                                    <div class="taxi-card">
                                        @if($taxi->image)
                                            <img src="{{ asset('storage/' . $taxi->image) }}" alt="Taxi {{ $taxi->matricule }}" class="taxi-image">
                                        @else
                                            <img src="{{ asset('images/taxi.png') }}" alt="Taxi par défaut" class="taxi-image">
                                        @endif
                                        
                                        <h5 class="fw-bold">{{ $taxi->modele }}</h5>
                                        <p><strong>Matricule :</strong> {{ $taxi->matricule }}</p>
                                        <p><strong>Adresse :</strong> {{ $taxi->adresse }}</p>
                                        
                                        <div class="d-flex mt-3">
                                            <x-primary-button class="btn-sm" onclick="window.location='{{ route('taxi.edit', $taxi->id) }}'">
                                                  <i class="fas fa-edit mr-1"></i> Modifier
                                            </x-primary-button>
                                            <form method="POST" action="{{ route('taxi.destroy', $taxi->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce taxi ?')">
    @csrf
    @method('DELETE')
    <x-danger-button class="btn-sm" type="submit">
        <i class="fas fa-trash mr-1"></i> Supprimer
    </x-danger-button>
</form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Reservations Tab -->
                <div class="tab-pane fade" id="reservations" role="tabpanel">
                    <h2 class="tab-title"><i class="fas fa-calendar-alt me-2"></i>Réservations</h2>
                    
                    @if($taxis->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Aucune réservation disponible. Vous devez d'abord ajouter un taxi.
                        </div>
                    @else
                        @foreach($taxis as $taxi)
                            @if(!$taxi->reservations->isEmpty())
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-taxi me-2"></i>Taxi: {{ $taxi->matricule }} ({{ $taxi->modele }})
                                    </h5>
                                    
                                    <div class="table-responsive">
                                        <table class="reservation-table">
                                            <thead>
                                                <tr>
                                                    <th>Date/Heure</th>
                                                    <th>Itinéraire</th>
                                                    <th>Client</th>
                                                    <th>Prix</th>
                                                    <th>Statut</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($taxi->reservations as $reservation)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $reservation->date_res }}</strong><br>
                                                            {{ $reservation->heure_res }}
                                                        </td>
                                                        <td>
                                                            <strong>Départ:</strong> {{ $reservation->adresse_dep }}<br>
                                                            <strong>Arrivée:</strong> {{ $reservation->adresse_arr }}
                                                        </td>
                                                        <td>{{ $reservation->client->name }}</td>
                                                        <td>{{ $reservation->prix }} TND</td>
                                                        <td>
                                                            @if($reservation->statut === 'confirmee')
                                                                <span class="status-badge status-confirmed">
                                                                    <i class="fas fa-check-circle me-1"></i>Confirmée
                                                                </span>
                                                            @else
                                                                <span class="status-badge status-pending">
                                                                    <i class="fas fa-clock me-1"></i>En attente
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($reservation->statut !== 'confirmee')
                                                                <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn-confirm">
                                                                        <i class="fas fa-check me-1"></i>Confirmer
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if($taxis->flatMap->reservations->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Aucune réservation trouvée pour vos taxis.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @include('components.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer les tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Activer les tabs si l'URL a un hash
            if(window.location.hash) {
                var tabTrigger = new bootstrap.Tab(document.querySelector(window.location.hash + '-tab'));
                tabTrigger.show();
            }
        });
    </script>
</body>
</html>