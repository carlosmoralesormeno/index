<?php 

if(isset($_GET["test-id"]) && !empty($_GET["test-id"])):
$evaluacionesConf = EvaluacionConfigData::getEvaluacionesConfig($_GET["test-id"]);
$evaconf = count($evaluacionesConf);
    if($evaconf>0):
?>

<div id="card-aplicacion" class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title"><i class="fas fa-question-circle"></i> Aplicación de Evaluaciones</h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Curso</th>
                    <th scope="col">Registro</th>
                </tr>
            </thead>
            <?php
            $n = 1; 
                if(!empty($evaluacionesConf)){
                
                    foreach($evaluacionesConf as $r):

                    echo "<tr>";
                    echo '<td><button type="button" class="btn btn-info" onclick="cargarConfigReporteTest('.$r->ID_TEST.','.$r->ID_CURSO_REG.','.$r->ID_LETRA_REG.','.$r->IDCURSO.','.$n.')"><i class="fas fa-poll-h"></i></button></td>';
                    echo "<td>$r->NOMBRE_CURSO</td>";
                    echo "<td width='90'>";

                    echo '<select name="qt" id="qt-'.$n.'" class="form-control">';
                                for($i=1;$i<=$r->MAX_TEST;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                    echo '</select>';

                    echo  "</td>";
                    echo "</tr>";

                    $n = ++$n;

                    endforeach;
                }

        echo "</table>";

        ?>
    </div>
</div>
<?php else:?>
<div class="callout callout-danger">
    <div class="d-flex justify-content-between">
        <h5><i class="icon fas fa-info"></i> No hay cursos para revisar resultados</h5>
    </div>
</div>
<?php endif;?>
<?php endif;?>