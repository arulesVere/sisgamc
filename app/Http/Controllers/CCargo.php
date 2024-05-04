<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use DB;
use Alert;
class CCargo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allCargo="SELECT * FROM colcapir_bddsisgamc.cargo WHERE estado=1 ORDER BY nombre ASC";
        $query=DB::select($allCargo);
        return view('Cargo.index', ['query' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $cargo=new Cargo();
        $cargo->nombre=$request->get('txtcargo');
        $cargo->detalle=$request->get('txtdetalle');
        //echo $cargo;
        $cargo->save();
        Alert::success('EXITO', 'REGISTRO EXITOSO');
        return redirect('/Cargo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit($idcargo)
    {
        $cargo=Cargo::findOrFail($idcargo); 
        return view('Cargo.edit', ['car' => $cargo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCargo)
    {
        $cargo=Cargo::findOrFail($idCargo);
        $cargo->nombre=$request->get('txtcargo');
        $cargo->detalle=$request->get('txtdetalle');
        //echo  $cargo;
        $cargo->update();
        return redirect('/Cargo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcargo)
    {
        $car=Cargo::FindOrFail($idcargo);
        $car->estado=0;
        $car->update();
        return redirect('/Cargo');
    }
}
