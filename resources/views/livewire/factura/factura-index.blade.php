<div>
    <div class="flex justify-between">
        <p class="inline-flex mt-4 pl-5 text-lg text-gray-700">Listado de Facturas</p>
        <a href="{{route('facturas.create')}}" class="inline-flex items-center mt-4 mr-5 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-100 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear Factura
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

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-2 pl-5 pr-5 mb-2">
                    <input wire:model="search" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Buscar">
                </div>
                @if($facturas->count())
                <div class="min-w-full divide-y divide-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Número
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Fecha
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Cliente
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Total
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                F. Pago
                            </th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Estado
                            </th>
                            <th scope="col" class="relative px-3 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="relative px-3 py-3">
                                <span class="sr-only">Anular</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($facturas as $factura)
                            <tr>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center text-sm font-medium text-gray-900">
                                    {{$factura->numero}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center text-sm font-medium text-gray-900">
                                    {{ date('Y-m-d H:i', strtotime($factura->fecha)) }}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$factura->cliente->nombre}}
                                            <p class="text-xs">{{$factura->cliente->identificacion}}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-right text-sm font-medium text-gray-900">
                                    $ {{$factura->total}}
                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                @if ($factura->forma_pago == 'CONTADO')
                                    <div class="text-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-green-800">
                                            CONTADO
                                        </span>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-yellow-800">
                                            CRÉDITO
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    @if ($factura->estadoFactura->codigo == '002')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                            {{$factura->estadoFactura->nombre}}
                                        </span>
                                    @else
                                        @if ($factura->estadoFactura->codigo == '001')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                {{$factura->estadoFactura->nombre}}
                                            </span>
                                        @endif
                                    @endif

                                </div>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{route('facturas.show', $factura)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">Ver</a>
                                <a href="{{route('facturas.edit', $factura)}}" class="mr-3 text-indigo-600 hover:text-indigo-800">edit</a>
                                <a href="{{route('pdf.generate', $factura)}}" target="_blank" class="mr-3 text-indigo-600 hover:text-indigo-800">PDF</a>
                            </td>
                            <td>
                                <form action="{{route('facturas.destroy', $factura)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Anular</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                        <!-- More items... -->
                        </tbody>
                    </table>
                    <div class="bg-gray-100 px-6 py-2 border-t border-gray-200">
                        {{ $facturas->links() }}
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

