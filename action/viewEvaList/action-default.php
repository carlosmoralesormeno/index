<?php 
if(isset($_GET["id_rut"]) && !empty($_GET["id_rut"])):
$evaluaciones = EvaluacionData::getEvaluaciones($_GET["id_rut"]);
$personas = PersonasData::getAllPersonas();
$cursos = CursosData::getAll();
//contar el total de evaluaciones
$totalEval = count($evaluaciones);
echo '<input type="hidden" id="prueba" value="">';
?>
<div id="id-reg"></div>

<!-- Modulo Edición -->

<?php if($totalEval>0): ?>

<div class="table-responsive">
    <table class="table table-theme table-row v-middle">
        <thead>
            <tr>
                <th class="text-muted" style="width:20px;">#</th>
                <th class="text-muted" style="width:200px;">Nombre</th>
                <th class="text-muted" style="width:150px;">Asignatura</th>
            </tr>
        </thead>

        <?php
                $n = 1;
                    if(!empty($evaluaciones)){
                        foreach($evaluaciones as $r):
                        $OASub = "";
                        $OALen = strlen($r->OBJETIVO_APRENDIZAJE_TEST);
                        if ($OALen>50){
                            $OASub = substr($r->OBJETIVO_APRENDIZAJE_TEST, 0, 50)."...";
                        }else{
                            $OASub = $r->OBJETIVO_APRENDIZAJE_TEST;
                        }

                        $HASub = "";
                        $HALen = strlen($r->HABILIDADES_TEST);
                        if ($HALen>50){
                            $HASub = substr($r->HABILIDADES_TEST, 0, 50)."...";
                        }else{
                            $HASub = $r->HABILIDADES_TEST;
                        }
                        echo "<td>$n</td>";
                        echo '<td class="flex">
                        <a href="index.php?view=app.evaluacion.editar&id='.$r->ID_TEST.'" class="ajax item-title text-color "><strong>'.$r->NOMBRE_TEST.'</strong></a><br>
                        <small><strong>OA: </strong>'.$OASub.'</small><br>
                        <small><strong>Habilidades: </strong> '.$HASub.'</small><br>';
                        echo '
                        <button type="button" class="btn btn-warning btn-margin" onclick="cargarEvaluacionEditar('.$r->ID_TEST.')"><i class="fas fa-pencil-alt"></i></button>
                        <a href="index.php?view=app.evaluacion.editar&id='.$r->ID_TEST.'" class="ajax btn btn-primary"><i class="fas fa-file-alt"></i></i></a>
                        <button type="button" class="btn btn-danger btn-margin" onclick="cargarConfigurarEvaluacion('.$r->ID_TEST.')"><i class="fas fa-sliders-h"></i></button>
                        <a href="index.php?view=app.evaluacion.resultado&id='.$r->ID_TEST.'" class="ajax btn btn-info"><i class="fas fa-poll-h"></i></i></a></td>';
                        //echo "<td>$r->OBJETIVO_APRENDIZAJE_TEST</td>";
                        echo "<td>$r->NOMBRE_ASIGNATURA</td>";
                        /*echo '<td>
                        <div class="item-action dropdown">
                            <a href="#" data-toggle="dropdown" class="text-muted">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                <a class="dropdown-item" onclick="cargarEvaluacionEditar('.$r->ID_TEST.')">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" cargarEvaluacionVistaPrevia('.$r->ID_TEST.')">
                                    <i class="fas fa-file-alt"></i> Crear
                                </a>
                                <a class="dropdown-item" onclick="cargarConfigurarEvaluacion('.$r->ID_TEST.')">
                                    <i class="fas fa-sliders-h"></i> Configurar
                                </a>
                                <a class="dropdown-item" onclick="cargarRevisionEvaluacion('.$r->ID_TEST.')">
                                    <i class="fas fa-poll-h"></i> Resultado
                                </a>
                            </div>
                        </div>
                        </td>';*/
                        echo "</tr>";
                        $n = ++$n;
                        endforeach;
                    }
                    echo "</table>";
                ?>
</div>

<?php else: ?>


<div class="callout callout-danger">
    <div class="d-flex justify-content-between">
        <h5><i class="icon fas fa-info"></i> No hay evaluaciones</h5>
    </div>
</div>

<?php endif; ?>

<!-- modal-Reporte-->
<div class="modal fade" id="modal-reporte" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-poll-h"></i> Seleccionar Resultados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="reporte-curso"></div>
                <button id="btn-volver-menu" data-dismiss="modal" class="btn float-right btn-primary"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-msj" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-modal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="texto-modal">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="" id="" class="btn btn-primary" data-dismiss="modal"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endif;?>