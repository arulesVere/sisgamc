<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;
use DB;
use File;
use Alert;
class COficina extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alloficina='SELECT o.idoficina,o.nombre,o.estado,o.fecharegistro,o.secretaria FROM colcapir_bddsisgamc.oficina o WHERE o.estado=1 ORDER BY o.nombre DESC';
        $queryoficina=DB::SELECT($alloficina);
        return view('Oficina.index',['qoficina'=>$queryoficina]);
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
        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta;

        $oficina=new Oficina();
        $nombre=$request->get('txtoficina');
        $oficina->nombre=$nombre;
        $oficina->secretaria=$request->get('cbxsecretaria');

        $path=($directorio.$nombre);
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
            $oficina->save();
            Alert::success('EXITO', 'REGISTRO EXITOSO');
            return redirect('/Oficina');
        }
        else
        {
            Alert::info('DUPLICADO', 'EL VALOR REGISTRADO YA EXISTE');
            return redirect('/Oficina');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function show(Oficina $oficina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function edit(Oficina $oficina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oficina $oficina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oficina $oficina)
    {
        //
    }
}
