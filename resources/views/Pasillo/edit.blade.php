@extends('Layout.layout')
@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">EDICION DE REGISTRO</h4>
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
                <form class="form-horizontal" action="/Pasillo/{{$qpasillo->idpasillo}}" method="Post" data-parsley-validate>
                        @csrf    
				        @method('PUT')
                  <div class="card-body">
                    <h4 class="card-title">INGRESE DATOS:</h4>

                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-4 text-end control-label col-form-label"
                        >NOMBRE</label
                      >
                      <div class="col-sm-4">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          placeholder="NOMBRE DE PASILLO" name="txtpasillo" value="{{$qpasillo->pasillo}}"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-4 text-end control-label col-form-label"
                        >DETALLE</label
                      >
                      <div class="col-sm-4">
                        <textarea class="form-control" rows="3" cols="40" name="txtdetalle" value="{{$qpasillo->detalle}}"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-4 text-end control-label col-form-label"
                        >OFICINA</label
                      >
                      <div class="col-sm-4">
                        <select
                            class="select2 form-select "
                            style="height: 36px; width: 100%" name="cbxoficina"
                        >
                            <option>SELECCIONE UNA OPCION</option>
                            @foreach($qoficina as $qo)
                            <option value="{{$qo->idoficina}}"  
                            @if($qo->idoficina == $qpasillo->idoficina) selected=true @endif
                            > {{$qo->nombre}} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  <div class="border-top">
                    <div class="card-body d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">GUARDAR</button> &nbsp;
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
      