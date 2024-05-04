<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Storage;
use DB;
use File;
use View;
use Alert;
class CArchivo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sessionidfolder=session('sessionidfolder');
        $allarchivo='SELECT * FROM colcapir_bddsisgamc.archivo a WHERE a.estado=1 AND a.idfolder="'. $sessionidfolder.'" ORDER BY a.nombre ASC';
        $queryarchivo=DB::select($allarchivo);
        return view('Archivo.index',['queryarchivo'=>$queryarchivo]);
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
        $sessionidfolder=session('sessionidfolder');

        $queryoficial=DB::select('SELECT p.idpersona,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,o.idoficina,o.nombre AS oficina
        FROM colcapir_bddsisgamc.persona p 
        INNER JOIN colcapir_bddsisgamc.oficina o ON p.idoficina=o.idoficina 
        WHERE p.estado=1 AND p.idpersona="'.$sessionidusuario.'"');

        $queryfolder=DB::select('SELECT f.idfolder,f.numero AS folder,f.idtramite,t.nombre FROM colcapir_bddsisgamc.folder f
        INNER JOIN colcapir_bddsisgamc.tramite t ON f.idtramite=t.idtramite WHERE f.estado=1 AND f.idfolder="'. $sessionidfolder.'"');
    
        $nombrecompleto=$queryoficial[0]->nombrecompleto;
        $nombreoficina=$queryoficial[0]->oficina;
        $nombrefolder=$queryfolder[0]->folder;
        $nombretramite=$queryfolder[0]->nombre;
        
        $ruta='SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$nombreoficina; 

        if(request()->hasFile('txtfile'))
        { 
            $archivo=new Archivo();
            $file=$request->file('txtfile');
            $nombre=$file->getClientOriginalName();

            $archivo->nombre=  $nombre;
            $archivo->peso= $file->getSize();
            $archivo->tipo= $file->getClientOriginalExtension();
            $archivo->idfolder= $sessionidfolder;

            $nombret=DB::select('SELECT t.nombre AS tramite FROM colcapir_bddsisgamc.tramite t INNER JOIN colcapir_bddsisgamc.oficina o
            ON t.idoficina=o.idoficina WHERE o.nombre="'. $nombreoficina.'"');
            $nombret=$nombret[0]->tramite;

            if($nombretramite==$nombret)
            {
                $file->move($directorio."/".$nombrecompleto."/".$nombret."/".$nombrefolder, $nombre);
                Alert::success('EXITO', 'RESPALDO EXITOSO');
            }
            else
            {
                Alert::error('ERROR', 'ERROR EN EL RESPALDO');
            }
            $archivo->save();
            return redirect('/Archivo');
        }
        else{
            Alert::warning('ADVERTENCIA', 'CARGAR RESPALDO');
        } 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idarchivo)
    {
        $verarchivo=DB::select('SELECT f.idfolder,o.nombre AS oficina,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        f.numero AS folder, f.estado AS folderestado, a.idarchivo AS idarchivo,a.nombre AS nombrearchivo,a.tipo AS tipo,a.estado AS archivoestado 
        FROM colcapir_bddsisgamc.folder f 
        INNER JOIN colcapir_bddsisgamc.archivo a ON f.idfolder=a.idfolder 
        INNER JOIN colcapir_bddsisgamc.persona p ON p.idpersona=f.idpersona
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        WHERE a.idarchivo="'.$idarchivo.'"');
        
        $nombrefolder=$verarchivo[0]->folder;
        $nombrearchivo=$verarchivo[0]->nombrearchivo;
        $tipoarchivo=$verarchivo[0]->tipo;
        $oficina=$verarchivo[0]->oficina;
        $usuario=$verarchivo[0]->nombrecompleto;

        $ruta='SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$oficina; 

        $visualizar=$directorio.'/'.$usuario.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistaduplicado=$directorio.'/'.$usuario.'/'.'DUPLICADO DE PLACA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistapreescripcion=$directorio.'/'.$usuario.'/'.'PREESCRIPCION'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistabaja=$directorio.'/'.$usuario.'/'.'BAJA DEFINITIVA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistahojaruta=$directorio.'/'.$usuario.'/'.'HOJA DE RUTA'.'/'.$nombrefolder.'/'.$nombrearchivo;

        if (file_exists($visualizar)){
            File::delete($visualizar);
            $archivo=Archivo::FindOrFail($idarchivo);
            $archivo->estado=0;
            $archivo->update();
            return redirect('/Archivo');
        }
        else if (file_exists($vistaduplicado)){
            File::delete($vistaduplicado);
            $archivo=Archivo::FindOrFail($idarchivo);
            $archivo->estado=0;
            $archivo->update();
            return redirect('/Archivo');
        }
        else if (file_exists($vistapreescripcion)){
            File::delete($vistapreescripcion);
            $archivo=Archivo::FindOrFail($idarchivo);
            $archivo->estado=0;
            $archivo->update();
            return redirect('/Archivo');
        }
        else if (file_exists($vistabaja)){
            File::delete($vistabaja);
            $archivo=Archivo::FindOrFail($idarchivo);
            $archivo->estado=0;
            $archivo->update();
            return redirect('/Archivo');
        }
        else if (file_exists($vistahojaruta)){
            File::delete($vistahojaruta);
            $archivo=Archivo::FindOrFail($idarchivo);
            $archivo->estado=0;
            $archivo->update();
            return redirect('/Archivo');
        }
        else
        {
           echo 'NO EXISTE';
        }

    }
    public function ver($idarchivo)
    {
        $verarchivo=DB::select('SELECT f.idfolder,o.nombre AS oficina,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        f.numero AS folder, f.estado AS folderestado, a.idarchivo AS idarchivo,a.nombre AS nombrearchivo,a.tipo AS tipo,a.estado AS archivoestado, t.nombre AS tramite
        FROM colcapir_bddsisgamc.folder f 
        INNER JOIN colcapir_bddsisgamc.archivo a ON f.idfolder=a.idfolder 
        INNER JOIN colcapir_bddsisgamc.persona p ON p.idpersona=f.idpersona
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE a.idarchivo="'.$idarchivo.'"');
    

        $nombrefolder=$verarchivo[0]->folder;
        $nombretramite=$verarchivo[0]->tramite;
        $nombrearchivo=$verarchivo[0]->nombrearchivo;
        $tipoarchivo=$verarchivo[0]->tipo;
        $oficina=$verarchivo[0]->oficina;
        $usuario=$verarchivo[0]->nombrecompleto;

        $ruta='SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$oficina;
        $vistaduplicado=$directorio.'/'.$usuario.'/'.'DUPLICADO DE PLACA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistapreescripcion=$directorio.'/'.$usuario.'/'.'PREESCRIPCION'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistabaja=$directorio.'/'.$usuario.'/'.'BAJA DEFINITIVA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistahojaruta=$directorio.'/'.$usuario.'/'.'HOJA DE RUTA'.'/'.$nombrefolder.'/'.$nombrearchivo;

        $visualizar=$directorio.'/'.$usuario.'/'.$nombrefolder.'/'.$nombrearchivo;

        if($nombretramite=="DUPLICADO DE PLACA")
        {
            if (file_exists($vistaduplicado)){
                return response()->file($vistaduplicado);
           }
           
        }
        else if($nombretramite=="PREESCRIPCION")
        {
            if (file_exists($vistapreescripcion)){
                return response()->file($vistapreescripcion);
           }
           else
           {
               echo 'NO EXISTE';
           }
        }
        else if($nombretramite=="HOJA DE RUTA")
        {
            if (file_exists($vistahojaruta)){
                return response()->file($vistahojaruta);
           }
           else
           {
               echo 'NO EXISTE';
           }
        }
        else if($nombretramite=="BAJA DEFINITIVA")
        {
            if (file_exists($vistabaja)){
                return response()->file($vistabaja);
           }
           else
           {
               echo 'NO EXISTE';
           }
        }
        else
        {
            if (file_exists($visualizar)){
                return response()->file($visualizar);
            }
            else
            {
                echo 'NO EXISTE';
            }
        }
        //return Response::view($visualizar)->header('Content-Type', $type);
        
       // return Response::make($visualizar);
        //return Response::view($visualizar)->header('Content-Type', $type);
       
    }
    public function download($idarchivo)
    {
        $verarchivo=DB::select('SELECT f.idfolder,o.nombre AS oficina,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        f.numero AS folder, f.estado AS folderestado, a.idarchivo AS idarchivo,a.nombre AS nombrearchivo,a.tipo AS tipo,a.estado AS archivoestado,t.nombre AS tramite
        FROM colcapir_bddsisgamc.folder f 
        INNER JOIN colcapir_bddsisgamc.archivo a ON f.idfolder=a.idfolder 
        INNER JOIN colcapir_bddsisgamc.persona p ON p.idpersona=f.idpersona
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE a.idarchivo="'.$idarchivo.'"');
    

        $nombrefolder=$verarchivo[0]->folder;
        $nombrearchivo=$verarchivo[0]->nombrearchivo;
        $tipoarchivo=$verarchivo[0]->tipo;
        $oficina=$verarchivo[0]->oficina;
        $usuario=$verarchivo[0]->nombrecompleto;
        $nombretramite=$verarchivo[0]->tramite;

        $ruta='SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta.$oficina;

        $vistaduplicado=$directorio.'/'.$usuario.'/'.'DUPLICADO DE PLACA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistapreescripcion=$directorio.'/'.$usuario.'/'.'PREESCRIPCION'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistabaja=$directorio.'/'.$usuario.'/'.'BAJA DEFINITIVA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $vistahojaruta=$directorio.'/'.$usuario.'/'.'HOJA DE RUTA'.'/'.$nombrefolder.'/'.$nombrearchivo;
        $visualizar=$directorio.'/'.$usuario.'/'.$nombrefolder.'/'.$nombrearchivo;
        //echo $visualizar;
       
       
        if ($tipoarchivo=='pdf') {
            $headers = ['Content-Type: application/pdf'];
            $fileName = $nombrearchivo.'.pdf';
        }
        if ($tipoarchivo=='docx') {
            $headers = ['Content-Type: application/octet-stream'];
            $fileName = $nombrearchivo.'.docx';
        }
        if($nombretramite=="DUPLICADO DE PLACA")
        {
            return response()->download($vistaduplicado, $fileName, $headers);
        }
        else if($nombretramite=="PREESCRIPCION")
        {
            return response()->download($vistapreescripcion, $fileName, $headers);
        }
        else if($nombretramite=="BAJA DEFINITIVA")
        {
            return response()->download($vistabaja, $fileName, $headers);
        }
        else if($nombretramite=="HOJA DE RUTA")
        {
            return response()->download($vistahojaruta, $fileName, $headers);
        }
        else
        {
        return response()->download($visualizar, $fileName, $headers);
        }
    }

   /*  public function view($idarchivo,Request $request)
    {
        $idfolder=$request->get('txtidfolder');

        $ruta="SELECT ruta FROM colcapir_bddsisgamc.config";
        $queryruta=DB::select($ruta);
        $directorio=$queryruta[0]->ruta; 

        $filePath = $directorio."/".('PRUEBA')."/".('vero.pdf');
      
  
    } */

    
}
