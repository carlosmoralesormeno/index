<?php
    echo '<script src="js/jswebcam.js?'.rand(1,1000).'"></script>';
    echo '<script src="js/bsfile.js?'.rand(1,1000).'"></script>';
?>
<?php
$registro = RegistroData::getRegistroEstudiante($_GET["id_est"]);
$idRegistro = $registro->COD_ALUMNO;
?>

<section>
    <form enctype="multipart/form-data" id="form-captura">
        <?php
        echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$idRegistro.'">';
        ?>
        <div class="row">
            <div class="col-lg-12 center-block">
                <div id="well-img" class="well center-block" style="max-width: 200px;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 center-block">
                <div class="form-group">
                    <input class="filestyle" data-icon="false" type="file" id="imputImg" accept="image/*"
                        onchange="revisarImagen(this,1);">
                </div>

                <div class="form-group">
                    <div id="loading-img">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" id="btn-save-img" class="btn btn-success btn-sm btn-block pull-right"
                        data-toggle="collapse" data-target="#collapseDatos" onclick="guardarImagen(event)"><i
                            class="fas fa-save"></i>
                        Guardar
                        Captura</button>
                </div>

                
                <br><br>
                <div id="resultado"></div>

            </div>
        </div>
    </form>

</section>

<script>
$('#imputImg').filestyle({
    iconName: 'fas fa-camera',
    buttonText: 'Seleccione ...',
    buttonName: 'btn-primary'
});
</script>