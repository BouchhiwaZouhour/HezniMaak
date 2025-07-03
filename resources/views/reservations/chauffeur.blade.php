@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <h2 class="dashboard-title">
            <i class="fas fa-calendar-alt me-2"></i>Mes Réservations
        </h2>
        
        @if($reservations->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucune réservation trouvée.
            </div>
        @else
            <div class="reservation-grid">
                @foreach($reservations as $reservation)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <h5>Réservation #{{ $reservation->id }}</h5>
                        <span class="badge status-{{ str_replace(' ', '-', $reservation->statut) }}">
                            {{ $reservation->statut }}
                        </span>
                    </div>
                    
                    <div class="reservation-body">
                        <div class="reservation-info">
                            <p><i class="fas fa-user me-2"></i><strong>Client:</strong> {{ $reservation->client->name }}</p>
                            <p><i class="fas fa-taxi me-2"></i><strong>Véhicule:</strong> {{ $reservation->taxi->modele }}</p>
                            <p><i class="fas fa-map-marker-alt me-2"></i><strong>Départ:</strong> {{ $reservation->adresse_dep }}</p>
                            <p><i class="fas fa-flag-checkered me-2"></i><strong>Arrivée:</strong> {{ $reservation->adresse_arr }}</p>
                        </div>
                        
                        <div class="reservation-time">
                            <p><i class="fas fa-calendar-day me-2"></i><strong>Date:</strong> {{ $reservation->date_res }}</p>
                            <p><i class="fas fa-clock me-2"></i><strong>Heure:</strong> {{ $reservation->heure_res }}</p>
                        </div>
                    </div>
                    
                    @if(Auth::user()->role === 'chauffeur' && $reservation->statut === 'en attente')
                    <div class="reservation-actions">
                        <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-confirm">
                                <i class="fas fa-check-circle me-2"></i>Confirmer
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .dashboard-container {
        padding: 40px 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 80px);
    }
    
    .dashboard-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--accent-color);
    }
    
    .reservation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }
    
    .reservation-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .reservation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .reservation-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: var(--primary-color);
        color: white;
    }
    
    .reservation-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-en-attente {
        background: #ffc107;
        color: #000;
    }
    
    .status-confirmée {
        background: #28a745;
        color: white;
    }
    
    .reservation-body {
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .reservation-info, .reservation-time {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .reservation-actions {
        padding: 0 20px 20px;
        text-align: right;
    }
    
    .btn-confirm {
        background: var(--accent-color);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-confirm:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .reservation-grid {
            grid-template-columns: 1fr;
        }
        
        .reservation-body {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection