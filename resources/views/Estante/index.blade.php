@extends('Layout.layout')
@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">LISTA ESTANTES</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Estante</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Inicio
                    </li>
                  </ol>
                </nav>
              </div>
            <!-- div para evento crear -->
            <div class="border-top">
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#oficinaModal">
                    NUEVO REGISTRO
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
                  <h5 class="card-title">DETALLE:</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>NOMBRE</th>
                          <th>FILA</th>
                          <th>OFICINA</th>
                          <th>ESTADO</th>
                          <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($qestante as $qe)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$qe->nombre}}</td>
                          <td>{{$qe->fila}}</td>
                          <td>{{$qe->oficina}}</td>
                          @if($qe->estado==0)
                          <td>INACTIVO</td>
                          @else
                          <td>ACTIVO</td>
                          @endif
                          <td>
                            <!-- <a href="" data-toggle="modal" data-target="" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a> -->
                            <a href="/Estante/{{$qe->idestante}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <a href="/Estante/{{$qe->idestante}}/delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{$qe->idestante}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                          </td>
                        </tr>                   
                        @include('Estante.delete')
                        @endforeach
                      </tbody>
                    </table>
                    @include('Estante.create')
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <!-- ==============================================================  -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar @-->
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
