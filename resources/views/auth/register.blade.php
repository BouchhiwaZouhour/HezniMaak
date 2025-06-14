<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adresse email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Téléphone -->
<div class="mt-4">
    <x-input-label for="telephone" :value="__('Téléphone')" />
    <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="tel" />
    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
</div>


        <!-- Rôle -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select name="role" id="role" class="block mt-1 w-full" :value="old('role')" required>
                <option value="client" class="block mt-1 w-full" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                <option value="chauffeur" class="block mt-1 w-full" {{ old('role') == 'chauffeur' ? 'selected' : '' }}>Chauffeur</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme Mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm t rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('login') }}">
                {{ __('Déjà inscrit') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Créer compte') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
