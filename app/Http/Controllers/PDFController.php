<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\pagoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    // function to display preview
    public function index()
    {
        return view('reportes.index');
    }
    public function preview()
    {
        return view('reportes.factura');
    }

    public function generatePDF($id)
    {
        $factura = Factura::where('id', '=', $id)->first(); //002 es PAGADA
        $facturaDetalle = FacturaDetalle::where('factura_id', '=', $id)->get();
        return PDF::loadView('reportes.factura', compact('factura', 'facturaDetalle'))
            ->stream('archivo.pdf');

        //return $pdf->stream('archivo.pdf');
    }

    public function generateComprobantePagoPDF($factura_id)
    {
        $factura = Factura::find($factura_id);
        $pagos = pagoFactura::where('factura_id', '=', $factura->id)->get();
        $total_pagos = pagoFactura::where('factura_id', '=', $factura->id)
                                    ->sum('monto');
        return PDF::loadView('reportes.pago', compact('pagos', 'factura','total_pagos'))
            ->stream('archivo-pago.pdf');

    }
    public function reporteMensualPDF($anio, $mes) {
        $vendido = Factura::selectRaw('SUM(total) AS vendido, YEAR(fecha) as anio, MONTH(fecha) as mes')
                        ->where('estado_factura_id', '<>', 2)
                        ->whereRaw('YEAR(fecha) = ? AND MONTH(fecha) = ?', [$anio,$mes])
                        ->groupByRaw('YEAR(fecha), MONTH(fecha)')
                        ->first();

        $facturas = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereRaw('YEAR(facturas.fecha) = ? AND MONTH(facturas.fecha) = ?', [$anio,$mes])
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->get();

        return PDF::loadView('reportes.reporte-mensual', compact('vendido','facturas'))
                    ->stream('archivo-pago.pdf');
    }
}
