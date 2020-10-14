<?php 
$idCurso = $_GET["id_nvl"];
$idLetra = $_GET["id_ltr"];
echo '<input type="hidden" name="" id="id-nvl" class="form-control" value="'.$idCurso.'">';
echo '<input type="hidden" name="" id="id-ltr" class="form-control" value="'.$idLetra.'">';
?>

<?php
    echo '<script src="js/jsregistro.js?'.rand(1,1000).'"></script>';
?>
<section>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading panel-menu"></div>
            <div class="panel-body">
                <h3><i class="fa fa-book-open"></i> Libro de Registro</h3>
                <p>Permite visualizar la información de los estudiantes que actualmente se encuentran registrados en el
                    sistema. </p>

                <div id="loading">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
                <div id="registro-curso">

                </div>
            </div>
</section>

<!-- Inicio Modal -->
<div class="modal bootstrap-dialog type-primary fade" tabindex="-1" id="modal-msj" role="dialog"
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
                <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Final Modal -->

<script>
cargarRegistro()
</script>