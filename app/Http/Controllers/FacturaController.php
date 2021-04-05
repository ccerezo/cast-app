<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\EstadoFactura;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\pagoFactura;
use App\Models\Producto;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facturas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'forma_pago' => 'required'
        ]);
        //return $request->all();
        $factura = $request->all();
        if(strcmp($factura['forma_pago'], 'CONTADO') === 0){
            $estadoFactura = EstadoFactura::where('codigo', '=', '002')->first(); //002 es PAGADA
        } else {
            $estadoFactura = EstadoFactura::where('codigo', '=', '001')->first(); //001 es PENDIENTE
        }

        $venta = Factura::create(
            [
            '_token' => $factura['_token'],
            'numero' => $factura['numero'],
            'fecha' => $factura['fecha'],
            'subtotal' => $factura['subtotal'],
            'iva' => $factura['iva'],
            'total' => $factura['total'],
            'descuento' => $factura['descuento'],
            'forma_pago' => $factura['forma_pago'],
            'cliente_id' => $factura['cliente_id'],
            'vendedor_id' => $factura['vendedor_id'],
            'estado_factura_id' => $estadoFactura->id
        ]);
        foreach($factura['cantidad'] as $key => $valor) {
            $producto = Producto::where('id', '=', $key)->first();
            $venta_detalle = FacturaDetalle::create(
                [
                '_token' => $factura['_token'],
                'precio_produccion' => $producto->precio_produccion,
                'precio_mayorista' => $producto->precio_mayorista,
                'precio_venta_publico' => $producto->precio_venta_publico,
                'cantidad' => $valor[0],
                'descuento' => $producto->descuento,
                'iva' => $producto->iva,
                'factura_id' => $venta->id,
                'producto_id' => $key
            ]);
        }
        $pago = pagoFactura::create(
            [
            '_token' => $factura['_token'],
            'fecha' => $factura['fecha'],
            'monto' => $factura['monto'],
            'descripcion' => $factura['descripcion'],
            'factura_id' => $venta->id,
            'metodo_pago_id' => $factura['metodo_pago_id'],
        ]);

        $factura = $venta;
        return redirect()->route('facturas.edit', compact('factura'))->with('info', 'El registro se creó con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $productos = FacturaDetalle::where('factura_id', '=', $factura->id)->get();
        return view('facturas.show', compact('factura','vendedors','clientes','productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $productos = FacturaDetalle::where('factura_id', '=', $factura->id)->get();
        return view('facturas.edit', compact('factura','vendedors','clientes','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //$factura->delete();
        // ESTADO FACTURA ID ES ANULADO
        $factura->update([
            'estado_factura_id' => 3
        ]);

        return redirect()->route('facturas.index')->with('info', 'La Factura fue ANULADA con éxito!');
    }
}
