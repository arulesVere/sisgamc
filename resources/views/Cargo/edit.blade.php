@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">DATOS:</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Cargo</a></li>
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
                <form class="form-horizontal" action="/Cargo/{{$car->idcargo}}" method="Post" data-parsley-validate>
                @csrf    
				        @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">ACTUALIZAR CARGO:</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >CARGO:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="INGRESE CARGO" name="txtcargo" value="{{$car->nombre}}"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >DETALLE:</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          placeholder="INGRESE DETALLE" name="txtdetalle" value="{{$car->detalle}}"
                        />
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
