<div class="reservations-list mt-8">
                <h3 class="text-xl font-semibold mb-4">Réservations des Taxis :</h3>
                @forelse($taxis as $taxi)
                    <div class="taxi-reservations border rounded p-4 mb-4">
                        <h4 class="text-lg font-semibold">Taxi : {{ $taxi->matricule }} - {{ $taxi->modele }}</h4>
                        <table class="w-full border mt-4">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Date</th>
                                    <th class="border px-4 py-2">Heure</th>
                                    <th class="border px-4 py-2">Adresse Départ</th>
                                    <th class="border px-4 py-2">Adresse Arrivée</th>
                                    <th class="border px-4 py-2">Prix</th>
                                    <th class="border px-4 py-2">Client</th>
                                    <th class="border px-4 py-2">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($taxi->reservations as $reservation)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $reservation->date_res }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->heure_res }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->adresse_dep }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->adresse_arr }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->prix }} TND</td>
                                        <td class="border px-4 py-2">{{ $reservation->client->name }} </td>
                                        
                                        <td class="border px-4 py-2">
                                            {{-- Bouton pour confirmer une réservation --}}
                                            @if($reservation->statut !== 'confirmee')
                                                <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                                        Confirmer
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-green-600">Confirmée</span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @empty
                    <p>Aucun taxi assigné pour le moment.</p>
                @endforelse
            </div>