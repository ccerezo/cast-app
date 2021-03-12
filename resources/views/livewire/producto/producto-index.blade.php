<div>
    <div class="flex justify-between mb-2">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Listado de Productos</p>
        <a href="{{route('productos.create')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Agregar Producto
        </a>
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

            <div class="grid gap-2 grid-cols-4 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="pl-5">
                    <input wire:model="search" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Buscar">
                    <select wire:model="searchCategoria" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchLinea" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Linea</option>
                        @foreach ($lineas as $linea)
                            <option value="{{$linea->id}}">{{ $linea->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{$talla->id}}">{{ $talla->numero1 }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-3">
                    @if($productos->count())
                        <div class="grid gap-2 grid-cols-3 pl-5 pr-5 divide-y divide-gray-200">
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            @foreach ($productos as $producto)
                            <div class="bg-white shadow overflow-hidden border border-gray-300 sm:rounded-lg">
                                <div class="px-1 py-1 sm:px-3">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $producto->descripcion }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    {{ $producto->codigo }}
                                </p>
                                </div>
                                <div class="border-t border-gray-300">
                                <dl>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Código
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $producto->codigo }}
                                    </dd>
                                    </div>
                                    <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Producción
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        ${{ number_format($producto->precio_produccion,2) }}
                                    </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Mayorias
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        ${{ number_format($producto->precio_mayorista,2) }}
                                    </dd>
                                    </div>
                                    <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            PVP
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            ${{ number_format($producto->precio_venta_publico,2) }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Categoría
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $producto->categoria->nombre }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Talla
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $producto->talla->numero1 }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Color
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $producto->color->nombre }}
                                            <span style="background-color: {{$producto->color->codigo}}" class="rounded-full ml-2 px-3 py-1 text-sm font-medium">

                                            </span>
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Stock
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div class="rounded-full h-7 w-7 bg-gray-900 text-gray-100 flex items-center justify-center">
                                                {{ $producto->stock }}
                                            </div>
                                        </dd>
                                    </div>

                                </dl>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                            {{ $productos->links() }}
                        </div>
                    @else
                        <p class="bg-gray-100 px-6 py-2 border-t border-gray-200">No hay registro.</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
