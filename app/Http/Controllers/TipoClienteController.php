<?php

namespace App\Http\Controllers;

use App\Models\TipoCliente;
use Illuminate\Http\Request;

class TipoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipoClientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoClientes.create');
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
            'tipo' => 'required',
            'codigo' => 'required'
        ]);
        $tipoCliente = TipoCliente::create($request->all());

        return redirect()->route('tipoClientes.edit', compact('tipoCliente'))->with('info', 'El registro se creó con éxito.');
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
    public function edit(TipoCliente $tipoCliente)
    {
        return view('tipoClientes.edit', compact('tipoCliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCliente $tipoCliente)
    {
        $request->validate([
            'tipo' => 'required'
        ]);
        $tipoCliente->update($request->all());

        return redirect()->route('tipoClientes.edit', compact('tipoCliente'))->with('info', 'Los datos se actualizaron con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCliente $tipoCliente)
    {
        $tipoCliente->delete();

        return redirect()->route('tipoClientes.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
