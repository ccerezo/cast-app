<div>
    <div class="flex justify-between border-b border-gray-300 pb-2 mb-3 shadow ">
        <p class="inline-flex mt-3 pl-5 text-lg text-gray-700">Listado de Productos</p>
        <div>
            @if ($producto_tmp!== null)
                <a href="{{route('productos.edit', $producto_tmp)}}" class="inline-flex items-center mt-3 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Actualizar Productos
                </a>
            @endif

            <a href="{{route('productos.create')}}" class="inline-flex items-center mt-3 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Agregar Nuevos Producto
            </a>
        </div>

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
                            <div class="relative bg-white overflow-hidden border border-gray-300 shadow sm:rounded-lg pb-1.5">

                                <div class="px-1 pt-2 pb-1 sm:px-3">
                                    <h3 class="text-md leading-5 font-medium text-gray-900">
                                        {{ $producto->linea->nombre }} {{ $producto->categoria->nombre }} {{ $producto->modelo->nombre }}
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Talla {{ $producto->talla->numero1 }} - {{ $producto->color->nombre }} <span style="background-color: {{$producto->color->codigo}}" class="rounded-full relative top-1 inline-block w-4 h-4"></span>
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
                                    <div class="bg-gray-50 px-2 py-0.5 sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Stock
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                                            <div class="rounded-full font-bold h-7 w-7 bg-gray-100 text-gray-900 flex items-center justify-center">
                                                {{ $producto->stock }}
                                            </div>
                                        </dd>
                                    </div>
                                    <div class="text-center mt-2 grid grid-cols-2">
                                        <div>
                                        {{ $message }}
                                        <button wire:click="$set('message', '{{$producto}}')">Say Hi</button>
                                        <button wire:click="$set('productoTMP', '{{$producto}}')" class="modal-open bg-transparent w-5 h-5 text-blue-400 hover:text-blue-500">
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
    <div wire:ignore.self class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

          <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
          </div>

          <!-- Add margin if you want to see some of the overlay behind the modal-->
          <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
              <p class="text-2xl font-bold">Código de Barras</p>
              <div class="modal-close cursor-pointer z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
              </div>
            </div>

            <!--Body-->

            @if($productoTMP)
                <p>{{$productoTMP->codigo}} {{$productoTMP->modelo->nombre}}</p>
                {!!DNS1D::getBarcodeHTML($productoTMP->codigo_barras, 'C128',2,40)!!}
                <p>{{$productoTMP->codigo_barras}}</p>
            @endif

            <!--Footer-->
            <div class="flex justify-end pt-2">
              <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
              <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Cerrar</button>
            </div>

          </div>
        </div>
    </div>
</div>


