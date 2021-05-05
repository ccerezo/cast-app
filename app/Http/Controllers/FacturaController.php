<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cupo;
use App\Models\EstadoFactura;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Inventario;
use App\Models\pagoFactura;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
            'cliente_id' => 'required',
            'forma_pago' => 'required'
        ]);
        //return $request->all();
        $es_a_credito = false;
        $factura = $request->all();
        if(strcmp($factura['forma_pago'], 'CONTADO') === 0){
            $estadoFactura = EstadoFactura::where('codigo', '=', '01')->first(); //01 ES PAGADA
        } else {
            $es_a_credito = true;
            $estadoFactura = EstadoFactura::where('codigo', '=', '03')->first(); //03 NO Pagada
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
            'observacion' => $factura['observacion'],
            'vencimiento' => $factura['vencimiento'],
            'facturado_como_id' => $factura['facturado_como_id'],
            'cliente_id' => $factura['cliente_id'],
            'cajero_id' => Auth::user()->id,
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
                'cantidad' => $valor,
                'descuento' => $producto->descuento,
                'iva' => $producto->iva,
                'factura_id' => $venta->id,
                'producto_id' => $key
            ]);
        }
        if(!$es_a_credito){
            $pago = pagoFactura::create(
                [
                '_token' => $factura['_token'],
                'fecha' => $factura['fecha'],
                'monto' => $factura['total'],
                'descripcion' => $factura['observacion'],
                'factura_id' => $venta->id,
                'metodo_pago_id' => $factura['metodo_pago_id'],
            ]);
        } else {
            $cupo = Cupo::where('cliente_id', '=', $factura['cliente_id'])->first();
            if($cupo) {
                $cupo->update([
                    'ultimo_credito' => $factura['fecha'],
                    'cupo_disponible' => $cupo->cupo_disponible - $factura['total'],
                    'saldo' => $cupo->saldo + $factura['total'],
                ]);
            }
        }



        $factura = $venta;
        return redirect()->route('facturas.show', compact('factura'))->with('info', 'El registro se creó con éxito.');
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
        $productos = FacturaDetalle::where('factura_id', '=', $factura->id)->get();
        $pagos = pagoFactura::where('factura_id', '=', $factura->id)->get();
        return view('facturas.show', compact('factura','clientes','productos','pagos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        // $productos = FacturaDetalle::where('factura_id', '=', $factura->id)->get();
        // $pagos = pagoFactura::where('factura_id', '=', $factura->id)->get();
        return view('facturas.edit', compact('factura'));
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
        //return $request->all();
        $detalle_nuevo = array();
        $detalle_viejo = array();
        $detalles_viejo = FacturaDetalle::where('factura_id', '=', $factura->id)
                                        ->selectRaw('factura_detalles.producto_id')
                                        ->get();

        foreach($detalles_viejo as $dv) {
            array_push($detalle_viejo, $dv->producto_id);
        }
        //return $detalle_viejo;

        foreach($request->input('cantidad') as $key => $valor) {
            $detalle = FacturaDetalle::where('factura_id', '=', $factura->id)
                                        ->where('producto_id', '=', $key)
                                        ->first();

            //$id_nuevo = $detalle->id;
            //return $detalle->id;
            //$id_nuevo = $detalle->id;

            array_push($detalle_nuevo, $key);

            if($detalle) {
                $producto = Producto::where('id', '=', $key)->first();
                $inventario = Inventario::where('producto_id', '=', $key)->first();

                if($detalle->cantidad > $valor) {

                    $producto->update([
                        'stock' => $producto->stock + ($detalle->cantidad - $valor)
                    ]);

                    $inventario->update([
                        'salidas' => $inventario->salidas - ($detalle->cantidad - $valor),
                        'stock' => $inventario->stock + ($detalle->cantidad - $valor)
                    ]);
                    $detalle->update([
                        'cantidad' => $valor
                    ]);
                }



            } else {
                $producto = Producto::find($key);
                $cupo = FacturaDetalle::create([
                    'precio_produccion' => $producto->precio_produccion,
                    'precio_mayorista' => $producto->precio_mayorista,
                    'precio_venta_publico' => $producto->precio_venta_publico,
                    'cantidad' => $valor,
                    'descuento' => 0,
                    'iva' => 'no',
                    'factura_id' => $factura->id,
                    'producto_id' => $producto->id
                ]);
            }

        }

        //print_r($detalle_viejo);
        //print_r($detalle_nuevo);
        $reemplazados = array_diff($detalle_viejo,$detalle_nuevo);
        //return $reemplazados;
        $detalles_a_eliminar = FacturaDetalle::where('factura_id', '=', $factura->id)
                                ->whereIn('producto_id', $reemplazados)->get();

        foreach($detalles_a_eliminar as $d) {

            $producto = Producto::where('id', '=', $d->producto_id)->first();
            $inventario = Inventario::where('producto_id', '=', $d->producto_id)->first();

            $producto->update([
                'stock' => $producto->stock + ($d->cantidad)
            ]);

            $inventario->update([
                'salidas' => $inventario->salidas - ($d->cantidad),
                'stock' => $inventario->stock + ($d->cantidad)
            ]);

        }

        FacturaDetalle::where('factura_id', '=', $factura->id)
                        ->whereIn('producto_id', $reemplazados)
                        ->delete();
        //FacturaDetalle::destroy($reemplazados);

        return redirect()->route('facturas.edit', $factura)->with('info', 'Los datos se actualizaron con éxito');
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
        $estadoFactura = EstadoFactura::where('codigo', '=', '02')->first(); //02 ES ANULADA
        // ESTADO FACTURA ID ES ANULADO
        $factura->update([
            'estado_factura_id' => $estadoFactura->id
        ]);

        $detalles_factura = FacturaDetalle::where('factura_id', '=', $factura->id)->get();

        foreach($detalles_factura as $item){
            $inventario = Inventario::where('producto_id', '=', $item->producto_id)->first();
            $producto = Producto::where('id', '=', $item->producto_id)->first();
            $inventario->update([
                'stock' => $item->cantidad + $inventario->stock,
                'salidas' => $inventario->salidas - $item->cantidad
            ]);
            $producto->update([
                'stock' => $item->cantidad + $producto->stock,
            ]);

        }
        if(strcmp($factura->forma_pago, 'CREDITO') === 0){
            $cupo = Cupo::where('cliente_id', '=', $factura->cliente_id)->first();
            if($cupo) {
                $cupo->update([
                    'cupo_disponible' => $cupo->cupo_disponible + $factura->total,
                    'saldo' => $cupo->saldo - $factura->total,
                ]);
            }
        }

        return redirect()->route('facturas.index')->with('info', 'La Factura fue ANULADA con éxito!');
    }
}
