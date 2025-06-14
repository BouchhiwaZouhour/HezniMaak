<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Site de Réservation de Taxis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite([ 'resources/js/app.js'])
</head>
<body>

  @include('components.header')
<x-app-layout>

    <div class="max-w-7xl mx-auto py-8 px-6">
        <!-- Barre d'étapes -->
        <div class="flex border-b bg-gray-50 shadow-md rounded-lg">

            @php
                $etapes = ['Informations','Liste Taxis', 'Réservations'];
            @endphp
            @foreach($etapes as $index => $etape)
                <button class="step-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition" 
                        data-step="{{ $index + 1 }}">
                    {{ $etape }}
                </button>
            @endforeach
            
        </div>

        <!-- Contenu des étapes -->
        <div id="etape-content"  class="tab-content mt-4">
            <div class="etape-div hidde" id="etape-1">
                <div class="p-6 bg-green-50 shadow-md rounded-lg">
                    <h3 class="text-2xl font-semibold text-green-700 mb-4">👤 Informations du Chauffeur</h3>
                    <p><strong>Nom :</strong> {{ $chauffeur->name }}</p>
                    <p><strong>Statut :</strong> <strong>{{ $chauffeur->statut }}</strong></p>


        <!-- Formulaire de modification des informations du profil -->
          <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">Modifier les informations du profil</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Mettez à jour les informations de votre profil et votre adresse email.
                </p>
            </header>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Nom')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $chauffeur->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $chauffeur->email)" required autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-input-label for="telephone" :value="__('Téléphone')" />
                    <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $chauffeur->telephone)" autocomplete="telephone" />
                    <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-sm text-gray-600">{{ __('Modifications enregistrées.') }}</p>
                    @endif
                </div>
            </form>
          </section>

          <section class="mt-8">
            <header>
                <h2 class="text-lg font-medium text-red-600">Supprimer le compte</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Une fois votre compte supprimé, toutes vos données seront perdues. Veuillez confirmer en saisissant votre mot de passe.
                </p>
            </header>

            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
                @csrf
                @method('DELETE')

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="password" name="password" type="password" class="block w-full mt-1" required />
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <x-danger-button>{{ __('Supprimer le compte') }}</x-danger-button>
                </div>
            </form>
          </section>
                </div>
        </div>


            <div class="etape-div hidden" id="etape-2">
                <div class="p-6 bg-green-50 shadow-md rounded-lg">
                    <h3 class="text-2xl font-semibold text-green-700 mb-4">📋 Liste des Taxis</h3>
                    <form action="{{ route('taxi.create') }}" method="GET">
                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-300">
                            Ajouter un Taxi
                        </button>
                    </form>
                    <br>
                    @forelse($taxis as $taxi)
                        <div class="border rounded p-4 mb-4 shadow-md bg-white">
                            <p><strong>Matricule :</strong> {{ $taxi->matricule }}</p>
                            <p><strong>Modèle :</strong> {{ $taxi->modele }}</p>
                            <p><strong>Adresse :</strong> {{ $taxi->adresse }}</p>
                            <!-- Affichage de l'image -->
@if($taxi->image)
    <img src="{{ asset('storage/' . $taxi->image) }}" alt="Image du taxi" class="mt-2 w-32 h-32 object-cover rounded-md">
@else
    <img src="{{ asset('images/taxi.png') }}" alt="Image par défaut" class="mt-2 w-32 h-32 object-cover rounded-md">
@endif
 
                            <div class="mt-2">
                          
                            <a href="{{ route('taxi.edit', $taxi->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Modifier</a>


                                <form method="POST" action="{{ route('taxi.destroy', $taxi->id) }}" onsubmit="return confirm('Confirmer la suppression ?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>Aucun taxi disponible pour le moment.</p>
                    @endforelse
                </div>
            </div>

            <div class="etape-div hidden" id="etape-3">
                <div class="p-6 bg-green-50 shadow-md rounded-lg">
                    <h3 class="text-2xl font-semibold text-green-700 mb-4">📅 Réservations des Taxis</h3>
                    @forelse($taxis as $taxi)
                        <div class="border rounded p-4 mb-4 shadow-md bg-white">
                            <h4 class="text-lg font-semibold text-green-800">Taxi : {{ $taxi->matricule }}</h4>
                            <table class="w-full border mt-4">
                                <thead>
                                    <tr class="bg-gray-100">
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
                                            <td class="border px-4 py-2">{{ $reservation->client->name }}</td>
                                            <td class="border px-4 py-2">
                                                @if($reservation->statut !== 'confirmee')
                                                    <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
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
                        <p>Aucune réservation trouvée.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
  @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stepButtons = document.querySelectorAll('.step-btn');
            const etapeDivs = document.querySelectorAll('.etape-div');

            stepButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const step = button.dataset.step;

                    // Cacher toutes les divisions
                    etapeDivs.forEach(div => div.classList.add('hidden'));

                    // Afficher la bonne division
                    document.getElementById(`etape-${step}`).classList.remove('hidden');
                });
            });

            // Afficher la première étape par défaut
            document.getElementById('etape-1').classList.remove('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
</body>