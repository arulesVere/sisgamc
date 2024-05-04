<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;
use DB;
use Session;

class CReporte extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Reporte.rangofecha');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
    public function reporterangofecha(Request $request)
    {
        $sessionidusuario=session('sessionidusuario');

        $queryrangofecha=DB::select('SELECT p.idpersona,f.idfolder,f.numero,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,
        o.nombre AS oficina,t.nombre AS tramite,f.fechainicio,f.fechafin
        FROM colcapir_bddsisgamc.persona p INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina 
        INNER JOIN colcapir_bddsisgamc.folder f ON f.idpersona=p.idpersona
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'" AND f.fechainicio=? AND f.fechafin=?', [$request->get('txtinicio'),$request->get('txtfin')]);
        return view('Reporte.rangofecha',['qrangofecha'=>$queryrangofecha]);
    }

    public function vistareportetipotramite()
    {
        $nombreoficina=session('sessionoficina');
      
        $alltramite=DB::select('SELECT t.idtramite,t.nombre,o.idoficina,o.nombre AS oficina FROM colcapir_bddsisgamc.tramite t 
        INNER JOIN colcapir_bddsisgamc.oficina o ON t.idoficina=o.idoficina WHERE t.estado=1 AND o.nombre="'.$nombreoficina.'" ORDER BY t.nombre DESC');
        
        return view('Reporte.portramite',['querytramite'=>$alltramite]);
    }

    public function reportetipotramite(Request $request)
    {
        
        $sessionidusuario=session('sessionidusuario');
        $nombreoficina=session('sessionoficina');
      
        $alltramite=DB::select('SELECT t.idtramite,t.nombre,o.idoficina,o.nombre AS oficina FROM colcapir_bddsisgamc.tramite t 
        INNER JOIN colcapir_bddsisgamc.oficina o ON t.idoficina=o.idoficina WHERE t.estado=1 AND o.nombre="'.$nombreoficina.'" ORDER BY t.nombre DESC');

        $allreportetramite=DB::select('SELECT p.idpersona,f.idfolder,f.codigo,f.numero,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        o.idoficina,o.nombre AS oficina,t.nombre AS tramite,f.fechainicio,f.fechafin,CONCAT(e.nombre," ",e.fila) AS estante,f.estado,f.estado AS estadofolder
        FROM colcapir_bddsisgamc.persona p INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina 
        INNER JOIN colcapir_bddsisgamc.folder f ON f.idpersona=p.idpersona
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        INNER JOIN colcapir_bddsisgamc.estante e ON e.idestante=f.idestante
        WHERE p.idpersona="'.$sessionidusuario.'" AND t.idtramite=?',[$request->get('cbxtramite')]);

        
        return view('Reporte.portramite',['queryreportetramite'=>$allreportetramite,'querytramite'=> $alltramite, 'oficina'=>$nombreoficina]);
    }
    public function vistanumerofolder()
    {
        return view('Reporte.pornumero');
    }
    public function reportenumerofolder(Request $request)
    {
        $sessionidusuario=session('sessionidusuario');

        $allreportefolder=DB::select('SELECT p.idpersona,f.idfolder,f.numero,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,o.nombre AS oficina,t.nombre AS tramite,f.fechainicio,f.fechafin
        FROM colcapir_bddsisgamc.persona p INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina 
        INNER JOIN colcapir_bddsisgamc.folder f ON f.idpersona=p.idpersona
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'" AND f.numero=?',[$request->get('txtnumero')]);

        return view('Reporte.pornumero',['queryfolder'=>$allreportefolder]);
    }
    public function barchart()
    {
        return view('Principal.principal');
    }
}
