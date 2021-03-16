<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
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
            'codigo' => 'required'
        ]);
        $productos = $request->all();
        //return $productos;

        foreach($productos['stock'] as $key_talla => $valor_talla) {
            $lista = array();
            foreach($valor_talla as $key_color => $valor_color) {
                if(!(is_null($valor_color[0]))){

                    $producto = Producto::create(
                        [
                        '_token' => 'cqy9VqXla958HBd438JeZEnMrcGlqsQ8xdaMckZR',
                        'codigo' => $productos['codigo'],
                        'bodega_id' => $productos['bodega_id'],
                        'marca_id' => $productos['marca_id'],
                        'modelo_id' => $productos['modelo_id'],
                        'linea_id' => $productos['linea_id'],
                        'categoria_id' => $productos['categoria_id'],
                        'descripcion' => 'descripcion',
                        'precio_produccion' => $productos['precio_produccion'],
                        'precio_mayorista' => $productos['precio_mayorista'],
                        'precio_venta_publico' => $productos['precio_venta_publico'],
                        'descuento' => 0,
                        'stock' => $valor_color[0],
                        'talla_id' => $key_talla,
                        'color_id' => $key_color
                    ]);

                }
            }
        }
        //$modelo = Modelo::create($p);

        return redirect()->route('productos.edit', compact('producto'))->with('info', 'El registro se creó con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());

        return redirect()->route('productos.edit', $producto)->with('info', 'Los datos se actualizaron con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
