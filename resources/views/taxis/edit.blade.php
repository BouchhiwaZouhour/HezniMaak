<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Taxi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('taxis.update', $taxi->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                        <input type="text" name="matricule" id="matricule" value="{{ $taxi->matricule }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="modele" class="block text-sm font-medium text-gray-700">Modèle</label>
                        <input type="text" name="modele" id="modele" value="{{ $taxi->modele }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" name="adresse" id="adresse" value="{{ $taxi->adresse }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="prix_par_metre" class="block text-sm font-medium text-gray-700">Prix par mètre</label>
                        <input type="number" step="0.01" name="prix_par_metre" id="prix_par_metre" value="{{ $taxi->prix_par_metre }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                    <label for="disponible" class="block text-sm font-medium text-gray-700">Disponibilité</label>
                     <select name="disponible" id="disponible" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                         <option value="1" selected>Disponible</option>
                         <option value="0">Non disponible</option>
                      </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
