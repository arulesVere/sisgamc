<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Empastado;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use DB;
use File;
use Session;
use Google\Client;
use Google\Service\Drive;
class CVehiculo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function token()
    {
        $client_id = \Config('services.google.client_id');
        $client_secret = \Config('services.google.client_secret');
        $refresh_token = \Config('services.google.refresh_token');
        $folder_id = \Config('services.google.folder_id');
        $response = Http::post('https://oauth2.googleapis.com/token', [

            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',

        ]);
//dd($response);
        $access_token = json_decode((string) $response->getBody(), true)['access_token'];
        return $access_token;
    }
    public function index()
    {
        $allvehiculo=DB::SELECT('SELECT e.idempastado,e.codigo,e.numero,e.fecha,e.condicion,t.nombre,est.nombre,p.pasillo,v.carpetas,
        v.total,v.certificaciones,v.placas,v.fechasingreso
        FROM colcapir_bddsisgamc.empastado e
        INNER JOIN colcapir_bddsisgamc.vehiculo v ON v.idempastado=e.idempastado
        INNER JOIN colcapir_bddsisgamc.tramite t ON e.idtramite=t.idtramite
        INNER JOIN colcapir_bddsisgamc.estante est ON e.idestante=est.idestante
        INNER JOIN colcapir_bddsisgamc.pasillo p ON e.idpasillo=p.idpasillo WHERE e.estado=1');
        return view('Vehiculo.index',['allvehiculo'=>$allvehiculo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltramite=DB::SELECT('SELECT * FROM colcapir_bddsisgamc.tramite WHERE estado=1');
        $allpasillo=DB::SELECT('SELECT * FROM colcapir_bddsisgamc.pasillo WHERE estado=1');
        $allestante=DB::SELECT('SELECT * FROM colcapir_bddsisgamc.estante WHERE estado=1');
        return view('Vehiculo.create',['qtramite'=>$alltramite,'qpasillo'=>$allpasillo,'qestante'=>$allestante]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombreoficina=session('sessionoficina');

        $accessToken = $this->token();

                $empastado=new Empastado();
                $empastado->codigo=Str::random(5);
                $empastado->numero=$request->get('txtnumero');
                $empastado->fecha=$request->get('txtgestion');
                $empastado->idpersona = 100;
                $empastado->idtramite=$request->get('cbxtramite');
                $empastado->idestante=$request->get('cbxestante');
                $empastado->idpasillo=$request->get('cbxpasillo');
                $empastado->save();

                $maxidfolder=DB::select('SELECT MAX(e.idempastado) AS idempastado FROM colcapir_bddsisgamc.empastado e WHERE e.estado=1');
                $vehiculo=new Vehiculo();
                $vehiculo->idempastado=$maxidfolder[0]->idempastado;;
                $vehiculo->carpetas=$request->get('txtcarpetas');
                $vehiculo->total=$request->get('txttotal');
                $vehiculo->certificaciones=$request->get('txtcertificaciones');
                $vehiculo->placas=$request->get('txtplacas');
                $vehiculo->fechasingreso=$request->get('txtfechasingreso');
                $vehiculo->save();
                // crear carpetas y subcarpetas


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($idempastado)
    {
        $vehiculo=DB::SELECT('SELECT e.codigo,e.numero,e.fecha,t.nombre,est.nombre,p.pasillo,v.carpetas,
        v.total,v.certificaciones,v.placas,v.fechasingreso
        FROM colcapir_bddsisgamc.empastado e
        INNER JOIN colcapir_bddsisgamc.vehiculo v ON v.idempastado=e.idempastado
        INNER JOIN colcapir_bddsisgamc.tramite t ON e.idtramite=t.idtramite
        INNER JOIN colcapir_bddsisgamc.estante est ON e.idestante=est.idestante
        INNER JOIN colcapir_bddsisgamc.pasillo p ON e.idpasillo=p.idpasillo
        WHERE e.estado=1 AND e.idempastado="'.$idempastado.'"');
        return view('Vehiculo.edit',['vehiculo'=>$vehiculo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }

}
