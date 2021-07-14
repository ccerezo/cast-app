<div>
    <div class="flex justify-between">
        <p class="inline-flex pl-5 mt-4 text-lg text-gray-700">Inventario</p>
        {{-- <a href="{{route('modelos.create')}}" class="inline-flex items-center px-4 py-2 mt-4 mr-5 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Agregar Modelo
        </a> --}}
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
                <div class="grid gap-2 pl-5 pr-5 mb-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <input wire:model="searchCodigoBarras" type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:col-span-2 md:col-span-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar">
                    <select wire:model="searchColor" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm sm:col-span-1 md:col-span-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm sm:col-span-1 md:col-span-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Producto
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Entradas
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ultima Entrada
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Salidas
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ultima Salida
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
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
                                <td class="px-6 py-2 whitespace-nowrap">
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
                                            <div class="flex text-sm font-medium text-gray-900">
                                                {{$inventario->entradas}}
                                                <input wire:model="searchCodigoBarras" type="text" class="block w-12 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{\Carbon\Carbon::parse($inventario->ultima_entrada)->locale('es_ES')->isoFormat('YYYY-MM-D h:mm')}}
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
                                                @if ($inventario->ultima_salida)
                                                {{\Carbon\Carbon::parse($inventario->ultima_salida)->locale('es_ES')->isoFormat('YYYY-MM-D h:mm')}}
                                                @endif
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
                                <td class="px-4 py-1 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="{{route('inventarios.edit', $inventario)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">Editar</a>
                                </td>
                                </tr>
                            @endforeach
                            <!-- More items... -->
                            </tbody>
                        </table>
                        <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                            {{ $inventarios->links() }}
                        </div>
                    </div>
                @else
                    <p class="px-6 py-2 bg-gray-100 border-t border-gray-200">No hay registro.</p>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
