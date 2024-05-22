<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Empastado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Storage;
use DB;
use File;
use View;
use Alert;
class CArchivo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sessionidempastado=session('sessionidempastado');
        $allarchivo='SELECT * FROM colcapir_bddsisgamc.archivo a WHERE a.estado=1 AND a.idempastado="'. $sessionidempastado.'" ORDER BY a.nombre ASC';
        $queryarchivo=DB::select($allarchivo);
        return view('Archivo.index',['queryarchivo'=>$queryarchivo]);
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
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idarchivo)
    {
       
    }
    public function ver($idarchivo)
    {
      
    }
    public function download($idarchivo)
    {
        
    }

}
