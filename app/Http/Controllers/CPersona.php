<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class CPersona extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allPersona='SELECT p.idpersona,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,p.carnet,c.nombre AS cargo,o.nombre AS oficina,p.estado,p.fecharegistro 
        FROM colcapir_bddsisgamc.persona p 
        INNER JOIN colcapir_bddsisgamc.cargo c ON p.idcargo=c.idcargo 
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        WHERE p.estado=1
        ORDER BY p.papellido ASC';
        $query=DB::select($allPersona);
        $allCargo="SELECT * FROM colcapir_bddsisgamc.cargo WHERE estado=1 ORDER BY nombre ASC";
        $queryCargo=DB::select($allCargo);
        $allrol="SELECT * FROM colcapir_bddsisgamc.rol WHERE estado=1 ORDER BY nombre ASC";
        $queryrol=DB::select($allrol);
        $alloficina='SELECT o.idoficina,o.nombre,o.estado,o.fecharegistro,o.secretaria FROM colcapir_bddsisgamc.oficina o WHERE o.estado=1 ORDER BY o.nombre DESC';
        $queryoficina=DB::select($alloficina);
        return view('Persona.index', ['persona' => $query,'cargo' => $queryCargo,'rol' => $queryrol,'oficina'=>$queryoficina]);
 
       // return view('Persona.edit');

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
        $persona=new Persona();
        $persona->nombre=$request->get('txtnombre');
        $persona->papellido=$request->get('txtpapellido');
        $persona->sapellido=$request->get('txtsapellido');
        $persona->carnet=$request->get('txtcarnet');
        $persona->correo=$request->get('txtcorreo');
        $persona->contrasenia=Str::random(5);
        $persona->idcargo=$request->get('cbxcargo');
        $persona->idoficina=$request->get('cbxoficina');
        //echo $persona;
        $persona->save();

        $queryultimoregistro="SELECT MAX(idpersona)  AS idpersona FROM colcapir_bddsisgamc.persona WHERE estado=1";
        $idpersona = DB::select($queryultimoregistro);


        $allrol='SELECT * FROM colcapir_bddsisgamc.rol WHERE estado=1';
        $queryrol = DB::select($allrol);

        $listaroles=$request->input("chxrol");
   
        foreach ($listaroles as $roles) 
        {
            $rol= new Permiso();
            $rol->idpersona=$idpersona[0]->idpersona;
            $rol->idrol=$roles;
            $rol->save();
        }

        return redirect('/Persona');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($idpersona)
    {
        $allCargo="SELECT * FROM colcapir_bddsisgamc.cargo WHERE estado=1 ORDER BY nombre ASC";
        $querycargo=DB::select($allCargo);
        $allrol="SELECT * FROM colcapir_bddsisgamc.rol WHERE estado=1 ORDER BY nombre ASC";
        $queryrol=DB::select($allrol);
        $alloficina='SELECT o.idoficina,o.nombre,o.estado,o.fecharegistro,o.secretaria FROM colcapir_bddsisgamc.oficina o WHERE o.estado=1 ORDER BY o.nombre DESC';
        $queryoficina=DB::select($alloficina);
        $allpermiso='SELECT * FROM colcapir_bddsisgamc.permiso';
        $querypermiso=DB::select($allpermiso);
        $persona=Persona::findOrFail($idpersona); 
        return view('Persona.edit', ['per'=>$persona,'car'=>$querycargo,'rol'=>$queryrol,'ofi'=>$queryoficina,'permiso'=>$querypermiso]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idpersona)
    {
        $persona=Persona::findOrFail($idpersona);
        $persona->nombre=$request->get('txtnombre');
        $persona->papellido=$request->get('txtpapellido');
        $persona->sapellido=$request->get('txtsapellido');
        $persona->carnet=$request->get('txtcarnet');
        $persona->correo=$request->get('txtcorreo');
        $persona->idcargo=$request->get('cbxcargo');
        $persona->idoficina=$request->get('cbxoficina');
        $persona->update();
        $listaroles=$request->input("chxrol");
        foreach ($listaroles as $roles) 
        {
            $rol= new Permiso();
            $rol->idpersona=$persona->idpersona;
            $rol->idrol=$roles;
            $rol->update();
        } 
        return redirect('/Persona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
