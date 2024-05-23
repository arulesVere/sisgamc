@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">LISTA DE REGISTROS</h4>
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
                <!-- div para evento crear -->
            <div class="border-top">
                <div class="card-body">
                  <button type="button" class="btn btn-primary"><a href="{{ route('Vehiculo.create') }}" style="color:white;">NUEVO REGISTRO</a>
                  </button>
                </div>
            </div>
              <!-- fin evento crear -->

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
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">DETALLE</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th style="width:5%;">#</th>
                          <th>CODIGO</th>
                          <th>N° TOMO</th>
                          <th>GESTIÓN</th>
                          <th>CARPETAS</th>
                          <th>TOTAL</th>
                          <th>N° DE CERTIFICACION </br> DE PROPIEDAD</th>
                          <th>N° DE PLACAS</th>
                          <th>FECHAS </br> DE INGRESO</th>
                          <th>CONDICION</th>
                          <th>UBICACION</th>
                          <th>ACCIÓN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allvehiculo as $allv)
                        <tr>
                          <td style="width:5%;">{{$loop->iteration}}</td>
                          <td>{{$allv->codigo}}</td>
                          <td>{{$allv->numero}}</td>
                          <td>{{$allv->fecha}}</td>
                          <td>1-6</td>
                          <td>6</td>
                          <td>ABC</td>
                          <td>ABC</td>
                          <td>1/05/2024</td>
                          <td>{{$allv->condicion}}</td>
                          <td>ESTANTE 1 PASILLO 3</td>
                          <td>
                            <a href="/Archivo/?google_folder_id={{$allv->google_folder_id}}"  class="btn btn-info btn-sm"><i class="mdi mdi-file"></i></a>
                            <a href="/Vehiculo/{{$allv->idempastado}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <a href="/Vehiculo/{{$allv->idempastado}}/delete" data-bs-toggle="modal" data-bs-target="#deleteVehiculoModal{{$allv->idempastado}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                          </td>
                        </tr>
                        @include('Vehiculo.delete')
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
