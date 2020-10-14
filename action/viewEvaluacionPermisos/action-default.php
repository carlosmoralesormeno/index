<?php 

if(isset($_GET["test-id"]) && !empty($_GET["test-id"])):
$evaluacionesConf = EvaluacionConfigData::getEvaluacionesPerm($_GET["test-id"], $_GET["curso-p-id"]);
$evaconf = count($evaluacionesConf);
    if($evaconf>0):
?>

<div id="card-permiso" class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title"><i class="fas fa-share-square"></i> Evaluacion Compartida</h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <?php
            $n = 1; 
                if(!empty($evaluacionesConf)){
                
                    foreach($evaluacionesConf as $r):

                    echo "<tr>";
                    echo "<td>$n</td>";
                    echo "<td>$r->NOMBRE_CURSO</td>";
                    echo "<td>$r->NOMBRE_DOCENTE</td>";
                    echo '
                    <td width="90">
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarConfigurarPermiso('.$r->ID.')"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                    </td>';

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
        <h5><i class="icon fas fa-info"></i> No hay permisos de evaluación</h5>
    </div>
</div>
<?php endif;?>
<?php endif;?>