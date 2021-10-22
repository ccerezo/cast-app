<div>
    <div class="flex justify-between pb-2 mb-3 border-b border-gray-300 shadow ">
        {{-- <p class="inline-flex pl-5 mt-3 text-lg text-gray-700">Factura: #{!! Form::text('numero', null, ['wire:model' => "numeroFactura", 'class' => 'pt-0.5 border-0 pl-2 focus:ring-indigo-500 focus:border-indigo-500 text-md border-gray-300']) !!}</p> --}}
        <p class="inline-flex pl-5 mt-3 text-lg text-gray-700">Ventas Mensuales</p>
        <x-jet-danger-button wire:click="$set('openModal',true)" class="inline-flex items-center px-4 py-2 mt-2 mr-5 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Ver Reportes
        </x-jet-danger-button>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (session('info'))
                    <div class="p-4 text-gray-900 bg-green-400 border-l-4 border-green-900" role="alert">
                        <p class="font-bold">Información!</p>
                        <p>{{session('info')}}</p>
                    </div>
            @endif

            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">

                @if($ventas->count())
                <div class="min-w-full divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Año
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Mes
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Ventas
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Detalle
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ventas as $venta)
                            <tr>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-center text-gray-900">
                                    {{$venta->year}}

                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-center text-gray-900">
                                    {{ \Carbon\Carbon::parse("".$venta->year."-".$venta->mes."")->locale('es_ES')->monthName }}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-center text-gray-900">
                                    $ {{number_format($venta->total,2)}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{route('pdf.reporteMensualPDF', [$venta->year, $venta->month])}}" target="_blank" class="text-gray-600 hover:text-gray-800" title="Imprimir">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                        {{ $ventas->links() }}
                    </div>
                </div>
                @else
                    <p class="px-6 py-2 bg-gray-100 border-t border-gray-200">No existen registros.</p>
                @endif
            </div>
        </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
           Seleccione Fechas, Desde - Hasta
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-0 mb-1 border-t border-gray-300">
                <label class="mt-3">Fecha de Inicio:</label>
                <div class="mt-3">
                    {!! Form::date('desde', \Carbon\Carbon::now()->format('Y-m-d'), ['wire:model' => 'desde', 'class' => 'w-full block mb-1 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-xs border border-gray-300']) !!}
                    @error('fecha')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-0 mb-1">
                <label class="mt-3">Fecha de Fin:</label>
                <div class="mt-3">
                    {!! Form::date('hasta', \Carbon\Carbon::now()->format('Y-m-d'), ['wire:model' => 'hasta', 'class' => 'w-full block mb-1 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-xs border border-gray-300']) !!}
                    @error('fin')
                        <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-0 mb-5">
                <label class="mt-3">Cliente:</label>
                <div class="mt-3">
                    @livewire('shared.cliente-search')
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <a href="{{route('pdf.reportePorPrecioPDF', [$desde, $hasta, $cliente_id])}}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Imprimir">
                Ventas por Precio
            </a>
            <a href="{{route('pdf.reportePorProductosPDF', [$desde, $hasta, $cliente_id])}}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Imprimir">
                Productos Vendidos
            </a>
            <a href="{{route('pdf.reporteLoMasVendidoPDF', [$desde, $hasta])}}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Imprimir">
                Lo más Vendido
            </a>
            <a href="{{route('pdf.reporteDetalleInventarioPDF', [$desde, $hasta])}}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Imprimir">
                Inventario Detalle
            </a>
        </x-slot>
    </x-jet-dialog-modal>
</div>
