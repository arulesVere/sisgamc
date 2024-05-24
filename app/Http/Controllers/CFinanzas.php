<?php

namespace App\Http\Controllers;

use App\Models\Finanzas;
use App\Models\Empastado;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use DB;
use Storage;
use Session;
use Alert;
use Carbon\Carbon;
use Google\Service\Drive;
use Google\Client;

class CFinanzas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFolderId($folderName, $folderId, $driveService)
    {
        try {
            $pageToken = null;

            $query = "parents in '" . $folderId . "' and mimeType='application/vnd.google-apps.folder'";
            $response = $driveService->files->listFiles(
                array(
                    'q' => $query,
                    'spaces' => 'drive',
                    'pageToken' => $pageToken,
                    'fields' => 'nextPageToken, files(id, name)',
                )
            );
            foreach ($response->files as $file) {
                if ($file->name == $folderName) {
                    return $file->id;
                }
            }

            $fileMetadata = new Drive\DriveFile(
                array(
                    'parents' => array($folderId),
                    'name' => $folderName,
                    'mimeType' => 'application/vnd.google-apps.folder'
                )
            );
            $file = $driveService->files->create(
                $fileMetadata,
                array(
                    'fields' => 'id'
                )
            );


            return $file->id;

        } catch (Exception $e) {
            echo "Error Message: " . $e;
        }
    }

    private function getTomoFolderId(Request $request)
    {

        $accessToken = session('googletoken');

        $client = new Client();
        $client->addScope(Drive::DRIVE);
        $client->setAccessToken($accessToken);
        $driveService = new Drive($client);

        $main_folder_id = \Config('services.google.folder_id');
        $oficina = session('sessionoficina');
        $oficina_folder_id = $this->getFolderId($oficina, $main_folder_id, $driveService);

        $tipo_tramite_folder = $request->get('cbxtramite');
        $nombret = DB::table('tramite')
            ->select('tramite.nombre as nombre')
            ->where('tramite.idtramite', '=', [$request->get('cbxtramite')])
            ->where('tramite.estado', '=', 1)
            ->get();
        $nombre = $nombret[0]->nombre;

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $fecha = Carbon::parse($request->get('txtgestion'));
        $mes = $meses[($fecha->format('n')) - 1];

        $tipo_tramite_folder_id = $this->getFolderId($nombre, $oficina_folder_id, $driveService);

        $time_input = strtotime($request->get('txtgestion'));
        $gestion_folder = date('Y', $time_input);
        $gestion_folder_id = $this->getFolderId($gestion_folder, $tipo_tramite_folder_id, $driveService);

        $mes_folder = date('m', $time_input);

        //$mes_folder_id = $this->getFolderId($mes_folder, $gestion_folder_id, $driveService);
        
        $mes_folder_id = $this->getFolderId($mes, $gestion_folder_id, $driveService);

        $tomo_folder = $request->get('txtnumero');
        return $this->getFolderId($tomo_folder, $mes_folder_id, $driveService);
    }
    public function index()
    {
        $sessionidusuario=session('sessionidusuario');
        $nombreoficina=session('sessionoficina');

        $allfinanzas = DB::table('empastado')
        ->join('finanzas', 'empastado.idempastado', '=', 'finanzas.idempastado')
        ->join('tramite', 'empastado.idtramite', '=', 'tramite.idtramite')
        ->join('estante', 'empastado.idestante', '=', 'estante.idestante')
        ->join('pasillo', 'empastado.idpasillo', '=', 'pasillo.idpasillo')
        ->select('empastado.*')
        ->where('empastado.estado', '=', 1)
        ->get()
        ->all();
        //dd($allfinanzas);
       return view('Finanzas.index', ['querybyfinanzas'=>$allfinanzas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nombreoficina=session('sessionoficina');
        $alltramite = DB::SELECT('SELECT t.idtramite,t.nombre AS nombre FROM colcapir_bddsisgamc.tramite t INNER JOIN colcapir_bddsisgamc.oficina o 
        ON t.idoficina=o.idoficina WHERE t.estado=1 AND o.nombre="'.$nombreoficina.'"');
        $allpasillo = DB::SELECT('SELECT p.idpasillo,p.pasillo AS pasillo FROM colcapir_bddsisgamc.pasillo p INNER JOIN colcapir_bddsisgamc.oficina o 
        ON p.idoficina=o.idoficina WHERE p.estado=1 AND o.nombre="'.$nombreoficina.'"');
        $allestante = DB::SELECT('SELECT e.idestante,e.nombre FROM colcapir_bddsisgamc.estante e INNER JOIN colcapir_bddsisgamc.oficina o 
        ON e.idoficina=o.idoficina WHERE e.estado=1 AND o.nombre="'.$nombreoficina.'"');
        return view('Finanzas.create', ['qtramite' => $alltramite, 'qpasillo' => $allpasillo, 'qestante' => $allestante]);
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
          $tomo_folder_id = $this->getTomoFolderId($request);
          $empastado = new Empastado();
          $empastado->codigo = Str::random(5);
          $empastado->numero = $request->get('txtnumero');
          $empastado->fecha = $request->get('txtgestion');
          $empastado->idpersona = $sessionidusuario;
          $empastado->idtramite = $request->get('cbxtramite');
          $empastado->idestante = $request->get('cbxestante');
          $empastado->idpasillo = $request->get('cbxpasillo');
          $empastado->google_folder_id = $tomo_folder_id;
          $empastado->save();
                         
          $maxidfolder=DB::select('SELECT MAX(e.idempastado) AS idempastado FROM colcapir_bddsisgamc.empastado e WHERE e.estado=1');
          $finanzas=new Finanzas();
          $finanzas->idempastado=$maxidfolder[0]->idempastado;
          $finanzas->nrocomprobante=$request->get('txtcomprobantes');
          $finanzas->save();
          Alert::success('EXITO', 'REGISTRO EXITOSO');
          return redirect('/Finanzas');  
                        
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
