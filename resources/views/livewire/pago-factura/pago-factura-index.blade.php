<div>
    <div class="flex justify-between border-b border-gray-300 mb-3">
        {{-- <p class="inline-flex mt-3 pl-5 text-lg text-gray-700">Factura: #{!! Form::text('numero', null, ['wire:model' => "numeroFactura", 'class' => 'pt-0.5 border-0 pl-2 focus:ring-indigo-500 focus:border-indigo-500 text-md border-gray-300']) !!}</p> --}}
        <p class="inline-flex mt-3 pl-5 text-lg text-gray-700">Cuentas por Cobrar</p>
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
                <div class="px-2 grid grid-cols-12 gap-3 border-gray-300 rounded mb-3">
                    <div class="col-start-1 col-span-4">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-3">
                                {!! Form::label('l_numero', 'Número:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-4 col-span-4">
                                {!! Form::text('numero', null, ['wire:model' => "searchNumero", 'class' => 'mb-1 px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 text-xs border-gray-300']) !!}
                                @error('numero')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                                @enderror
                            </div>
                            <div class="col-start-1 col-span-3">
                                {!! Form::label('l_pago', 'Forma de Pago:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-4 col-span-9 text-xs pl-1 py-1">
                                {!! Form::checkbox('forma_pago', 'CONTADO', null, ['wire:model' => "searchContado", 'class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Contado
                                {!! Form::checkbox('forma_pago', 'CREDITO', null, ['wire:model' => "searchCredito", 'class' => 'ml-4 py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Crédito
                            </div>
                        </div>
                    </div>

                    <div class="col-start-5 col-span-4">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-3">
                                {!! Form::label('l_vendedor', 'Vendedor:', ['class' => 'py-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-4 col-span-5">
                                {!! Form::select('vendedor_id', $vendedors, null,
                                                ['wire:model' => 'vendedor_id', 'wire:change' => 'consultarVendedor()',
                                                    'class' => 'w-full block mb-1 py-1 px-3 border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-xs']) !!}
                            </div>
                            <div class="col-start-1 col-span-3">
                                {!! Form::label('l_cupo', 'Saldo Total:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-4 col-span-5">
                                <label class="block py-1 pl-2 text-xs border border-gray-300 text-gray-700">
                                    $ {{number_format($vendedor->cupo_aprobado - $vendedor->cupo_disponible,2)}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-start-9 col-span-4">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-2 text-right">
                                {!! Form::label('l_cliente', 'Cliente:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-4 col-span-9 mb-1 w-full">
                                @livewire('shared.cliente-search')
                                @error('cliente_id')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                                @enderror
                            </div>

                        </div>
                    </div>
                    {!! Form::hidden('cliente_id', $cliente_id) !!}
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
                                F. Ingreso
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Cliente
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                F. Vencimiento
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Valor
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
                                    {{ date('Y-m-d', strtotime($factura->fecha)) }}
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
                                <div class="text-center text-sm font-medium text-gray-900">
                                    @if ($factura->vencimiento)
                                        <p>{{ date('Y-m-d', strtotime($factura->vencimiento)) }}</p>
                                        @php
                                            $hoy = \Carbon\Carbon::parse(date('Y-m-d'));
                                            $vencimiento = \Carbon\Carbon::parse($factura->vencimiento);
                                        @endphp
                                        @if ($factura->estadoFactura->codigo != '01')
                                            @if ($vencimiento->diffInDays($hoy, false) > 0)
                                            <p class="px-2 inline text-xs leading-5 font-semibold rounded-full text-yellow-800">
                                                {{$vencimiento->diffInDays($hoy, false)}} días vencidos
                                            </p>
                                            @endif
                                        @endif
                                    @endif
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
                            <td class="px-1 py-3 whitespace-nowrap text-center text-sm font-medium">
                                <button type="button" wire:click="registrarPago({{$factura->id}})" class="text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                            </td>
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
                    <p class="bg-gray-100 px-6 py-2 border-t border-gray-200">No tiene cuentas por cobrar.</p>
                @endif
            </div>
        </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            @if ($factura_tmp)
                @if ($factura_tmp->estadoFactura->codigo != '01')
                <p class="px-2 w-full text-gray-600 border-b border-gray-300 shadow-b">
                    Registar Pago de Factura # {{$factura_tmp->numero}}
                </p>
                @else
                <p class="px-2 w-full text-green-600 border-b border-gray-300 shadow-b">
                    Factura # {{$factura_tmp->numero}} ya está pagada
                </p>
                @endif
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-12 gap-0 border border-gray-300 mb-5">
                @if (count($pagos_factura))
                <div class="col-start-1 col-span-12 divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Método de Pago
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pagos_factura as $pago)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-1">
                                            <div class="text-xs text-gray-900">
                                                {{ $pago->metodoPago->nombre }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-center">
                                        <div class="text-xs text-gray-900">
                                            {{ date('Y-m-d H:i', strtotime($pago->fecha)) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-right">
                                        <div class="text-xs font-medium text-gray-900">
                                            $ {{ number_format($pago->monto,2) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="text-xs text-gray-900">
                                        {{ $pago->descripcion }}
                                    </div>
                                </td>
                                <td class="px-1 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('pdf.generatePago', $pago)}}" target="_blank" class="text-gray-600 hover:text-gray-800" title="Imprimir">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="col-start-1 col-span-5">
                        <label class="p-2 block text-xs text-gray-700">Esta Factura no tiene Pagos Registrados</label>
                    </div>
                @endif
            </div>
            @if ($factura_tmp)
                @if ($factura_tmp->estadoFactura->codigo != '01')
                <div class="grid grid-cols-12 gap-0 border border-gray-300">
                    <div class="col-start-1 col-span-2 border-r border-gray-300">
                        <label class="text-right pr-2 pt-2 block text-xs text-gray-700">Saldo Factura:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2 pb-2">
                        <label class="font-bold block w-full text-lg pl-2 pt-1 text-gray-700">$ {{number_format(($factura_tmp->total - $total_pagos),2)}}</label>
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Método de Pago:</label>
                    </div>
                    <div class="col-start-3 col-span-10 ml-1 pb-2 ">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-12 pl-3 py-1 text-sm">
                                @foreach($metodos as $metodo)
                                    <x-jet-input type="radio" name="metodo_pago" value="{{$metodo->id}}" wire:model.defer="metodo_pago" class="py-0.5 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                                    <span class="mr-3">{{$metodo->nombre}}</span>
                                @endforeach
                                <x-jet-input-error for="metodo_pago" />
                            </div>
                        </div>
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300 ml-2">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Fecha de Pago:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2 pb-2">
                        <x-jet-input type="datetime-local" wire:model.defer="fecha" class="mr-2 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm border border-gray-300" />
                        <x-jet-input-error for="fecha" />
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300 pb-5">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Monto Recibido:</label>
                    </div>
                    <div class="col-start-3 col-span-8 ml-2">
                        <x-jet-input type="number" wire:model.defer="monto" class="mr-2 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm border border-gray-300" />
                        <x-jet-input-error for="monto" />
                    </div>
                    <div class="col-start-1 col-span-2 border-r border-gray-300 pb-5">
                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Descripción:</label>
                    </div>
                    <div class="col-start-3 col-span-9 ml-2">
                        <x-jet-input type="text" wire:model.defer="descripcion" class="w-full mr-2 py-1 px-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm border border-gray-300" />
                        <x-jet-input-error for="descripcion" />
                    </div>
                </div>
                @endif
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            @if ($factura_tmp)
                @if ($factura_tmp->estadoFactura->codigo != '01')
                <x-jet-danger-button wire:click="save" class="inline-flex items-center border border-gray-300 rounded-md shadow-sm disabled:opacity-25">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Guardar Pago
                </x-jet-danger-button>
                @endif
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
