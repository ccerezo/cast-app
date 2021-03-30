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
                            <div class="flex-1 col-start-1 col-span-8">

                                {{-- {!! Form::text('producto_id', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300 rounded', 'placeholder' => 'Buscar Producto']) !!} --}}
                                @livewire('shared.producto-search')
                                {{-- @foreach ($detalle as $p)
                                    {{ $p->descripcion }}
                                @endforeach --}}
                                {{-- {{$seleccionados}} --}}
                                {{-- @foreach ($seleccionados as $i => $p)
                                    {{ $p->descripcion }}
                                @endforeach --}}
                                {{$seleccionados}}

                            </div>
                            <div class="col-start-9 col-span-4">
                                <div class="grid grid-cols-12 gap-0">
                                    <div class="col-start-1 col-span-12">
                                        {!! Form::label('resumen', 'Datos de Factura', ['class' => 'bg-gray-100 p-2 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-1 col-span-5 shadow border-t border-b border-l border-gray-200">
                                        {!! Form::label('numero', 'Número:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('fecha', 'Fecha:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow border-t border-gray-200">
                                        {!! Form::text('numero', null, ['class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                        {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                    </div>

                                    <div class="col-start-1 col-span-5 shadow border-t border-b border-l border-gray-200">
                                        {!! Form::label('vendedor', 'Vendedor:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('cupo', 'Cupo Disponible:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow border-t border-gray-200">
                                        {!! Form::select('vendedor_id', $vendedors, null,
                                                        ['class' => 'block w-full py-1 px-3 border-1 border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-xs']) !!}
                                        {!! Form::text('cupo', null, ['class' => 'px-2 py-1 text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                    </div>
                                    <div class="col-start-1 col-span-5 shadow border-t border-b border-l border-gray-200">
                                        {!! Form::label('cliente', 'Cliente:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('pago', 'Forma de Pago:', ['class' => 'px-2 py-1 border-b border-t block text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="col-start-6 col-span-12 shadow border-t border-gray-200 text-xs">
                                        {!! Form::select('clientes_id', $clientes, null,
                                                        ['class' => 'block w-full px-2 py-1 border-1 border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-xs']) !!}
                                        <div class="px-1 py-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border border-gray-300">
                                            {!! Form::radio('forma_pago', 'CONTADO', null, ['class' => 'py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Contado
                                            {!! Form::radio('forma_pago', 'CRÉDITO', null,['class' => 'ml-4 py-1 px-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) !!} Crédito
                                        </div>
                                    </div>
                                    <div class="mt-5 col-start-1 col-span-5 shadow border-t border-b border-l border-gray-200">
                                        {!! Form::label('resumen', 'Resumen', ['class' => 'bg-gray-100 p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('subtotal', 'Subtotal', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'IVA', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'Descuento', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                        {!! Form::label('name', 'Total', ['class' => 'p-2 block border-t text-xs text-gray-700']) !!}
                                    </div>
                                    <div class="mt-5 col-start-6 col-span-12 shadow border-t border-gray-200">
                                        {!! Form::label('valores', 'VALORES', ['class' => 'bg-gray-100 p-2 border block text-xs text-gray-700']) !!}
                                        {!! Form::text('subtotal', null, ['class' => 'text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                        {!! Form::text('iva', null, ['class' => 'text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                        {!! Form::text('descuento', null, ['class' => 'text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                        {!! Form::text('total', null, ['class' => 'text-right focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
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
