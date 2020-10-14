<script src="js/jsnotas.js"></script>

<?php 
$estudiante = EstudiantesData::getEstudianteById($_SESSION['user_id']);
?>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading panel-menu"></div>
            <div class="panel-body">
                <h3><i class="fa fa-user-graduate"></i> Situación Académica</h3>
                <p>En este módulo podrás revisar tu Situación Académica en el sistema.</p>
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
                            <select name="estudiante" id="estudiante" class="form-control" disabled>
                                <option value="<?php echo $estudiante->COD_REGISTRO_ESC; ?>"><?php echo $estudiante->NOMBRE;?>
                                </option>
                            </select>
                           
                        </div>
                    </div>
                </div>
                <script>cargarSACalificaciones()</script>  
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