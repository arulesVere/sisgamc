@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">DATOS</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    Edicion
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
                <form class="form-horizontal" action="/Empastado/{{$allv->idempastado}}" method="Post" data-parsley-validate>
                @csrf    
				        @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">ACTUALIZAR USUARIO:</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >N° TOMO:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="N° TOMO" value="{{$allv->numero}}" name="txtnumero"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >GESTIÓN</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE PRIMER APELLIDO" value="{{$allv->fecha}}" name="txtgestion"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CARPETAS EN EL TOMO</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE SEGUNDO APELLIDO" value="{{$qv->carpetas}}" name="txtcarpetas"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >TOTAL CARPETAS</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE CARNET" value="{{$qv->total}}" name="txttotal"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CERTIFICACIONES DE PROPIEDAD</label
                      >
                      <div class="col-sm-6">
                       <textarea class="form-control" rows="3" cols="40" value="{{$qv->certificaciones}}" name="txtcertificaciones"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >PLACAS</label
                      >
                      <div class="col-md-6">
                       <textarea class="form-control" rows="3" cols="40" value="{{$qv->placas}}" name="txtplacas"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >FECHAS DE INGRESO</label
                      >
                      <div class="col-sm-6">
                        <textarea class="form-control" rows="3" cols="40" value="{{$qv->fechasingreso}}" name="txtfechasingreso"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >TRAMITE</label
                      >
                      <div class="col-sm-6">
                        <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxoficina">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($tramite as $tra)
                          <option value="{{$tra->idtramite}}" @if($tra->idtramite==$allv->idtramite) selected=true @endif>
                          {{$tra->nombre}}  
                          </option>
                         @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >ESTANTE</label
                      >
                      <div class="col-sm-6">
                        <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxoficina">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($estante as $est)
                          <option value="{{$est->idestante}}" @if($est->idestante==$allv->idestante) selected=true @endif>
                          {{$est->estante}}  
                          </option>
                         @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >PASILLO</label
                      >
                      <div class="col-sm-6">
                        <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxoficina">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($pasillo as $pas)
                          <option value="{{$pas->idpasillo}}" @if($pas->idpasillo==$allv->idpasillo) selected=true @endif>
                          {{$pas->pasillo}}  
                          </option>
                         @endforeach
                        </select>
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
