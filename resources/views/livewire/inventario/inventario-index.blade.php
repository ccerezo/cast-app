<div>
    <div class="flex justify-between">
        <p class="inline-flex pl-5 mt-4 text-lg text-gray-700">Inventario</p>
        {{-- <a href="{{route('modelos.create')}}" class="inline-flex items-center px-4 py-2 mt-4 mr-5 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Agregar Modelo
        </a> --}}
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div>
                @if (session()->has('message'))
                    <div class="p-4 text-gray-900 bg-green-400 border-l-4 border-green-900" role="alert">
                        <p class="font-bold">Información!</p>
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <div class="grid gap-2 pl-5 pr-5 mb-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <input wire:model="searchCodigoBarras" type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:col-span-2 md:col-span-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar">
                    <select wire:model="searchColor" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm sm:col-span-1 md:col-span-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm sm:col-span-1 md:col-span-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{$talla->id}}">{{ $talla->numero1 }}</option>
                        @endforeach
                    </select>
                </div>
                @if($inventarios->count())
                    <div class="min-w-full divide-y divide-gray-200">
                        {{-- @php
                            print_r($entradas);
                        @endphp --}}
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Producto
                                </th>
                                <th scope="col" class="flex px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Entradas
                                    @if ($ingresar_entradas)
                                        <svg xmlns="http://www.w3.org/2000/svg" wire:click="openAlertEntrada" width="24" height="24" class="text-green-700 cursor-pointer" viewBox="0 0 24 24" fill="currentColor"><path fill="none" d="M9 14H15V19H9zM11 5H13V7H11z"></path><path fill="none" d="M7,14c0-1.103,0.897-2,2-2h6c1.103,0,2,0.897,2,2v5h2.001L19,8.414L15.586,5H15v4h-1h-1h-2H9H7V5H5v14h2V14z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2V8c0-0.265-0.105-0.52-0.293-0.707l-4-4C16.52,3.105,16.266,3,16,3H5C3.897,3,3,3.897,3,5v14 C3,20.103,3.897,21,5,21z M15,19H9v-5h6V19z M13,7h-2V5h2V7z M5,5h2v4h2h2h2h1h1V5h0.586L19,8.414L19.001,19H17v-5 c0-1.103-0.897-2-2-2H9c-1.103,0-2,0.897-2,2v5H5V5z"></path></svg>
                                    @else
                                        <svg wire:click="openIngresarEntradas" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif

                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ultima Entrada
                                </th>
                                <th scope="col" class="flex px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Salidas
                                    @if ($ingresar_salidas)
                                        <svg xmlns="http://www.w3.org/2000/svg" wire:click="guardarSalidas" width="24" height="24" class="text-red-800 cursor-pointer" viewBox="0 0 24 24" fill="currentColor"><path fill="none" d="M9 14H15V19H9zM11 5H13V7H11z"></path><path fill="none" d="M7,14c0-1.103,0.897-2,2-2h6c1.103,0,2,0.897,2,2v5h2.001L19,8.414L15.586,5H15v4h-1h-1h-2H9H7V5H5v14h2V14z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2V8c0-0.265-0.105-0.52-0.293-0.707l-4-4C16.52,3.105,16.266,3,16,3H5C3.897,3,3,3.897,3,5v14 C3,20.103,3.897,21,5,21z M15,19H9v-5h6V19z M13,7h-2V5h2V7z M5,5h2v4h2h2h2h1h1V5h0.586L19,8.414L19.001,19H17v-5 c0-1.103-0.897-2-2-2H9c-1.103,0-2,0.897-2,2v5H5V5z"></path></svg>
                                    @else
                                        <svg wire:click="openIngresarSalidas" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-800" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ultima Salida
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Stock
                                </th>
                                <th scope="col" class="relative px-4 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inventarios as $inventario)
                                <tr>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-1">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->producto->linea->nombre}}
                                                {{$inventario->producto->categoria->nombre}}
                                                {{$inventario->producto->modelo->nombre}}
                                                {{$inventario->producto->color->nombre}}
                                                T. {{$inventario->producto->talla->numero1}}
                                                <p class="text-xs">{{$inventario->producto->codigo_barras}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="">
                                            <div class="flex text-sm font-medium text-gray-900">
                                                @if ($ingresar_entradas)
                                                    <input wire:model="entradas.{{$inventario->producto->id}}" type="number" class="block w-20 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @else
                                                    {{$inventario->entradas}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{\Carbon\Carbon::parse($inventario->ultima_entrada)->locale('es_ES')->isoFormat('YYYY-MM-DD hh:mm')}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="">
                                            <div class="flex text-sm font-medium text-gray-900">
                                                @if ($ingresar_salidas)
                                                    <input wire:model="salidas.{{$inventario->producto->id}}" type="number" class="block w-20 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @else
                                                    {{$inventario->salidas}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                @if ($inventario->ultima_salida)
                                                {{\Carbon\Carbon::parse($inventario->ultima_salida)->locale('es_ES')->isoFormat('YYYY-MM-DD hh:mm')}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{$inventario->stock >= 5 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}} ">
                                                {{$inventario->stock}}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- <a href="{{route('inventarios.edit', $inventario)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">Editar</a> --}}
                                    <button wire:click="openEntradasSalidas({{$inventario->producto}})" class="w-5 h-5 text-blue-400 bg-transparent modal-open hover:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                        </svg>
                                    </button>
                                </td>
                                </tr>
                            @endforeach
                            <!-- More items... -->
                            </tbody>
                        </table>
                        <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                            {{ $inventarios->links() }}
                        </div>
                    </div>
                @else
                    <p class="px-6 py-2 bg-gray-100 border-t border-gray-200">No hay registro.</p>
                @endif
            </div>
        </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Entradas y Salidas
        </x-slot>
        <x-slot name="content">
            @if ($inventarioDetalle)
            <div class="min-w-full divide-y divide-gray-200">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Fecha
                        </th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                            Entradas
                        </th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Salidas
                        </th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Stock
                        </th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Elaborado por
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($inventarioDetalle as $item)
                        <tr>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">
                                        @if ($item->ultima_entrada)
                                            {{\Carbon\Carbon::parse($item->ultima_entrada)->locale('es_ES')->isoFormat('YYYY-MM-DD hh:mm')}}
                                        @else
                                            {{\Carbon\Carbon::parse($item->ultima_salida)->locale('es_ES')->isoFormat('YYYY-MM-DD hh:mm')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$item->entradas}}
                                </div>
                                @if ($item->entradas)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                        </td>

                        <td class="px-4 py-1 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$item->salidas}}
                                </div>
                                @if ($item->salidas)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-800" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{$item->stock >= 5 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}} ">
                                        {{$item->stock}}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <div class="flex items-center">
                                {{$item->descripcion}}
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                    {{ $inventarioDetalle->links() }}
                </div> --}}
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    <x-jet-dialog-modal wire:model="openGuardarEntradas">
        <x-slot name="title">
            Produccion Elaborada por:
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-2">
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" wire:model="elaboradoPor" id="" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openGuardarEntradas', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="guardarEntradas" class="inline-flex items-center border border-gray-300 rounded-md shadow-sm disabled:opacity-25">
                <svg wire:loading wire:target="guardarEntradas" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Guardar Entradas
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
