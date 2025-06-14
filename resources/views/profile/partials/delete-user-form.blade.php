
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Supprimer votre compte</h2>
        <p class="mt-1 text-sm text-gray-600">
            Une fois votre compte supprimé, toutes vos données seront perdues. 
            Veuillez confirmer en saisissant votre mot de passe.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('DELETE')

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 ">Mot de passe</label>
            <input id="password" name="password" type="password" class="block w-full mt-1 " required />
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
        <div class="flex items-center gap-4">
            <x-danger-button>
                {{ __('Supprimer le compte') }}
            </x-danger-button>
        </div>
            </div>
    </form>
</section>
