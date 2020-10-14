<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Carlos Morales Ormeño">
    <meta name="description"
        content="Sistema Administrativo Integral Educacional (SAIE), es un sistema de gestión escolar capaz de ayudar al proceso administrativo dentro de las instituciones educativas">
    <meta property="og:title" content="Sistema Administrativo Institucional Educacional SAIE">

    <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <title>SAIE | Santa Cruz de Larqui</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- style -->
    <!-- build:css ./assets/css/site.min.css -->
    <link rel="stylesheet" href="libs/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/theme.css" type="text/css" />
    <?php echo '<link rel="stylesheet" href="assets/css/style.css?'.rand(1,1000).'">';?>
    <link type="text/css" rel="stylesheet" href="css/prism.css" />
    <!-- System -->
    <script src="libs/jquery/dist/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>


<?php
    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""):
    echo '<script src="js/jsevaluacion.js?'.rand(1,1000).'"></script>';
    $usuario = UsuariosData::getUsuario($_SESSION['run_id'], $_SESSION['type_user']);
    $uId = $_SESSION['type_user'];
    $adm = $_SESSION['admin'];

    $len= strlen($usuario->NOMBRE_USUARIO);
    $string = $usuario->NOMBRE_USUARIO;
    $newString = "";
    for ($i = 0; $i <= $len; $i++) {
        $letra = substr($string, $i, 1);
        if($letra!=" "){
            $newString = $newString .''. $letra;
        }else{
            break;
        }
    }
    $nombreUsuario = $newString.' '.$usuario->APELLIDO_USUARIO;
?>

