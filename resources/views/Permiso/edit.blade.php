@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">DATOS:</h4>
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
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form class="form-horizontal" method="post" action="/Permiso">
                        @csrf    
				                @method('PUT')
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">ACTUALIZAR PERMISOS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                <label
                                    for="fname"
                                    class="col-sm-3 text-end control-label col-form-label"
                                    >NOMBRE:</label
                                >
                                <div class="col-sm-9">
                                    <label
                                    for="fname"
                                    class="col-sm-3 text-end control-label col-form-label"
                                    >{{$permiso->nombre}}</label>
                               
                                </div>
                                <div class="form-group row">
                                <label
                                    for="lname"
                                    class="col-sm-3 text-end control-label col-form-label"
                                    >PRIMER APELLIDO</label
                                >
                                <div class="col-sm-9">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="lname"
                                    placeholder="INGRESE PRIMER APELLIDO" name="txtpapellido"
                                    />
                                </div>
                                </div>
                                <div class="form-group row">
                                <label
                                    for="lname"
                                    class="col-sm-3 text-end control-label col-form-label"
                                    >PERMISOS</label
                                >
                                    <div class="col-md-9">
                      
                                    <div class="form-check mr-sm-2">
                                        <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="customControlAutosizing1" value="" name="chxrol[]"
                                        />
                                        <label
                                        class="form-check-label mb-0"
                                        for="customControlAutosizing1"
                                        >c</label
                                        >
                                    </div>
                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                    </div>
                </form>
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
            Contacto: sistemas_gamcol@colcapirhua.gob.bo , gamc@colcapirhua.gob.bo Teléfono: (+591 4) 4269983, (+591 4) 4269985</a>..
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
          </div>
          @endsection
    