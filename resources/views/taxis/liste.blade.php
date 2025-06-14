@isset($taxis)
    <div id="result_rech" class="mt-5">
        <h3>Résultats de la Recherche</h3>
        @if($taxis->isEmpty())
            <p>Aucun taxi trouvé à cette adresse.</p>
        @else
            <ul class="list-group">
                @foreach($taxis as $taxi)
                    <li class="list-group-item">
                        <strong>Matricule :</strong> {{ $taxi->matricule }}<br>
                        <strong>Modèle :</strong> {{ $taxi->modele }}<br>
                        <strong>Adresse :</strong> {{ $taxi->adresse }}
                        <form action="{{ route('reservation.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Réserver</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endisset
