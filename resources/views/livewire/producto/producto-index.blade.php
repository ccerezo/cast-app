<div>
    <div class="flex justify-between pb-2 mb-3 border-b border-gray-300 shadow ">
        <p class="inline-flex pl-5 mt-3 text-lg text-gray-700">Listado de Productos</p>
        <div>
            @if (count($productoSeleccionado) > 1)
                <button wire:click="eliminarProductos()" class="inline-flex items-center px-4 py-2 mt-3 mr-4 text-sm font-medium text-gray-100 bg-red-700 border border-gray-300 rounded-md shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Eliminar Productos
                </button>
            @endif
            @if ($producto_tmp!== null)
                <a href="{{route('productos.edit', $producto_tmp)}}" class="inline-flex items-center px-4 py-2 mt-3 mr-4 text-sm font-medium text-gray-100 bg-gray-700 border border-gray-300 rounded-md shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Actualizar Productos
                </a>
            @endif

            <a href="{{route('productos.create')}}" class="inline-flex items-center px-4 py-2 mt-3 mr-5 text-sm font-medium text-gray-100 bg-blue-700 border border-gray-300 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Agregar Nuevos Producto
            </a>
        </div>

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

            <div class="grid gap-2 overflow-hidden border-b border-gray-200 shadow lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 sm:rounded-lg">
                <div class="pl-5">
                    <input wire:model="searchCodigoBarras" type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar">
                    <select wire:model="searchLinea" class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Linea</option>
                        @foreach ($lineas as $linea)
                            <option value="{{$linea->id}}">{{ $linea->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchCategoria" class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchModelo" class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Modelo</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{ $modelo->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchColor" class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{$talla->id}}">{{ $talla->numero1 }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-5 md:col-span-3 sm:col-span-2">
                    @if($productos->count())
                        <div class="grid gap-3 pr-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            @foreach ($productos as $producto)
                            <div class="relative bg-white overflow-hidden border border-gray-300 shadow sm:rounded-lg pb-1.5">
                                <div class="px-1 pt-2 pb-1 sm:px-3">
                                    <input wire:model="productoSeleccionado" type="checkbox" value="{{$producto->id}}" class="px-1 py-1 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
                                    <h3 class="font-medium leading-5 text-gray-900 text-md">
                                        {{ $producto->linea->nombre }} {{ $producto->categoria->nombre }} {{ $producto->modelo->nombre }}
                                    </h3>
                                    <p class="max-w-2xl mt-1 text-sm text-gray-500">
                                        Talla {{ $producto->talla->numero1 }} - {{ $producto->color->nombre }} <span style="background-color: {{$producto->color->codigo}}" class="relative inline-block w-4 h-4 rounded-full top-1"></span>
                                    </p>
                                </div>
                                <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            C. Barras
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            {{ $producto->codigo_barras }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Código
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            {{ $producto->codigo }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Producción
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            ${{ number_format($producto->precio_produccion,2) }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Mayoritas
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            ${{ number_format($producto->precio_mayorista,2) }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            PVP
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            ${{ number_format($producto->precio_venta_publico,2) }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Descuento
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            {{ $producto->descuento }}%
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Stock
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            <div class="flex items-center justify-center font-bold text-gray-900 bg-gray-100 rounded-full h-7 w-7">
                                                {{ $producto->stock }}
                                            </div>
                                        </dd>
                                    </div>
                                    <div class="grid grid-cols-2 mt-2 text-center">

                                        <div>
                                            <button wire:click="generateCodeBar({{$producto->id}})" class="w-5 h-5 text-blue-400 bg-transparent modal-open hover:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <form action="{{route('productos.destroy', $producto)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="w-5 h-5 text-red-400 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </dl>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="px-6 py-2 bg-gray-100 border-t border-gray-200">
                            {{ $productos->links() }}
                        </div>
                    @else
                        <p class="px-6 py-2 bg-gray-100 border-t border-gray-200">No hay registro.</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Información del Producto
        </x-slot>

        <x-slot name="content">
            @if($productoTMP)
                <p>{{$productoTMP->codigo}} {{$productoTMP->modelo->nombre}}</p>
                {!!DNS1D::getBarcodeHTML($productoTMP->codigo_barras, 'C128',2,40)!!}
                <p>Color: {{$productoTMP->color->nombre}} - Talla: {{$productoTMP->talla->numero1}}</p>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>


