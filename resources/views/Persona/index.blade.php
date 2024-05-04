@extends('Layout.layout')
@section('content')

        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">LISTA USUARIOS</h4>
              
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                     Inicio
                    </li>
                  </ol>
                </nav>
              </div>
              <!-- div para evento crear -->
              <div class="border-top">
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                          <th>NOMBRE COMPLETO</th>
                          <th>CARNET</th>
                          <th>CARGO</th>
                          <th>OFICINA</th>
                          <th>ESTADO</th>
                          <th>FECHA REGISTRO</th>
                          <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($persona as $persona)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$persona->nombrecompleto}}</td>
                          <td>{{$persona->carnet}}</td>
                          <td>{{$persona->cargo}}</td>
                          <td>{{$persona->oficina}}</td>
                          @if($persona->estado==0)
                          <td>INACTIVO</td>
                          @else
                          <td>ACTIVO</td>
                          @endif
                          <td>{{$persona->fecharegistro}}</td>
                          <td><a href="/Persona/{{$persona->idpersona}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a></td>
                        </tr>
                      
                        @endforeach
                      </tbody>
                    </table>
                
                    @include('Persona.create')
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

@stop