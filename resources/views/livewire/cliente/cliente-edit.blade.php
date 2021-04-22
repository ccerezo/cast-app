<div>
    <button type="button" wire:click="$set('openModal', true)" class="cursor-pointer mr-1 text-indigo-600 hover:text-indigo-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
        </svg>
    </button>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <p class="px-2 w-full text-gray-600 border-b border-gray-300 shadow-b">
                Editar Cliente
            </p>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-2">
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Cédula/RUC</label>
                    <input type="text" wire:model="cliente.identificacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('identificacion')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" wire:model="cliente.nombre" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('nombre')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" wire:model="cliente.direccion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" wire:model="cliente.telefono" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="text" wire:model="cliente.correo" id="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-4 sm:col-span-4">
                    {!! Form::label('tipo', 'Tipo Cliente', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                    {!! Form::select('tipo_cliente_id', $tipos, null,
                                    ['wire:model' => 'cliente.tipo_cliente_id', 'wire:change' => 'getTipoCliente()','class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
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
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
