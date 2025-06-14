@if(Auth::check() && Auth::user()->role === 'client' && isset($taxis))
                <div class="col-md-6">
                    <section id="result_rech">
                        <h3>Résultats de la Recherche</h3>
                        @if($taxis->isEmpty())
                            <p>Aucun taxi trouvé à l'adresse : {{ $adresse_dep }}.</p>
                        @else
                            <ul class="list-group">
                                <p>Vous avez recherché un taxi de <strong>{{$adresse_dep}}</strong> à <strong>{{$adresse_arr}}</strong> pour le <strong>{{$date_res}}</strong> à <strong>{{$heure_res}}</strong>.</p>
                                <p>Affichage des taxis disponibles...</p>
                                @foreach($taxis as $taxi)
                                    <li class="list-group-item">
                                        <strong>Matricule :</strong> {{ $taxi->matricule }}<br>
                                        <strong>Modèle :</strong> {{ $taxi->modele }}<br>
                                        <strong>Adresse :</strong> {{ $taxi->adresse }}<br>
                                        <strong>Disponibilité :</strong> {{ $taxi->disponible ? 'Disponible' : 'Indisponible' }}
                                        <form action="{{ route('reservation.store') }}" method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="taxi_id" value="{{ $taxi->id }}">
                                            <input type="hidden" name="adresse_dep" value="{{ $adresse_dep ?? '' }}">
                                            <input type="hidden" name="adresse_arr" value="{{ $adresse_arr ?? '' }}">
                                            <input type="hidden" name="date_res" value="{{ request('date_res') }}">
                                            <input type="hidden" name="heure_res" value="{{ request('heure_res') }}">
                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </section>
                </div>
 @endif