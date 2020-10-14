<?php
$cursos = CursosData::getAll();
$rut_id = $_SESSION['run_id'];
?>

<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="js/jstrabajo.js"></script>
<?php
    //echo '<script src="js/jswebcam.js?'.rand(1,1000).'"></script>';
    echo '<script src="js/bsfile.js?'.rand(1,1000).'"></script>';
?>


<section>

    <div id="id-reg"></div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading panel-menu"></div>
            <div class="panel-body">
                <h3><i class="fas fa-file-upload"></i> Administrador de Documentos</h3>
                <p>En este módulo podrá crear espacios para almacenar documentos de sus estudiantes.</p>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordionPrueba" href="#collapseDatos"
                                class="arrow-click" aria-expanded="true" aria-controls="collapseDatos">
                                <i class="fas fa-folder-open"></i> Datos del Documento
                                <span class="glyphicon pull-right glyphicon-menu-up" aria-hidden="true"></span>
                            </a>
                        </h3>
                    </div>
                    <div id="collapseDatos" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="headingDatos" style="" aria-expanded="true">
                        <div class="panel-body">

                            <form method="post" action="index.php?action=addDocumento">
                                <?php
                                echo '<input type="hidden" name="id-rut" id="id-rut" value="'.$rut_id.'">'; 
                            ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="txt_nombre">Nombre del Documento</label>
                                            <input type="text" name="txt_nombre" id="txt_nombre" class="form-control"
                                                required="required" placeholder="Ingrese el nombre del trabajo"
                                                aria-describedby="helpId">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-2">
                                        <?php if(count($cursos)>0):?>
                                        <div class="form-group">
                                            <label for="id_curso">Curso</label>
                                            <select name="id_curso" id="id_curso" class="form-control"
                                                required="required" onchange="cargarCurso()">
                                                <option value="" disabled selected>Seleccione el Curso</option>
                                                <?php foreach($cursos as $cur):?>
                                                <option value="<?php echo $cur->ID_CURSO; ?>">
                                                    <?php echo $cur->NOMBRE_CURSO.' '.$cur->NOMBRE_LETRA; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="id_asignatura">Asignatura</label>
                                            <select name="id_asignatura" id="id_asignatura" class="form-control"
                                                required="required">
                                                <option value="" disabled selected>Seleccione Primero Curso</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="id_atributo">Atributo</label>
                                            <select name="id_atributo" id="id_atributo" class="form-control"
                                                required="required" onchange="estadoAtributo()">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Evaluado</option>
                                                <option value="2">Material Apoyo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="fecha" id="lb_fecha">Fecha de Entrega</label>
                                            <input type="date" name="fecha" id="fecha" class="form-control"
                                                aria-describedby="helpId">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="txt_objetivo">Objetivo</label>
                                            <textarea name="txt_objetivo" id="txt_objetivo" class="form-control"
                                                rows="3" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="filestyle" data-icon="false" type="file" id="imputImg"
                                                required="required" accept=".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg" onchange="revisarImagen(this,1);">
                                        </div>
                                    </div>


                                    <div class="col-lg-2">

                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block pull-right"><i
                                                    class="fas fa-save"></i>
                                                Guardar Trabajo</button>
                                        </div>
                                    </div>


                                </div>



                            </form>


                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordionPrueba" href="#collapseDatos"
                                class="arrow-click" aria-expanded="true" aria-controls="collapseDatos">
                                <i class="fas fa-file-alt"></i> Documentos Agregados
                                <span class="glyphicon pull-right glyphicon-menu-up" aria-hidden="true"></span>
                            </a>
                        </h3>
                    </div>
                    <div id="collapseDatos" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="headingDatos" style="" aria-expanded="true">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="th-color">
                                            <th>Opción</th>
                                            <th>Nombre Documento</th>
                                            <th>Curso</th>
                                            <th>Fecha de Entrega</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Test 1</td>
                                            <td>1° Medio A</td>
                                            <td>11-10-2019</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Inicio Modal -->
                <div class="modal bootstrap-dialog type-primary fade bs-example-modal-lg" tabindex="-1" id="modal-msj"
                    role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <h4 class="modal-title bootstrap-dialog-title" id="titulo-modal"></h4>
                            </div>
                            <div class="modal-body" id="texto-modal"></div>
                            <div class="modal-footer" id="footer-modal">
                                <button type="button" class="btn btn-default btn-sm"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final Modal -->
</section>
<script>
$('#imputImg').filestyle({
    iconName: 'fas fa-file',
    buttonText: 'Elegir Documento',
    buttonName: 'btn-primary'
});
</script>
<script>
ocultarFechaEntrega()
</script>