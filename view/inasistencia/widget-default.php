<script src="js/jsinasistencia.js"></script>

<?php 
$asignaturas = AsignaturasData::getAll($_GET["id_nvl"]);
$curso = $_GET["id_nvl"];
$letra = $_GET["id_ltr"];
echo '<input type="hidden" id="id-curso" value="'.$curso.'">';
echo '<input type="hidden" id="id-letra" value="'.$letra.'">';
?>

<section>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading panel-menu"></div>
            <div class="panel-body">
                <h3><i class="fa fa-user-graduate"></i> Ingreso de Inasistencia</h3>
                <p>Puede ingresar las inasistencias de cada estudiante asociada al curso.</p>

                <?php
						if(count($asignaturas)>0):
					?>
                <div class="panel panel-primary" id="panel-datos">
                    <div class="panel-heading panel-menu"><i class="fas fa-address-book"></i> Datos de Calificaciones
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="prueba">Semestre</label>
                            <select name="semestre" id="semestre" class="form-control" onchange="cargarInasistencia()"
                                onclick="esconderMensaje()">
                                <option value="" disabled selected>Seleccione el Semestre</option>
                                <option value="0" selected>1° Semestre</option>
                                <option value="1">2° Semestre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prueba">Asignatura</label>
                            <select name="asignatura" id="asignatura" class="form-control"
                                onchange="cargarInasistencia()" onclick="esconderMensaje()">
                                <option value="" disabled selected>Seleccione una Asignatura</option>
                                <?php foreach($asignaturas as $est):?>
                                <option value="<?php echo $est->COD_ASIGNATURA_NOTA_ASIGNATURA_CURSO; ?>">
                                    <?php echo $est->NOMBRE_ASIGNATURA; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div id="mensaje"></div>
                <div id="loading">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
                <div id="calificaciones"></div>

            </div>
        </div>
</section>