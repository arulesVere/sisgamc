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
use Illuminate\Support\Facades\Http;

use Google\Client;
use Google\Service\Drive;

class CArchivo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $google_folder_id = request()->query('google_folder_id');
        $this->google_folder_id = $google_folder_id;
        $allarchivo = DB::table('archivo')
            ->where('estado', '=', 1)
            ->where('google_folder_id', '=', $google_folder_id)
            ->orderBy('nombre', 'asc')
            ->get();
        return view('Archivo.index', ['queryarchivo' => $allarchivo, 'google_folder_id' => $google_folder_id]);
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
        $accessToken = session('googletoken');
        $client = new Client();
        $client->addScope(Drive::DRIVE);
        $client->setAccessToken($accessToken);
        $driveService = new Drive($client);
        $google_folder_id = $request->get('google_folder_id');

        $file = $request->file('txtfile');

        $name = $file->getClientOriginalName();
        $mime = $file->getClientMimeType();
        $fileMetadata = new Drive\DriveFile(
            array(
                'name' => $name,
                'parents' => array($google_folder_id)
            )
        );

        $path = $file->getRealPath();

        $content = file_get_contents($path);
        $google_file = $driveService->files->create(
            $fileMetadata,
            array(
                'data' => $content,
                'mimeType' => $mime,
                'uploadType' => 'multipart',
                'fields' => 'id'
            )
        );

        $archivo=new Archivo();
        $archivo->nombre=  $name;
        $archivo->peso= $file->getSize();
        $archivo->tipo= $mime;
        $archivo->google_folder_id= $google_folder_id;
        $archivo->google_file_id= $google_file->id;
        $archivo->save();

        return redirect('/Archivo?google_folder_id=' . $google_folder_id);
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
        $archivo = Archivo::find($idarchivo);
        $google_file_id = $archivo->google_file_id;
        $google_folder_id = $archivo->google_folder_id;
        $archivo->delete();

        $accessToken = session('googletoken');
        $client = new Client();
        $client->addScope(Drive::DRIVE);
        $client->setAccessToken($accessToken);
        $driveService = new Drive($client);
        $driveService->files->delete($google_file_id);
        return redirect('/Archivo?google_folder_id=' . $google_folder_id);

    }
    public function ver($idarchivo)
    {
        $verarchivo = DB::select('SELECT f.idfolder,o.nombre AS oficina,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        f.numero AS folder, f.estado AS folderestado, a.idarchivo AS idarchivo,a.nombre AS nombrearchivo,a.tipo AS tipo,a.estado AS archivoestado, t.nombre AS tramite
        FROM colcapir_bddsisgamc.folder f
        INNER JOIN colcapir_bddsisgamc.archivo a ON f.idfolder=a.idfolder
        INNER JOIN colcapir_bddsisgamc.persona p ON p.idpersona=f.idpersona
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE a.idarchivo="' . $idarchivo . '"');


        $nombrefolder = $verarchivo[0]->folder;
        $nombretramite = $verarchivo[0]->tramite;
        $nombrearchivo = $verarchivo[0]->nombrearchivo;
        $tipoarchivo = $verarchivo[0]->tipo;
        $oficina = $verarchivo[0]->oficina;
        $usuario = $verarchivo[0]->nombrecompleto;

        $ruta = 'SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta = DB::select($ruta);
        $directorio = $queryruta[0]->ruta . $oficina;
        $vistaduplicado = $directorio . '/' . $usuario . '/' . 'DUPLICADO DE PLACA' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistapreescripcion = $directorio . '/' . $usuario . '/' . 'PREESCRIPCION' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistabaja = $directorio . '/' . $usuario . '/' . 'BAJA DEFINITIVA' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistahojaruta = $directorio . '/' . $usuario . '/' . 'HOJA DE RUTA' . '/' . $nombrefolder . '/' . $nombrearchivo;

        $visualizar = $directorio . '/' . $usuario . '/' . $nombrefolder . '/' . $nombrearchivo;

        if ($nombretramite == "DUPLICADO DE PLACA") {
            if (file_exists($vistaduplicado)) {
                return response()->file($vistaduplicado);
            }

        } else if ($nombretramite == "PREESCRIPCION") {
            if (file_exists($vistapreescripcion)) {
                return response()->file($vistapreescripcion);
            } else {
                echo 'NO EXISTE';
            }
        } else if ($nombretramite == "HOJA DE RUTA") {
            if (file_exists($vistahojaruta)) {
                return response()->file($vistahojaruta);
            } else {
                echo 'NO EXISTE';
            }
        } else if ($nombretramite == "BAJA DEFINITIVA") {
            if (file_exists($vistabaja)) {
                return response()->file($vistabaja);
            } else {
                echo 'NO EXISTE';
            }
        } else {
            if (file_exists($visualizar)) {
                return response()->file($visualizar);
            } else {
                echo 'NO EXISTE';
            }
        }
        //return Response::view($visualizar)->header('Content-Type', $type);

        // return Response::make($visualizar);
        //return Response::view($visualizar)->header('Content-Type', $type);

    }
    public function download($idarchivo)
    {
        $verarchivo = DB::select('SELECT f.idfolder,o.nombre AS oficina,CONCAT(p.papellido," ",IFNULL(p.sapellido," ")," ",p.nombre) AS nombrecompleto,
        f.numero AS folder, f.estado AS folderestado, a.idarchivo AS idarchivo,a.nombre AS nombrearchivo,a.tipo AS tipo,a.estado AS archivoestado,t.nombre AS tramite
        FROM colcapir_bddsisgamc.folder f
        INNER JOIN colcapir_bddsisgamc.archivo a ON f.idfolder=a.idfolder
        INNER JOIN colcapir_bddsisgamc.persona p ON p.idpersona=f.idpersona
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=p.idoficina
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        WHERE a.idarchivo="' . $idarchivo . '"');


        $nombrefolder = $verarchivo[0]->folder;
        $nombrearchivo = $verarchivo[0]->nombrearchivo;
        $tipoarchivo = $verarchivo[0]->tipo;
        $oficina = $verarchivo[0]->oficina;
        $usuario = $verarchivo[0]->nombrecompleto;
        $nombretramite = $verarchivo[0]->tramite;

        $ruta = 'SELECT ruta FROM colcapir_bddsisgamc.config';
        $queryruta = DB::select($ruta);
        $directorio = $queryruta[0]->ruta . $oficina;

        $vistaduplicado = $directorio . '/' . $usuario . '/' . 'DUPLICADO DE PLACA' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistapreescripcion = $directorio . '/' . $usuario . '/' . 'PREESCRIPCION' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistabaja = $directorio . '/' . $usuario . '/' . 'BAJA DEFINITIVA' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $vistahojaruta = $directorio . '/' . $usuario . '/' . 'HOJA DE RUTA' . '/' . $nombrefolder . '/' . $nombrearchivo;
        $visualizar = $directorio . '/' . $usuario . '/' . $nombrefolder . '/' . $nombrearchivo;
        //echo $visualizar;


        if ($tipoarchivo == 'pdf') {
            $headers = ['Content-Type: application/pdf'];
            $fileName = $nombrearchivo . '.pdf';
        }
        if ($tipoarchivo == 'docx') {
            $headers = ['Content-Type: application/octet-stream'];
            $fileName = $nombrearchivo . '.docx';
        }
        if ($nombretramite == "DUPLICADO DE PLACA") {
            return response()->download($vistaduplicado, $fileName, $headers);
        } else if ($nombretramite == "PREESCRIPCION") {
            return response()->download($vistapreescripcion, $fileName, $headers);
        } else if ($nombretramite == "BAJA DEFINITIVA") {
            return response()->download($vistabaja, $fileName, $headers);
        } else if ($nombretramite == "HOJA DE RUTA") {
            return response()->download($vistahojaruta, $fileName, $headers);
        } else {
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
