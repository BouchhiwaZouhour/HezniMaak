@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Réservations pour le Chauffeur d'ID: {{ $chauffeur_id }}</h2>
    
    @if($reservations->isEmpty())
        <p>Aucune réservation trouvée pour ce taxi.</p>
    @else
        <ul>
            @foreach($reservations as $reservation)
                <li>
                    Réservation #{{ $reservation->id }} | 
                    Client: {{ $reservation->client->name }} | 
                    Taxi : {{ $reservation->taxi->modele }}
                    Adresse de départ : {{ $reservation->adresse_dep }}
                    Adresse d'arrivée : {{ $reservation->adresse_arr }}
                    Date: {{ $reservation->date_res }} | 
                    Heure: {{ $reservation->heure_res }} | 
                    Statut: {{ $reservation->statut }}
                    @if (Auth::user()->role === 'chauffeur' && $reservation->statut === 'en attente')
                    <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                         @csrf
                       <button type="submit" class="btn btn-success">Confirmer</button>
                    </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