<body class="layout-row">
    <!-- ############ Aside START-->
    <div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade nav-expand" aria-hidden="true">
        <div class="sidenav h-100 modal-dialog bg-light">
            <!-- sidenav top -->
            <div class="navbar">
                <!-- brand -->
                <a href="./" class="navbar-brand ">
                    <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor">
                        <g class="loading-spin" style="transform-origin: 256px 256px">
                            <path
                                d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z">
                            </path>
                        </g>
                    </svg>
                    <!-- <img src="../assets/img/logo.png" alt="..."> -->
                    <span class="hidden-folded d-inline l-s-n-1x ">Saie</span>
                </a>
                <!-- / brand -->
            </div>
            <!-- Flex nav content -->
            <div class="flex scrollable hover">
                <div class="nav-stacked nav-active-primary auto-nav" data-nav="">
                    <ul class="nav">
                        <li class="nav-header">
                            <span class="text-xs hidden-folded">Principal</span>
                        </li>
                        <li class="active">
                            <a href="./">
                                <span class="nav-icon"><i class="fas fa-home"></i></span>
                                <span class="nav-text">Inicio</span>
                                <span class="nav-badge"><b class="badge badge-pill bg-danger theme">1</b></span>
                            </a>
                        </li>
                        <?php if($uId==2):?>
                        <li>
                            <a href="./">
                                <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                                <span class="nav-text">Ajustes</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if($uId==2):?>
                        <li>
                            <a href="index.php?view=cursos&mnu=0">
                                <span class="nav-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-text">Estudiantes</span>
                                </span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if($uId==2):?>
                        <li>
                            <a href="index.php?view=app.evaluacion.admin">
                                <span class="nav-icon"><i class="fas fa-file-alt"></i></span>
                                <span class="nav-text">Evaluaciones</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if($uId==1):?>
                        <li>
                            <a href="index.php?view=app.evaluacion.tareas">
                                <span class="nav-icon"><i class="fas fa-tasks"></i></span>
                                <span class="nav-text">Tareas</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <li class="nav-header hidden-folded">
                            <span class="text-xs">Componentes</span>
                        </li>
                        <li>
                            <a href="#">
                                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg></span>
                                <span class="nav-text">Calendario</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- sidenav bottom -->
            <div class="py-2 mt-2 b-t no-shrink">
                <ul class="nav no-border">
                    <li>
                        <a href="logout.php">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-power">
                                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                    <line x1="12" y1="2" x2="12" y2="12"></line>
                                </svg>
                            </span>
                            <span class="nav-text">Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ############ Aside END-->
    <div id="main" class="layout-column flex">
        <!-- ############ Header START-->
        <div id="header" class="page-header ">
            <div class="navbar navbar-expand-lg">
                <!-- brand -->
                <a href="./" class="navbar-brand d-lg-none">
                    <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor">
                        <g class="loading-spin" style="transform-origin: 256px 256px">
                            <path
                                d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z">
                            </path>
                        </g>
                    </svg>
                    <!-- <img src="../assets/img/logo.png" alt="..."> -->
                    <span class="hidden-folded d-inline l-s-n-1x d-lg-none">Saie</span>
                </a>
                <ul class="nav navbar-menu order-1 order-lg-2">
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link px-2" data-toggle="fullscreen" data-plugin="fullscreen">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-2" data-toggle="dropdown">
                            <i data-feather="settings"></i>
                        </a>
                        <!-- ############ Setting START-->
                        <div class="dropdown-menu dropdown-menu-center mt-3 w-md animate fadeIn">
                            <div class="setting px-3">
                                <div class="mb-2 text-muted">
                                    <strong>Tema</strong>
                                </div>
                                <div class="mb-2 text-muted">
                                    <strong>Color:</strong>
                                </div>
                                <div class="mb-2">
                                    <label class="radio radio-inline ui-check ui-check-md">
                                        <input type="radio" name="bg" value="">
                                        <i></i>
                                    </label>
                                    <label class="radio radio-inline ui-check ui-check-color ui-check-md">
                                        <input type="radio" name="bg" value="bg-dark">
                                        <i class="bg-dark"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- ############ Setting END-->
                    </li>
                    <!-- Notification -->
                    <!-- User dropdown menu -->
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link d-flex align-items-center px-2 text-color">
                            <span class=" mx-2 d-none l-h-1x d-lg-block text-right"><small
                                    class="text-fade d-block mb-1">Hola,
                                    Bienvenido</small><?php echo $nombreUsuario;?></span>
                            <span class="avatar w-24" style="margin: -2px;"><img src="./img/logo.png" alt="..."></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right w mt-3 animate fadeIn">
                            <a class="dropdown-item" href="#"><?php echo $nombreUsuario;?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
                        </div>
                    </li>
                    <!-- Navarbar toggle btn -->
                    <li class="nav-item d-lg-none">
                        <a href="#" class="nav-link px-2" data-toggle="collapse" data-toggle-class
                            data-target="#navbarToggler">
                            <i data-feather="search"></i>
                        </a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-1" data-toggle="modal" data-target="#aside">
                            <i data-feather="menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ############ Footer END-->
        <!-- ############ Content START-->
        <div id="content" class="flex ">
            <!-- ############ Main START-->
            <div>
                <?php View::load("index"); ?>
            </div>
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
        <!-- ############ Footer START-->
        <div id="footer" class="page-footer hide">
            <div class="d-flex p-3">
                <span class="text-sm text-muted flex">&copy; Copyright. Carlos Morales Ormeño</span>
                <div class="text-sm text-muted">Version 8.6.7.20</div>
            </div>
        </div>
        <!-- ############ Footer END-->
    </div>
    <!-- build:js assets/js/site.min.js -->
    <!-- jQuery -->
    <!-- ajax page -->
    <script src="libs/pjax/pjax.min.js"></script>
    <script src="assets/js/ajax.js"></script>
    <!-- lazyload plugin -->
    <script src="assets/js/lazyload.config.js"></script>
    <script src="assets/js/lazyload.js"></script>
    <script src="assets/js/plugin.js"></script>
    <!-- scrollreveal-->
    <script src="libs/scrollreveal/dist/scrollreveal.min.js"></script>
    <!-- feathericon -->
    <script src="libs/feather-icons/dist/feather.min.js"></script>
    <script src="assets/js/plugins/feathericon.js"></script>
    <!-- theme -->
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/utils.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="js/sweetalert2.all.min.js"></script>

    <!-- endbuild -->
</body>

<?php endif; ?>

<?php
    if(isset($_SESSION["user_id"])){
    }else{
        Action::execute("login",array()); 
    }
?>

</html>