<?php

namespace App\Http\Controllers;

use App\Models\Pasillo;
use Illuminate\Http\Request;
use DB;
use Alert;
class CPasillo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $allpasillo=DB::SELECT('SELECT p.idpasillo,p.pasillo,p.detalle,p.estado,o.nombre AS oficina FROM colcapir_bddsisgamc.pasillo p 
        INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina WHERE p.estado=1');
        return view('Pasillo.index',['qpasillo'=>$allpasillo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alloficina=DB::SELECT('SELECT * FROM colcapir_bddsisgamc.oficina WHERE estado=1');
        return view('Pasillo.create',['qoficina'=>$alloficina]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pas=new Pasillo();
        $pas->pasillo=$request->get('txtpasillo');
        $pas->detalle=$request->get('txtdetalle');
        $pas->idoficina=$request->get('cbxoficina');
        $pas->save();
        Alert::success('EXITO', 'REGISTRO EXITOSO');
        return redirect('/Pasillo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasillo  $pasillo
     * @return \Illuminate\Http\Response
     */
    public function show(Pasillo $pasillo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasillo  $pasillo
     * @return \Illuminate\Http\Response
     */
    public function edit($idpasillo)
    {
        $alloficina=DB::select('SELECT o.idoficina,o.nombre,o.estado,o.fecharegistro
        FROM colcapir_bddsisgamc.oficina o WHERE o.estado=1 ORDER BY o.nombre DESC');

        $querypasillo=Pasillo::findOrFail($idpasillo); 
        return view('Pasillo.edit', ['qoficina'=>$alloficina,'qpasillo'=>$querypasillo]); 
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasillo  $pasillo
     * @return \Illuminate\Http\Response
     */
    public function update($idpasillo)
    {
        $pasillo=Pasillo::findOrFail($idpasillo);
        $pasillo->pasillo=$request->get('txtpasillo');
        $pasillo->detalle=$request->get('txtdetalle');
        $pasillo->update();
        return redirect('/Pasillo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasillo  $pasillo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idpasillo)
    {
        $pasillo=Pasillo::FindOrFail($idpasillo);
        $pasillo->estado=0;
        $pasillo->update();
        return redirect('/Pasillo');
    }
}
