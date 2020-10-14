<?php
    $cursos = CursosData::getAll();
    $ensenanza = EnsenanzaData::getAll();
    $menu = $_GET["mnu"];
    $viewMenu = "";
    $viewTitle = "";

    switch ($menu){
        case 0: 
            $viewMenu = "registrocurso";
            $viewTitle = "Cursos";
        break;
        case 2: 
            $viewMenu = "situacionacademica";
            $viewTitle = "Situación Académica";
        break;
        case 3: 
            $viewMenu = "calificaciones";
            $viewTitle = "Ingreso de Calificaciones";
        break;
        case 4: 
            $viewMenu = "calificacionesview";
            $viewTitle = "Calificaciones";
        break;
        case 5: 
            $viewMenu = "inasistencia";
            $viewTitle = "Ingreso de Inasistencia";
        break;
    }
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $viewTitle ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active"><?php echo $viewTitle ?></li>          
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Información:</h5>
            Cada curso cuenta con el número actual de estudiantes.
        </div>
        <!-- Modulo de Cursos -->
        <?php
            $ensenanzaRow = count($ensenanza);
            $cursosRows = count($cursos);
            $a=0;

            for($e=0;$e<$ensenanzaRow;$e++){
                $en =$ensenanza[$e];

                echo '
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-address-book"></i> '.$en->NOMBR_ENSENANZA.'</h5>
                        </div>
                    <div class="card-body">
                ';
                        for($n=0;$n<$cursosRows;$n++){
                            $r =$cursos[$n];
                            if($en->COD_ID == $r->ID_ENSENANZA_REG){
                                echo "<a href='index.php?view=".$viewMenu."&id_nvl=".$r->ID_CURSO_REG."&id_ltr=".$r->ID_LETRA_REG."' class='btn btn-primary btn-margin' role='button'>
                                <i class='fa fa-book-open'></i> ".$r->NOMBRE_CURSO." ".$r->NOMBRE_LETRA." <span class='badge'>".$r->TOTAL_MATRICULA."</span> </a>";
                                }
                            }
                        echo "</div>";
                    echo "</div>";
                    }
        ?>
        <!-- /.Modulo de Cursos -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->