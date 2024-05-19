@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Tables</h4>
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
                  <button type="button" class="btn btn-primary"><a href="{{ route('Pasillo.create') }}">NUEVO REGISTRO</a>
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
                  <h5 class="card-title">Basic Datatable</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th style="width:10%;">#</th>
                          <th>N° PASILLO</th>
                          <th>DETALLE</th>
                          <th>OFICINA</th>
                          <th>ACCIÓN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($qpasillo as $pas)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$pas->pasillo}}</td>
                          <td>{{$pas->detalle}}</td>
                          <td>{{$pas->oficina}}</td>
                          <td>
                            <a href="/Pasillo/{{$pas->idpasillo}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <a href="/Pasillo/{{$pas->idpasillo}}/delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{$pas->idpasillo}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                           </td>
                        </tr>
                        @include('Pasillo.delete')
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