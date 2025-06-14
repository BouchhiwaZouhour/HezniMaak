<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Site de Réservation de Taxis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite([ 'resources/js/app.js'])

    <style>
        .reservation-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .reservation-section h2 {
            color: #ff8200;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .reservation-section label {
            font-weight: bold;
            color: #333;
        }

        .reservation-section input, .reservation-section select, .reservation-section button {
            border-radius: 5px;
        }

        .reservation-section button {
            background-color: #ff8200;
            border: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .reservation-section button:hover {
            background-color: #cc6a00;
        }

        #result_rech {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        #result_rech h3 {
            color: #ff8200;
            font-weight: bold;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item button {
            background-color: #ff8200;
            color: #fff;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .list-group-item button:hover {
            background-color: #cc6a00;
        }
    </style>

</head>
<body>
    @include('components.header')

    <!-- Espace de réservation -->
    <section class="reservation-section container my-5">
        <h2 class="text-center mb-4">Réservez votre taxi maintenant</h2>

        <!-- Étape 3 : Confirmation -->
        @if(session('reservation_confirmed'))
    <div id="reservation-alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <h4>✅ Réservation Confirmée</h4>
        <p>Votre réservation a été enregistrée avec succès !</p>
    </div>
@endif
        <!-- Étape 1 : Formulaire de recherche -->
        @if(!isset($taxis))
            <form action="{{ route('taxi.recherche') }}" method="GET" class="mx-auto" style="max-width: 500px;" >
                @csrf
                <div class="mb-3">
                    <label for="adresse_dep" class="form-label">Adresse de départ :</label>
                    <input type="text" class="form-control" name="adresse_dep" id="adresse_dep" placeholder="Entrez l'adresse de départ" required>
                </div>
                <div class="mb-3">
                    <label for="adresse_arr" class="form-label">Adresse d'arrivée :</label>
                    <input type="text" class="form-control" name="adresse_arr" id="adresse_arr" placeholder="Entrez l'adresse d'arrivée" required>
                </div>
                <div class="mb-3">
                    <label for="date_res" class="form-label">Date de réservation :</label>
                    <input type="date" class="form-control" name="date_res" id="date_res" required>
                </div>
                <div class="mb-3">
                    <label for="heure_res" class="form-label">Heure de réservation :</label>
                    <input type="time" class="form-control" name="heure_res" id="heure_res" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Chercher</button>
            </form>
        @endif

        <!-- Étape 2 : Affichage des taxis disponibles -->
        @if( isset($taxis))
            <div id="result_rech" class="mt-5">
                <h3>Résultats de la Recherche</h3>
                @if($taxis->isEmpty())
                    <p>Aucun taxi trouvé à l'adresse : {{ $adresse_dep }}.</p>
                @else
                    <ul class="list-group">
                        @foreach($taxis as $taxi)
                            <li class="list-group-item">
                                <strong>Matricule :</strong> {{ $taxi->matricule }}<br>
                                <strong>Modèle :</strong> {{ $taxi->modele }}<br>
                                <strong>Adresse :</strong> {{ $taxi->adresse }}<br>
                                <strong>Disponibilité :</strong> {{ $taxi->disponible ? 'Disponible' : 'Indisponible' }}
                              
                                    @if(Auth::check() && Auth::user()->role === 'client')
                                    <form action="{{ route('reservation.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="taxi_id" value="{{ $taxi->id }}">
                                    <input type="hidden" name="adresse_dep" value="{{ $adresse_dep ?? '' }}">
                                    <input type="hidden" name="adresse_arr" value="{{ $adresse_arr ?? '' }}">
                                    <input type="hidden" name="date_res" value="{{ request('date_res') }}">
                                    <input type="hidden" name="heure_res" value="{{ request('heure_res') }}">
                                    <button type="submit" class="btn btn-primary">Réserver</button>
                                    </form>
                                    @else
                                    <a href="{{ route('login') }}" class="btn btn-warning mt-2">Connectez-vous pour réserver</a>
                                    @endif

                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif


    </section>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
