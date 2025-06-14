<x-app-layout>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="container">
    <h2>Réservations pour le taxi ID: {{ $taxi_id }}</h2>
    
    @if($reservations->isEmpty())
        <p>Aucune réservation trouvée pour ce taxi.</p>
    @else
        <ul>
            @foreach($reservations as $reservation)
                <li>
                <p>Client : {{ $reservation->client->name }}</p>
                <p>Chauffeur : {{ $reservation->chauffeur->name }}</p>
                <p>Adresse de départ : {{ $reservation->adresse_dep }}</p>
                <p>Adresse d'arrivée : {{ $reservation->adresse_arr }}</p>
                <p>Date : {{ $reservation->date_res }}</p>
                <p>Heure : {{ $reservation->heure_res }}</p>
                <p>Statut : {{ $reservation->statut }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</div>
</div>
</x-app-layout>
