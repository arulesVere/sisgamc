@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">REPORTE DE REGISTROS POR RANGO DE FECHAS/CREACION</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Reporte</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Inicio
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
            <div class="col-12">   
              <div class="card">
                <div class="card-body">
                <form class="form-horizontal" method="post" action="/reporterangofecha">
                @csrf
                  
                        <div class="row" style="justify-content: center"> 
                            <label for="fname" class="col-sm-1 text-end control-label col-form-label">FECHA FIN:</label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control" id="fname" name="txtinicio" placeholder="INGRESE FECHA FIN"/>
                            </div>
                    
                            <label for="fname" class="col-sm-1 text-end control-label col-form-label">FECHA FIN:</label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control" id="fname" name="txtfin" placeholder="INGRESE FECHA FIN"/>
                            </div>

                            
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> </button>
                            </div>
                        </div> 
                  
                </form>
                <hr>
                @if(isset($qrangofecha)>=1)
                 <!--  <h5 class="card-title">Basic Datatable</h5> -->
                  <div id="areaImprimir" class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                    <caption>REPORTE GENERADO</caption>
                      <thead class="table-light">
                        <tr>
                          <th style="widht:5%;">#</th>
                          <th>FOLDER</th>
                          <th>FECHA INICIO</th>
                          <th>FECHA FIN</th>
                          <th>TIPO TRAMITE</th>
                          <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($qrangofecha as $qrf)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><i class="fas fa-folder"></a></i>&nbsp;&nbsp;&nbsp;{{$qrf->numero}}</td>
                          <td>{{$qrf->fechainicio}}</td>
                          <td>{{$qrf->fechafin}}</td>
                          <td>{{$qrf->tramite}}</td>
                          <td>
                          <a href="{{route('listfile',$qrf->idfolder)}}"  data-toggle="modal" data-target="" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                
                  @else
                   SIN DATOS
                 @endif 
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

   