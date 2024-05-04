<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Illuminate\Http\Request;
use DB;
class CTramite extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alltramite='SELECT t.idtramite,t.nombre AS tramite, t.estado,o.nombre AS oficina FROM colcapir_bddsisgamc.tramite t
        INNER JOIN colcapir_bddsisgamc.oficina o ON t.idoficina=o.idoficina
        WHERE t.estado=1 ORDER BY t.nombre DESC;';
        $querytramite=DB::select($alltramite);
        $alloficina='SELECT * FROM colcapir_bddsisgamc.oficina o WHERE o.estado=1 ORDER BY o.nombre DESC';
        $queryoficina=DB::select($alloficina);
        return view('Tramite.index',['querytramite'=>$querytramite,'queryoficina'=>$queryoficina]);
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
        $tramite=new Tramite();
        $tramite->nombre=$request->get('txttramite');
        $tramite->idoficina=$request->get('cbxoficina');
        $tramite->save();
        return redirect('/Tramite');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(Tramite $tramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramite $tramite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tramite $tramite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tramite $tramite)
    {
        //
    }
}
