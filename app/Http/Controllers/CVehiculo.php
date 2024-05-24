<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Pasillo;
use App\Models\Tramite;
use App\Models\Vehiculo;
use App\Models\Empastado;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use DB;
use File;
use Session;
use Google\Client;
use Google\Service\Drive;
use Carbon\Carbon;

class CVehiculo extends Controller
{
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

    public function index(Request $request)
    {
        $allvehiculo = DB::table('empastado')
            ->join('vehiculo', 'empastado.idempastado', '=', 'vehiculo.idempastado')
            ->where('estado', '=', 1)
            ->get()
            ->all();

        return view('Vehiculo.index', ['allvehiculo' => $allvehiculo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltramite = DB::SELECT('SELECT * FROM colcapir_bddsisgamc.tramite WHERE estado=1');
        $allpasillo = DB::SELECT('SELECT * FROM colcapir_bddsisgamc.pasillo WHERE estado=1');
        $allestante = DB::SELECT('SELECT * FROM colcapir_bddsisgamc.estante WHERE estado=1');
        return view('Vehiculo.create', ['qtramite' => $alltramite, 'qpasillo' => $allpasillo, 'qestante' => $allestante]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tomo_folder_id = $this->getTomoFolderId($request);
        $sessionidusuario=session('sessionidusuario');
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

        $maxidfolder = DB::select('SELECT MAX(e.idempastado) AS idempastado FROM colcapir_bddsisgamc.empastado e WHERE e.estado=1');

        $vehiculo = new Vehiculo();
        $vehiculo->idempastado = $maxidfolder[0]->idempastado;

        $vehiculo->carpetas = $request->get('txtcarpetas');
        $vehiculo->total = $request->get('txttotal');
        $vehiculo->certificaciones = $request->get('txtcertificaciones');
        $vehiculo->placas = $request->get('txtplacas');
        $vehiculo->fechasingreso = $request->get('txtfechasingreso');
        $vehiculo->save();
        // crear carpetas y subcarpetas

        return redirect('/Vehiculo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empastado = Empastado::find($id);
        $vehiculo = Vehiculo::find($id);
        $tramite = DB::table('tramite')
            ->where('tramite.estado', '=', 1)
            ->get();
        $estante = DB::table('estante')
            ->where('estante.estado', '=', 1)
            ->get();
        $pasillo = DB::table('pasillo')
            ->where('pasillo.estado', '=', 1)
            ->get();
        return view('Vehiculo.edit', ['empastado' => $empastado, 'vehiculo' => $vehiculo, 'tramite' => $tramite, 'estante' => $estante, 'pasillo' => $pasillo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idempastado)
    {
        $tomo_folder_id = $this->getTomoFolderId($request);
        $empastado = Empastado::find($idempastado);
        $empastado->numero = $request->get('txtnumero');
        $empastado->fecha = $request->get('txtgestion');
        $empastado->idtramite = $request->get('cbxtramite');
        $empastado->idestante = $request->get('cbxestante');
        $empastado->idpasillo = $request->get('cbxpasillo');
        $empastado->google_folder_id = $tomo_folder_id;
        $empastado->update();


        $vehiculo = Vehiculo::where('idempastado', '=', $idempastado)->first();
        $vehiculo->carpetas = $request->get('txtcarpetas');
        $vehiculo->total = $request->get('txttotal');
        $vehiculo->certificaciones = $request->get('txtcertificaciones');
        $vehiculo->placas = $request->get('txtplacas');
        $vehiculo->fechasingreso = $request->get('txtfechasingreso');
        $vehiculo->update();


        return redirect('/Vehiculo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehiculoId)
    {

        $vehiculo = Vehiculo::find($vehiculoId);
        $vehiculo->delete();
        return redirect('/Vehiculo');
    }

}
