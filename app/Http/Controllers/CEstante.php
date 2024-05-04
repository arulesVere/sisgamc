<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Oficina;
use Illuminate\Http\Request;
use DB;
use Storage;
use Session;
use Alert;
class CEstante extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allestante='SELECT e.idestante,e.nombre,e.fila,e.idoficina,o.nombre AS oficina, e.estado,e.fecharegistro
        FROM colcapir_bddsisgamc.estante e
        INNER JOIN colcapir_bddsisgamc.oficina o
        WHERE o.estado=1 AND e.estado=1 ORDER BY o.nombre DESC';
        $queryestante=DB::SELECT($allestante);
        $alloficina='SELECT * FROM colcapir_bddsisgamc.oficina WHERE estado=1';
        $queryoficina=DB::SELECT($alloficina);
        return view('Estante.index',['qestante'=>$queryestante,'qoficina'=>$queryoficina]);
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
        $estante=new Estante();
        $estante->nombre=$request->get('txtestante');
        $estante->fila=$request->get('txtfila');
        $estante->idoficina=$request->get('cbxoficina');
        //echo $estante;
        $estante->save();
        Alert::success('EXITO', 'REGISTRO EXITOSO');
        return redirect('/Estante');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function show(Estante $estante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estante $estante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estante $estante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estante $estante)
    {
        //
    }
}
