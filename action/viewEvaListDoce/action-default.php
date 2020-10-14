<?php 
if(isset($_GET["id_rut"]) && !empty($_GET["id_rut"])):
$evaluaciones = EvaluacionData::getEvaluaciones($_GET["id_rut"]);
$totalEval = count($evaluaciones);
$cursos = CursosData::getAll();
echo '<input type="hidden" id="prueba" value="">';
?>
<div id="id-reg"></div>

<script src="plugins/tinymce/tinymce.min.js"></script>
<?php
    echo '<script src="js/jseditortexto.js?'.rand(1,1000).'"></script>';
?>

<!--div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Evaluaciones</span>
                <span class="info-box-number">
                    <?php
                        echo $totalEval;
                        /*if ($totalEval == 0){
                            echo '<small> Evaluaciones</small>';
                        }elseif($totalEval == 1){
                            echo '<small> Evaluación</small>';
                        }elseif($totalEval>1){
                            echo '<small> Evaluaciones</small>';
                        }*/
                    ?>
                </span>
            </div>
            /.info-box-content >
        </div>
    </div>

</div-->


<!-- Modulo Edición -->
<div id="card-evaluaciones" class="card card-info card-outline">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title"><i class="fas fa-file-alt"></i> Evaluaciones</h5>
            <button type="button" name="" id="" class="btn btn-primary btn-sm" onclick="cargarNuevaEvaluacion()"><i
                    class="fas fa-plus-square"></i> Agregar</button>
        </div>
    </div>


    <!-- /.Modulo Edición -->

    <?php if($totalEval>0): ?>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <!--th scope="col">Objetivo de Aprendizaje</th-->
                    <th scope="col">Asignatura</th>
                    <th scope="col">Opciones</th>
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
                        echo "<td><strong>$r->NOMBRE_TEST</strong> <br><small><strong>OA:</strong> $OASub</small><br><small><strong>Habilidades:</strong> $HASub</small></td>";
                        //echo "<td>$r->OBJETIVO_APRENDIZAJE_TEST</td>";
                        echo "<td>$r->NOMBRE_ASIGNATURA</td>";
                        echo '<td width="70">
                        <button type="button" class="btn btn-warning btn-sm" onclick="cargarEvaluacionEditar('.$r->ID_TEST.')"><i class="fas fa-pencil-alt"></i> Editar</button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="cargarEvaluacionVistaPrevia('.$r->ID_TEST.')"><i class="fas fa-file-alt"></i> Crear</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="cargarConfigurarEvaluacion('.$r->ID_TEST.')"><i class="fas fa-sliders-h"></i> Configurar</button>
                        <button type="button" class="btn btn-info btn-sm" onclick="cargarRevisionEvaluacion('.$r->ID_TEST.')"><i class="fas fa-poll-h"></i> Resultado</button>
                        </td>';
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

<!-- modal-pregunta -->
<div class="modal fade" id="modal-preg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="far fa-check-circle"></i> Pregunta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tipo-pregunta">Tipo de Pregunta</label>
                    <select name="tipo-pregunta" id="tipo-pregunta" class="form-control"
                        onchange="DetectarCambioTipoPregunta()">
                        <option value="0">Alternativas</option>
                        <option value="1">Pregunta Abierta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txt-pregunta">Redate la Pregunta</label>
                    <textarea class="mceEditor" id="txt-pregunta" name="txt-pregunta"></textarea><br>
                </div>

                <div class="form-group">
                    <button id="btn-guardar-pregunta" class="btn btn-success" onclick="guardarPregunta(event)"><i
                            class="fas fa-save"></i> Guardar</button>
                    <button id="btn-actualizar-pregunta" class="btn btn-info" onclick="actualizarPregunta(event)"><i
                            class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-pregunta" class="btn btn-danger" onclick="eliminarPregunta(event)"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo-alt"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-alternativa-->
<div class="modal fade" id="modal-alt" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-list"></i> Alternativas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="vista-previa-pregunta-a"></div>
                <label for="txt-alternativa">Ingrese la alternativa, y luego presione Guardar</label>
                <textarea class="mceEditor" id="txt-alternativa" name="txt-alternativa"></textarea><br>

                <div class="accion-alternativa">
                    <button id="btn-guardar-alternativa" class="btn btn-success" onclick="guardarAlternativa(event)"><i
                            class="fas fa-plus"></i> Agregar</button>
                    <button id="btn-actualizar-alternativa" class="btn btn-info"
                        onclick="actualizarAlternativa(event)"><i class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-alternativa" class="btn btn-danger" onclick="eliminarAlternativa(event)"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-aplicar-->
<div class="modal fade" id="modal-aplicacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-aplicacion"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="id-curso">Curso</label>
                            <select name="curso" id="id-curso-c" class="form-control">
                                <option value="" disabled selected>Seleccione el Curso</option>
                                <?php foreach($cursos as $cur):
                                    ?>
                                <option value="<?php echo $cur->ID_CURSO; ?>">
                                    <?php echo $cur->NOMBRE_CURSO.' '.$cur->NOMBRE_LETRA; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="id-intentos">Registro</label>
                            <input type="number" class="form-control" name="Intentos" id="id-intentos"
                                aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                </div>

                <button id="btn-guardar-configuracion" class="btn btn-block btn-success"
                    onclick="guardarConfigurarEvaluacion()"><i class="fas fa-plus"></i> Agregar</button><br>

                <!-- Modulo Edición -->

                <div id="tabla-evaluacion"></div>

                <button id="btn-volver-menu" data-dismiss="modal" class="btn float-right btn-primary"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
<?php endif;?>