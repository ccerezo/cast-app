<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tallas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tallas.create');
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
            'numero1' => 'required'
        ]);
        $talla = Talla::create($request->all());

        return redirect()->route('tallas.edit', compact('talla'))->with('info', 'El registro se creó con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Talla $talla)
    {
        return view('tallas.show', compact('talla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talla $talla)
    {
        return view('tallas.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'numero1' => 'required'
        ]);

        $talla->update($request->all());

        return redirect()->route('tallas.edit', $talla)->with('info', 'Los datos se actualizaron con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talla $talla)
    {
        $talla->delete();

        return redirect()->route('tallas.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
