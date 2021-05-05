<div>
    <div class="flex justify-between border-b border-gray-300 pb-2 mb-3 shadow ">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Listado de Materias Primas</p>

        <a href="{{route('inventarioMateriaPrimas.create')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Agregar Inventario de Materias Primas
        </a>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if (session('info'))
                    <div class="bg-green-400 border-l-4 border-green-900 text-gray-900 p-4" role="alert">
                        <p class="font-bold">Información!</p>
                        <p>{{session('info')}}</p>
                    </div>
            @endif

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-2 pl-5 pr-5 mb-2">
                    <input wire:model="search" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Buscar">
                </div>
                @if($invetarioMaterias->count())
                <div class="min-w-full divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Código
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripcion
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Unidad
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Proveedor
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha de Compra
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Costo Unidad
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th scope="col" class="relative px-3 py-2">
                                <span class="sr-only">Edi</span>
                            </th>
                            <th scope="col" class="relative px-3 py-2">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="relative px-3 py-2">
                                <span class="sr-only">Elim</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($invetarioMaterias as $inventario)
                            <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->materiaPrima->codigo}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->materiaPrima->descripcion}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->materiaPrima->unidad}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->proveedor->nombre}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->fecha_compra}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            $ {{number_format($inventario->costo_unidad,2)}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$inventario->stock}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                @if ($inventario->activo == 'si')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </td> --}}
                            <td class="px-2 py-2 whitespace-nowrap">
                                <button type="button" wire:click="registrarSalidas({{$inventario->id}})" class="text-gray-600 hover:text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                      </svg>
                                </button>
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap">
                                <a href="{{route('inventarioMateriaPrimas.edit', $inventario)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">Editar</a>
                            </td>
                            <td class="px-2 pt-0 whitespace-nowrap">
                                <form action="{{route('inventarioMateriaPrimas.destroy', $inventario)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                        <!-- More items... -->
                        </tbody>
                    </table>
                    <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                        {{ $invetarioMaterias->links() }}
                    </div>
                </div>
                @else
                    <p class="bg-gray-100 px-6 py-2 border-t border-gray-200">No hay registro.</p>
                @endif
            </div>
        </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <p class="px-2 w-full text-gray-600 border-b border-gray-300 shadow-b">
                Registar Salidas de Materia Prima
            </p>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-12 gap-0 border border-gray-300 mb-5">
                @if (count($inventario_salidas))
                <div class="col-start-1 col-span-12 divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Salidas
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($inventario_salidas as $inventario_salida)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-center">
                                        <div class="text-xs text-gray-900">
                                            {{ date('Y-m-d H:i', strtotime($inventario_salida->fecha)) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-center">
                                        <div class="text-xs font-medium text-gray-900">
                                            {{ number_format($inventario_salida->salidas,2) }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="col-start-1 col-span-5">
                        <label class="p-2 block text-xs text-gray-700">No se han registrado Salidas hasta la Fecha.</label>
                    </div>
                @endif
            </div>
            @if ($inventario_tmp)
                @if ($inventario_tmp->stock > 0)
                <div class="grid grid-cols-12 gap-0 border border-gray-300">
                    <div class="col-start-1 col-span-2 border-r border-gray-300">
                        <label class="text-right pr-2 pt-2 block text-xs text-gray-700">Stock:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2 pb-2">
                        <label class="font-bold block w-full text-lg pl-2 pt-1 text-gray-700">{{$inventario_tmp->stock}} {{$inventario_tmp->materiaPrima->unidad}}</label>
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300 ml-2">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Fecha:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2 pb-2">
                        <x-jet-input type="datetime-local" wire:model.defer="fecha" class="mr-2 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm border border-gray-300" />
                        <x-jet-input-error for="fecha" />
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300 pb-5">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Salidas:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2">
                        <x-jet-input type="number" wire:model.defer="salidas" class="mr-2 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm border border-gray-300" />
                        <x-jet-input-error for="salidas" />
                    </div>
                </div>
                @endif
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            @if ($inventario_tmp)
                @if ($inventario_tmp->stock > 0)
                <x-jet-danger-button wire:click="saveDetalle" class="inline-flex items-center border border-gray-300 rounded-md shadow-sm disabled:opacity-25">
                    <svg wire:loading wire:target="saveDetalle" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Guardar Salidas
                </x-jet-danger-button>
                @endif
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>


