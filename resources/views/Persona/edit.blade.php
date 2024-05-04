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
                <form class="form-horizontal" action="/Persona/{{$per->idpersona}}" method="Post" data-parsley-validate>
                @csrf    
				        @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">ACTUALIZAR USUARIO:</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >NOMBRE:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="INGRESE NOMBRE" value="{{$per->nombre}}" name="txtnombre"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >PRIMER APELLIDO</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE PRIMER APELLIDO" value="{{$per->papellido}}" name="txtpapellido"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >SEGUNDO APELLIDO</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE SEGUNDO APELLIDO" value="{{$per->sapellido}}" name="txtsapellido"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CARNET</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE CARNET" value="{{$per->carnet}}" name="txtcarnet"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CORREO</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE CORREO" value="{{$per->correo}}" name="txtcorreo"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CARGO</label
                      >
                      <div class="col-md-6">
                        <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxcargo">
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($car as $car)
                          <option value="{{$car->idcargo}}"  
                          @if($car->idcargo == $per->idcargo) selected=true @endif
                          > {{$car->nombre}} </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >OFICINA</label
                      >
                      <div class="col-sm-6">
                        <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxoficina">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($ofi as $ofi)
                          <option value="{{$ofi->idoficina}}" @if($ofi->idoficina==$per->idoficina) selected=true @endif>
                          {{$ofi->nombre}}  
                          </option>
                         @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >PERMISOS</label
                      >
                      <div class="col-sm-6">                    
                       @foreach($rol as $rol)
                        <div class="form-check mr-sm-2">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            id="customControlAutosizing1" value="{{$rol->idrol}}" name="chxrol[]"
                            @if($permiso)
                              @if(in_array($rol->idrol,
                              array($permiso[0]->idrol)))
                              checked  
                              @endif 
                            @endif 
                            />
                          <label
                            class="form-check-label mb-0"
                            for="customControlAutosizing1"
                           >{{$rol->nombre}}</label
                          >
                        </div>
                       @endforeach
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
