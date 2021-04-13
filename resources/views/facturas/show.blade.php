<x-app-layout>
    <div class="flex justify-between border-b border-gray-300">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Factura</p>
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
                                    <label class="px-2 py-1 block text-xs text-gray-700">Vendedor:  {{ $factura->vendedor->nombre }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Cliente: {{ $factura->cliente->nombre }}</label>
                                </div>
                                <div class="grid grid-cols-3 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Fecha: {{ $factura->fecha }}</label>
                                    <label class="px-2 py-1 block text-xs text-gray-700">Forma de Pago: {{ $factura->forma_pago }}</label>
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
                                <div class="grid grid-cols-3 gap-0">
                                    @if ($factura->observacion)
                                        <label class="px-2 block text-xs text-gray-700">Observación: {{ $factura->observacion }}</label>
                                    @else
                                        <label></label>
                                    @endif
                                    @if ($pagos->count())
                                        <label class="px-2 block text-xs text-gray-700">Método de pago:
                                        @foreach ($pagos as $pago)
                                            {{ $pago->metodoPago->nombre }}
                                        @endforeach
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-1">
                                {!! Form::label('codigo', 'Código', ['class' => 'bg-gray-100 px-2 py-1  border-b border-t block text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-2 col-span-7">
                                {!! Form::label('descripcion', 'Descripción', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-9 col-span-1">
                                {!! Form::label('precio', 'Precio', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-center text-gray-700']) !!}
                            </div>
                            <div class="col-start-10 col-span-1">
                                {!! Form::label('cantidad', 'Cantidad', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-center text-gray-700']) !!}
                            </div>
                            <div class="col-start-11 col-span-1">
                                {!! Form::label('descuento', 'Descuento', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-center text-gray-700']) !!}
                            </div>
                            <div class="col-start-12 col-span-1">
                                {!! Form::label('importe', 'Importe', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-center text-gray-700']) !!}
                            </div>
                        </div>

                        @foreach ($productos as $item)

                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-1 col-span-1 text-xs py-1 pl-3 border-r">
                                {{ $item->producto->codigo }}
                            </div>
                            <div class="col-start-2 col-span-7 text-xs py-1 pl-3 border-r">
                                {{ $item->producto->descripcion }} {{ ($item->descuento+0) > 0 ? ' - Desct. '.$item->descuento.'%':'' }}
                            </div>
                            <div class="col-start-9 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                @if (strcmp($factura->tipo, 'FINAL') === 0)
                                    $ {{ number_format(($item->precio_venta_publico+0),2) }}
                                @else
                                    @if (strcmp($factura->tipo, 'MAYORISTA') === 0)
                                        $ {{ number_format(($item->precio_mayorista+0),2) }}
                                    @endif
                                @endif

                            </div>
                            <div class="col-start-10 col-span-1 text-xs border-r py-1 text-center">
                                {{ $item->cantidad }}
                            </div>
                            <div class="col-start-11 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                @if (strcmp($factura->tipo, 'FINAL') === 0)
                                    $ {{ number_format(($item->precio_venta_publico * $item->cantidad) * (($item->descuento)/100),2) }}
                                @else
                                    @if (strcmp($factura->tipo, 'MAYORISTA') === 0)
                                        $ {{ number_format(($item->precio_mayorista * $item->cantidad) * (($item->descuento)/100),2) }}
                                    @endif
                                @endif

                            </div>
                            <div class="col-start-12 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                @if (strcmp($factura->tipo, 'FINAL') === 0)
                                    $ {{ number_format(($item->precio_venta_publico * $item->cantidad),2) }}
                                @else
                                    @if (strcmp($factura->tipo, 'MAYORISTA') === 0)
                                        $ {{ number_format(($item->precio_mayorista * $item->cantidad),2) }}
                                    @endif
                                @endif

                            </div>
                        </div>
                        @endforeach

                        <div class="grid grid-cols-12 gap-0 border-t pt-3">
                            <div class="col-start-11 col-span-2">
                                <div class="grid grid-cols-2 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Subtotal:</label>
                                    <label class="pr-3 py-1 block text-xs text-gray-700 text-right">$ {{number_format($factura->subtotal,2)}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-11 col-span-2">
                                <div class="grid grid-cols-2 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Iva:</label>
                                    <label class="pr-3 py-1 block text-xs text-gray-700 text-right">$ {{number_format($factura->iva,2)}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-11 col-span-2">
                                <div class="grid grid-cols-2 gap-0">
                                    <label class="px-2 py-1 block text-xs text-gray-700">Descuento:</label>
                                    <label class="pr-3 py-1 block text-xs text-gray-700 text-right">$ {{number_format($factura->descuento,2)}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-11 col-span-2">
                                <div class="grid grid-cols-2 gap-0">
                                    <label class="pl-2 py-1 font-bold block border-t text-lg text-gray-700">TOTAL:</label>
                                    <label class="pr-3 py-1 text-right border-t font-bold block w-full text-lg border-gray-300">$ {{number_format($factura->total,2)}}</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{route('facturas.index')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Regresar
                        </a>
                        <a href="{{route('pdf.generate', $factura)}}" target="_blank" class="cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Imprimir</a>
                        {{-- {!! Form::submit('Editar', ['class' => 'cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
