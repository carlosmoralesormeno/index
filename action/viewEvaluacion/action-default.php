<?php 
if(isset($_GET["id_test"]) && !empty($_GET["id_test"])):
$puntajeTest = EvaluacionesData::getQuestPts($_GET["id_test"]);
$evaluacion = EvaluacionesData::getResultTest($_GET["id_test"],$_GET["id_ntest"],$_GET["id_nvl"],$_GET["id_ltr"]);
$nombreCurso = CursosData::getNombreById($_GET["id_nvl"]);
$nombreLetra = CursosData::getLetraById($_GET["id_ltr"]);
$curso = $nombreCurso->NOMBRE_CURSO.' '.$nombreLetra->NOMBRE_LETRA;
$ponderacionTest = 60;
$evaCont = count($evaluacion);
$idView = $_GET["id_view"];
?>

<style>

@media print {
  .page-sidenav, .page-header, .btn {
    display: none !important;
  }
}

</style>

<!-- Modulo Edición -->

<input type="hidden" name="nombre-curso" id="nombre-curso" value="<?php echo $curso;?>">

<div id="vista-reporte" class="card card-info card-outline">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title"><i class="fas fa-poll-h"></i> Resultados</h5>
            <div class="card-tools">
                <button type="button" name="" id="" class="btn btn-info btn-margin" onclick="recargarReporteTest(<?php echo $idView; ?>)"><i
                        class="fas fa-sync-alt"></i></button>
                <?php if($idView == 0):?>
                <button type="button" name="" id="" class="btn btn-warning btn-margin"
                    onclick="cargarPermisosReporteTest()"><i class="fas fa-share-square"></i></button>
                <?php endif;?>
                <button id="btn-new" class="btn btn-primary btn-margin" onclick="window.print();"><i
                        class="fas fa-print"></i>
                </button>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Puntaje Total</span>
                        <span class="info-box-number">
                            <?php
                        echo $puntajeTest->PUNTAJE_TEST;
                    ?>
                            <small> Ptos.</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ponderación</span>
                        <span class="info-box-number">
                            <?php
                        echo $ponderacionTest;
                    ?>
                            <small>%</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.Modulo Edición -->
    <?php
        if($evaCont>0):
    ?>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Revisión</th>
                    <th scope="col">Nota</th>
                </tr>
            </thead>

            <?php

                function notaEstudianteTest($ptsTest, $pondTest, $ptsTotal){
                    $nota_minima = 2.0;
                    $nota_maxima = 7.0;
                    $nota_aprobacion = 4.0;
                    $ponderacion = $pondTest;
                    $puntaje_total = $ptsTotal;
                    $nota_estudiante = 0.0;

                    $nota1 = (($nota_maxima - $nota_aprobacion) / ($puntaje_total * (1 - $ponderacion / 100))) * ($ptsTest - $puntaje_total) + $nota_maxima;
                    $nota2 = (($nota_minima - $nota_aprobacion) / (-($ponderacion * $puntaje_total) / 100)) * $ptsTest + $nota_minima;
                    $puntaje_minimo = $puntaje_total * $ponderacion / 100;

                    if($ptsTest >= $puntaje_minimo){
                        $nota_estudiante = $nota1;
                    }else{
                        $nota_estudiante = $nota2;
                    };

                    $nota_estudiante = number_format($nota_estudiante,1,".",",");

                    return $nota_estudiante;
                }

                $n = 1;

                    if(!empty($evaluacion)){
                    
                        foreach($evaluacion as $r):
                        echo "<td>$n</td>";
                        echo "<td>$r->NOMBRE</td>";
                        echo '<td>
                                <span class="badge bg-primary-lt">
                                    '.$r->RESPUESTAS.'
                                </span>
                                <span class="badge bg-success-lt">
                                    '.$r->CORRECTAS.'
                                </span>
                                <span class="badge bg-warning-lt">
                                    '.$r->PUNTAJE.'
                                </span>
                            </td>';
                        echo "<td>".$nota=notaEstudianteTest($r->PUNTAJE, $ponderacionTest, $puntajeTest->PUNTAJE_TEST)."</td>";
                        echo '<td width="70">
                        <a href="#" class="ajax btn btn-warning btn-sm" data-pjax-state="" onclick="cargar_imprimir_ventana('.$_GET["id_test"].','.$r->COD_REGISTRO_ESC.','.$_GET["id_ntest"].')"><i class="fas fa-print"></i></a>
                        <button type="button" class="btn btn-primary btn-sm" onclick="cargarEvaluacionEstudiante('.$r->COD_REGISTRO_ESC.',0,'.$idView.')"><i class="fas fa-book-open"></i></button>';
                        if($idView==0){
                            echo ' <button type="button" class="btn btn-danger btn-sm" onclick="EliminarEvaluacionEstudiante('.$r->COD_REGISTRO_ESC.')"><i class="fas fa-trash-alt"></i></button>';
                        }
                        echo '</td>';

                        echo "</tr>";

                        $n = ++$n;

                        endforeach;
                    }

                    echo "</table>";

                ?>
    </div>
    <?php else:?>
    <div class="card-body">
        <div class="callout callout-danger">
            <div class="d-flex justify-content-between">
                <h5><i class="icon fas fa-info"></i> No hay Resultados</h5>
            </div>
        </div>
    </div>
    <?php endif;?>

</div>

<?php endif;?>

<?php

        if(isset($_GET["id_curso"]) && !empty($_GET["id_curso"])){
            
            $cursos = CursosData::getByIdCurso($_GET["id_curso"]);
           
                echo '
                    <input type="hidden" id="id-nvl-n" value="'.$cursos->ID_CURSO_REG.'">
                    <input type="hidden" id="id-ltr-n" value="'.$cursos->ID_LETRA_REG.'">
                ';
            
        }
?>