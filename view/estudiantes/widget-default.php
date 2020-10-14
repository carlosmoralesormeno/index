<?php 
$registro = RegistroData::getRegistroEstudiante($_GET["id_est"]);
$estudiante = EstudiantesData::getDatosEstudiante($registro->COD_ALUMNO);
$bEstudiante = EstudiantesData::getDatosAdicionalesEstudiante($registro->COD_ALUMNO);
?>
<section>
    <div class="container-fluid">

        <legend><i class="fa fa-th-list"></i> Información Resumen del Estudiante</legend>
        <p>Permite visualizar la información del estudiante que actualmente se encuentran registrado en el sistema.
        </p>

        <div class="list">

            <div class="table-responsive">

                <table class="table table-sm table-bordered">

                    <tr class="th-color">
                        <th colspan="15" scope="col">DATOS DEL ESTUDIANTE</th>
                    </tr>
                    <tr class="th-color-cell">
                        <th scope="col">RUN</th>
                        <th scope="col" colspan="6"> Nombre Completo</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>".number_format($estudiante->RUN_INSCRIPCION,0,",","."). "-". $estudiante->DV_INSCRIPCION."</td>";
                                    echo "<td colspan='6'>".$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION."</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-cell">
                        <th scope="col">Sexo</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Estado Civil</th>
                        <th scope="col">Nacionalidad</th>
                        <th scope="col" colspan="2">Comuna</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>$estudiante->NOMBRE_GENERO</td>";
                                    echo "<td>$estudiante->FNAC_INCRIPCION</td>";
                                    echo "<td>0</td>";
                                    echo "<td>$estudiante->NOMBRE_ESTADO_CIVIL</td>";
                                    echo "<td>$estudiante->NOMBRE_NACIONALIDAD</td>";
                                    echo "<td colspan='2'>$estudiante->nombre_ciudad</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-cell">
                        <th scope="col" colspan='7'>Dirección</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td colspan='7'>$estudiante->DIRECCION_INSCRIPCION</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-cell">
                        <th scope="col">Teléfono</th>
                        <th scope="col">Celular</th>
                        <th scope="col" colspan='5'>Correo Electrónico</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>$estudiante->TELEFONO_INSCRIPCION</td>";
                                    echo "<td>$estudiante->CELULAR_INSCRIPCION</td>";
                                    echo "<td colspan='5'>$estudiante->CORREO_INSCRIPCION</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-cell">
                        <th scope="col">Sector Residencia</th>
                        <th scope="col">Origen Indígena</th>
                        <th scope="col">Subvención Escolar</th>
                        <th scope="col">PIE</th>
                        <th scope="col">JUNAEB</th>
                        <th scope="col">Chile Solidario</th>
                        <th scope="col">Repitente</th>
                    </tr>
                    <?php
                                    echo "<tr> ";
                                    echo "<td>$bEstudiante->ARURAL</td>";
                                    echo "<td>$bEstudiante->INDIGENA</td>";
                                    echo "<td>$bEstudiante->SEP</td>";
                                    echo "<td>$bEstudiante->INTEGRACION</td>";
                                    echo "<td>$bEstudiante->JUNAEB</td>";
                                    echo "<td>$bEstudiante->CHILE_SOLIDARIO</td>";
                                    echo "<td>$bEstudiante->REPITIENTE</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-cell">
                        <th scope="col">Convivencia</th>
                        <th scope="col">Problemas de Salud</th>
                        <th scope="col" colspan="5">Otros Antecedentes</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>$bEstudiante->VIVE_ALUMNO</td>";
                                    echo "<td>$bEstudiante->PROBLEMAS_ALUMNO</td>";
                                    echo "<td colspan='5'>$bEstudiante->ENFERMEDADES_ALUMNO</td>";
                                    echo "</tr>";
                                ?>

                    <tr class="th-color-2">
                        <th colspan="15" scope="col">DATOS DEL APODERADO</th>
                    </tr>
                    <tr class="th-color-cell-2">
                        <th scope="col">RUN</th>
                        <th scope="col" colspan="6"> Nombre Completo</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>".number_format($estudiante->RUN_INSCRIPCION,0,",","."). "-". $estudiante->DV_INSCRIPCION."</td>";
                                    echo "<td colspan='6'>".$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION."</td>";
                                    echo "</tr>";
                                ?>
                    <tr class="th-color-cell-2">
                        <th scope="col">Sexo</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Parentesco</th>
                        <th scope="col" colspan="4">Nivel Educacional</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>$estudiante->NOMBRE_GENERO</td>";
                                    echo "<td>0</td>";
                                    echo "<td>$estudiante->NOMBRE_ESTADO_CIVIL</td>";
                                    echo "<td colspan='4'>$estudiante->NOMBRE_NACIONALIDAD</td>";
                                    echo "</tr>";
                                ?>
                    <tr class="th-color-cell-2">
                        <th scope="col" colspan="3">Situación Laboral</th>
                        <th scope="col" colspan="4">Lugar de Trabajo</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td colspan='3'>$estudiante->NOMBRE_NACIONALIDAD</td>";
                                    echo "<td colspan='4'>$estudiante->NOMBRE_NACIONALIDAD</td>";
                                    echo "</tr>";
                                ?>
                    <tr class="th-color-2">
                        <th colspan="15" scope="col">APODERADO SUPLENTE</th>
                    </tr>
                    <tr class="th-color-cell-2">
                        <th scope="col" colspan="2">Nombre</th>
                        <th scope="col">Edad</th>
                        <th scope="col" colspan="2">Nivel Educacional</th>
                        <th scope="col">Ocupación</th>
                        <th scope="col">Parentesco</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td colspan='2'>".$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION."</td>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "<td colspan='2'>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "</tr>";
                                ?>
                    <tr class="th-color-3">
                        <th colspan="15" scope="col">DATOS DE MATRICULA</th>
                    </tr>
                    <tr class="th-color-cell-3">
                        <th scope="col">N° Matrícula</th>
                        <th scope="col">Fecha Matricula</th>
                        <th scope="col" colspan="4">Curso</th>
                        <th scope="col">Retirado</th>
                    </tr>
                    <?php
                                    echo "<tr>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION."</td>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "<td colspan='4'>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "<td>".$estudiante->APAT_INSCRIPCION."</td>";
                                    echo "</tr>";
                                ?>
                </table>

            </div>


        </div>

    </div>

</section>