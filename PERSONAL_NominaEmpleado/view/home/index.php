<?php
session_start();
include 'timezone.php';

if (isset($_SESSION["id"])) {
  $correo = $_SESSION["usu_correo"];
  $Nombre = $_SESSION["firstname"];
} else {
  $correo = "Correo no disponible";
  $Nombre = "Nombre no disponible";
}

$currentTime = get_current_time(); // Call the function
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Empleado | Fundación Emprende Hoy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">

        <!-- plugin css -->
        <link href="../../assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

        <!-- preloader css -->
        <link rel="stylesheet" href="../../assets/css/preloader.min.css" type="text/css">

        <!-- Bootstrap Css -->
        <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Nómina</span>
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Nómina</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../../assets/picture/avatar-1.jpg" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $Nombre ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="../profile/index.php"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Mi perfil</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Restablecer contraseña</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../index.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i>Cerrar Sesión</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar="" class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-icons">Información del sistema</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#" data-key="t-boxicons">Versión del sistema</a></li>
                                    <li><a href="#" data-key="t-material-design">Mi contrato</a></li>
                                    <li><a href="#" data-key="t-dripicons">Solicitudes</a></li>
                                    <li><a href="#" data-key="t-font-awesome">Soporte</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                            <div class="card-body">
                                <img src="../../assets/picture/giftbox.png" alt="">
                                <div class="mt-4">
                                    <h5 class="alertcard-title font-size-16">Actualizar mi plan</h5>
                                    <p class="font-size-13">Actualice su plan desde una prueba gratuita para seleccionar "Plan de negocios".</p>
                                    <a href="#" class="btn btn-primary mt-2">Actualizar ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm order-2 order-sm-1">
                                                <div class="d-flex align-items-start mt-3 mt-sm-0">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xl me-3">
                                                            <img src="../../assets/picture/avatar-2.jpg" alt="" class="img-fluid rounded-circle d-block">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-16 mb-1"><?php echo $Nombre ?></h5>
                                                            <p class="text-muted font-size-13">Cargo: Full Stack Developer</p>

                                                            <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>ID Empleado:</div>
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?php echo $correo ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                   </div>
                                    <!-- end card body -->
                                </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Salario</span>
                                                <h4 class="mb-3">
                                                    $<span class="counter-value" data-target="800">0</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-danger text-danger">-$365</span>
                                            <span class="ms-1 text-muted font-size-13">Tu salario anterior</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of Trades</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="6257">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ISSS</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="3">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">+3%</span>
                                            <span class="ms-1 text-muted font-size-13">Descuento</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">AFP</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="7.25">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">+7.25%</span>
                                            <span class="ms-1 text-muted font-size-13">Descuento</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->    
                        </div><!-- end row-->
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Mi asistencia</h4>
                                        <div class="flex-shrink-0">

                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                                <div class="float-end ms-2">
                                                    <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#" class="text-reset text-decoration-underline"><?php echo $currentTime; ?></a></h5>
                                                </div>
                                                <h5 class="font-size-14 mb-4">El Salvador</h5>
                                                <div class="form-group mb-3">
                                                        <label>ID Empleado :</label>
                                                        <input type="email" class="form-control" placeholder="1cvb254ugxvfcd280ki" readonly>
                                                    </div>
                                                <div>
                                                    <div class="form-group mb-3">
                                                        <label>Seleccione horario :</label>
                                                        <select class="form-select">
                                                            <option>Hora de entrada</option>
                                                            <option>Hora de salida</option>
                                                        </select>
                                                    </div>
                                                <div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-danger w-md">Sell Coin</button>
                                                    </div>
                                                 </div>
                                             </div>
                                         </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Transactions</h4>
                                        <div class="flex-shrink-0">
                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                                                        All 
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab" role="tab">
                                                        Buy 
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#transactions-sell-tab" role="tab">
                                                        Sell  
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- end nav tabs -->
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body px-0">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                                <div class="table-responsive px-3" data-simplebar="" style="max-height: 352px;">
                                                    <table class="table align-middle table-nowrap table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">16 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">17 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">18 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                                <div class="table-responsive px-3" data-simplebar="" style="max-height: 352px;">
                                                    <table class="table align-middle table-nowrap table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                             <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">18 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">16 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">17 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane" id="transactions-sell-tab" role="tabpanel">
                                                <div class="table-responsive px-3" data-simplebar="" style="max-height: 352px;">
                                                    <table class="table align-middle table-nowrap table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">18 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">15 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">16 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">17 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            

                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">14 Mar, 2021</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Coin Value</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Recent Activity</h4>
                                        <div class="flex-shrink-0">
                                            <select class="form-select form-select-sm mb-0 my-n1">
                                                <option value="Today" selected="">Today</option>
                                                <option value="Yesterday">Yesterday</option>
                                                <option value="Week">Last Week</option>
                                                <option value="Month">Last Month</option>
                                            </select>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body px-0">
                                        <div class="px-3" data-simplebar="" style="max-height: 352px;">
                                            <ul class="list-unstyled activity-wid mb-0">

                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                        <i class="bx bx-bitcoin font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">+0.5 BTC</h6>
                                                                <div class="font-size-13">$178.53</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>

                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        <i class="mdi mdi-ethereum font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">-20.5 ETH</h6>
                                                                <div class="font-size-13">$3541.45</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>

                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                        <i class="bx bx-bitcoin font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">+0.5 BTC</h6>
                                                                <div class="font-size-13">$5791.45</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>
            
                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        <i class="mdi mdi-litecoin font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">-1.5 LTC</h6>
                                                                <div class="font-size-13">$5791.45</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>


                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                        <i class="bx bx-bitcoin font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">+0.5 BTC</h6>
                                                                <div class="font-size-13">$5791.45</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>

                                                <li class="activity-list">
                                                    <div class="activity-icon avatar-md">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        <i class="mdi mdi-litecoin font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                                <p class="text-truncate text-muted font-size-13">0xb77ad0099e21d4fca87fa4ca92dda1a40af9e05d205e53f38bf026196fa2e431</p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end me-3">
                                                                <h6 class="mb-1">+.55 LTC</h6>
                                                                <div class="font-size-13">$91.45</div>
                                                            </div>

                                                            <div class="flex-shrink-0 text-end">
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>
                
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>
                                            </ul>
                                        </div>    
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div><!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minia.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar="" class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0">

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/metisMenu.min.js"></script>
        <script src="../../assets/js/simplebar.min.js"></script>
        <script src="../../assets/js/waves.min.js"></script>
        <script src="../../assets/js/feather.min.js"></script>
        <!-- pace js -->
        <script src="../../assets/js/pace.min.js"></script>

        <!-- apexcharts -->
        <script src="../../assets/js/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="../../assets/js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../../assets/js/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="../../assets/js/dashboard.init.js"></script>

        <script src="../../assets/js/app.js"></script>

    </body>

</html>