<div>
    <div class="flex justify-between">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Inventario</p>
        {{-- <a href="{{route('modelos.create')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Agregar Modelo
        </a> --}}
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
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-2 pl-5 pr-5 mb-2">
                    <input wire:model="searchCodigoBarras" type="text" class="sm:col-span-2 md:col-span-1 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Buscar">
                    <select wire:model="searchColor" class="sm:col-span-1 md:col-span-1 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="sm:col-span-1 md:col-span-1 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{$talla->id}}">{{ $talla->numero1 }}</option>
                        @endforeach
                    </select>
                </div>
                @if($inventarios->count())
                    <div class="min-w-full divide-y divide-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Entradas
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ultima Entrada
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Salidas
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ultima Salida
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th scope="col" class="relative px-4 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inventarios as $inventario)
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-1">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->producto->linea->nombre}}
                                                {{$inventario->producto->categoria->nombre}}
                                                {{$inventario->producto->modelo->nombre}}
                                                {{$inventario->producto->color->nombre}}
                                                T. {{$inventario->producto->talla->numero1}}
                                                <p class="text-xs">{{$inventario->producto->codigo_barras}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->entradas}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->ultima_entrada}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->salidas}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$inventario->ultima_salida}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{$inventario->stock >= 5 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}} ">
                                                {{$inventario->stock}}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('inventarios.edit', $inventario)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">Editar</a>
                                </td>
                                </tr>
                            @endforeach
                            <!-- More items... -->
                            </tbody>
                        </table>
                        <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                            {{ $inventarios->links() }}
                        </div>
                    </div>
                @else
                    <p class="bg-gray-100 px-6 py-2 border-t border-gray-200">No hay registro.</p>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
