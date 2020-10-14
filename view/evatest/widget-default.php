<?php
$uId = $_SESSION['user_id'];
echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$uId.'">';
$curso = EstudiantesData::getCurso($uId);
$prueba = EvaluacionesData::getTestEstudiante($uId, $curso->COD_CUR_MINED_AL, $curso->LETRA_CUR_ALUM);
$estudiante = $uId;
//var_dump($curso);
?>
<?php
    echo '<script src="js/jsevaluacion.js?'.rand(1,1000).'"></script>';
?>



<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Evaluación</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Evaluación</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="alert alert-info alert-dismissible fade show">
            <button type="button" class="close" id="alert-evaluacion-help" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Ayuda</h5>
            Selecciona una evaluación de la lista y luego presiona <strong>Iniciar Evaluación</strong>
        </div>

        <!-- Modulo Edición -->
        <div id="card-evaluacion-est" class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-question-circle"></i> Seleccionar Evaluación</h5>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Evaluación</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <?php
            $n = 1; 
                if(!empty($prueba)){
                    foreach($prueba as $r):

                    if($r->TEST_EST<$r->MAX_TEST_C){
                        echo "<tr>";
                        echo "<td>$n</td>";
                        echo "<td>$r->NOMBRE_TEST</td>";
                        echo '
                        <td width="90">
                        <button type="button" class="btn btn-info btn-sm" onclick="cargarEvaluacionTest('.$r->IDTEST.','.$estudiante.')"><i class="fas fa-poll-h"></i> Iniciar Evaluación</button> 
                        </td>';
                        echo "</tr>";
                        $n = ++$n;
                    }

                    endforeach;
                }

                echo "</table>";

                ?>
            </div>
        </div>
        <!-- /.Modulo Edición -->
        <!-- Mostrar Prueba-->

        <div class="alert alert-info alert-dismissible" id="alerta-save">
            <h5><i class="icon fas fa-info"></i> Todo Listo</h5>
            La evaluación ha sido enviada.
            Revisa si tienes otra evaluación <a name="" id="" class="btn btn-warning" href="index.php?view=evatest" role="button"><i class="fas fa-sync-alt"></i> Revisar</a>
        </div>

        <div id="resultado">
        </div>

        <div id="evaluacion"></div>
        <div id="loading_spinner">
            <p><i class="fas fa-file-upload"></i> Espere un momento por favor...</p>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
        </div>
        <!-- /.Mostrar Prueba-->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<!-- Inicio Modal -->
<div class="modal bootstrap-dialog type-primary fade bs-example-modal-lg" tabindex="-1" id="modal-msj" role="dialog"
    aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title bootstrap-dialog-title" id="titulo-modal"></h4>
            </div>
            <div class="modal-body" id="texto-modal"></div>
            <div class="modal-footer" id="footer-modal">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Final Modal -->