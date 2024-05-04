<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Categorizacion;
use App\Models\BajaDefinitiva;
use App\Models\Preescripcion;
use App\Models\Duplicado;
use App\Models\Hojaruta;
use Illuminate\Http\Request;
use File;
use DB;
use Storage;
use Session;
class CFolder extends Controller
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
       
            if($querytramite[0]->idtramite==1) {
                $allfolderbypreescripcion=DB::select('SELECT f.idfolder,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,f.solicitante,f.carnet,
                pre.placa,pre.nrotramite,pre.nroregistro
                FROM colcapir_bddsisgamc.folder f 
                INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
                INNER JOIN colcapir_bddsisgamc.preescripcion pre ON pre.idfolder=f.idfolder
                WHERE f.estado=1 AND f.idpersona=1 ORDER BY numero ASC');
                return view('Folder.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybypreescripcion'=>$allfolderbypreescripcion]);
            }
            if($querytramite[0]->idtramite==2) {
                $allfolderbybaja=DB::select('SELECT f.idfolder,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,f.solicitante,f.carnet,
                bd.placa,bd.razon,bd.hr,bd.tramitador
                FROM colcapir_bddsisgamc.folder f 
                INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
                INNER JOIN colcapir_bddsisgamc.bajadefinitiva bd ON bd.idfolder=f.idfolder
                WHERE f.estado=1 AND f.idpersona="'. $sessionidusuario.'" ORDER BY numero ASC');
                return view('Folder.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybybaja'=>$allfolderbybaja]);
            }
           
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
    function genera_codigo ($longitud) 
    {
        $caracteres = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $codigo = '';
    
        for ($i = 1; $i <= $longitud; $i++) {
            $codigo .= $caracteres[numero_aleatorio(0, 35)];
        }
    
        return $codigo;
    }
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
                $folder->codigo=genera_codigo(5);
                $numero=$request->get('txtnumero');
                $folder->numero=$numero;
                $folder->nrohoja=$request->get('txthoja');

                $folder->fechainicio=$request->get('txtinicio');
                $folder->fechafin=$request->get('txtfin');
                $folder->solicitante=$request->get('txtsolicitante');
                $folder->carnet=$request->get('txtcarnet');
                $folder->idtramite=$request->get('cbxtramite');


                $path=($directorio.'/'.$nombrecompleto.'/'.$numero);
                if(!File::isDirectory($path))
                    {
                        File::makeDirectory($path, 0777, true, true);
                        $folder->save();
                        if($nombreoficina=="RUAT")
                            {
                                if($folder->idtramite==1)
                                {
                                $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                                $prees=new preescripcion();
                                $prees->idfolder=$maxidfolder[0]->idfolder;
                                $prees->placa=$request->get('txtplacapreescripcion');
                                $prees->nrotramite=$request->get('txtnumtramite');
                                $prees->nroregistro=$request->get('txtnumtecnico');
                                $prees->save();
                                return redirect('/Folder');
                                }
                                if($folder->idtramite==2)
                                {
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
                                return redirect('/Folder');
                               /*  print_r($bajadef); */
                                }
                                if($folder->idtramite==3)
                                {
                                $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                                $dupli=new duplicado();
                                $dupli->idfolder=$maxidfolder[0]->idfolder;
                                $dupli->placa=$request->get('txtplacaduplicado');
                                $dupli->vehiculo=$request->get('cbxvehiculo');
                                $dupli->tipoplaqueta=$request->get('cbxplaqueta');
                                $dupli->plaqueta=$request->get('txtplaqueta');
                                $dupli->save();
                                return redirect('/Duplicado');
                               /*  print_r($bajadef); */
                                }
                                if($folder->idtramite==4)
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
                                return redirect('/Ruat');
                               /*  print_r($bajadef); */
                                }
                            }
                     
                              //  return redirect('/Folder');
                    }
                    else{
                        echo('FOLDER EXISTENTE');
                    }
        }
        else{
            echo('no existe');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit($idfolder)
    {
        $folder=Folder::findOrFail($idfolder); 
        $ruat=Categorizacion::findOrFail($idfolder); 


        $alltramite='SELECT * FROM colcapir_bddsisgamc.tramite t WHERE t.estado=1 ORDER BY t.nombre DESC';
        $querytramite=DB::select($alltramite);

        return view('Folder.edit', ['fol' => $folder,'ruat'=>$ruat,'tramite'=>$querytramite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idfolder)
    {
        $sessionidusuario=session('sessionidusuario');
    
        $queryoficial=DB::select('SELECT p.idpersona,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,o.nombre AS oficina
        FROM colcapir_bddsisgamc.persona p INNER JOIN bddsisgamc.oficina o ON p.idoficina=o.idoficina WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'"');
    
        $nombrecompleto=$queryoficial[0]->nombrecompleto;
        $nombreoficina=$queryoficial[0]->oficina;

        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$nombreoficina;

        $folder=Folder::findOrFail($idfolder);

      /*   echo $folder; */
        $nombreantiguo=$folder->nombre;
        if(File::isDirectory($directorio.'/'.$nombrecompleto.'/'.$folder->nombre))
        {
            $folder->numero=$request->get('txtnumero');
            $nombre=$request->get('txtfolder');
            $folder->nombre=$nombre;
            rename($directorio.'/'.$nombrecompleto.'/'.$nombreantiguo,$directorio.'/'.$nombrecompleto.'/'.$nombre);
        
            $folder->fechafin=$request->get('txtfin');
            $folder->nrohoja=$request->get('txtnrohoja');
            $folder->idtramite=$request->get('cbxtramite');
            //echo  $folder;
            $folder->update();
          
            if($nombreoficina=="RUAT")
            {

                $ruat=Categorizacion::findOrFail($folder->idfolder);
                $ruat->nrocertificacion=$request->get('txtcertificacion');
                $ruat->nroplaca=$request->get('txtplaca');
                $ruat->nroplaqueta=$request->get('cbxplaqueta');
                $ruat->tramitador=$request->get('txttramitador');
                $ruat->carnet=$request->get('txtcarnet');
                $ruat->update();
                return redirect('/Folder');
                
            }
        }
        else{
            echo 'NO EXISTE FOLDER';
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($idfolder)
    {
       
        $fol=Folder::FindOrFail($idfolder);
        $fol->estado=0;
        $fol->update();
        return redirect('/Folder');

    }

    public function cancel($idfolder)
    {
        
        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta;

        $fol=Folder::FindOrFail($idfolder);

       /*  echo $fol->idfolder;
        echo $fol->nombre; */

        if(File::isDirectory($directorio.$fol->nombre))
        {
            File::deleteDirectory($directorio.$fol->nombre);
            $fol->delete();
            return redirect('/Folder');
        }
       
    }

    public function listfile($idfolder)
    {
        $allarchivo=DB::select('SELECT * FROM colcapir_bddsisgamc.archivo WHERE estado=1 AND idfolder="'.$idfolder.'" ORDER BY nombre ASC');
        if(count($allarchivo)>=0)
        {
           
         Session::put('sessionidfolder',$idfolder);

        return view('Archivo.index',['queryarchivo'=>$allarchivo,'idfolder'=>$idfolder]); 
        }
        else
        {
            echo('No hay datos');
        }
    }
}
