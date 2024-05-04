@extends('Layout.layout')
@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">LISTA OFICINAS</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Oficina</a></li>
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
                          <th>OFICINA</th>
                          <th>PERTENECIENTE A:</th>
                          <th>ESTADO</th>
                          <th>FECHA REGISTRO</th>
                          <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($qoficina as $q)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$q->nombre}}</td>
                          <td>{{$q->secretaria}}</td>
                          @if($q->estado==0)
                          <td>INACTIVO</td>
                          @else
                          <td>ACTIVO</td>
                          @endif
                          <td>{{$q->fecharegistro}}</td>
                          <td>
                            <!-- <a href="" data-toggle="modal" data-target="" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a> -->
                            <a href="/Oficina/{{$q->idoficina}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <a href="/Oficina/{{$q->idoficina}}/delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{$q->idoficina}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                          </td>
                        </tr>                   
                        @include('Oficina.delete')
                        @endforeach
                      </tbody>
                    </table>
                    @include('Oficina.create')
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
