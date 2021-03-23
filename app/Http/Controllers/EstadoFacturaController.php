<?php

namespace App\Http\Controllers;

use App\Models\EstadoFactura;
use Illuminate\Http\Request;

class EstadoFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estadoFacturas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estadoFacturas.create');
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
            'nombre' => 'required'
        ]);
        $estadoFactura = EstadoFactura::create($request->all());

        return redirect()->route('estadoFacturas.edit', compact('estadoFactura'))->with('info', 'El registro se creó con éxito.');;
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
    public function edit(EstadoFactura $estadoFactura)
    {
        return view('estadoFacturas.edit', compact('estadoFactura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoFactura $estadoFactura)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $estadoFactura->update($request->all());

        return redirect()->route('estadoFacturas.edit', compact('estadoFactura'))->with('info', 'Los datos se actualizaron con éxito.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoFactura $estadoFactura)
    {
        $estadoFactura->delete();

        return redirect()->route('estadoFacturas.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
