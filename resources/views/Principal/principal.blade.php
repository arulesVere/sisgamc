@extends('Layout.layout')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Page wrapper  -->
      <!-- ============================================================== -->
    
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Principal
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
          <!-- Sales Cards  -->
          <!-- ============================================================== -->
          <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-view-dashboard"></i>
                  </h1>
                  <h6 class="text-white">Dashboard</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-chart-areaspline"></i>
                  </h1>
                  <h6 class="text-white">Charts</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-collage"></i>
                  </h1>
                  <h6 class="text-white">Widgets</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-border-outside"></i>
                  </h1>
                  <h6 class="text-white">Tables</h6>
                </div>
              </div>
            </div>
           
          
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-calendar-check"></i>
                  </h1>
                  <h6 class="text-white">Calnedar</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
           
            <!-- Column -->
          </div>
          <!-- ============================================================== -->
          <!-- Sales chart -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-body">
                 

                  <div class="row">

                 
                      <div class="col-lg-9">
                          <div style="height:500px; width:900px; margin:auto;">
                            <canvas id="barChart"></canvas>
                          </div>
                      </div>
                           
                      <script>
                        $(function(){
                          var datas=<?php echo json_encode($folder);?>;
                          var barCanvas=$("#barChart");
                          var barChart=new Chart(barCanvas,{
                            type:'bar',
                            data:{
                              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                              datasets:[
                                {
                                  label:'New user Growth,2020',
                                  data:datas,
                                  backgroundcolor:['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],

                                }
                              ]
                            },
                            options:{
                              scales:{
                                yAxes:[{
                                    ticks:{
                                      beginAtZero:true
                                    }
                                  }]
                                }
                              }
                            });
                          })
                      </script> 
                    <!-- column -->
                    

                    <div class="col-lg-3">
                      <div class="row">
                        <div class="col-6">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="fas fa-user fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$persona[0]->total}}</h5>
                            <small class="font-light">USUARIOS</small>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class=" fas fa-folder fs-3 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$folder[0]->total}}</h5>
                            <small class="font-light">CARPETAS</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="far fa-file fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$archivo[0]->total}}</h5>
                            <small class="font-light">ARCHIVOS</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="fab fa-empire fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$oficina[0]->total}}</h5>
                            <small class="font-light">OFICINAS</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="fas fa-indent fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$cargo[0]->total}}</h5>
                            <small class="font-light">CARGOS</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="fas fa-user-secret fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{$cargo[0]->total}}</h5>
                            <small class="font-light">ROLES</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- column -->
                  </div>
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
      
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->

@stop