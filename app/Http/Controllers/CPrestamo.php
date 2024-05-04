<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Folder;
use App\Models\Registro;
use Illuminate\Http\Request;
use DB;
use Storage;
use Session;
use Alert;
class CPrestamo extends Controller
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

        $codigofolder=DB::select('SELECT f.idfolder,f.codigo AS codigofolder, o.nombre FROM colcapir_bddsisgamc.folder f
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=t.idoficina
        WHERE f.estado=1 and o.nombre="'.$nombreoficina.'" ORDER BY f.codigo ASC');

        $folder=DB::select('SELECT p.idprestamo,f.codigo AS codigofolder,p.codigo,f.idfolder,p.fechaprestamo,p.fechadevolucion,p.motivo,p.aquien,
        CONCAT(e.nombre," ",e.fila) AS estante,f.estado FROM colcapir_bddsisgamc.prestamo p 
        INNER JOIN colcapir_bddsisgamc.folder f ON f.idfolder=p.idfolder
        INNER JOIN colcapir_bddsisgamc.tramite t ON t.idtramite=f.idtramite
        INNER JOIN colcapir_bddsisgamc.oficina o ON o.idoficina=t.idoficina
        INNER JOIN colcapir_bddsisgamc.estante e ON e.idestante=f.idestante
        WHERE f.estado=2 AND o.nombre="'.$nombreoficina.'" GROUP BY codigofolder');
        return view('Prestamo.index', ['con'=>$queryconfig,'querytramite'=>$querytramite,'queryprestamo'=>$folder,'codigo'=>$codigofolder]);
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
        $prestamo=new Prestamo();
        $prestamo->codigo=$request->get('cbxcodigo');
        $prestamo->fechaprestamo=$request->get('txtfechaprestamo');
        $prestamo->fechadevolucion=$request->get('txtfechadevolucion');
        $prestamo->aquien=$request->get('txtasignadoa');
        $prestamo->motivo=$request->get('txtmotivo');
        $prestamo->idfolder=$request->get('cbxcodigo');
        $prestamo->estado=2;
        //estado 2 es prestado
        $prestamo->save();
       
        $queryultimoregistro=DB::select("SELECT MAX(idprestamo) AS idprestamo FROM colcapir_bddsisgamc.prestamo");
        $ultimo=$queryultimoregistro[0]->idprestamo;


        $folder=Folder::findOrFail($request->get('cbxcodigo'));
        $folder->estado=2;
        $folder->update();
        Alert::success('EXITO', 'REGISTRO EXITOSO');
        return redirect('/Prestamo'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idfolder)
    {
        $folder=Folder::FindOrFail($idfolder);
        $folder->estado=1;
        $folder->update();
        Alert::success('EXITO', 'DEVOLUCION EXITOSA');
        return redirect('/Prestamo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
