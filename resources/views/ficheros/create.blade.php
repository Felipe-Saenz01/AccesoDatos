<x-app-layout>


    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <h2 class=" flex items-cente justify-center font-semibold text-xl text-gray-800 leading-tight mb-4">
            Crear Nuevo Fichero
        </h2>

        <x-validation-errors class="my-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('ficheros.store') }}">
            @csrf

            <div>
                <x-label for="nombre" value="{{ __('Nombre Fichero') }}" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="extension" value="{{ __('Extensión o tipo de fichero') }}" />
                <x-select id="extension" class="block mt-1 w-full" name="extension" required>
                    <option value="">Seleccione tipo</option>
                    <option value="txt">TXT</option>
                    <option value="doc">DOC</option>
                    <option value="xml">XML</option>
                </x-select>
            </div>
        

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Crear') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>