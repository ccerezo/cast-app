<div>
    <div class="flex justify-between border-b border-gray-300 pb-2 mb-3 shadow ">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Buscar Productos para Actualizar</p>
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

            <div class="grid gap-2 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="pl-5">
                    <input wire:model="searchCodigoBarras" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Buscar">
                    <select wire:model="searchLinea" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Linea</option>
                        @foreach ($lineas as $linea)
                            <option value="{{$linea->id}}">{{ $linea->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchCategoria" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchModelo" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Filtrar por Modelo</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{ $modelo->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchColor" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                    <select wire:model="searchTalla" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Seleccione Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{$talla->id}}">{{ $talla->numero1 }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-5 md:col-span-3 sm:col-span-2">
                    @if($productos->count())
                        <div class="grid gap-3 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 pr-5">
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            @foreach ($productos as $producto)

                            <div class="relative bg-white shadow overflow-hidden border border-gray-300 sm:rounded-lg">

                                <input type="hidden" wire:model="selected_id.{{$producto->id}}">
                                <div class="px-1 pt-2 pb-1 sm:px-3">
                                    <h3 class="text-md leading-5 font-medium text-gray-900">
                                        {{ $producto->linea->nombre }} {{ $producto->categoria->nombre }} {{ $producto->modelo->nombre }}
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Talla {{ $producto->talla->numero1 }} - {{ $producto->color->nombre }} <span style="background-color: {{$producto->color->codigo}}" class="rounded-full relative top-1 inline-block w-4 h-4"></span>
                                    </p>
                                </div>
                                <div class="border-t border-gray-300">
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
                                            <input type="text" wire:model="produccion.{{$producto->id}}" class="p-0.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </dd>
                                    </div>
                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Mayoritas
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            <input type="text" wire:model="mayorista.{{$producto->id}}" class="p-0.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                        </dd>
                                    </div>
                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            PVP
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            <input type="text" wire:model="publico.{{$producto->id}}" class="p-0.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                        </dd>
                                    </div>

                                    <div class="bg-white px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Stock:
                                            <span class="rounded-full font-bold h-7 w-7 bg-gray-100 text-gray-900 flex items-center justify-center">
                                                {{ $producto->stock }}
                                            </span>
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            <input type="text" wire:model="stock.{{$producto->id}}" placeholder="Agg. Stock" class="p-0.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                                        </dd>
                                    </div>

                                </dl>
                                </div>
                                <div class="text-center grid grid-cols-1">
                                    <div>
                                    <button wire:click="update({{$producto->id}})" class="inline-flex items-center mb-2 px-2 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg wire:loading wire:target="update({{$producto->id}})" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Actualizar
                                    </button>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                            {{ $productos->links() }}
                        </div>
                    @else
                        <p class="bg-gray-100 px-6 py-2 border-t border-gray-200">Buscar los productos que desea Actualizar</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
