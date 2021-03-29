<div>
    <div class="mt-10 p-5 sm:mt-0">
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
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-4 sm:col-span-4">
                                {!! Form::label('name', 'Número', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::text('numero', null, ['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) !!}
                                @error('numero')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-4 sm:col-span-4">
                                {!! Form::label('name', 'Fecha', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) !!}
                                @error('fecha')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-4 sm:col-span-4">
                                {!! Form::label('vendedor', 'Vendedor', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::select('vendedor_id', $vendedors, null,
                                                ['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                            </div>
                            <div class="col-span-4 sm:col-span-4">
                                {!! Form::label('cliente', 'Cliente', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::select('clientes_id', $clientes, null,
                                                ['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                            </div>
                            <div class="col-span-4 sm:col-span-4 pt-7">
                                {!! Form::radio('forma_pago', 'CONTADO', null, ['class' => 'py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!} Contado
                                {!! Form::radio('forma_pago', 'CRÉDITO', null,['class' => 'ml-5 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!} Crédito
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-3">

                        </div>

                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-start-9 col-span-2 shadow border-t border-b border-l border-gray-200">
                                {!! Form::label('resumen', 'Resumen', ['class' => 'bg-gray-100 p-2 border-b border-t block text-xs text-gray-700']) !!}
                                {!! Form::label('subtotal', 'Subtotal', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                {!! Form::label('name', 'IVA', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                {!! Form::label('name', 'Descuento', ['class' => 'p-2 border-b border-t block text-xs text-gray-700']) !!}
                                {!! Form::label('name', 'Total', ['class' => 'p-2 block border-t text-xs text-gray-700']) !!}
                            </div>
                            <div class="col-start-11 col-span-2 shadow border-t border-gray-200">
                                {!! Form::label('valores', 'VALORES', ['class' => 'bg-gray-100 p-2 border block text-xs text-gray-700']) !!}
                                {!! Form::text('subtotal', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                {!! Form::text('iva', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                {!! Form::text('descuento', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
                                {!! Form::text('total', null, ['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300']) !!}
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
