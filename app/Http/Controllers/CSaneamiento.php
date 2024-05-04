<?php

namespace App\Http\Controllers;

use App\Models\Saneamiento;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use DB;
use Storage;
use Session;
use Alert;
class CSaneamiento extends Controller
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

        $alltramite='SELECT t.idtramite,t.nombre FROM colcapir_bddsisgamc.tramite t 
        INNER JOIN colcapir_bddsisgamc.oficina o ON t.idoficina=o.idoficina
        WHERE t.estado=1 AND o.nombre="'.$nombreoficina.'" ORDER BY t.nombre DESC';
        $querytramite=DB::select($alltramite);

        $allestante=DB::select('SELECT e.idestante,CONCAT(e.nombre," - ",e.fila," DE ",o.nombre) AS estante,e.estado
        FROM colcapir_bddsisgamc.estante e
        INNER JOIN colcapir_bddsisgamc.oficina o
        WHERE o.estado=1 AND o.nombre="'.$nombreoficina.'" AND e.estado=1 ORDER BY o.nombre DESC');

        if($nombreoficina=="SANEAMIENTO BASICO")
        {
            $allfolderbysaneamiento=DB::select('SELECT f.idfolder,f.codigo,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,f.solicitante,f.carnet,
            san.fecharecepcion,san.otb,san.supervisor AS supervisor,san.procedencia,CONCAT(est.nombre," ",est.fila) AS estante
            FROM colcapir_bddsisgamc.folder f 
            INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
            INNER JOIN colcapir_bddsisgamc.saneamiento san ON san.idfolder=f.idfolder
            INNER JOIN colcapir_bddsisgamc.estante est ON f.idestante=est.idestante
            WHERE f.estado=1 AND f.idpersona="'. $sessionidusuario.'" ORDER BY numero ASC');
            return view('Saneamiento.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybysaneamiento'=>$allfolderbysaneamiento,'querybyestante'=> $allestante]);
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
        FROM colcapir_bddsisgamc.persona p INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'"');
    
        $nombrecompleto=$queryoficial[0]->nombrecompleto;
        $nombreoficina=$queryoficial[0]->oficina;

        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$nombreoficina;
        
        if(File::isDirectory($directorio))
        {
                $folder=new Folder();
                $folder->idpersona=$sessionidusuario;
                $folder->codigo=strtoupper(Str::random(5));
                $numero=$request->get('txtnumero');
                $folder->numero=$numero;
                $folder->nrohoja=$request->get('txthoja');
                $folder->idestante=$request->get('cbxestante');
                $folder->fechainicio=$request->get('txtinicio');
                $folder->fechafin=$request->get('txtfin');
                $folder->solicitante=$request->get('txtsolicitante');
                $folder->carnet=$request->get('txtcarnet');
                $folder->idtramite=$request->get('cbxtramite');
                $nombret=DB::select('SELECT nombre AS nombretramite FROM colcapir_bddsisgamc.tramite WHERE idtramite=?',[$request->get('cbxtramite')]);
                $nombre=$nombret[0]->nombretramite;
                $path=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$numero);
                if(!File::isDirectory($path))
                    {
                        File::makeDirectory($path, 0777, true, true);
                        $folder->save();
                       
                        $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                        $san=new saneamiento();
                        $san->idfolder=$maxidfolder[0]->idfolder;
                        $san->fecharecepcion=$request->get('txtfecharecepcion');
                        $san->solicitud=$request->get('cbxtramite');
                        $san->otb=$request->get('txtotb');
                        $san->procedencia=$request->get('cbxprocedencia');
                        $san->supervisor=$request->get('txtresponsable');
                        $san->save();
                        Alert::success('EXITO', 'REGISTRO EXITOSO');
                        return redirect('/Saneamiento');
                            
                    }
                    else
                    {
                        Alert::info('DUPLICADO', 'EL VALOR REGISTRADO YA EXISTE');
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
     * @param  \App\Models\Saneamiento  $saneamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Saneamiento $saneamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saneamiento  $saneamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Saneamiento $saneamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saneamiento  $saneamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saneamiento $saneamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saneamiento  $saneamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saneamiento $saneamiento)
    {
        //
    }
}
