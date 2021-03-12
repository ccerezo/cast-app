<x-app-layout>

    <div class="mt-10 p-5 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Crear Bodegas
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Puede crear la direfentes bodegas donde se almacenan los productos.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                @if (session('info'))
                    <div class="bg-green-400 border-l-4 border-green-900 text-gray-900 p-4" role="alert">
                        <p class="font-bold">Información!</p>
                        <p>{{session('info')}}</p>
                    </div>
                @endif
                {!! Form::open(['route' => 'bodegas.store']) !!}

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-6 sm:col-span-3">
                                {!! Form::label('name', 'Nombre', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::text('nombre', null, ['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) !!}
                                @error('nombre')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                {!! Form::label('name', 'Direccion', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::text('direccion', null, ['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) !!}
                                @error('direccion')
                                    <span class="mt-2 text-sm text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                {!! Form::label('name', 'Nota', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                                {!! Form::text('nota', null, ['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) !!}
                            </div>

                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{route('bodegas.index')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Regresar
                        </a>
                        {!! Form::submit('Guardar', ['class' => 'cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
