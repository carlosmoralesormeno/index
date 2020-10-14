<?php 
$uId = $_SESSION['user_id'];
echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$uId.'">';
$prueba = EvaluacionesData::getTestDocente($uId);
$docente = $uId;
$totalEval = count($prueba);
?>

<div id="card-evaluaciones" class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title"><i class="fas fa-question-circle"></i> Seleccionar Evaluación</h5>
    </div>
    <?php if($totalEval>0): ?>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Evaluación</th>
                    <th scope="col">Registro</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php
                $n = 1; 
                if(!empty($prueba)){
                    foreach($prueba as $r):
                        echo "<tr>";
                        echo '<td><button type="button" class="btn btn-info" onclick="cargarPermisoReporteTest('.$r->IDTEST.','.$r->ID_CURSO_REG.','.$r->ID_LETRA_REG.','.$r->IDCURSOP.',1,'.$n.')"><i class="fas fa-poll-h"></i></button> </td>';
                        echo "<td>$r->NOMBRE_TEST<br><small><strong>$r->NOMBRE_CURSO</strong></small> </td>";
                        echo "<td width='90'>";
                        echo '<select name="qt" id="qt-'.$n.'" class="form-control">';
                            for($i=1;$i<=$r->MAXTEST;$i++){
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
    <?php else: ?>
    <div class="card-body">
        <div class="callout callout-danger">
            <div class="d-flex justify-content-between">
                <h5><i class="icon fas fa-info"></i> No hay evaluaciones</h5>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>