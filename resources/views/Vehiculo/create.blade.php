@extends('Layout.layout')
@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">NUEVO REGISTRO</h4>
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
                <form class="form-horizontal" action="/Vehiculo" method="Post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">INGRESE DATOS:</h4>

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
                          type="date"
                          class="form-control" name="txtgestion"
                        />
                      </div>
                  </div>

                  <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >3. CARPETAS EN EL TOMO</label
                      >
                      <div class="col-lg-3">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="CARPETAS INCLUIDAS" name="txtcarpetas"
                        />
                      </div>
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >4. TOTAL CARPETAS</label
                      >
                      <div class="col-lg-3">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="TOTAL CARPETAS" name="txttotal"
                        />
                      </div>
                  </div>

                  <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >5. CERTIFICACIONES DE PROPIEDAD</label
                      >
                      <div class="col-lg-3">
                        <textarea class="form-control" rows="5" cols="40" name="txtcertificaciones"></textarea>
                      </div>
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >6. PLACAS</label
                      >
                      <div class="col-lg-3">
                        <textarea class="form-control" rows="5" cols="40" name="txtplacas"></textarea>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >7. FECHAS DE INGRESO</label
                      >
                      <div class="col-lg-3">
                        <textarea class="form-control" rows="5" cols="40" name="txtfechasingreso"></textarea>
                      </div>
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >8. TRAMITE</label
                      >
                      <div class="col-lg-3">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxtramite"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($qtramite as $qt)
                          <option value="{{$qt->idtramite}}">{{$qt->nombre}}</option>
                          @endforeach
                      </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >9. ESTANTE</label
                      >
                      <div class="col-lg-3">
                        <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxestante"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($qestante as $qe)
                          <option value="{{$qe->idestante}}">{{$qe->nombre}}</option>
                          @endforeach
                      
                        </select>
                      </div>
                      <label
                        for="fname"
                        class="col-sm-2 text-end control-label col-form-label"
                        >10. PASILLO</label
                      >
                      <div class="col-lg-3">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxpasillo"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($qpasillo as $qp)
                          <option value="{{$qp->idpasillo}}">{{$qp->pasillo}}</option>
                          @endforeach
                      </select>
                      </div>
                  </div>

                  <div class="border-top">
                    <div class="card-body d-flex justify-content-center">
                        <button type='submit' class="btn btn-primary">GUARDAR</button> &nbsp;
                        <button type='reset' class="btn btn-success">RESETEAR</button>
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
      