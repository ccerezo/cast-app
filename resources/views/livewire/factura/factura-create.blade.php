<div>
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
                {!! Form::open(['route' => 'facturas.store']) !!}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-2 bg-white">

                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-start-1 col-span-8">

                                {{-- {!! Form::text('producto_id', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300 rounded', 'placeholder' => 'Buscar Producto']) !!} --}}
                                @livewire('shared.producto-search')

                                <div class="grid grid-cols-12 gap-0">
                                    <div class="col-start-1 col-span-1">
                                        {!! Form::label('codigo', 'Código', ['class' => 'bg-gray-100 px-2 py-1  border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-2 col-span-7">
                                        {!! Form::label('descripcion', 'Descripción', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-9 col-span-1">
                                        {!! Form::label('precio', 'Precio', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-10 col-span-1">
                                        {!! Form::label('cantidad', 'Cantidad', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-11 col-span-1">
                                        {!! Form::label('descuento', 'Descuento', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-12 col-span-1">
                                        {!! Form::label('importe', 'Importe', ['class' => 'bg-gray-100 px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                </div>

                                @foreach ($seleccionados as $i => $id)
                                    @foreach($detalle as $j => $p)

                                        {{-- @if ($id == $p->id)
                                            <div class="grid grid-cols-12 gap-0 border">
                                                <div class="col-start-1 col-span-2 text-xs py-1 pl-3 border-r">
                                                    {{ $p->codigo }}
                                                </div>
                                                <div class="col-start-3 col-span-7 text-xs py-1 pl-3 border-r">
                                                    {{ $p->descripcion }}
                                                </div>
                                                <div class="col-start-10 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                                    $ {{ number_format($p->precio_venta_publico,2) }}
                                                </div>
                                                <div class="col-start-11 col-span-1 text-xs">
                                                    {!! Form::text('cantidad['.$i.']', $items_cantidad, ['wire:keydown.tab' => 'valorFinal('.$p.')' , 'class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                                </div>
                                                <div class="col-start-12 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                                    $ {{ number_format($p->precio_venta_publico,2) }}
                                                </div>
                                            </div>
                                        @endif --}}

                                        @if ($id == $p['id'])
                                            <div class="grid grid-cols-12 gap-0 border">
                                                <div class="col-start-1 col-span-1 text-xs py-1 pl-3 border-r">
                                                    {{ $p['codigo'] }}
                                                </div>
                                                <div class="col-start-2 col-span-7 text-xs py-1 pl-3 border-r">
                                                    {{ $p['descripcion'] }} {{ ($p['descuento']+0) > 0 ? ' - Desct. '.$p['descuento'].'%':'' }}
                                                </div>
                                                <div class="col-start-9 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                                    $ {{ number_format(($p['precio_venta_publico']+0),2) }}
                                                </div>
                                                <div class="col-start-10 col-span-1 text-xs">
                                                    {!! Form::number('cantidad['.$p['id'].']', null, ['wire:model' => "cantidad.$i",
                                                                                                        'wire:keydown.tab' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                        'wire:keydown.enter.prevent' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                        'wire:change' => 'valorFinal('.$p['id'].', '.$i.')' ,
                                                                                                        'min' => '1',
                                                                                                        'max' => ($p['stock']+0),
                                                                                                        'class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                                </div>
                                                <div class="col-start-11 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                                    $ {{ number_format(($p['valor_descuento']+0),2) }}
                                                </div>
                                                <div class="col-start-12 col-span-1 text-xs text-right pr-3 py-1 border-r">
                                                    $ {{ number_format(($p['importe']+0),2) }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach

                            </div>
                            <div class="col-start-9 col-span-4">
                                <div class="grid grid-cols-12 gap-0">
                                    <div class="col-start-1 col-span-12">
                                        {{-- Campor Requeridos --}}
                                        @error('numero')
                                            <span class="mt-2 text-sm text-red-500">{{$message}}</span><br>
                                        @enderror
                                        @error('forma_pago')
                                            <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                                        @enderror
                                        {!! Form::label('resumen', 'Datos de Factura', ['class' => 'bg-gray-100 p-2 border block text-xs text-gray-700']) !!}
                                        {!! Form::hidden('cliente_id', $cliente_id) !!}
                                        {!! Form::hidden('subtotal', $subtotal) !!}
                                        {!! Form::hidden('iva', $iva) !!}
                                        {!! Form::hidden('descuento', $total_descuento) !!}
                                        {!! Form::hidden('total', $total) !!}
                                    </div>
                                    <div class="col-start-1 col-span-5 shadow">
                                        {!! Form::label('numero', 'Número:', ['class' => 'px-2 py-1 border border-gray-300 block text-xs text-gray-700']) !!}
                                        {!! Form::label('fecha', 'Fecha:', ['class' => 'px-2 py-1 border border-gray-300 block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow">
                                        {!! Form::text('numero', null, ['wire:model' => "numeroFactura", 'class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                        {!! Form::datetime('fecha', \Carbon\Carbon::now()->format('Y-m-d H:i:s'), ['class' => 'px-2 pt-0.5 pb-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-r border-gray-300']) !!}
                                    </div>

                                    <div class="col-start-1 col-span-5 shadow">
                                        {!! Form::label('vendedor', 'Vendedor:', ['class' => 'px-2 py-1 border block text-xs text-gray-700']) !!}
                                        {!! Form::label('cupo', 'Cupo Disponible:', ['class' => 'px-2 py-1 border block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow">
                                        {!! Form::select('vendedor_id', $vendedors, null,
                                                        ['class' => 'block w-full py-1 px-3 border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-xs']) !!}
                                        {!! Form::label('cupo_disponible', '$ '.number_format(0,2), ['class' => 'text-right py-1 pr-2 border-b border-t border-r border-gray-300 block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-1 col-span-5 shadow">
                                        {!! Form::label('cliente', 'Cliente:', ['class' => 'px-2 py-1 border block text-xs text-gray-700']) !!}
                                        {!! Form::label('pago', 'Forma de Pago:', ['class' => 'px-2 py-1 border block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow text-xs">
                                        {{-- {!! Form::select('cliente_id', $clientes, null,
                                                        ['class' => 'block w-full px-2 py-1 border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-xs']) !!} --}}
                                        @livewire('shared.cliente-search')
                                        <div class="px-1 py-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-r border-gray-300">
                                            {!! Form::radio('forma_pago', 'CONTADO', null, ['required', 'class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Contado
                                            {!! Form::radio('forma_pago', 'CREDITO', null, ['required', 'class' => 'ml-4 py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Crédito
                                        </div>
                                    </div>
                                    <div class="mt-5 col-start-1 col-span-5 shadow border-t border-b border-l border-gray-200">
                                        {!! Form::label('resumen', 'Resumen', ['class' => 'bg-gray-100 p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('subtotal', 'Subtotal', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'IVA', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'Descuento', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'Total', ['class' => 'pl-2 py-1 font-bold block border-t text-lg text-gray-700']) !!}
                                    </div>
                                    <div class="mt-5 col-start-6 col-span-12 shadow border-t border-gray-200">
                                        {!! Form::label('valores', 'VALORES', ['class' => 'bg-gray-100 p-2 border block text-xs text-gray-700']) !!}
                                        {!! Form::label('subtotal', '$ '.number_format($subtotal,2), ['class' => 'text-right p-2 border-b border-t border-gray-300 block text-xs text-gray-700']) !!}
                                        {!! Form::label('iva', '$ '.number_format($iva,2), ['class' => 'text-right p-2 border-b border-t border-gray-300 block text-xs text-gray-700']) !!}
                                        {!! Form::label('descuento', '$ '.number_format($total_descuento,2), ['class' => 'text-right p-2 border-b border-t border-gray-300 block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', '$ '.number_format($total,2), ['class' => 'pr-2 py-1 text-right font-bold block w-full text-lg border-gray-300']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{route('facturas.index')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Regresar
                        </a>
                        {!! Form::submit('Guardar', ['class' => 'cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
