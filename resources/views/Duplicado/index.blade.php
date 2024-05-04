@extends('Layout.layout')
@section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">LISTA CARPETAS / DUPLICADO</h4>
              
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Folder</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Inicio
                    </li>
                  </ol>
                </nav>
              </div>
              <!-- div para evento crear -->
              <div class="border-top">
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#duplicadoModal">
                    NUEVO FOLDER
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
                <!-- 
                 <div class="row d-flex justify-content-center">
                    <label class="col-2">VER POR TIPO DE TRAMITE</label>
                      <div class="col-3">
                        <select
                            class="select2 form-select shadow-none"
                            style="width: 100%; height: 36px"
                          >
                            <option>Select</option>
                            <option value="AK">Alaska</option>
                        </select>
                      </div>
                  </div> -->

                  <h5 class="card-title">DETALLE:</h5>
                  <div class="table-responsive">
                      <table
                        id="zero_config"
                        class="table table-striped table-bordered"
                      >
                        <thead>
                          <tr>
                            <th>#</th>
                            <th style="width:10%;">Nº</th>
                            
                            <th>TIPO TRAMITE</th>
                            <th>GESTION</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <th>CANT. HOJAS</th>

                            <th>SOLICITANTE</th>
                            <th>CARNET</th>

                            <th>ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($querybyduplicado as $qbb)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><i class="fas fa-folder"></a></i>&nbsp;{{$qbb->numero}}</td>
                            <td>{{$qbb->tramite}}</td>
                            
                            <td>{{$qbb->fechainicio}}</td>
                            @if($qbb->fechafin==null)
                            <td><p class="text-warning">EN PROCESO</p></td>
                            @else
                            <td>{{$qbb->fechafin}}</td>
                            @endif
                            <td>{{$qbb->nrohoja}}</td>

                            <td>{{$qbb->solicitante}}</td>
                            <td>{{$qbb->carnet}}</td> 
                            <td>
                              <a href="{{route('listfile',$qbb->idfolder)}}" data-toggle="modal" data-target="" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
                              <a href="/Folder/{{$qbb->idfolder}}/edit" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @include('Duplicado.create')
                    </div>
                 <!--  FIN TABLA DUPLICADO -->
                </div>
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

        <style>
          .disabled 
          {
          cursor: not-allowed;
          pointer-events: none;
          }
        </style>
        <script>
          $('#cbxtramite').on('change',function()
          {
              var selectValor = $(this).val();
              $('.bajadefinitiva').hide();
              if (selectValor == "VACIO") {
                  $('.bajadefinitiva').hide();
                  $('.preescripcion').hide();
                  $('.duplicado').hide();
                  $('.hojaruta').hide();
              }
              else
                {
                  if (selectValor == 2) {
                    $('.bajadefinitiva').show();
                  }
                  else
                  {
                    $('.bajadefinitiva').hide();
                  }
                  if (selectValor == 1) {
                    $('.preescripcion').show();
                  }
                  else {
                    $('.preescripcion').hide();
                  }
                  if (selectValor == 3) {
                    $('.duplicado').show();
                  }
                  else {
                    $('.duplicado').hide();
                  }
                  if (selectValor == 4) {
                    $('.hojaruta').show();
                  }
                  else {
                    $('.hojaruta').hide();
                  }
                }
          });

          $(document).ready(function(){
              $(".tramitador").click(function(evento){
                  var valor = $(this).val();
                  if(valor == 'ABOGADO'){
                      $("#divabogado").css("display", "block");
                  }else{
                      $("#divabogado").css("display", "none");
                  }
              });
          });

        </script>

@stop