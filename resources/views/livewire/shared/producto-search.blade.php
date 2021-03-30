<div class="relative">
    <input type="text"
            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full text-xs border-gray-300 rounded"
            placeholder="Buscar productos..."
            wire:model="query"
            wire:keydown.escape="resetear"
            wire:keydown.tab="resetear"
            wire:keydown.arrow-up="decrementHighlight"
            wire:keydown.arrow-down="incrementHighlight"
            wire:keydown.enter="selectProducto"
    />
    <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg" wire:loading>
        <div class="list-item">Buscando...</div>
    </div>
    @if(!empty($query))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resetear"></div>
        <div class="absolute z-10 divide-y divide-gray-100 bg-white w-full rounded-t-none shadow-lg">
            @if(!empty($productos))

                    @foreach ($productos as $i => $p)
                    <a
                        wire:click.prevent="selectProducto" href="#"
                        class="block hover:bg-indigo-600 flex items-center transition ease-in-out duration-150 px-3 py-1 {{ $highlightIndex === $i ? 'bg-indigo-800 text-white' : '' }}">
                            {{ $p['descripcion'] }}
                    </a>
                    @endforeach

            @else
                <div class="list-item">No se encontraron resultados!</div>
            @endif
        </div>
    @endif
</div>


