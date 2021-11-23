<div>
    <div class="flex justify-between mb-3 border-b border-gray-300">
        {{-- <p class="inline-flex pl-5 mt-3 text-lg text-gray-700">Factura: #{!! Form::text('numero', null, ['wire:model' => "numeroFactura", 'class' => 'pt-0.5 border-0 pl-2 focus:ring-indigo-500 focus:border-indigo-500 text-md border-gray-300']) !!}</p> --}}
        <p class="inline-flex pl-5 mt-3 text-lg text-gray-700">Cuentas por Cobrar</p>
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
                <div class="grid grid-cols-12 gap-3 px-2 mb-3 border-gray-300 rounded">
                    <div class="col-span-4 col-start-1">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-3 col-start-1">
                                {!! Form::label('l_numero', 'Número:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-span-4 col-start-4">
                                {!! Form::text('numero', null, ['wire:model' => "searchNumero", 'class' => 'mb-1 px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 text-xs border-gray-300']) !!}
                                @error('numero')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                                @enderror
                            </div>
                            <div class="col-span-3 col-start-1">
                                {!! Form::label('l_pago', 'Forma de Pago:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-span-9 col-start-4 py-1 pl-1 text-xs">
                                {!! Form::checkbox('forma_pago', 'CONTADO', null, ['wire:model' => "searchContado", 'class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Contado
                                {!! Form::checkbox('forma_pago', 'CREDITO', null, ['wire:model' => "searchCredito", 'class' => 'ml-4 py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Crédito
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 col-start-5">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-2 col-start-1">
                                {!! Form::label('l_cliente', 'Cliente:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-span-9 col-start-3">
                                @livewire('shared.cliente-search')
                            </div>
                            @if (count($select_factura))
                                <div class="col-span-2 col-start-1">
                                    {!! Form::label('l_total_pagar', 'Facturas:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                                </div>
                                <div class="flex col-span-5 col-start-3">
                                    <label class="flex items-center justify-center w-full py-1 text-xs text-center text-red-500">
                                        ({{count($select_factura)}}) Seleccionadas
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-4 col-start-9">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-3 col-start-1">
                                {!! Form::label('l_cta_x_cobrar', 'Por Cobrar:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="w-full col-span-6 col-start-4">
                                <label class="block py-1 pr-2 text-xs text-right text-gray-700 border border-gray-300">
                                    $ {{$por_cobrar - $abonado}}
                                </label>
                            </div>
                            @if (count($select_factura)>0)
                            <div class="col-span-3 col-start-1">
                                {!! Form::label('l_total_pagar', 'Total a:', ['class' => 'pt-1 text-xs text-gray-700']) !!}
                            </div>
                            <div class="flex col-span-6 col-start-4">
                                <label class="flex items-center justify-center w-1/2 py-1 text-xs text-center text-red-500 border border-gray-300 rounded">
                                    $ {{number_format($total_facturas_seleccionadas,2)}}
                                </label>
                                <button type="button" wire:click="registrarPagoFacturasSeleccionadas()" class="flex items-center justify-center w-1/2 py-1 text-xs text-white bg-indigo-600 border border-indigo-600 rounded hover:bg-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg> <span class="mt-0.5">Pagar</span>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    {!! Form::hidden('cliente_id', $cliente_id) !!}
                </div>
                @if($facturas->count())
                @php
                    // print_r($select_factura);
                @endphp
                <div class="min-w-full divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            @if ($cliente)
                            <th class="px-1">
                                {{-- {!! Form::checkbox('forma_pago', 'CONTADO', null, ['wire:model' => "searchContado", 'class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} --}}
                            </th>
                            @endif
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Número
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                F. Ingreso
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Cliente
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                F. Vencimiento
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Valor
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Abonado
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                Saldo
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                F. Pago
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
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
                            {{-- <tr class="{{$select_factura[$factura->id] ? 'bg-yellow-300': ''}}"> --}}
                            <tr>
                            @if ($cliente)
                            <td class="px-2 py-3">
                                @if ($factura->estadoFactura->codigo == '03' || $factura->estadoFactura->codigo == '04')
                                {!! Form::checkbox('forma_pago', $factura->id, null,
                                    ['wire:model' => "select_factura.$factura->id",
                                    'wire:click' => "facturasSeleccionadas()",
                                    'class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!}
                                @endif
                            </td>
                            @endif
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-center text-gray-900">
                                    {{$factura->numero}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-center text-gray-900">
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
                                <div class="text-sm font-medium text-center text-gray-900">
                                    @if ($factura->vencimiento)
                                        <p>{{ date('Y-m-d', strtotime($factura->vencimiento)) }}</p>
                                        @php
                                            $hoy = \Carbon\Carbon::parse(date('Y-m-d'));
                                            $vencimiento = \Carbon\Carbon::parse($factura->vencimiento);
                                        @endphp
                                        @if ($factura->estadoFactura->codigo != '01')
                                            @if ($vencimiento->diffInDays($hoy, false) > 0)
                                            <p class="inline px-2 text-xs font-semibold leading-5 text-yellow-800 rounded-full">
                                                {{$vencimiento->diffInDays($hoy, false)}} días vencidos
                                            </p>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>

                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-right text-gray-900">
                                    $ {{$factura->total}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-right text-gray-900">
                                    $ {{ number_format($this->abonadoPorFactura($factura->id),2)}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-right text-gray-900">
                                    $ {{ number_format($factura->total - $this->abonadoPorFactura($factura->id),2)}}
                                </div>
                            </td>

                            <td class="px-3 py-3 whitespace-nowrap">
                                @if ($factura->forma_pago == 'CONTADO')
                                    <div class="text-center">
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 rounded-full">
                                            CONTADO
                                        </span>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 rounded-full">
                                            CRÉDITO
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    @if ($factura->estadoFactura->codigo == '01')
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-200 rounded-full">
                                            {{$factura->estadoFactura->nombre}}
                                        </span>
                                    @else
                                        @if ($factura->estadoFactura->codigo == '03' || $factura->estadoFactura->codigo == '04')
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-200 rounded-full">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @endif
                                    @endif

                                </div>
                            </td>
                            <td class="px-1 py-3 text-sm font-medium text-center whitespace-nowrap">
                                <button type="button" wire:click="registrarPago({{$factura->id}})" class="text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
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
                    <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                        {{ $facturas->links() }}
                    </div>
                </div>
                @else
                    <p class="px-6 py-2 bg-gray-100 border-t border-gray-200">No tiene cuentas por cobrar.</p>
                @endif
            </div>
        </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            @if ($factura_tmp)
                @if ($factura_tmp->estadoFactura->codigo != '01')
                <p class="w-full px-2 text-gray-600 border-b border-gray-300 shadow-b">
                    Registar Pago de Factura # {{$factura_tmp->numero}}
                </p>
                @else
                <p class="w-full px-2 text-green-600 border-b border-gray-300 shadow-b">
                    Factura # {{$factura_tmp->numero}} ya está pagada
                </p>
                @endif
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-12 gap-0 mb-5 border border-gray-300">
                @if (count($pagos_factura))
                <div class="col-span-12 col-start-1 divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Método de Pago
                            </th>
                            <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Fecha
                            </th>
                            <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Monto
                            </th>
                            <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="col-span-5 col-start-1">
                        <label class="block p-2 text-xs text-gray-700">Esta Factura no tiene Pagos Registrados</label>
                    </div>
                @endif
            </div>
            @if ($factura_tmp)
                @if ($factura_tmp->estadoFactura->codigo != '01')
                <div class="grid grid-cols-12 gap-0 border border-gray-300">
                    <div class="col-span-2 col-start-1 border-r border-gray-300">
                        <label class="block pt-2 pr-2 text-xs text-right text-gray-700">Saldo Factura:</label>
                    </div>
                    <div class="col-span-8 col-start-3 pb-2 ml-2">
                        <label class="block w-full pt-1 pl-2 text-lg font-bold text-gray-700">$ {{number_format(($factura_tmp->total - $total_pagos),2)}}</label>
                    </div>
                    <div class="col-span-2 col-start-1 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Método de Pago:</label>
                    </div>
                    <div class="col-span-10 col-start-3 pb-2 ml-1 ">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-12 col-start-1 py-1 pl-3 text-sm">
                                @foreach($metodos as $metodo)
                                    <x-jet-input type="radio" name="metodo_pago" value="{{$metodo->id}}" wire:model.defer="metodo_pago" class="py-0.5 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                                    <span class="mr-3">{{$metodo->nombre}}</span>
                                @endforeach
                                <x-jet-input-error for="metodo_pago" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 col-start-1 ml-2 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Fecha de Pago:</label>
                    </div>
                    <div class="col-span-8 col-start-3 pb-2 ml-2">
                        <x-jet-input type="datetime-local" wire:model.defer="fecha" class="px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-jet-input-error for="fecha" />
                    </div>
                    <div class="col-span-2 col-start-1 pb-5 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Monto Recibido:</label>
                    </div>
                    <div class="col-span-8 col-start-3 ml-2">
                        <x-jet-input type="number" wire:model.defer="monto" class="px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-jet-input-error for="monto" />
                    </div>
                    <div class="col-span-2 col-start-1 pb-5 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Descripción:</label>
                    </div>
                    <div class="col-span-9 col-start-3 ml-2">
                        <x-jet-input type="text" wire:model.defer="descripcion" class="w-full px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
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
                        <svg wire:loading wire:target="save" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Guardar Pago
                    </x-jet-danger-button>
                @else
                    <a href="{{route('pdf.generateComprobantePago', $factura_tmp->id)}}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Imprimir">
                        Imprimir
                    </a>
                @endif
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="openModalTotal">
        <x-slot name="title">
            @if ($cliente)
            <p class="w-full px-2 text-gray-600 border-b border-gray-300 shadow-b">
                Cliente {{$cliente->nombre}}
            </p>
            @endif

        </x-slot>
        <x-slot name="content">
            @if (session('messagePago'))
                <div class="p-4 text-gray-900 bg-green-400 border-l-4 border-green-900" role="alert">
                    <p class="mb-3 font-bold border-b border-green-600">El Pago se guardó exitosamente!</p>
                    <p>Pago realizado en <i> {{session('messagePago')->metodoPago->nombre}}</i> por el monto de: <i>$ {{number_format(session('messagePago')->monto,2)}}</i>
                        con fecha <i>{{session('messagePago')->fecha}}</i>
                        @if (session('messagePago')->descripcion)
                            y la siguiente descripción: <i>{{session('messagePago')->descripcion}}</i>
                        @endif
                    </p>
                </div>
            @else
                <div class="grid grid-cols-12 gap-0 border border-gray-300">
                    <div class="col-span-2 col-start-1 border-r border-gray-300">
                        <label class="block pt-2 pr-2 text-xs text-right text-gray-700">Valor a Pagar:</label>
                    </div>
                    <div class="col-span-8 col-start-3 pb-2 ml-2">
                        <label class="block w-full pt-1 pl-2">
                            <span class="text-lg font-bold text-gray-700">$ {{number_format($total_facturas_seleccionadas,2)}} -</span>
                            <span class="text-sm text-gray-700">de ({{count($select_factura)}}) Facturas Seleccionadas</span>
                        </label>
                    </div>
                    <div class="col-span-2 col-start-1 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Método de Pago:</label>
                    </div>
                    <div class="col-span-10 col-start-3 pb-2 ml-1 ">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-12 col-start-1 py-1 pl-3 text-sm">
                                @foreach($metodos as $metodo)
                                    <x-jet-input type="radio" name="metodo_pago" value="{{$metodo->id}}" wire:model.defer="metodo_pago" class="py-0.5 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                                    <span class="mr-3">{{$metodo->nombre}}</span>
                                @endforeach
                                <x-jet-input-error for="metodo_pago" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 col-start-1 ml-2 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Fecha de Pago:</label>
                    </div>
                    <div class="col-span-8 col-start-3 pb-2 ml-2">
                        <x-jet-input type="datetime-local" wire:model.defer="fecha" class="px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-jet-input-error for="fecha" />
                    </div>
                    <div class="col-span-2 col-start-1 pb-5 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Monto Recibido:</label>
                    </div>
                    <div class="col-span-8 col-start-3 ml-2">
                        <x-jet-input type="number" wire:model.defer="monto" class="px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-jet-input-error for="monto" />
                    </div>
                    <div class="col-span-2 col-start-1 pb-5 border-r border-gray-300">
                        <label class="block pt-1 pr-2 text-xs text-right text-gray-700">Descripción:</label>
                    </div>
                    <div class="col-span-9 col-start-3 ml-2">
                        <x-jet-input type="text" wire:model.defer="descripcion" class="w-full px-2 py-1 mr-2 text-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-jet-input-error for="descripcion" />
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModalTotal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            @if (!session('messagePago'))
            <x-jet-danger-button wire:click="saveFacturasSeleccionadas" class="inline-flex items-center border border-gray-300 rounded-md shadow-sm disabled:opacity-25">
                <svg wire:loading wire:target="saveFacturasSeleccionadas" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Guardar Pago
            </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
