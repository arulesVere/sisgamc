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

    }
    public function download($idarchivo)
    {
       
    }
}
