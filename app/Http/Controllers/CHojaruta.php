<?php

namespace App\Http\Controllers;
use App\Models\Hojaruta;
use App\Models\Folder;
use Illuminate\Http\Request;
use File;
use DB;
use Storage;
use Session;

class CHojaruta extends Controller
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
            $allfolderbyhojaruta=DB::select('SELECT f.idfolder,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,f.solicitante,f.carnet,hr.nroform,hr.aquien,hr.adonde,hr.motivo
            FROM colcapir_bddsisgamc.folder f 
            INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
            INNER JOIN colcapir_bddsisgamc.hojaruta hr ON hr.idfolder=f.idfolder
            WHERE f.estado=1 AND f.idpersona="'. $sessionidusuario.'" ORDER BY numero ASC');
            return view('Ruat.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybyhojaruta'=>$allfolderbyhojaruta]);
            
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
            $folder->idgestion=$request->get('cbxgestion');
            $folder->idtramite=4;

            $path=($directorio.'/'.$nombrecompleto.'/'.'HOJA DE RUTA'.'/'.$numero);
            if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                    $folder->save();
                    if($nombreoficina=="RUAT")
                        {
                            $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                            $hojaruta=new hojaruta();
                            $hojaruta->idfolder=$maxidfolder[0]->idfolder;
                            $hojaruta->placa=$request->get('txtplacahojaruta');
                            $hojaruta->nroform=$request->get('txtnroform');
                            $hojaruta->motivo=$request->get('txtmotivo');
                            $hojaruta->aquien=$request->get('txtresponsable');
                            $hojaruta->adonde=$request->get('txtunidad');
                            $hojaruta->save();
                            return redirect('/Hojaruta');  
                        }
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
