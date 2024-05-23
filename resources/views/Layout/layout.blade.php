<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
$sessionoficina=session('sessionoficina');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta
      name="description"
      content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>SISTEMA DE ARCHIVOS | GAMC 2022</title>
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{asset('matrix/assets/images/escudo100x100.png')}}"
    />
    <!-- Custom CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{asset('matrix/assets/extra-libs/multicheck/multicheck.css')}}"
    />
    <link
      href="{{asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}"
      rel="stylesheet"
    />
    <link href="{{asset('matrix/dist/css/style.min.css')}}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="/Principal">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="{{asset('matrix/assets/images/escudo100x100.png')}}"
                  alt="homepage"
                  class="light-logo"
                  width="50"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                <img
                  src="{{asset('matrix/assets/images/solotextoblanco50.png')}}"
                  alt="homepage"
                  class="light-logo"
                />
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
              <b>BIENVENIDO(A):</b>{{$sessionusuario}} -
              <b>OFICINA:</b>{{$nombreoficina}}
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="{{asset('matrix/assets/images/users/1.jpg')}}"
                    alt="user"
                    class="rounded-circle"
                    width="31"
                  />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown"
                >
                  <!-- <a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-account me-1 ms-1"></i></a
                  > -->
                 <!--  <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="/logout"
                    ><i class="fa fa-power-off me-1 ms-1"></i>CERRAR SESION</a
                  >
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">

              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="/Principal"
                  aria-expanded="false"
                  ><i class="mdi mdi-chart-bar"></i
                  ><span class="hide-menu"> DASHBOARD</span></a
                >
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="/google-drive"
                  aria-expanded="false"
                  ><i class="mdi mdi-google-drive"></i
                  ><span class="hide-menu"> GOOGLE DRIVE</span></a
                >
              </li>

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">USUARIO </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Persona" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu"> ADMINISTRAR </span></a
                    >
                  </li>
                </ul>
              </li>

              <li class="sidebar-item"  @if($sessionoficina=="URBANISMO") style="display:;" @else style="display:none;" @endif>
              <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="#"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">URBANISMO</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Urbanismo" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> GESTIONAR </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item"  @if($sessionoficina=="FINANZAS") style="display:;" @else style="display:none;" @endif>
              <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="#"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">FINANZAS</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Finanzas" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> GESTIONAR </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item"  @if($sessionoficina=="SANEAMIENTO BASICO") style="display:;" @else style="display:none;" @endif>
              <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="#"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">SANEAMIENTO BÁSICO </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Saneamiento" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> GESTIONAR </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="#"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">PRESTAMO </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Prestamo" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> GESTIONAR </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item" @if($sessionoficina=="RUAT") style="display:;" @else style="display:none;" @endif>
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-face"></i
                  ><span class="hide-menu">INGRESOS </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Ruat" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> GESTIONAR </span></a
                    >
                  </li>
                 <li class="sidebar-item">
                    <a href="/Vehiculo" class="sidebar-link"
                      ><i class="mdi mdi-file-outline"></i
                      ><span class="hide-menu"> VEHICULO </span></a
                    >
                  </li>
                </ul>
              </li>
                <!-- <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Bajadefinitiva" class="sidebar-link"
                      ><i class="mdi mdi-package-down"></i
                      ><span class="hide-menu"> BAJA DEFINITIVA </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Duplicado" class="sidebar-link"
                      ><i class="mdi mdi-lumx"></i
                      ><span class="hide-menu"> DUPLICADO </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Hojaruta" class="sidebar-link"
                      ><i class="mdi mdi-file-outline"></i
                      ><span class="hide-menu"> HOJA DE RUTA </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Preescripcion" class="sidebar-link"
                      ><i class="mdi mdi-pen"></i
                      ><span class="hide-menu"> PREESCRIPCION </span></a
                    >
                  </li>
                </ul>
              </li> -->

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">REPORTES </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{url('/vistanumerofolder')}}" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu"> POR FOLDER </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Reporte" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu"> RANGO FECHA </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="{{url('/vistareportetipotramite')}}" class="sidebar-link"
                      ><i class="mdi mdi-note-plus"></i
                      ><span class="hide-menu"> POR TRAMITE </span></a
                    >
                  </li>
                </ul>
              </li>

              <!-- <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-face"></i
                  ><span class="hide-menu">PERMISOS </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Permiso" class="sidebar-link"
                      ><i class="mdi mdi-key"></i
                      ><span class="hide-menu"> OTORGAR/DENEGAR </span></a
                    >
                  </li>
                </ul>
              </li> -->

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-move-resize-variant"></i
                  ><span class="hide-menu">CONTROL INTERNO </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Auditoria" class="sidebar-link"
                      ><i class="mdi mdi-history"></i
                      ><span class="hide-menu"> AUDITORIA </span></a
                    >
                  </li>
                </ul>
              </li>

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-apple-keyboard-option"></i
                  ><span class="hide-menu">ADMINISTRAR OPCIONES </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="/Oficina" class="sidebar-link"
                      ><i class="mdi mdi-calendar-check"></i
                      ><span class="hide-menu"> OFICINA </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Cargo" class="sidebar-link"
                      ><i class="mdi mdi-account-network"></i
                      ><span class="hide-menu"> CARGO </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Tramite" class="sidebar-link"
                      ><i class="mdi mdi-adjust"></i
                      ><span class="hide-menu"> TRAMITE </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Estante" class="sidebar-link"
                      ><i class="mdi mdi-adjust"></i
                      ><span class="hide-menu"> ESTANTE </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Pasillo" class="sidebar-link"
                      ><i class="mdi mdi-adjust"></i
                      ><span class="hide-menu"> PASILLO </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/Rol" class="sidebar-link"
                      ><i class="mdi mdi-adjust"></i
                      ><span class="hide-menu"> ROLES </span></a
                    >
                  </li>

                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link  waves-dark"
                  href="/logout"
                  aria-expanded="false"
                  ><i class="mdi mdi-account-key"></i
                  ><span class="hide-menu">CERRAR SESION </span></a
                >
               <!--  <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item">
                    <a href="/logout" class="sidebar-link"
                      ><i class="mdi mdi-logout"></i
                      ><span class="hide-menu"> CERRAR SESION </span></a
                    >
                  </li>

                </ul> -->
              </li>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <section class="content">
          @include('sweetalert::alert')
          @yield('content')
        </section>
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('matrix/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('matrix/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('matrix/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('matrix/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('matrix/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('matrix/dist/js/custom.min.js')}}"></script>
    <!-- this page js -->
    <script src="{{asset('matrix/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
    <script src="{{asset('matrix/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
    <script src="{{asset('matrix/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    </script>

  </body>
</html>
