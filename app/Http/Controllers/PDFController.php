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

    public function generatePagoPDF($id)
    {
        $pago = pagoFactura::where('id', '=', $id)->first();
        $factura = Factura::where('id', '=', $pago->factura_id)->first();
        $total_pagos = pagoFactura::where('factura_id', '=', $pago->factura_id)
                                    ->where('fecha', '<', $pago->fecha)->sum('monto');
        return PDF::loadView('reportes.pago', compact('pago', 'factura','total_pagos'))
            ->stream('archivo-pago.pdf');

    }
}
