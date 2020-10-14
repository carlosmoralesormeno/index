<?php
//$uId = $_SESSION['user_id'];
//echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$uId.'">';
//$curso = EstudiantesData::getCurso($uId);

//$estudiante = $uId;
$t=1;
//var_dump($curso);
?>


<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Carga Masiva</h2>
            <small class="text-muted">Cargar Estudiantes al Curso por CSV</small>
        </div>
        <div class="flex"></div>
        <div>

        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="sr">

            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Ayuda:</h5>
                <p> Antes de cargar a los estudiantes, descarge el archivo csv e ingrese los datos solicitados
                    <strong><i class="fas fa-poll-h"></i>
                        Iniciar</strong></p>
            </div>



            <!-- Modulo Edición -->
            <div id="card-evaluacion-est" class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-tasks"></i> Estudiantes</h5>
                </div>

                <?php if($t==0): ?>

                <div class="card-body">
                    <div class="callout callout-info">
                        <div class="d-flex justify-content-between">
                            <h5><i class="icon fas fa-info"></i> No Hay Estudiantes Cargados</h5>
                        </div>
                    </div>
                </div>

                <?php else: ?>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">RUT</th>
                                <th scope="col">DV</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Apellido Nombres</th>
                            </tr>
                        </thead>
                        <?php

                                $fila = 1;
                                $flag = true;
                                $csv = "csv/carga_estudiantes.csv";
                                if (($gestor = fopen($csv, "r")) !== FALSE) {
                                    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                                        $datos = array_map("utf8_encode", $datos);
                                        if($flag) { $flag = false; continue; }
                                        $numero = count($datos);
                                        $estudiante = RegistroData::getEstudianteRUT($datos[0]);
                                        if(!empty($estudiante)){
                                            $registro = $estudiante->RUN_INSCRIPCION;
                                        }else{
                                            $registro = 0;
                                        }
                                        $dcsv = $datos[0];
                                        if($registro<>$dcsv){
                                            echo "<tr>";
                                            echo "<td>$fila</td>";
                                            echo "<td>$datos[0]</td>";
                                            echo "<td>$datos[1]</td>";
                                            echo "<td>$datos[2]</td>";
                                            echo "<td>$datos[3]</td>";
                                            echo "<td>$datos[4]</td>";
                                            echo "</tr>";
                                        }

                                        $fila++;

                                    }
                                    fclose($gestor);

                                    
                                }

                                echo "</table>";
                        ?>

                </div>
                <?php endif; ?>
            </div>
            <!-- /.Modulo Edición -->
            <!-- Mostrar Prueba-->
            <div id="resultado">
            </div>
            <!-- /.Mostrar Prueba-->

        </div>
    </div>
</div>
<!-- /.content -->