<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $menus = [
            //['name' => 'Dashboard', 'route' => route('dashboard'), 'active' => request()->routeIs('dashboard') ],
            ['name' => 'Productos', 'route' => route('productos.index'), 'active' => request()->routeIs('productos.index')]
            /*['name' => 'Categoría', 'route' => route('categorias.index'), 'active' => request()->routeIs('categorias.index')],
            /*[
                'name' => 'Colores', 'route' => route('colors.index'), 'active' => request()->routeIs('colors.index')
            ],
            [
                'name' => 'Linea', 'route' => route('lineas.index'), 'active' => request()->routeIs('lineas.index')
            ],
            [
                'name' => 'Marca', 'route' => route('marcas.index'), 'active' => request()->routeIs('marcas.index')
            ],
            [
                'name' => 'Modelo', 'route' => route('modelos.index'), 'active' => request()->routeIs('modelos.index')
            ],
            [
                'name' => 'Tallas', 'route' => route('tallas.index'), 'active' => request()->routeIs('tallas.index')
            ],
            */
        ];
        $configuraciones = [
            ['name' => 'Bodegas', 'route' => route('bodegas.index'), 'active' => request()->routeIs('bodegas.index') ],
            ['name' => 'Categoría', 'route' => route('categorias.index'), 'active' => request()->routeIs('categorias.index')],
            ['name' => 'Colores', 'route' => route('colors.index'), 'active' => request()->routeIs('colors.index')],
            ['name' => 'Linea', 'route' => route('lineas.index'), 'active' => request()->routeIs('lineas.index')],
            ['name' => 'Marca', 'route' => route('marcas.index'), 'active' => request()->routeIs('marcas.index')],
            ['name' => 'Modelo', 'route' => route('modelos.index'), 'active' => request()->routeIs('modelos.index')],
            ['name' => 'Tallas', 'route' => route('tallas.index'), 'active' => request()->routeIs('tallas.index')],
            /*[
                'name' => 'Productos', 'route' => route('productos.index'), 'active' => request()->routeIs('productos.index')
            ]*/
        ];
        return view('livewire.navigation', compact('menus', 'configuraciones'));
    }
}
