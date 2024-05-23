<?php
$sessionidfolder=session('sessionidfolder');
?>
        @extends('Layout.layout')
        @section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">ARCHIVOS</h4>
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
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#archivoModal">
                    NUEVO ARCHIVO
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
                  <h5 class="card-title mb-0">LISTA ARCHIVOS</h5>
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">ARCHIVO</th>
                      <th scope="col">VISUALIZAR</th>
                      <th scope="col">FORMATO</th>
                      <th scope="col"><i class="fas fa-arrow-alt-circle-down"></i>  DESCARGAR</th>
                      <th scope="col">ESTADO</th>
                      <th scope="col">FECHA REGISTRO</th>
                      <th scope="col">ACCION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($queryarchivo as $query)

                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$query->nombre}}</td>

                      <td><a target="_blank" href="https://drive.google.com/file/d/{{$query->google_file_id}}"> VER </a><i class="fas fa-eye"></i></td>
                      <td>{{$query->tipo}}</td><!-- Aqui metodo para descargar -->
                      <td><a target="_blank" href="https://drive.usercontent.google.com/u/0/uc?id={{$query->google_file_id}}&export=download"> DESCARGAR </a><i class="fas fa-arrow-alt-circle-down"></i></td>
                      @if($query->estado==0)
                      <td>DE BAJA</td>
                      @else
                      <td>ACTIVO</td>
                      @endif
                      <td>{{$query->fecharegistro}}</td>
                      <td>

                        <a href="/Archivo/{{$query->idarchivo}}/delete" data-bs-toggle="modal" data-bs-target="#deletearchivoModal{{$query->idarchivo}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                    @include('Archivo.delete')
                   @endforeach
                  </tbody>
                </table>

                <input type="text" class="form-control" id="fname" name="txtidfolder" value=" {{$sessionidfolder}}" style="visibility:hidden"/>
                @include('Archivo.create')
              </div>
            </div>
          </div>

          <!-- ============================================================== -->
          <!-- Sales Cards  -->
          <!-- ============================================================== -->


        <footer class="footer text-center">
        Contacto: sistemas_gamcol@colcapirhua.gob.bo , gamc@colcapirhua.gob.bo Teléfono: (+591 4) 4269983, (+591 4) 4269985</a>.
        </footer>
    @stop
