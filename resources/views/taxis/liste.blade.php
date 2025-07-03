@isset($taxis)
<div class="search-results-container mt-5">
    <h3 class="results-title">
        <i class="fas fa-search me-2"></i>Résultats de la recherche
    </h3>
    
    @if($taxis->isEmpty())
        <div class="empty-results">
            <i class="fas fa-taxi fa-3x mb-3"></i>
            <p>Aucun taxi trouvé à cette adresse.</p>
        </div>
    @else
        <div class="taxis-grid">
            @foreach($taxis as $taxi)
            <div class="taxi-card">
                @if($taxi->image)
                    <img src="{{ asset('storage/' . $taxi->image) }}" alt="{{ $taxi->modele }}" class="taxi-image">
                @else
                    <img src="{{ asset('images/taxi-default.jpg') }}" alt="Taxi par défaut" class="taxi-image">
                @endif
                
                <div class="taxi-info">
                    <h4>{{ $taxi->modele }}</h4>
                    <p><i class="fas fa-id-card-alt me-2"></i>{{ $taxi->matricule }}</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ $taxi->adresse }}</p>
                    <p><i class="fas fa-money-bill-wave me-2"></i>{{ $taxi->prix_par_metre }} TND/m</p>
                    
                    <div class="availability">
                        @if($taxi->disponible)
                            <span class="badge available">
                                <i class="fas fa-check-circle me-1"></i>Disponible
                            </span>
                        @else
                            <span class="badge unavailable">
                                <i class="fas fa-times-circle me-1"></i>Non disponible
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="taxi-actions">
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="taxi_id" value="{{ $taxi->id }}">
                        <!-- Ajoutez les autres champs cachés nécessaires -->
                        <button type="submit" class="btn-reserve">
                            <i class="fas fa-calendar-check me-2"></i>Réserver
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .search-results-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 25px;
    }
    
    .results-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--accent-color);
    }
    
    .empty-results {
        text-align: center;
        padding: 30px;
        color: #6c757d;
    }
    
    .taxis-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .taxi-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .taxi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .taxi-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .taxi-info {
        padding: 15px;
    }
    
    .taxi-info h4 {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .taxi-info p {
        margin-bottom: 8px;
    }
    
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .available {
        background: #d4edda;
        color: #155724;
    }
    
    .unavailable {
        background: #f8d7da;
        color: #721c24;
    }
    
    .taxi-actions {
        padding: 0 15px 15px;
    }
    
    .btn-reserve {
        width: 100%;
        padding: 10px;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-reserve:hover {
        background: var(--primary-color);
    }
    
    @media (max-width: 768px) {
        .taxis-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endisset