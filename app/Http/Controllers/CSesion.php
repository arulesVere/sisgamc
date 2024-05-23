<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Http;

class CSesion extends Controller
{

    private function get_google_token()
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
        $access_token = json_decode((string) $response->getBody(), true)['access_token'];
        return $access_token;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionidusuario = session('sessionidusuario');
        /* if($sessionidusuario<>"")
        { */
        return view('Sesion.index');
        /*  }
         else
         {
             Session::flash('Mensaje','Loguearse antes de continuar');
             //return redirect('/');
         }   */

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
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show(Sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesion $sesion)
    {
        //
    }
    public function autenticacion(Request $request)
    {
        $sesion = DB::select('SELECT p.idpersona,p.nombre,p.papellido,p.sapellido,p.tipopersona,o.nombre AS nombreoficina FROM colcapir_bddsisgamc.persona p
        INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina
        WHERE p.estado=1 AND correo=? AND contrasenia=? ', [$request->get('txtcorreo'), $request->get('txtcontrasenia')]);

        $allp = DB::select('SELECT COUNT(idpersona) AS total FROM colcapir_bddsisgamc.persona WHERE estado=1');
        $allf = DB::select('SELECT COUNT(idfolder) AS total FROM colcapir_bddsisgamc.folder WHERE estado=1');
        $alla = DB::select('SELECT COUNT(idarchivo) AS total FROM colcapir_bddsisgamc.archivo WHERE estado=1');
        $allo = DB::select('SELECT COUNT(idoficina) AS total FROM colcapir_bddsisgamc.oficina WHERE estado=1');
        $allc = DB::select('SELECT COUNT(idcargo) AS total FROM colcapir_bddsisgamc.cargo WHERE estado=1');
        $allr = DB::select('SELECT COUNT(idrol) AS total FROM colcapir_bddsisgamc.rol WHERE estado=1');


        $allfolder = DB::select('SELECT COUNT(f.idfolder) AS cantidad FROM colcapir_bddsisgamc.folder f');

        $datas = array();

        if (count($sesion) > 0) {
            // Auth::loginUsingId($sesion[0]->idpersona);
            if ($sesion[0]->tipopersona == 1) {
                Session::put('sessionusuario', $sesion[0]->nombre . ' ' . $sesion[0]->papellido);
                Session::put('sessionoficina', $sesion[0]->nombreoficina);
                Session::put('sessionidusuario', $sesion[0]->idpersona);
                Session::put('googletoken', $this->get_google_token());

                return view('Principal.principal', ['persona' => $allp, 'folder' => $allf, 'archivo' => $alla, 'oficina' => $allo, 'cargo' => $allc, 'rol' => $allr, 'datas' => $datas]);

            }
        } else {
            return redirect('/');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
