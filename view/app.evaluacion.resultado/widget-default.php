<?php 
$id=$_GET["id"];
$personas = PersonasData::getAllPersonas();
$evaluacion = EvaluacionData::getEvaluacion($_GET["id"]); 
?>
<?php
    //echo '<script src="js/jseditortexto.js?'.rand(1,1000).'"></script>';
?>
<input type="hidden" id="id-prueba" name="id-prueba" value="">
<input type="hidden" id="id-curso" name="id-prueba" value="">
<input type="hidden" id="id-letra" name="id-prueba" value="">
<input type="hidden" id="id-estudiante" name="id-prueba" value="">
<input type="hidden" id="id-curso-p" name="id-curso-p" value="">
<input type="hidden" id="id-qt" name="id-curso-p" value="">

<input type="hidden" id="id-pregunta-a" name="id-pregunta-a" value="">
<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">
<input type="hidden" id="update-tipo-pregunta" name="update-tipo-pregunta" value="">
<div id="insert-pregunta"></div>
<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Resultados <?php echo ucwords(mb_strtolower(($evaluacion->NOMBRE_TEST))); ?></h2>
            <small id="titulo-nombre-curso"></small>
        </div>
        <div class="flex"></div>
        <div>
            <button id="btn-new" class="btn btn-info btn-margin"
                onclick="<?php echo 'cargarRevisionEvaluacion('.$id.')';?>"><i class="fas fa-poll-h"></i></button>

            <a href="index.php?view=app.evaluacion.admin" class="ajax btn btn-primary btn-margin"><i
                    class="fas fa-undo"></i></a>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="loading m-4"></div>
        <div id="reporte"></div>
    </div>
</div>
<!-- /.content -->
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

<!-- modal-aplicar-->
<div class="modal fade" id="modal-permiso-evaluacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-permiso-evaluacion"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id-docente-p">Docente</label>
                            <select name="docente" id="id-docente-p" class="form-control">
                                <option value="" disabled selected>Seleccione el Docente</option>
                                <?php foreach($personas as $per):
                                    ?>
                                <option value="<?php echo $per->RUN_PERSONA; ?>">
                                    <?php echo $per->NOMBRE_PERSONA; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <button id="btn-guardar-configuracion" class="btn btn-block btn-success"
                    onclick="guardarPermisosReporteTest()"><i class="fas fa-plus"></i> Agregar</button><br>


                <div id="tabla-permisos"></div>

                <button id="btn-volver-menu" data-dismiss="modal" class="btn float-right btn-primary"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php echo '<script>cargarRevisionEvaluacion('.$id.')</script>';?>
