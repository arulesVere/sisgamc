@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">NUEVO REGISTRO</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Finanzas</a></li>
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
              <form class="form-horizontal" action="/Finanzas" method="Post" >
                @csrf  
                  <div class="card-body">
                    <h4 class="card-title">INGRESE DATOS:</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >NÚMERO DE TOMO:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="N° TOMO" name="txtnumero"
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
                          type="date"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE GESTIÓN" name="txtgestion"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >NRO. COMPROBANTES</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="N° DE COMPROBANTES" name="txtcomprobantes"
                        />
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
                          style="height: 36px; width: 100%" name="cbxtramite">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($qtramite as $tra)
                         <option value="{{$tra->idtramite}}">{{$tra->nombre}}</option>
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
                          style="height: 36px; width: 100%" name="cbxestante">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($qestante as $est)
                         <option value="{{$est->idestante}}">{{$est->nombre}}</option>
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
                          style="height: 36px; width: 100%" name="cbxpasillo">
                          <option>SELECCIONE UNA OPCION</option>
                         @foreach($qpasillo as $pas)
                         <option value="{{$pas->idpasillo}}">{{$pas->pasillo}}</option>
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
