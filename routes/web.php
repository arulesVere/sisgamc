<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPrincipal;
use App\Http\Controllers\CPersona;
use App\Http\Controllers\CCargo;
use App\Http\Controllers\CFolder;
use App\Http\Controllers\CArchivo;
use App\Http\Controllers\CGestion;
use App\Http\Controllers\CRol;
use App\Http\Controllers\CPermiso;
use App\Http\Controllers\CSesion;
use App\Http\Controllers\CTramite;
use App\Http\Controllers\CReporte;
use App\Http\Controllers\COficina;
use App\Http\Controllers\CDuplicado;
use App\Http\Controllers\CHojaruta;
use App\Http\Controllers\CPreescripcion;
use App\Http\Controllers\CBajadefinitiva;
use App\Http\Controllers\CAuditoria;
use App\Http\Controllers\CSaneamiento;
use App\Http\Controllers\CPrestamo;
use App\Http\Controllers\CEstante;
use App\Http\Controllers\CRuat;
use App\Http\Controllers\CFinanzas;
use App\Http\Controllers\CUrbanismo;
use App\Http\Controllers\CVehiculo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */
/* Route::get('/', function () {
    return view('welcome');
});
 */
/*Route::get('/',[CPrincipal::class,'index']);*/
Route::get('/',[CSesion::class,'index']);

Route::get('/logout',[CSesion::class,'logout'])->name('logout');
Route::post('/autenticacion',[CSesion::class,'autenticacion'])->name('autenticacion');

Route::get('/Principal',[CPrincipal::class,'index']);
Route::resource('/Cargo', CCargo::class);
Route::resource('/Persona',CPersona::class);

Route::post('/cancel/{idfolder}', [CFolder::class, 'cancel'])->name('cancel');
//Route::resource('/Folder',CFolder::class);

Route::get('listfile/{idfolder}', [CFolder::class, 'listfile'])->name('listfile');

Route::get('vercantidad/{idfolder}', [CFolder::class, 'vercantidad'])->name('vercantidad');

Route::get('download/{idarchivo}', [CArchivo::class, 'download'])->name('download');
Route::get('ver/{idarchivo}', [CArchivo::class, 'ver'])->name('ver');
/* Route::get('{idarchivo}/view', [CArchivo::class, 'view'])->name('view'); */
Route::resource('/Archivo',CArchivo::class);


Route::resource('/Rol',CRol::class);

Route::resource('/Permiso',CPermiso::class);

Route::resource('/Tramite',CTramite::class);

Route::resource('/Reporte',CReporte::class);

Route::resource('/Oficina',COficina::class);

Route::resource('/Finanzas',CFinanzas::class);

Route::resource('/Urbanismo',CUrbanismo::class);

Route::resource('/Hojaruta',CHojaruta::class);

Route::resource('/Duplicado',CDuplicado::class);

Route::resource('/Preescripcion',CPreescripcion::class);

Route::resource('/Bajadefinitiva',CBajadefinitiva::class);

Route::resource('/Auditoria',CAuditoria::class);

Route::resource('/Saneamiento',CSaneamiento::class);

Route::resource('/Prestamo',CPrestamo::class);

Route::resource('/Estante',CEstante::class);

Route::resource('/Ruat',CRuat::class);

Route::resource('/Vehiculo',CVehiculo::class);

Route::post('reporterangofecha', [CReporte::class, 'reporterangofecha'])->name('reporterangofecha');
Route::get('vistareportetipotramite', [CReporte::class, 'vistareportetipotramite'])->name('vistareportetipotramite');
Route::post('reportetipotramite', [CReporte::class, 'reportetipotramite'])->name('reportetipotramite');
Route::get('vistanumerofolder', [CReporte::class, 'vistanumerofolder'])->name('vistanumerofolder');
Route::post('reportenumerofolder',[CReporte::class, 'reportenumerofolder'])->name('reportenumerofolder');

