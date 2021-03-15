<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Talla;
use App\Models\Tallaje;
use Illuminate\Http\Request;

class TallajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tallajes = Tallaje::all();
        return view('tallajes.index', compact('tallajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineas = Linea::pluck('nombre','id');
        $tallas = Talla::pluck('numero1','id');
        return view('tallajes.create',compact('lineas','tallas'));
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
            'linea_id' => 'required',
            'talla_id' => 'required',
        ]);
        $tallaje = Tallaje::create($request->all());

        return redirect()->route('tallajes.edit', compact('tallaje'))->with('info', 'El registro se creó con éxito.');;
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
    public function edit(Tallaje $tallaje)
    {
        $lineas = Linea::pluck('nombre','id');
        $tallas = Talla::pluck('numero1','id');
        return view('tallajes.edit', compact('tallaje','lineas','tallas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tallaje $tallaje)
    {
        $request->validate([
            'linea_id' => 'required',
            'talla_id' => 'required',
        ]);

        $tallaje->update($request->all());

        return redirect()->route('tallajes.edit', $tallaje)->with('info', 'Los datos se actualizaron con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tallaje $tallaje)
    {
        $tallaje->delete();

        return redirect()->route('tallajes.index')->with('info', 'El registro se Eliminó con éxito');
    }
}
