
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Réservation</title>
    <!-- Inclure votre CSS personnalisé -->
    <!-- Inclure Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.header')
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #ff8200;">Mes Réservations</h2>
            <div class="bg-white shadow sm:rounded-lg p-6">
                @if($reservations->isEmpty())
                    <p class="text-muted text-center">Aucune réservation trouvée pour ce client.</p>
                @else
                    <ul class="list-group">
                        @foreach($reservations as $reservation)
                            <li class="list-group-item mb-3">
                                <strong>Taxi :</strong> {{ $reservation->taxi->modele ?? 'Non spécifié' }}<br>
                                <strong>Chauffeur :</strong> {{ $reservation->chauffeur->name ?? 'Non spécifié' }}<br>
                                <strong>Adresse de départ :</strong> {{ $reservation->adresse_dep }}<br>
                                <strong>Adresse d'arrivée :</strong> {{ $reservation->adresse_arr }}<br>
                                <strong>Date :</strong> {{ $reservation->date_res }}<br>
                                <strong>Heure :</strong> {{ $reservation->heure_res }}<br>
                                <strong>Statut :</strong> <span class="badge bg-info text-dark">{{ $reservation->statut }}</span>
                                <div class="mt-3">
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?')">
                    Supprimer
                </button>
            </form>
        </div>
                            </li>
                            
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @include('components.footer')    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
