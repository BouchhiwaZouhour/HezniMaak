<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations | Taxi Réservation</title>
    @include('components.header-styles')
</head>
<body>
    @include('components.header')
    
    <div class="client-dashboard">
        <div class="container">
            <h2 class="page-title">
                <i class="fas fa-calendar-alt me-2"></i>Mes Réservations
            </h2>
            
            @if($reservations->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                    <h3>Aucune réservation trouvée</h3>
                    <p>Vous n'avez aucune réservation en cours.</p>
                    <a href="{{ route('welcome') }}" class="btn btn-primary">
                        <i class="fas fa-taxi me-2"></i>Faire une réservation
                    </a>
                </div>
            @else
                <div class="reservations-list">
                    @foreach($reservations as $reservation)
                    <div class="reservation-card">
                        <div class="reservation-header">
                            <h4>Réservation #{{ $reservation->id }}</h4>
                            <span class="status-badge status-{{ str_replace(' ', '-', $reservation->statut) }}">
                                {{ $reservation->statut }}
                            </span>
                        </div>
                        
                        <div class="reservation-details">
                            <div class="detail-group">
                                <h5><i class="fas fa-taxi me-2"></i>Informations Taxi</h5>
                                <p><strong>Modèle:</strong> {{ $reservation->taxi->modele ?? 'Non spécifié' }}</p>
                                <p><strong>Chauffeur:</strong> {{ $reservation->chauffeur->name ?? 'Non spécifié' }}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h5><i class="fas fa-route me-2"></i>Itinéraire</h5>
                                <p><strong>Départ:</strong> {{ $reservation->adresse_dep }}</p>
                                <p><strong>Arrivée:</strong> {{ $reservation->adresse_arr }}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h5><i class="fas fa-clock me-2"></i>Horaires</h5>
                                <p><strong>Date:</strong> {{ $reservation->date_res }}</p>
                                <p><strong>Heure:</strong> {{ $reservation->heure_res }}</p>
                            </div>
                        </div>
                        
                        <div class="reservation-actions">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                                    <i class="fas fa-trash-alt me-2"></i>Annuler
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
    @include('components.footer')

    <style>
        .client-dashboard {
            padding: 60px 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 160px);
        }
        
        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state i {
            color: var(--primary-color);
        }
        
        .reservations-list {
            display: grid;
            gap: 20px;
        }
        
        .reservation-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: var(--primary-color);
            color: white;
        }
        
        .reservation-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .status-en-attente {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-confirmée {
            background: #d4edda;
            color: #155724;
        }
        
        .reservation-details {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .detail-group {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .detail-group h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .reservation-actions {
            padding: 0 20px 20px;
            text-align: right;
        }
        
        @media (max-width: 768px) {
            .reservation-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>