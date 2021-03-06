<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $menus = [
            //['name' => 'Dashboard', 'route' => route('dashboard'), 'active' => request()->routeIs('dashboard') ],
            ['name' => 'Productos', 'route' => route('productos.index'), 'active' => request()->routeIs('productos.index')],
            ['name' => 'Clientes', 'route' => route('clientes.index'), 'active' => request()->routeIs('clientes.index')],
            ['name' => 'Inventario', 'route' => route('inventarios.index'), 'active' => request()->routeIs('inventarios.index')],
            ['name' => 'Facturas', 'route' => route('facturas.index'), 'active' => request()->routeIs('facturas.index')],
            ['name' => 'Cuentas por Cobrar', 'route' => route('pagoFacturas.index'), 'active' => request()->routeIs('pagoFacturas.index')],
            ['name' => 'Reportes', 'route' => route('reporte.index'), 'active' => request()->routeIs('reporte.index')],

        ];
        $configuraciones = [
            ['name' => 'Bodegas', 'route' => route('bodegas.index'), 'active' => request()->routeIs('bodegas.index') ],
            ['name' => 'Categoría', 'route' => route('categorias.index'), 'active' => request()->routeIs('categorias.index')],
            ['name' => 'Colores', 'route' => route('colors.index'), 'active' => request()->routeIs('colors.index')],
            ['name' => 'Linea', 'route' => route('lineas.index'), 'active' => request()->routeIs('lineas.index')],
            ['name' => 'Marca', 'route' => route('marcas.index'), 'active' => request()->routeIs('marcas.index')],
            ['name' => 'Modelo', 'route' => route('modelos.index'), 'active' => request()->routeIs('modelos.index')],
            ['name' => 'Tallas', 'route' => route('tallas.index'), 'active' => request()->routeIs('tallas.index')],
            ['name' => 'Tallaje', 'route' => route('tallajes.index'), 'active' => request()->routeIs('tallajes.index')],
            ['name' => 'Tipo Clientes', 'route' => route('tipoClientes.index'), 'active' => request()->routeIs('tipoClientes.index')],
            ['name' => 'Estados Factura', 'route' => route('estadoFacturas.index'), 'active' => request()->routeIs('estadoFacturas.index')],
            ['name' => 'Método de Pago', 'route' => route('metodoPagos.index'), 'active' => request()->routeIs('metodoPagos.index')],

        ];
        $inventarioMateriaPrima = [
            ['name' => 'Proveedor', 'route' => route('proveedors.index'), 'active' => request()->routeIs('proveedors.index')],
            ['name' => 'Materia Prima', 'route' => route('materiaPrimas.index'), 'active' => request()->routeIs('materiaPrimas.index')],
            ['name' => 'Inventario', 'route' => route('inventarioMateriaPrimas.index'), 'active' => request()->routeIs('inventarioMateriaPrimas.index')],

        ];
        return view('livewire.navigation', compact('menus', 'configuraciones','inventarioMateriaPrima'));
    }
}
