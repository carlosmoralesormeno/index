<script src="js/jsnotas.js"></script>

<?php 
$estudiantes = ApoderadosData::getEstudiante($_SESSION['run_id']);
?>

<section>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading panel-menu"></div>
            <div class="panel-body">
                <h3><i class="fa fa-user-graduate"></i> Situación Académica</h3>
                <p>En este módulo podrá revisar la Situación Académica de los estudiantes inscritos en el sistema.</p>

                <?php
						if(count($estudiantes)>0):
					?>
                <div class="panel panel-primary">
                    <div class="panel-heading panel-menu"><i class="fas fa-address-book"></i> Datos de Calificaciones
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="prueba">Semestre</label>
                            <select name="semestre" id="semestre" class="form-control"
                                onchange="cargarSACalificaciones()">
                                <option value="" disabled selected>Seleccione el Semestre</option>
                                <option value="0" selected>1° Semestre</option>
                                <option value="1">2° Semestre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prueba">Nombre del Estudiante</label>
                            <select name="estudiante" id="estudiante" class="form-control"
                                onchange="cargarSACalificaciones()">
                                <option value="" disabled selected>Seleccione un Estudiante</option>
                                <?php foreach($estudiantes as $est):?>
                                <option value="<?php echo $est->COD_REGISTRO_ESC; ?>"><?php echo $est->NOMBRE; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div id="calificaciones"></div>


                <div id="loading">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
</section>