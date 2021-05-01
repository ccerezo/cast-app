<?php

namespace App\Http\Controllers;

use App\Models\InventarioMateriaPrima;
use App\Models\Proveedor;
use App\Models\MateriaPrima;
use Illuminate\Http\Request;

class InventarioMateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventariomateriaPrimas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedors = Proveedor::pluck('nombre','id');
        $materia_primas = MateriaPrima::pluck('descripcion','id');
        return view('inventariomateriaPrimas.create', compact('proveedors','materia_primas'));
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
            'proveedor_id' => 'required',
            'materia_prima_id' => 'required',
            'stock' => 'numeric|required',
            'costo_unidad' => 'numeric',
        ]);
        $inventarioMateriaPrima = InventarioMateriaPrima::create($request->all());

        return redirect()->route('inventarioMateriaPrimas.edit', compact('inventarioMateriaPrima'))->with('info', 'El registro se creó con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InventarioMateriaPrima $inventarioMateriaPrima)
    {
        $proveedors = Proveedor::pluck('nombre','id');
        $materia_primas = MateriaPrima::pluck('descripcion','id');
        return view('inventariomateriaPrimas.edit', compact('proveedors','materia_primas','inventarioMateriaPrima'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventarioMateriaPrima $inventarioMateriaPrima)
    {
        $request->validate([
            'proveedor_id' => 'required',
            'materia_prima_id' => 'required',
            'stock' => 'numeric|required',
            'costo_unidad' => 'numeric',
        ]);

        $inventarioMateriaPrima->update($request->all());

        return redirect()->route('inventarioMateriaPrimas.edit', $inventarioMateriaPrima)->with('info', 'Los datos se actualizaron con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventarioMateriaPrima $inventarioMateriaPrima)
    {
        $inventarioMateriaPrima->delete();

        return redirect()->route('inventarioMateriaPrimas.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
