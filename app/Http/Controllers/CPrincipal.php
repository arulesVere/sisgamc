<?php

namespace App\Http\Controllers;

use App\Models\Principal;
use Illuminate\Http\Request;
use DB;

class CPrincipal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    public function index()
    {
        $allp=DB::select('SELECT COUNT(idpersona) AS total FROM colcapir_bddsisgamc.persona WHERE estado=1');
        $allf=DB::select('SELECT COUNT(idfolder) AS total FROM colcapir_bddsisgamc.folder WHERE estado=1');
        $alla=DB::select('SELECT COUNT(idarchivo) AS total FROM colcapir_bddsisgamc.archivo WHERE estado=1');
        $allo=DB::select('SELECT COUNT(idoficina) AS total FROM colcapir_bddsisgamc.oficina WHERE estado=1');
        $allc=DB::select('SELECT COUNT(idcargo) AS total FROM colcapir_bddsisgamc.cargo WHERE estado=1');
        $allr=DB::select('SELECT COUNT(idrol) AS total FROM colcapir_bddsisgamc.rol WHERE estado=1');
        
        $allfolder=DB::select('SELECT COUNT(f.idfolder) AS cantidad FROM colcapir_bddsisgamc.folder f');


        return view ('Principal.principal',['persona'=>$allp,'folder'=>$allf,'archivo'=>$alla,'oficina'=>$allo,'cargo'=>$allc,'rol'=>$allr]);
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
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function show(Principal $principal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function edit(Principal $principal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Principal $principal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Principal $principal)
    {
        //
    }
}
