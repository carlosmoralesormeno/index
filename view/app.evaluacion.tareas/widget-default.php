<?php
$uId = $_SESSION['user_id'];
echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$uId.'">';
$curso = EstudiantesData::getCurso($uId);
$prueba = EvaluacionesData::getTestEstudiante($uId, $curso->COD_CUR_MINED_AL, $curso->LETRA_CUR_ALUM);
$estudiante = $uId;

$t = 0;

if(!empty($prueba)){
    foreach($prueba as $r):
    if($r->TEST_EST<$r->MAX_TEST_C){
        $t = ++$t;
    }
    endforeach;
}

//var_dump($curso);
?>
<?php
    echo '<script src="js/jsevaluacion.js?'.rand(1,1000).'"></script>';
?>

<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">

<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Tareas</h2>
            <small class="text-muted">Muestra las tareas asignadas al estudiante</small>
        </div>
        <div class="flex"></div>
        <div>

        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="sr">
            <div class="list-item">

                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Ayuda:</h5>
                    <p> Selecciona una tarea de la lista y luego presiona <strong><i class="fas fa-poll-h"></i>
                            Iniciar</strong></p>
                </div>



                <!-- Modulo Edición -->
                <div id="card-evaluacion-est" class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-tasks"></i> Tareas Asignadas</h5>
                    </div>

                    <?php if($t==0): ?>

                    <div class="card-body">
                        <div class="callout callout-info">
                            <div class="d-flex justify-content-between">
                                <h5><i class="icon fas fa-info"></i> No Tienes Tareas Asignadas</h5>
                            </div>
                        </div>
                    </div>

                    <?php else: ?>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre Tarea</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <?php
                            $n = 1; 
                                if(!empty($prueba)){
                                    foreach($prueba as $r):

                                    if($r->TEST_EST<$r->MAX_TEST_C && $r->HABILITADO == null){
                                        echo "<tr>";
                                        echo "<td>$n</td>";
                                        echo "<td>$r->NOMBRE_TEST</td>";
                                        echo '
                                        <td width="90">
                                        <a href="index.php?view=app.evaluacion.aplicar&id='.$r->IDTEST.'" class="ajax btn btn-info btn-sm"><i
                                        class="fas fa-poll-h"></i><span> Iniciar</span></a>
                                        </td>';
                                        echo "</tr>";
                                        $n = ++$n;
                                    }

                                    endforeach;
                                }

                                echo "</table>";
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /.Modulo Edición -->
                <!-- Mostrar Prueba-->
                <div id="resultado">
                </div>
                <!-- /.Mostrar Prueba-->

            </div>
        </div>
    </div>
</div>
<!-- /.content -->