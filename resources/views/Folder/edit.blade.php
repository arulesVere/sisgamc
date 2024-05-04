<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">DATOS:</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Library
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form class="form-horizontal" action="/Folder/{{$fol->idfolder}}" method="Post" data-parsley-validate>
                @csrf    
				        @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">ACTUALIZAR FOLDER:</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >NUMERO DE FOLDER:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="number"
                          class="form-control"
                          id="fname"
                          placeholder="INGRESE NOMBRE" name="txtnumero" value="{{$fol->numero}}"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >FOLDER:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="INGRESE NOMBRE" name="txtfolder" value="{{$fol->nombre}}"
                        />
                      </div>
                    </div>
                   
                    
                    <div class="form-group row">
                        <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >FECHA FIN:</label
                        >
                        <div class="col-sm-6">
                        <input
                            type="date"
                            class="form-control"
                            id="fname" name="txtfin" value="{{$fol->fechafin}}"
                            placeholder="INGRESE FECHA FIN"
                        />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >NRO HOJAS FOLDER:</label
                        >
                        <div class="col-sm-6">
                        <input
                            type="num"
                            class="form-control"
                            id="fname" name="txtnrohoja" value="{{$fol->nrohoja}}"
                            placeholder="CANTIDAD DE HOJAS FOLDER"
                        />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >TIPO TRAMITE:</label
                        >
                        <div class="col-sm-6">
                          <select
                                class="select2 form-select shadow-none"
                                style="width: 100%; height: 36px" name="cbxtramite"
                              >
                                <option>SELECCIONE TRAMITE</option>
                                @foreach($tramite as $tra)
                                <option value="{{$tra->idtramite}}" @if($tra->idtramite==$fol->idtramite) selected=true @endif>{{$tra->nombre}}</option>
                                @endforeach
                          </select>
                        </div>
                    </div>

                    <div @if($nombreoficina=='RUAT') style="display:" @else style="display:none" @endif>
                      <div class="form-group row">
                          <label
                          for="fname"
                          class="col-sm-3 text-end control-label col-form-label"
                          >NRO CERTIFICACION:</label
                          >
                          <div class="col-sm-6">
                              <input
                                type="number"
                                class="form-control"
                                id="fname" name="txtcertificacion" value="{{$ruat->nrocertificacion}}"
                                placeholder="INGRESE NRO CERTIFICACION"/>
                          </div>
                      </div>
                    
                      <div class="form-group row">
                          <label
                          for="fname"
                          class="col-sm-3 text-end control-label col-form-label"
                          >NRO PLACA:</label
                          >
                          <div class="col-sm-6">
                              <input
                                type="text"
                                class="form-control"
                                id="fname" name="txtplaca" value="{{$ruat->nroplaca}}"
                                placeholder="INGRESE NRO PLACA"
                            />
                          </div>
                      </div>
                      <div class="form-group row">
                          <label
                          for="fname"
                          class="col-sm-3 text-end control-label col-form-label"
                          >NRO PLAQUETA:</label
                          >
                          <div class="col-sm-6">
                          <select
                                  class="select2 form-select shadow-none"
                                  style="width: 100%; height: 36px" name="cbxplaqueta"
                                >
                                  <option>SELECCIONE PLAQUETA</option>
                                  <option style="background-color: red;" value="PUBLICA" @if($ruat->nroplaqueta=="PUBLICA") selected=true @endif>PUBLICA</option>
                                  <option style="background-color: yellow;" value="INSTITUCIONAL"  @if($ruat->nroplaqueta=="INSTITUCIONAL") selected=true @endif>INSTITUCIONAL</option>
                                  <option style="background-color: white;" value="PARTICULAR"  @if($ruat->nroplaqueta=="PARTICULAR") selected=true @endif>PARTICULAR</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label
                          for="fname"
                          class="col-sm-3 text-end control-label col-form-label"
                          >TRAMITADOR:</label
                          >
                          <div class="col-sm-6">
                              <input
                                type="text"
                                class="form-control"
                                id="fname" name="txttramitador" value="{{$ruat->tramitador}}"
                                placeholder="INGRESE TRAMITADOR"
                            />
                          </div>
                      </div>
                      <div class="form-group row">
                          <label
                          for="fname"
                          class="col-sm-3 text-end control-label col-form-label"
                          >CARNET TRAMITADOR:</label
                          >
                          <div class="col-sm-6">
                              <input
                                type="text"
                                class="form-control"
                                id="fname" name="txtcarnet" value="{{$ruat->carnet}}"
                                placeholder="INGRESE CARNET DE TRAMITADOR"
                            />
                          </div>
                      </div>
                    </div>

                  </div>
                  <div class="border-top">
                    <div class="card-body text-center">
                      <button type="submit" class="btn btn-primary">
                        GUARDAR
                      </button>
                      <button type="button" class="btn btn-secondary">
                        CANCELAR
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              
           
          </div>
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
        Contacto: sistemas_gamcol@colcapirhua.gob.bo , gamc@colcapirhua.gob.bo Teléfono: (+591 4) 4269983, (+591 4) 4269985</a>..
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      @endsection
