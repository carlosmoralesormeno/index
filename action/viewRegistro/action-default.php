<?php 
$registro = RegistroData::getRegistro();
$cRegistro = RegistroData::getCantidadRegistro($_GET["id_nvl"],$_GET["id_ltr"]);
?>

<div class="panel panel-primary">
    <div class="panel-heading panel-menu"><i class="fas fa-chart-bar"></i> Información de Matrículas
    </div>

    <div class="table-responsive">

        <table class="table table-sm table-bordered table-hover ">
            <thead class="thead-light">

                <tr class="th-color-cell">
                    <th scope="col">Hombres</th>
                    <th scope="col">Mujeres</th>
                    <th scope="col">Total</th>
                    <th scope="col">Inicial</th>
                    <th scope="col">Ingreso</th>
                    <th scope="col">Retiro</th>
                    <th scope="col">Mat.Real</th>
                    <th scope="col">Católica</th>
                    <th scope="col">Evangélica</th>
                    <th scope="col">T. Valórico</th>
                    <th scope="col">JUNAEB</th>
                    <th scope="col">C. Solidario</th>
                    <th scope="col">Preferente</th>
                    <th scope="col">Prioritario</th>

                </tr>
            </thead>

            <?php
                echo "<tr>";
                echo "<td>$cRegistro->HOMBRES</td>";
                echo "<td>$cRegistro->MUJERES</td>";
                echo "<td>$cRegistro->TOTAL_MATRICULA</td>";
                echo "<td>$cRegistro->INICIAL</td>";
                echo "<td>$cRegistro->INGRESO</td>";
                echo "<td>$cRegistro->RETIRO</td>";
                echo "<td>$cRegistro->MAT_REAL</td>";
                echo "<td>$cRegistro->CATOLICA</td>";
                echo "<td>$cRegistro->EVANGELICA</td>";
                echo "<td>$cRegistro->OTRA_RELIGION</td>";
                echo "<td>$cRegistro->JUNAEB</td>";
                echo "<td>$cRegistro->CH_SOL</td>";
                echo "<td>$cRegistro->AL_SPR</td>";
                echo "<td>$cRegistro->AL_SEP</td>";
                echo "</tr>";
                echo "</table>";
            ?>

    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading panel-menu"><i class="fas fa-address-book"></i> Registro de
        Estudiantes</div>
    <div class="panel-body">
        <div class="alert alert-info fade in" id="alert-info" role="alert">
            <i class="fas fa-info-circle"></i> <strong>Recuerde </strong> <br>
            Puede ingresar el apellido, nombre, curso o RUN del estudiante para iniciar la búsqueda.
        </div>

        <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-search"></i></span>
            <input id="myInput" type="text" class="form-control" onkeyup="myFunction()" placeholder="Buscar...">
        </div>


    </div>

    <div class="table-responsive">

        <table class="table table-sm table-bordered table-hover">
            <thead>
                <tr class="th-color-cell">
                    <th scope="col">Opción</th>
                    <th scope="col">N°</th>
                    <th width="112" scope="col">RUN</th>
                    <th scope="col">Nombre Estudiante</th>
                    <th scope="col">Genero</th>
                    <th width="105" scope="col">F.Nacimiento</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Curso</th>
                    <th width="105" scope="col">F.Matrícula</th>
                    <th scope="col">Observación</th>
                </tr>
            </thead>
            <tbody id="myTable">

                <?php

                                    $registroRow = count($registro);

                                    for($i=0;$i<$registroRow;$i++){
                                    $r =$registro[$i];
                                    $runEstudiante = number_format($r->RUN_INSCRIPCION,0,",","."). "-". $r->DV_INSCRIPCION;
                                    $nombreEstudiante = $r->APAT_INSCRIPCION. " ". $r->AMAT_INSCRIPCION. " ". $r->NOMBRE_INSCRIPCION;
                                   
                                

                                    if($r->RETIRADO == 1){
                                        echo "<tr style='text-decoration:line-through; color:#FF0000'>";
                                    }else{
                                        if($r->PREMATR == 0){
                                            echo "<tr style='color:#001FC8'>";
                                        }
                                    }

                                    echo "<td width='100'>";
                    

                                    $img = "img/imgdb/".$r->COD_INSCRIPCION.".jpg";
                                    $imgdefault = "img/default-user-img.jpg";
                
                                    if(file_exists($img)){
                                        echo "
                                        <button type='button' class='btn btn-primary btn-xs' onclick='cargarDatosEstudiante($r->COD_REGISTRO_ESC)'><i class='fas fa-question'></i></button>
                                        <button type='button' class='btn btn-warning btn-xs' onclick='cargarDatosEstudiante($r->COD_REGISTRO_ESC)'><i class='fa fa-edit'></i></button>
                                        <button type='button' class='btn btn-success btn-xs' onclick='capturaFotoEstudiante($r->COD_REGISTRO_ESC)'><i class='fas fa-camera'></i></button>";
                                    }else{
                                        echo "
                                        <button type='button' class='btn btn-primary btn-xs' onclick='cargarDatosEstudiante($r->COD_REGISTRO_ESC)'><i class='fas fa-question'></i></button>
                                        <button type='button' class='btn btn-warning btn-xs' onclick='cargarDatosEstudiante($r->COD_REGISTRO_ESC)'><i class='fa fa-edit'></i></button>
                                        <button type='button' class='btn btn-danger btn-xs' onclick='capturaFotoEstudiante($r->COD_REGISTRO_ESC)'><i class='fas fa-camera'></i></button>";
                                    }
                
                                    echo "</td>";
                                    echo "<td>$r->NUM_MATR</td>";
                                    echo "<td scope='row' >$runEstudiante</td>";
                                    echo "<td>$nombreEstudiante</td>";
                                    echo "<td>$r->ABREV_GENERO</td>";
                                    echo "<td>$r->FNAC_INCRIPCION</td>";
                                    echo "<td>$r->EDAD</td>";
                                    echo "<td>$r->CURSOEST</td>";
                                    echo "<td>$r->FECHA_INGRESO</td>";
                                    echo "<td>$r->FECHA_RETIRO</td>";
                                    echo "</tr>";
                                    }
                                    
                                    echo "</tbody>";
                                    echo "</table>";

                                    ?>

    </div>
</div>
<script>
$(function() {
    $("[data-toggle=popover]").popover();
});


var accent_map = {
    'á': 'a',
    'é': 'e',
    'è': 'e',
    'í': 'i',
    'ó': 'o',
    'ú': 'u',
    'Á': 'a',
    'É': 'e',
    'è': 'e',
    'Í': 'i',
    'Ó': 'o',
    'Ú': 'u'
};

function accent_fold(s) {
    if (!s) {
        return '';
    }
    var ret = '';
    for (var i = 0; i < s.length; i++) {
        ret += accent_map[s.charAt(i)] || s.charAt(i);
    }
    return ret;
};


function myFunction() {

    var input = accent_fold($('#myInput').val().toLowerCase());
    $("#myTable tr").filter(function() {
        $(this).toggle(accent_fold($(this).text()).toLowerCase().indexOf(input) > -1)
    });

};
</script>