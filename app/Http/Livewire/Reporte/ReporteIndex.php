<?php

namespace App\Http\Livewire\Reporte;

use App\Models\Factura;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteIndex extends Component
{
    use WithPagination;
    public $openModal = false;
    public $desde;
    public $hasta;

    public function mount() {
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }
    public function render()
    {

        $ventas = Factura::selectRaw('year(fecha) as year, MONTH(fecha) month, MONTHNAME(fecha) mes, sum(total) total')
                        ->where('estado_factura_id', '<>', 2)
                        ->groupByRaw('year, month, mes')
                        ->orderBy('year', 'DESC')
                        ->orderBy('month', 'DESC')
                        ->paginate(12);
        return view('livewire.reporte.reporte-index', compact('ventas'));
    }
}
