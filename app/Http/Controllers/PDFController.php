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
                    ->stream('archivo-mensual.pdf');
    }

    public function reportePorPrecioPDF($desde, $hasta) {

        $vendedor = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 1)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $vendedor_total = Factura::where('facturas.facturado_como_id', '=', 1)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->sum('total');

        $mayorista = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 2)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $mayorista_total = Factura::where('facturas.facturado_como_id', '=', 2)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->sum('total');

        $final = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 3)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $final_total = Factura::where('facturas.facturado_como_id', '=', 3)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->sum('total');

        return PDF::loadView('reportes.reporte-por-precios', compact('vendedor','vendedor_total', 'mayorista','mayorista_total','final','final_total'))
                    ->stream('archivo-ventas-precios.pdf');
    }

    public function reportePorProductosPDF($desde, $hasta) {

        $productos = Factura::Join('factura_detalles','facturas.id','=','factura_detalles.factura_id')
                        ->Join('productos','factura_detalles.producto_id','=','productos.id')
                        ->selectRaw('factura_detalles.*, productos.descripcion, facturas.fecha,facturas.facturado_como_id,facturas.cliente_id')
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();
        return PDF::loadView('reportes.reporte-por-productos', compact('productos'))
                    ->stream('archivo-ventas-productos.pdf');
    }

    public function reporteLoMasVendidoPDF($desde, $hasta) {

        $productos = FacturaDetalle::Join('facturas','factura_detalles.factura_id','=','facturas.id')
                        ->Join('productos','factura_detalles.producto_id','=','productos.id')
                        ->selectRaw('factura_detalles.producto_id, SUM(factura_detalles.cantidad) as cantidad')
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->groupBy('factura_detalles.producto_id')
                        ->orderBy('cantidad', 'DESC')
                        ->get();
        return PDF::loadView('reportes.reporte-mas-vendido', compact('productos'))
                    ->stream('archivo-top-productos.pdf');
    }
}
