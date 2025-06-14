<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex justify-center w-auto items-center px-4 py-2 bg-orange-500 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
