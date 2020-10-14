<?php
$prueba = EvaluacionesData::getAllTest();
?>

<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="js/jseditortexto.js"></script>

<?php
    echo '<script src="js/jsevaluacion.js?'.rand(1,1000).'"></script>';
?>


<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">
<input type="hidden" id="update-tipo-pregunta" name="update-tipo-pregunta" value="">
<div id="insert-pregunta"></div>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edición de Preguntas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Edición de Preguntas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Modulo Pregunta -->
        <div id="collapseDatos" class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-question-circle"></i> Datos de la Evaluación</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <?php
                    if(count($prueba)>0):
                ?>
                <div class="form-group">
                    <label for="prueba">Nombre</label>
                    <select name="prueba" id="prueba" class="form-control" onchange="cargaPregunta()">
                        <option value="" disabled selected>Seleccione el Nombre de la Evaluacion</option>
                        <?php foreach($prueba as $est):
                            ?>
                        <option value="<?php echo $est->ID; ?>"><?php echo $est->NOMBRE_TEST; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small id="helpId" class="text-muted">Para agregar una evaluación, ingrese al menú Evaluaciones - Nueva</small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="pregunta">Pregunta</label>
                    <select name="pregunta" id="pregunta" class="form-control" onchange="vistaPreviaPregunta()">
                        <option value="">Seleccione la Prueba Primero</option>
                    </select>
                </div>

                <div class="form-group">
                    <!--button type="button" class="btn btn-warning btn-sm" onclick="preguntaVistaPrevia()">Vista Previa</button-->
                    <button type="button" class="btn btn-primary btn-block" onclick="btnPreguntaAlternativa(2)"><i
                            class="far fa-question-circle"></i> Nueva
                        Pregunta</button>
                </div>

                <div id="loading">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                </div>

                <div id="vista-previa-pregunta"></div>
            </div>
        </div>
        <!-- /.Modulo Pregunta -->

        <!-- Modulo Edición Alternativa-->
        <div id="form-altenativa" class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-check-circle"></i> Alternativa</h5>
            </div>
            <div class="card-body">
                <div id="vista-previa-pregunta-a"></div>
                <label for="txt-alternativa">Ingrese la alternativa, y luego presione guardar</label>
                <textarea class="mceEditor" id="txt-alternativa" name="txt-alternativa"></textarea><br>
                <div class="accion-alternativa">
                    <button id="btn-guardar-alternativa" class="btn btn-block btn-sm btn-success"
                        onclick="guardarAlternativa(event)">Nueva Alternativa</button>
                    <button id="btn-actualizar-alternativa" class="btn btn-block btn-sm btn-info"
                        onclick="actualizarAlternativa(event)">Actualizar Alternativa</button>
                    <button id="btn-eliminar-alternativa" class="btn btn-block btn-sm btn-danger"
                        onclick="eliminarAlternativa(event)">Eliminar Alternativa</button>
                    <button id="btn-volver-menu" class="btn btn-block btn-sm btn-primary"
                        onclick="ocultarAlternativa()">Volver al Menú</button>
                </div>
            </div>
        </div>
        <!-- /.Modulo Edición Alternativa-->
        <!-- Modulo Edición Pregunta-->
        <div id="form-pregunta" class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-check-circle"></i> Pregunta</h5>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="tipo-pregunta">Tipo de Respuesta</label>
                    <select name="tipo-pregunta" id="tipo-pregunta" class="form-control"
                        onchange="DetectarCambioTipoPregunta()">
                        <option value="0">Alternativas</option>
                        <option value="1">Redactar Respuesta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="txt-pregunta">Redate la Pregunta</label>
                    <textarea class="mceEditor" id="txt-pregunta" name="txt-pregunta"></textarea><br>
                </div>

                <div class="form-group">
                    <button id="btn-guardar-pregunta" class="btn btn-block btn-sm btn-success"
                        onclick="guardarPregunta(event)">Guardar Pregunta</button>
                    <button id="btn-actualizar-pregunta" class="btn btn-block btn-sm btn-info"
                        onclick="actualizarPregunta(event)">Actualizar Pregunta</button>
                    <button id="btn-eliminar-pregunta" class="btn btn-block btn-sm btn-danger"
                        onclick="eliminarPregunta(event)">Eliminar Pregunta</button>
                    <button id="btn-volver-menu" class="btn btn-block btn-sm btn-primary"
                        onclick="ocultarPregunta()">Volver al Menú</button>
                </div>

            </div>
        </div>
        <!-- /.Modulo Edición Pregunta-->

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
</div>
<!-- Final Modal -->