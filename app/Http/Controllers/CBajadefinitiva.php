<?php

namespace App\Http\Controllers;
use App\Models\Bajadefinitiva;
use App\Models\Folder;
use Illuminate\Http\Request;
use File;
use DB;
use Storage;
use Session;

class CBajadefinitiva extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionidusuario=session('sessionidusuario');
        $nombreoficina=session('sessionoficina');

        $allconfig="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryconfig=DB::select($allconfig);
        
        $alltramite='SELECT * FROM colcapir_bddsisgamc.tramite t WHERE t.estado=1 AND t.tipotramite=1 ORDER BY t.nombre DESC';
        $querytramite=DB::select($alltramite);
       
        if($nombreoficina=="RUAT")
        {
            $allfolderbybaja=DB::select('SELECT f.idfolder,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,f.solicitante,f.carnet,
            bd.placa,bd.razon,bd.hr,bd.tramitador
            FROM colcapir_bddsisgamc.folder f 
            INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
            INNER JOIN colcapir_bddsisgamc.bajadefinitiva bd ON bd.idfolder=f.idfolder
            WHERE f.estado=1 AND f.idpersona="'. $sessionidusuario.'" ORDER BY numero ASC');
            return view('Bajadefinitiva.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybybaja'=>$allfolderbybaja]);
        }
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
        $sessionidusuario=session('sessionidusuario');
    
        $queryoficial=DB::select('SELECT p.idpersona,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,o.nombre AS oficina
        FROM colcapir_bddsisgamc.persona p INNER JOIN bddsisgamc.oficina o ON p.idoficina=o.idoficina WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'"');
    
        $nombrecompleto=$queryoficial[0]->nombrecompleto;
        $nombreoficina=$queryoficial[0]->oficina;

        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$nombreoficina;
        
        if(File::isDirectory($directorio))
        {
                $folder=new Folder();
                $folder->idpersona=$sessionidusuario;
                $numero=$request->get('txtnumero');
                $folder->numero=$numero;
                $folder->nrohoja=$request->get('txthoja');

                $folder->fechainicio=$request->get('txtinicio');
                $folder->fechafin=$request->get('txtfin');
                $folder->solicitante=$request->get('txtsolicitante');
                $folder->carnet=$request->get('txtcarnet');
                $folder->idtramite=2;


                $path=($directorio.'/'.$nombrecompleto.'/'.'BAJA DEFINITIVA'.'/'.$numero);
                if(!File::isDirectory($path))
                    {
                        File::makeDirectory($path, 0777, true, true);
                        $folder->save();
                        
                        $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                        $bajadef=new bajadefinitiva();
                        $bajadef->idfolder=$maxidfolder[0]->idfolder;
                        $bajadef->placa=$request->get('txtplacabaja');
                        $bajadef->razon=$request->get('cbxrazonbaja');
                        $bajadef->hr=$request->get('txthojaruta');
                        $bajadef->tramitador=$request->get('rdbtramitador');
                        $bajadef->nomabogado=$request->get('txtabogado');
                        $bajadef->carnetabogado=$request->get('txtcarnetabogado');
                        $bajadef->save();
                        return redirect('/Bajadefinitiva');                               
                            
                    }
                    else
                    {
                        echo('FOLDER EXISTENTE');
                    }
        }
        else
        {
            echo('NO EXISTE');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
