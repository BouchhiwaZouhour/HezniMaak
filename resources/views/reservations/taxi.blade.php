<x-app-layout>
    <div class="taxi-reservations-container">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-calendar-alt me-2"></i>Réservations pour le Taxi #{{ $taxi_id }}
            </h2>
            
            @if($reservations->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Aucune réservation trouvée pour ce taxi.
                </div>
            @else
                <div class="reservations-table-container">
                    <table class="reservations-table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Chauffeur</th>
                                <th>Itinéraire</th>
                                <th>Date/Heure</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <i class="fas fa-user-circle me-2"></i>
                                        {{ $reservation->client->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <i class="fas fa-id-card-alt me-2"></i>
                                        {{ $reservation->chauffeur->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="route-info">
                                        <div><i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $reservation->adresse_dep }}</div>
                                        <div><i class="fas fa-flag-checkered text-success me-2"></i>{{ $reservation->adresse_arr }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="datetime-info">
                                        <div><i class="fas fa-calendar-day me-2"></i>{{ $reservation->date_res }}</div>
                                        <div><i class="fas fa-clock me-2"></i>{{ $reservation->heure_res }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ str_replace(' ', '-', $reservation->statut) }}">
                                        {{ $reservation->statut }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <style>
        .taxi-reservations-container {
            padding: 40px 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 80px);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .reservations-table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .reservations-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .reservations-table th {
            background: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
        }
        
        .reservations-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .reservations-table tr:hover td {
            background: rgba(58, 134, 255, 0.05);
        }
        
        .user-info, .route-info, .datetime-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-en-attente {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-confirmée {
            background: #d4edda;
            color: #155724;
        }
        
        @media (max-width: 768px) {
            .reservations-table-container {
                overflow-x: auto;
            }
        }
    </style>
</x-app-layout>