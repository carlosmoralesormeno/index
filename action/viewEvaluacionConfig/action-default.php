<?php 

if(isset($_GET["test-id"]) && !empty($_GET["test-id"])):
$evaluacionesConf = EvaluacionConfigData::getEvaluacionesConfig($_GET["test-id"]);
$evaluacion = EvaluacionData::getEvaluacion($_GET["test-id"]); 
$evaconf = count($evaluacionesConf);
    if($evaconf>0):
?>
<input type="hidden" name="name-evaluacion" id="name-evaluacion" value="<?php echo ucwords(mb_strtolower(($evaluacion->NOMBRE_TEST))); ?>">
<div id="card-aplicacion" class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title"><i class="fas fa-question-circle"></i> Aplicación de Evaluaciones</h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Registro</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php
            $n = 1; 
                if(!empty($evaluacionesConf)){
                
                    foreach($evaluacionesConf as $r):

                    echo "<tr>";
                    echo "<td>$n</td>";
                    echo "<td>$r->NOMBRE_CURSO</td>";
                    echo "<td width='90'><input type='number'
                    class='form-control' id='eva-config-$r->ID' placeholder='' maxlength='2' value='$r->MAX_TEST' onblur='actualizarConfigurarEvaluacion($r->ID,this.value)'></td>";
                    echo '
                    <td width="90">
                    <button type="button" class="btn btn-primary btn-sm" onclick="configurarListaEstudiantes('.$r->ID.','.$r->IDCURSO.')"><i class="fas fa-users"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarConfigurarEvaluacion('.$r->ID.')"><i class="fas fa-trash-alt"></i></button> 
                    </td>';

                    echo "</tr>";

                    $n = ++$n;

                    endforeach;
                }

        echo "</table>";

        ?>
    </div>
</div>
<div id="card-lista-curso" class="card card-primary card-outline" style="display:none">
    <form action="" id="form-configurar-curso">
        
        <input type="hidden" name="id-curso" id="id-curso" value="3">
        <input type="hidden" name="id-test" id="id-test" value="">
        
        <div class="card-header">
            <div class="d-flex justify-content-between">
            <h5 class="card-title" id="titulo-curso"><i class="fas fa-users"></i> Lista de Estudiantes</h5>
                <div class="card-tools">
                    <button type="submit" class="btn btn-success btn-margin" onclick="guardarConfigurarCursoTest(event)"><i class="fas fa-save"></i></button>
                    <button type="button" class="btn btn-primary btn-margin" onclick="cerrarListaCurso()"><i class="fas fa-undo"></i></button>
                </div>

            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <div class="form-group">
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-info"></i>Importante</h5>
                    Debe seleccionar a los estudiantes que <strong>NO RINDEN</strong> la evaluación.<br>
                </div>
            </div>
            <div class="table-responsive" id="tabla-curso"></div>
        </div>
    </form>
</div>
<?php else:?>
<div class="callout callout-danger">
    <div class="d-flex justify-content-between">
        <h5><i class="icon fas fa-info"></i> No hay cursos para realizar la evaluación</h5>
    </div>
</div>

<!-- ajax page 
<script src="assets/js/ajax.js"></script>-->
<?php endif;?>
<?php endif;?>