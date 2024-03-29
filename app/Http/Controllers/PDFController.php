<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Inventario;
use App\Models\InventarioDetalle;
use App\Models\pagoFactura;
use App\Models\Producto;
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
        //$customPaper = array(0,0,567.00,283.80);
        $customPaper = array(0,0,710,457);
        $cantidad_zapatos = FacturaDetalle::where('factura_id', '=', $id)->sum('cantidad');
        $facturaDetalle = FacturaDetalle::where('factura_id', '=', $id)->get();
        return PDF::loadView('reportes.factura', compact('factura', 'facturaDetalle','cantidad_zapatos'))
            ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->setPaper($customPaper, 'landscape')
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
    public function generateComprobantesPagoPDF($facturas)
    {
        $pagadas = json_decode($facturas , true);
        //$facturas = Factura::whereIn('id', $facturas);
        $pagos = pagoFactura::whereIn('factura_id', $pagadas)->get();
        //$total_pagos = pagoFactura::where('factura_id', '=', $factura->id)->sum('monto');
        return PDF::loadView('reportes.comprobantes-pago', compact('pagos'))
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

    public function reportePorPrecioPDF($desde, $hasta, $cliente_id = null) {

        $vendedor = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 1)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $vendedor_total = Factura::where('facturas.facturado_como_id', '=', 1)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->sum('total');

        $mayorista = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 2)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $mayorista_total = Factura::where('facturas.facturado_como_id', '=', 2)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->sum('total');

        $final = Factura::leftJoin('pago_facturas','facturas.id','=','pago_facturas.factura_id')
                        ->selectRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total,SUM(pago_facturas.monto) AS recibido')
                        ->where('facturas.facturado_como_id', '=', 3)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->groupByRaw('facturas.id,facturas.numero,facturas.fecha,facturas.cliente_id,facturas.total')
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        $final_total = Factura::where('facturas.facturado_como_id', '=', 3)
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->sum('total');

        return PDF::loadView('reportes.reporte-por-precios', compact('vendedor','vendedor_total', 'mayorista','mayorista_total','final','final_total'))
                    ->stream('archivo-ventas-precios.pdf');
    }
    public function reporteIngresosPDF($desde, $hasta, $cliente_id = null) {

        $inicio = $desde;
        $fin = $hasta;

        $pagos = pagoFactura::Join('facturas','facturas.id','=','pago_facturas.factura_id')
                            ->where('facturas.estado_factura_id', '<>', 2)
                            ->whereBetween('pago_facturas.fecha', [$desde, $hasta])
                            ->get();

        $total_metodos_vendedor = pagoFactura::Join('facturas','facturas.id','=','pago_facturas.factura_id')
                            ->selectRaw('pago_facturas.metodo_pago_id, SUM(pago_facturas.monto) as total')
                            ->where('facturas.estado_factura_id', '<>', 2)
                            ->where('facturas.facturado_como_id', '=', 1)
                            ->whereBetween('pago_facturas.fecha', [$desde, $hasta])
                            ->groupBy('pago_facturas.metodo_pago_id')
                            ->get();

        $total_metodos_mayorista = pagoFactura::Join('facturas','facturas.id','=','pago_facturas.factura_id')
                            ->selectRaw('pago_facturas.metodo_pago_id, SUM(pago_facturas.monto) as total')
                            ->where('facturas.estado_factura_id', '<>', 2)
                            ->where('facturas.facturado_como_id', '=', 2)
                            ->whereBetween('pago_facturas.fecha', [$desde, $hasta])
                            ->groupBy('pago_facturas.metodo_pago_id')
                            ->get();

        $total_metodos_pvp = pagoFactura::Join('facturas','facturas.id','=','pago_facturas.factura_id')
                            ->selectRaw('pago_facturas.metodo_pago_id, SUM(pago_facturas.monto) as total')
                            ->where('facturas.estado_factura_id', '<>', 2)
                            ->where('facturas.facturado_como_id', '=', 3)
                            ->whereBetween('pago_facturas.fecha', [$desde, $hasta])
                            ->groupBy('pago_facturas.metodo_pago_id')
                            ->get();


        return PDF::loadView('reportes.ingresos', compact('pagos','total_metodos_vendedor','total_metodos_mayorista','total_metodos_pvp','inicio','fin'))
                    ->setPaper('a4', 'landscape')
                    ->stream('archivo-ingresos.pdf');
    }
    public function reportePorProductosPDF($desde, $hasta, $cliente_id = null) {

        // $total_vendidos = Factura::Join('factura_detalles','facturas.id','=','factura_detalles.factura_id')
        //                 ->Join('productos','factura_detalles.producto_id','=','productos.id')
        //                 ->where('facturas.estado_factura_id', '<>', 2)
        //                 ->whereBetween('facturas.fecha', [$desde, $hasta])
        //                 ->when($cliente_id, function ($query, $cliente_id) {
        //                     return $query->where('facturas.cliente_id', $cliente_id);
        //                 })
        //                 ->sum('factura_detalles.cantidad');


        $productos = Factura::Join('factura_detalles','facturas.id','=','factura_detalles.factura_id')
                        ->Join('productos','factura_detalles.producto_id','=','productos.id')
                        ->selectRaw('factura_detalles.*, productos.descripcion, facturas.fecha,facturas.facturado_como_id,facturas.cliente_id')
                        ->where('facturas.estado_factura_id', '<>', 2)
                        ->whereBetween('facturas.fecha', [$desde, $hasta])
                        ->when($cliente_id, function ($query, $cliente_id) {
                            return $query->where('facturas.cliente_id', $cliente_id);
                        })
                        ->orderBy('facturas.fecha', 'DESC')
                        ->get();

        return PDF::loadView('reportes.reporte-por-productos', compact('productos'))
                    ->stream('archivo-ventas-productos.pdf');

        // $pdf =  PDF::loadView('reportes.reporte-por-productos', compact('productos'));
        // return $pdf->download('reporte-01.pdf');
    }

    public function reporteDetalleInventarioPDF($desde, $hasta) {



        $items = InventarioDetalle::whereBetween('ultima_entrada', [$desde, $hasta])
                        ->orderBy('ultima_entrada', 'DESC')
                        ->get();

        return PDF::loadView('reportes.reporte-detalle-inventario', compact('items'))
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
    public function reporteInventarioFiltradoPDF($codigo, $color) {

        $this->bandera = false;
        $this->condiciones3 = array();
        $this->searchCodigoBarras = $codigo;
        if(isset($codigo)){
            $this->bandera = true;
        }

        if(isset($color) && $color > 0){
            array_push($this->condiciones3, ['productos.color_id', '=', $color]);
        }
        // if($this->bandera){
        //     $inventarios = Inventario::whereIn('producto_id', function ($query) {
        //         $query->select('id')
        //             ->from('productos')
        //             ->where($this->condiciones3)
        //             ->where(function($query) {
        //                 $query->where('productos.codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
        //                       ->orWhere('productos.codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
        //             })->get();
        //         })
        //         ->get();
        // } else {
        //     $inventarios = Inventario::whereIn('producto_id', function ($query) {
        //         $query->select('id')
        //             ->from('productos')
        //             ->where($this->condiciones3)
        //             ->orderByDesc('productos.id');
        //         })
        //         ->get();
        // }

        if($this->bandera){
            $ultima_entrada = Inventario::Join('inventario_detalles','inventarios.producto_id','=','inventario_detalles.producto_id')
                ->whereIn('inventarios.producto_id', function ($query) {
                $query->select('id')
                    ->from('productos')
                    ->where($this->condiciones3)
                    ->where(function($query) {
                        $query->where('productos.codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                              ->orWhere('productos.codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                    })->get();
                })

                ->max('inventarios.ultima_entrada');


            $inventarios = Inventario::Join('inventario_detalles','inventarios.producto_id','=','inventario_detalles.producto_id')
                ->whereIn('inventarios.producto_id', function ($query) {
                $query->select('id')
                    ->from('productos')
                    ->where($this->condiciones3)
                    ->where(function($query) {
                        $query->where('productos.codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                              ->orWhere('productos.codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                    })->get();
                })
                ->selectRaw('DISTINCT inventarios.*,
                            (select entradas from inventario_detalles where producto_id = inventarios.producto_id and ultima_entrada = "'.$ultima_entrada.'" ORDER BY id DESC Limit 1) as entradas,
                            (select descripcion from inventario_detalles where producto_id = inventarios.producto_id and ultima_entrada = "'.$ultima_entrada.'" ORDER BY id DESC Limit 1) as descripcion')
                ->get();
        } else {
            $inventarios = Inventario::whereIn('producto_id', function ($query) {
                $query->select('id')
                    ->from('productos')
                    ->where($this->condiciones3)
                    ->orderByDesc('productos.id');
                })
                ->get();
        }

        return PDF::loadView('reportes.reporte-inventario-filtrado', compact('inventarios'))
                    ->stream('inventario-filtrado.pdf');
    }

    public function reporteInventarioTotalPDF() {

        $productos_registrados = Producto::where('activo', '=', 'si')->count('productos.id');
        $productos_en_stock = Producto::where('activo', '=', 'si')->sum('productos.stock');
        //$productos_con_stock = Producto::where('stock', '>', 0)->count('productos.stock');
        $precio_produccion = Producto::where('productos.stock', '>', 0)->selectRaw('SUM(productos.stock * productos.precio_produccion) as PC')->pluck('PC');

        return PDF::loadView('reportes.reporte-general-inventario', compact('productos_registrados','productos_en_stock','precio_produccion'))
                    ->setPaper('a4', 'landscape')
                    ->stream('reporte-general-inventario.pdf');

    }
}
