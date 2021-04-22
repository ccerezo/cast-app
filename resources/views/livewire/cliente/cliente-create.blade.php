<div>
    <x-jet-danger-button wire:click="$set('openModal',true)" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Agregar Cliente
    </x-jet-danger-button>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <p class="px-2 w-full text-gray-600 border-b border-gray-300 shadow-b">
                Crear Cliente
            </p>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-2">
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Cédula/RUC</label>
                    <input type="text" wire:model.defer="identificacion" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('identificacion')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" wire:model="nombre" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('nombre')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" wire:model="direccion" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('direccion')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" wire:model="telefono" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('telefono')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="text" wire:model="correo" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('correo')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-4 sm:col-span-4">
                    {!! Form::label('tipo', 'Tipo Cliente', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                    {!! Form::select('tipo_cliente_id', $tipos, null,
                                    ['wire:model' => 'tipo_cliente_id', 'wire:change' => 'getTipoCliente()','class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                </div>
                @if ($tipoCliente->codigo == '01')
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Cupo Aprobado</label>
                    <input type="number" wire:model="cupo_aprobado" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('cupo_aprobado')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                @else
                    <input type="hidden" wire:model="cupo_aprobado">
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" class="inline-flex items-center border border-gray-300 rounded-md shadow-sm disabled:opacity-25">
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Guardar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
