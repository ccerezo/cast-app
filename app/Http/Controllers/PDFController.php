<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\FacturaDetalle;
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
}
