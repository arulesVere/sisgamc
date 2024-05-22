@extends('Layout.layout')
@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">EDITAR REGISTRO</h4>
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
            <div class="col-md-12 col-sm-12">
              <div class="card">
                <form class="form-horizontal" action="/Vehiculo/{{$empastado->idempastado}}" method="Post"  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">VERIFIQUE DATOS: </h4>

                  <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >1. N° DE TOMO</label
                      >
                      <div class="col-lg-3">
                        <input
                          type="text"
                          class="form-control"
                          value="{{$empastado->numero}}"
                          placeholder="N° TOMO" name="txtnumero"
                        />
                      </div>
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >2. GESTIÓN</label
                      >
                      <div class="col-lg-3">
                        <input
                        disabled
                            value="{{$empastado->fecha}}"
                          type="date"
                          class="form-control" name="txtgestion"
                        />
                      </div>
                  </div>


                  <div class="border-top">
                    <div class="card-body d-flex justify-content-center">
                        <button type='submit' class="btn btn-primary">ACTUALIZAR</button> &nbsp;
                        <a class="btn btn-danger" rel="stylesheet" href="/Vehiculo">CANCELAR </a>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
        Contacto: sistemas_gamcol@colcapirhua.gob.bo , gamc@colcapirhua.gob.bo Teléfono: (+591 4) 4269983, (+591 4) 4269985</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->

      @endsection
