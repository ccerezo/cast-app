<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('metodoPagos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metodoPagos.create');
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
        $metodoPago = MetodoPago::create($request->all());

        return redirect()->route('metodoPagos.edit', compact('metodoPago'))->with('info', 'El registro se creó con éxito.');;
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
    public function edit(MetodoPago $metodoPago)
    {
        return view('metodoPagos.edit', compact('metodoPago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetodoPago $metodoPago)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $metodoPago->update($request->all());

        return redirect()->route('metodoPagos.edit', $metodoPago)->with('info', 'Los datos se actualizaron con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodoPago $metodoPago)
    {
        $metodoPago->delete();

        return redirect()->route('metodoPagos.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
