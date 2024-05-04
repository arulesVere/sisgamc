<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Persona;
use Illuminate\Http\Request;
use DB;
class CPermiso extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*   $alluserwithpermission='SELECT per.idpermiso,p.idpersona,r.idrol,CONCAT(p.papellido," ",IFNULL(NULL,p.sapellido)," ",p.nombre) AS usuario,c.nombre AS cargo,r.nombre AS rol
        FROM colcapir_bddsisgamc.persona p INNER JOIN bddsisgamc.cargo c ON p.idcargo=c.idcargo INNER JOIN bddsisgamc.permiso per ON p.idpersona=per.idpersona
        INNER JOIN bddsisgamc.rol r ON r.idrol=per.idrol WHERE p.estado=1';
        $queryuserwithpermission=DB::select($alluserwithpermission); */

        $alluser='SELECT per.idpersona, CONCAT(p.papellido," ",IFNULL(NULL,p.sapellido)," ",p.nombre) AS usuario,c.nombre AS cargo,o.nombre AS oficina,p.estado
        FROM colcapir_bddsisgamc.persona p INNER JOIN bddsisgamc.cargo c ON p.idcargo=c.idcargo
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        INNER JOIN colcapir_bddsisgamc.permiso per ON per.idpersona=p.idpersona';
        $queryuser=DB::select($alluser);

        return view('Permiso.index',['queryuserpermission'=>$queryuser]);
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
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit($idpersona)
    {
        
        $permiso=Persona::findOrFail($idpersona); 
        //dd($permiso);
       return view('Permiso.edit', ['permiso'=>$permiso]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
