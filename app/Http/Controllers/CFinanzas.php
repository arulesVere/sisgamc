<?php

namespace App\Http\Controllers;

use App\Models\Finanzas;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use DB;
use Storage;
use Session;
use Alert;
use Carbon\Carbon;

class CFinanzas extends Controller
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

        $allestante=DB::select('SELECT e.idestante,CONCAT(e.nombre," - ",e.fila," - PASILLO ",e.pasillo," DE ",o.nombre) AS estante,e.estado
        FROM colcapir_bddsisgamc.estante e
        INNER JOIN colcapir_bddsisgamc.oficina o ON e.idoficina=o.idoficina
        WHERE o.estado=1 AND o.nombre="'.$nombreoficina.'" AND e.estado=1 ORDER BY o.nombre DESC');

        $allfolderbyfinanzas=DB::select('SELECT f.idfolder,f.codigo,f.numero,f.idpersona,t.nombre AS tramite,f.estado,f.fechainicio,f.fechafin,f.nrohoja,fi.nrocomprobante,
        CONCAT(est.nombre," - ",est.fila," - PASILLO ",est.pasillo) AS estante
        FROM colcapir_bddsisgamc.folder f 
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        INNER JOIN colcapir_bddsisgamc.finanzas fi ON fi.idfolder=f.idfolder
        INNER JOIN colcapir_bddsisgamc.estante est ON f.idestante=est.idestante
        WHERE f.estado=1 AND f.idpersona="'. $sessionidusuario.'" ORDER BY numero ASC');

        return view('Finanzas.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'querybyfinanzas'=>$allfolderbyfinanzas,'querybyestante'=> $allestante]);
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
        
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
       
        if(File::isDirectory($directorio))
        {
            $folder=new Folder();
            $folder->idpersona=$sessionidusuario;
            $numero=$request->get('txtnumero');
            $folder->codigo=Str::random(5);
            $folder->numero=$numero;
            $folder->nrohoja=$request->get('txthoja');
            $folder->fechainicio=$request->get('txtinicio');
            $folder->fechafin='1000-01-01';
            
            $fecha = Carbon::parse($request->get('txtinicio'));
            $mes = $meses[($fecha->format('n')) - 1];
            //$dato= $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
            $mesliteral= $mes;
            $a単o=$fecha->format('Y');
            
            $folder->solicitante="SIN SOLICITANTE";
            $folder->carnet="SIN C.I.";
            $folder->idtramite=$request->get('cbxtramite');
            $folder->idestante=$request->get('cbxestante');

            $nombret=DB::select('SELECT nombre AS nombretramite FROM colcapir_bddsisgamc.tramite WHERE idtramite=?',[$request->get('cbxtramite')]);
            $nombre=$nombret[0]->nombretramite;
            $path=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$a単o.'/'.$mes.'/'.$numero);
            if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                            $folder->save();
                            $maxidfolder=DB::select('SELECT MAX(f.idfolder) AS idfolder FROM colcapir_bddsisgamc.folder f WHERE f.estado=1');
                            $finanzas=new Finanzas();
                            $finanzas->idfolder=$maxidfolder[0]->idfolder;
                            $finanzas->nrocomprobante=$request->get('txtcomprobante');
                            $finanzas->save();
                            Alert::success('EXITO', 'REGISTRO EXITOSO');
                            return redirect('/Finanzas');  
                        
                }
                else
                {
                    Alert::info('DUPLICADO', 'EL VALOR REGISTRADO YA EXISTE');
                    return redirect('/Finanzas');  
                }
        }
        else
        {
            Alert::error('NO EXISTE');
            return redirect('/Finanzas'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finanzas  $finanzas
     * @return \Illuminate\Http\Response
     */
    public function show(Finanzas $finanzas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finanzas  $finanzas
     * @return \Illuminate\Http\Response
     */
    public function edit($idfolder)
    {
        $nombreoficina=session('sessionoficina');
        $queryfolder=Folder::findOrFail($idfolder); 
        $queryfinanzas=Finanzas::findOrFail($idfolder);
        
        $alltramite='SELECT t.idtramite,t.nombre FROM colcapir_bddsisgamc.tramite t 
        INNER JOIN colcapir_bddsisgamc.oficina o ON t.idoficina=o.idoficina
        WHERE t.estado=1 AND o.nombre="'.$nombreoficina.'" ORDER BY t.nombre DESC';
        $querytramite=DB::select($alltramite);
        
        $queryestante=DB::select('SELECT e.idestante,CONCAT(e.nombre," - ",e.fila," DE ",o.nombre) AS estante,e.estado
        FROM colcapir_bddsisgamc.estante e
        INNER JOIN colcapir_bddsisgamc.oficina o ON e.idoficina=o.idoficina
        WHERE o.estado=1 AND o.nombre="'.$nombreoficina.'" AND e.estado=1 ORDER BY o.nombre DESC');
        
        return view('Finanzas.edit', ['fol'=>$queryfolder,'fin'=>$queryfinanzas,'tram'=>$querytramite,'est'=>$queryestante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finanzas  $finanzas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$idfinanzas)
    {
        
        $sessionidusuario=session('sessionidusuario');
        $queryoficial=DB::select('SELECT p.idpersona,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,o.nombre AS oficina
        FROM colcapir_bddsisgamc.persona p INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'"');
    
        $nombrecompleto=$queryoficial[0]->nombrecompleto;
        $nombreoficina=$queryoficial[0]->oficina;

        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        
        $nombret=DB::select('SELECT nombre AS nombretramite FROM colcapir_bddsisgamc.tramite WHERE idtramite=?',[$request->get('cbxtramite')]);
        $nombre=$nombret[0]->nombretramite;
         
      
        $mesesAntiguo = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");   
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");   
    
        $directorio=$queryruta[0]->ruta.$nombreoficina;
        
        $fol=Folder::findOrFail($idfinanzas);
        $numeroAntiguo=$fol->numero;
        $cantHojasAntiguo=$fol->nrohoja;
        $estAntiguo=$fol->idestante;
        
       
        $antiguaFecha=Carbon::parse($fol->fechainicio);
        $antMes = $mesesAntiguo[($antiguaFecha->format('n')) - 1];
        $antMesLiteral= $antMes;
        $antAno=$antiguaFecha->format('Y');
               
        $cantHojasNuevo=$request->get('txtnrohoja');
        $estNuevo=$request->get('cbxestante');
        
        $path=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$antMes.'/'.$numeroAntiguo);
        
        //print_r($path);
        if(file_exists($path))
        {
            
               $numeroNuevo=$request->get('txtnumero');
               
               $nuevaFecha=Carbon::parse($request->get('txtfechainicio'));
               $nueMes = $meses[($nuevaFecha->format('n')) - 1];
               $nuevoMesLiteral= $nueMes;
               $nueAno=$nuevaFecha->format('Y');
               
               $antiguaFecha=Carbon::parse($fol->fechainicio);
               $antMes = $mesesAntiguo[($antiguaFecha->format('n')) - 1];
               $antMesLiteral= $antMes;
               $antAno=$antiguaFecha->format('Y');
               
               $antiguoMes=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$antMes);
               $nuevoMes=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$nueMes);
              
               $antiguoAno=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno);
               $nuevoAno=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$nueAno); 
              
               if($numeroNuevo!=$numeroAntiguo)
               {
                    $antiguo=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$antMes.'/'.$numeroAntiguo);
                    $nuevo=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$antMes.'/'.$numeroNuevo);
                    rename($antiguo,$nuevo);
                    $fol->numero=$numeroNuevo;
                    $fol->update();
                    Alert::success('EXITO', 'REGISTRO ACTUALIZADO');
                    return redirect('/Finanzas');
               }
               if($antAno!=$nueAno)
               {
                    rename($antiguoAno,$nuevoAno);
                    $fol->numero=$numeroNuevo;
                    $fol->fechainicio=$request->get('txtfechainicio');
                    $fol->update();
                    Alert::success('EXITO', 'REGISTRO ACTUALIZADO');
                    return redirect('/Finanzas');
               }
               else
               {
                    print_r("error");
               }
              /* $queryfinanzas=Finanzas::findOrFail($fol->idfolder);
               $queryfinanzas->nrocomprobante=$request->get('txtnrocomprobante');
               $queryfinanzas->update();
               Alert::success('EXITO', 'REGISTRO ACTUALIZADO');
               return redirect('/Finanzas');*/
          
        }
       /* if(File::isDirectory($path))
        {
               $numeroNuevo=$request->get('txtnumero');
               
               $nuevaFecha=Carbon::parse($request->get('txtfechainicio'));
               $nueMes = $meses[($nuevaFecha->format('n')) - 1];
               $nuevoMesLiteral= $nueMes;
               $nueAno=$nuevaFecha->format('Y');
               
               $antiguaFecha=Carbon::parse($fol->fechainicio);
               $antMes = $mesesAntiguo[($antiguaFecha->format('n')) - 1];
               $antMesLiteral= $antMes;
               $antAno=$antiguaFecha->format('Y');
               
               $antiguoMes=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$antMes);
               $nuevoMes=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno.'/'.$nueMes);
              
               $antiguoAno=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$antAno);
               $nuevoAno=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$nueAno); 
               
               if($numeroNuevo!=$numeroAntiguo)
               {
                    $antiguo=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$a単o.'/'.$mes.'/'.$numeroAntiguo);
                    $nuevo=($directorio.'/'.$nombrecompleto.'/'.$nombre.'/'.$a単o.'/'.$mes.'/'.$numeroNuevo);
                    rename($antiguo,$nuevo);
                    $fol->numero=$numeroNuevo;
                    $fol->update();
               }
                if($antMes!=$nueMes)
               {
                    rename($antiguoMes,$nuevoMes);
                    $fol->numero=$numeroNuevo;
                    $fol->fechainicio=$request->get('txtfechainicio');
                    $fol->update();
               }
               if($antAno!=$nueAno)
               {
                    rename($antiguoAno,$nuevoAno);
                    $fol->numero=$numeroNuevo;
                    $fol->fechainicio=$request->get('txtfechainicio');
                    $fol->update();
               }
                if($cantHojasAntiguo!=$cantHojasNuevo)
               {
                   
                    $fol->nrohoja=$cantHojasNuevo;
                    $fol->update();
               }
               if($estAntiguo!=$estNuevo)
               {
                   
                    $fol->idestante=$estNuevo;
                    $fol->update();
               }
               $queryfinanzas=Finanzas::findOrFail($fol->idfolder);
               $queryfinanzas->nrocomprobante=$request->get('txtnrocomprobante');
               $queryfinanzas->update();
               Alert::success('EXITO', 'REGISTRO ACTUALIZADO');
               return redirect('/Finanzas');
          
       }
       else
        {
               Alert::error('NO EXISTE');
        }
            
     return redirect('/Finanzas');  */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finanzas  $finanzas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finanzas $finanzas)
    {
        //
    }
}
