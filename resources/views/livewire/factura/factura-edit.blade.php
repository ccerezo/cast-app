<div>
    <div class="flex justify-between border-b border-gray-300">
        {{-- <p class="inline-flex mt-3 pl-5 text-lg text-gray-700">Factura: #{!! Form::text('numero', null, ['wire:model' => "numeroFactura", 'class' => 'pt-0.5 border-0 pl-2 focus:ring-indigo-500 focus:border-indigo-500 text-md border-gray-300']) !!}</p> --}}
        <p class="inline-flex mt-3 pl-5 text-lg text-gray-700">Factura</p>
    </div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-6 md:gap-3">
            <div class="mt-5 md:mt-0 md:col-span-6">
                @if (session('info'))
                    <div class="bg-green-400 border-l-4 border-green-900 text-gray-900 p-4" role="alert">
                        <p class="font-bold">Información!</p>
                        <p>{{session('info')}}</p>
                    </div>
                @endif
                {!! Form::model($factura, ['route' => ['facturas.update', $factura], 'method' => 'put']) !!}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-2 bg-white">

                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-start-1 col-span-12">
                                <div class="grid grid-cols-12 gap-0">
                                    <div class="col-start-1 col-span-12">
                                        <label class="bg-gray-100 p-2 border block text-xs text-gray-700">Datos de Factura</label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Número: {{ $factura->numero }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Cliente: {{ $factura->cliente->nombre }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Forma de Pago: {{ $factura->forma_pago }}</label>
                                </div>
                                <div class="grid grid-cols-3 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">F. Ingreso: {{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Facturado como: {{ $factura->tipoCliente->tipo }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Estado:
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
                                    </label>
                                </div>
                                @if (strcmp($factura->forma_pago, 'CREDITO') === 0)
                                <div class="grid grid-cols-3 gap-0">
                                    @if ($factura->vencimiento)
                                        <label class="px-2 py-1 block text-xs text-gray-700">F. Vencimiento: {{ $factura->vencimiento }}</label>
                                    @else
                                        <label></label>
                                    @endif

                                    <label></label>
                                    @if ($pagos->count())
                                        <label class="px-2 py-1 block text-xs text-gray-700">Método de pago:
                                        @foreach ($pagos as $pago)
                                            {{ $pago->metodoPago->nombre }}
                                        @endforeach
                                        </label>
                                    @else
                                        <label></label>
                                    @endif
                                </div>
                                @endif
                                @if (strcmp($factura->forma_pago, 'CONTADO') === 0)
                                <div class="grid grid-cols-3 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Cajero:  {{ $factura->user->name }}</label>
                                    <label></label>
                                    @if ($pagos->count())
                                        <label class="px-2 py-1 block text-xs text-gray-700">Método de pago:
                                        @foreach ($pagos as $pago)
                                            {{ $pago->metodoPago->nombre }}
                                        @endforeach
                                        </label>
                                    @endif
                                </div>
                                @endif
                                <div class="grid grid-cols-2 gap-0">
                                    @if ($factura->observacion)
                                        <label class="px-2 py-1 block text-xs text-gray-700">Observación: {{ $factura->observacion }}</label>
                                    @else
                                        <label></label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-start-1 col-span-8 mt-5 border-gray-300 pb-3 rounded">

                            {{-- <div class="col-start-1 col-span-12">
                                <label class="bg-gray-100 p-2 border block text-xs text-gray-700">Agregar productos a la Factura</label>
                            </div> --}}
                            <div class="col-start-1 col-span-8 m-2">
                                @livewire('shared.producto-search')
                            </div>

                            <div class="grid grid-cols-12 gap-0 m-2">
                                <div class="col-start-1 col-span-7">
                                    {!! Form::label('descripcion', 'Descripción', ['class' => 'bg-gray-50 px-2 py-1 border block text-xs text-gray-700']) !!}
                                </div>
                                <div class="col-start-8 col-span-1">
                                    {!! Form::label('precio', 'Precio', ['class' => 'text-center bg-gray-50 px-2 py-1 border-r border-b border-t block text-xs text-gray-700']) !!}
                                </div>
                                <div class="col-start-9 col-span-1">
                                    {!! Form::label('cantidad', 'Cantidad', ['class' => 'text-center bg-gray-50 px-2 py-1 border-r border-b border-t block text-xs text-gray-700']) !!}
                                </div>
                                <div class="col-start-10 col-span-1">
                                    {!! Form::label('descuento', 'Descuento', ['class' => 'text-center bg-gray-50 px-2 py-1 border-r border-b border-t block text-xs text-gray-700']) !!}
                                </div>
                                <div class="col-start-11 col-span-2">
                                    <div class="grid grid-cols-12 gap-0">
                                        <div class="col-start-1 col-span-10 text-center">
                                            {!! Form::label('importe', 'Importe', ['class' => 'bg-gray-50 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                        </div>
                                        <div class="col-start-11 col-span-2">
                                            {!! Form::label('-', '', ['class' => 'bg-gray-50 px-2 py-1  border-b border-t border-r block text-xs text-gray-100']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach ($seleccionados as $i => $id)
                                @foreach($detalle as $j => $p)

                                    @if ($id == $p['id'])
                                        <div class="grid grid-cols-12 gap-0">

                                            <div class="col-start-1 col-span-7 text-xs py-1 pl-4">
                                                {{ $p['descripcion'] }} {{ ($p['descuento']+0) > 0 ? ' - Desct. '.$p['descuento'].'%':'' }}
                                            </div>
                                            <div class="col-start-8 col-span-1 text-xs text-right pr-3 py-1">
                                                @if (strcmp($factura->tipoCliente->codigo, '03') === 0)
                                                    $ {{ number_format(($p['precio_venta_publico']+0),2) }}
                                                @else
                                                    @if (strcmp($factura->tipoCliente->codigo, '02') === 0)
                                                        $ {{ number_format(($p['precio_mayorista']+0),2) }}
                                                    @else
                                                        @if (strcmp($factura->tipoCliente->codigo, '01') === 0)
                                                            $ {{ number_format(($p['precio_produccion']+0),2) }}
                                                        @endif
                                                    @endif
                                                @endif

                                            </div>
                                            <div class="col-start-9 col-span-1 text-xs">
                                                {!! Form::number('cantidad['.$p['id'].']', null, ['wire:model' => "cantidad.$i",
                                                                                                    'wire:keydown.tab' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                    'wire:keydown.enter.prevent' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                    'wire:change' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                    'min' => '1',
                                                                                                    'class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                            </div>
                                            <div class="col-start-10 col-span-1 text-xs text-right pr-3 py-1">
                                                $ {{ number_format(($p['valor_descuento']+0),2) }}
                                            </div>
                                            <div class="col-start-11 col-span-2 text-xs text-right">
                                                <div class="grid grid-cols-12 gap-0">
                                                    <div class="col-start-1 col-span-9 pr-3 py-1">
                                                        $ {{ number_format(($p['importe']+0),2) }}
                                                    </div>
                                                    <div class="col-start-10 col-span-3 pl-2">
                                                        <svg wire:click="eliminarProducto({{$p['id']}})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 24" stroke="currentColor" class="cursor-pointer text-red-700">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach

                            {{-- @if ($mensaje_repetido !== '')
                                <span class="mt-1 text-xs text-red-500 pl-3">{{$mensaje_repetido}}</span>
                            @endif --}}


                            @if(count($detalle))
                                <div class="grid grid-cols-12">

                                    <div class="col-start-10 col-span-1">
                                        <label class="text-right pr-2 py-1 block text-xs text-gray-700">Subtotal:</label>
                                    </div>
                                    <div class="col-start-11 col-span-2 text-xs text-right">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="col-start-1 col-span-9 pr-3 pt-1">
                                                {!! Form::label('subtotal', '$ '.number_format($subtotal,2), ['class' => 'block text-xs text-gray-700 text-right']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-10 col-span-1">
                                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">IVA:</label>
                                    </div>
                                    <div class="col-start-11 col-span-2 text-xs text-right">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="col-start-1 col-span-9 pr-3 pt-1">
                                                {!! Form::label('subtotal', '$ '.number_format($iva,2), ['class' => 'block text-xs text-gray-700 text-right']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-10 col-span-1">
                                        <label class="text-right pr-2 pt-1 block text-xs text-gray-700">Descuento:</label>
                                    </div>
                                    <div class="col-start-11 col-span-2 text-xs text-right">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="col-start-1 col-span-9 pr-3 pt-1">
                                                {!! Form::label('descuento', '$ '.number_format($total_descuento,2), ['class' => 'block text-xs text-gray-700 text-right']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-10 col-span-1 mt-1">
                                        <label class="text-right pr-2 pt-1 font-bold block text-lg text-gray-700 border-t border-b border-l border-gray-300">Total:</label>
                                    </div>
                                    <div class="col-start-11 col-span-2 mt-1">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="col-start-1 col-span-9 pr-3 pt-1 border-t border-b border-r border-gray-300">
                                                {!! Form::label('total', '$ '.number_format($total,2), ['class' => 'text-right font-bold block w-full text-lg']) !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{route('facturas.index')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Regresar
                        </a>
                        @if ($cantidad_total == $cantidad_total_tmp)
                            {!! Form::submit('Guardar', ['class' => 'cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) !!}
                        @else
                            <p class="inline-flex text-sm text-red-500 mr-5">La Factura debe contener {{ $cantidad_total_tmp }} producto(s), pero actualmente existen {{$cantidad_total}} producto(s) en esta Factura</p>
                        @endif

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
