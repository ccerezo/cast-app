<div>
    <div class="flex justify-between">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Listado de Facturas</p>
        <a href="{{route('facturas.create')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear Factura
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
                @if($facturas->count())
                <div class="min-w-full divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Número
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Fecha
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Cliente
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Total
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                F. Pago
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Estado
                            </th>
                            <th scope="col" class="relative px-1 py-3">
                                <span class="sr-only">Ver</span>
                            </th>
                            <th scope="col" class="relative px-1 py-3">
                                <span class="sr-only">Print</span>
                            </th>
                            <th scope="col" class="relative px-1 py-3">
                                <span class="sr-only">Anular</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($facturas as $factura)
                            <tr>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center text-sm font-medium text-gray-900">
                                    {{$factura->numero}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center text-sm font-medium text-gray-900">
                                    {{ date('Y-m-d H:i', strtotime($factura->fecha)) }}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$factura->cliente->nombre}}
                                            <p class="text-xs">{{$factura->cliente->identificacion}}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-right text-sm font-medium text-gray-900">
                                    $ {{$factura->total}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                @if ($factura->forma_pago == 'CONTADO')
                                    <div class="text-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-green-800">
                                            CONTADO
                                        </span>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-yellow-800">
                                            CRÉDITO
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    @if ($factura->estadoFactura->codigo == '01')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                            {{$factura->estadoFactura->nombre}}
                                        </span>
                                    @else
                                        @if ($factura->estadoFactura->codigo == '03' || $factura->estadoFactura->codigo == '04')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @endif
                                    @endif

                                </div>
                            </td>
                            <td class="px-1 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{route('facturas.show', $factura)}}" class="text-indigo-600 hover:text-indigo-800" title="Ver Factura">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                {{-- <a href="{{route('facturas.edit', $factura)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">edit</a> --}}

                            </td>
                            <td class="px-1 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{route('pdf.generate', $factura)}}" target="_blank" class="text-gray-600 hover:text-gray-800" title="Imprimir">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                            @if ($factura->estadoFactura->codigo != '02')
                                <td class="pt-1">
                                    <button type="button" wire:click="modalEliminar({{$factura->id}})" class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            @endif

                            </tr>
                        @endforeach
                        <!-- More items... -->
                        </tbody>
                    </table>
                    <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                        {{ $facturas->links() }}
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
            <span class="text-red-600">Información</span>
        </x-slot>

        <x-slot name="content">
            <p>Está seguro que desea <b>ANULAR</b> la Factura?</p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            @if ($factura_tmp)
            <form action="{{route('facturas.destroy', $factura_tmp)}}" method="POST" class="inline-flex ml-2">
                @csrf
                @method('delete')
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    ACEPTAR
                </button>
            </form>
            @endif

            {{-- <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Aceptar') }}
            </x-jet-danger-button> --}}
        </x-slot>
    </x-jet-dialog-modal>
</div>
