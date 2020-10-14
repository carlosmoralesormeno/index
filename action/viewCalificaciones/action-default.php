<?php 
$calificaciones = CalificacionesData::getByAsignatura($_GET["id_nvl"], $_GET["id_ltr"],$_GET["id_asig"],$_GET["id_sem"]);
$estudiantes = EstudiantesData::getEstudiante($_GET["id_nvl"], $_GET["id_ltr"]);
?>
<section>

    <div class="panel panel-primary">
        <div class="panel-heading panel-menu"><i class="fa fa-user-graduate"></i> Calificaciones</div>
        <div class="panel-body">
            <div class="alert alert-info fade in" id="alert-info" role="alert">
                <i class="fas fa-info-circle"></i> <strong>Información </strong> <br>
                - Para <b>Modificar Calificaciones</b> debe dirigirse al menú <a href="index.php?view=cursos&amp;mnu=3"
                    class=""><i class="fas fa-edit"></i><span>Ingreso de Calificaciones</span></a>.
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-light">
                    <?php

                $nombreColumnas = ["N°","Nombre Estudiante", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "N8", "N9", "N10", "N11", "N12", "PF"];
                    for ($f=0;$f<1;$f++) {
                        echo "<tr class='th-color-cell'>";
                        for ($c=0;$c<=14;$c++){
                            if($c==1){
                                echo "<th>".$nombreColumnas[$c]."</th>";
                            }else{
                                echo "<th style='text-align:center;'>".$nombreColumnas[$c]."</th>";
                            }
                            
                        }
                        echo "</tr>";
                    }
            ?>

                </thead>

                <?php 

                    $notasTabla = array();
                    $estudiantesTabla = array();


                    $estudiantesRows = count($estudiantes);
                    $notasRows = count($calificaciones);
                    

                    for($a=0;$a<$estudiantesRows;$a++){
                        $p = $estudiantes[$a];
                        $estudiantesTabla[] = array($p->COD_REGISTRO_ESC, $p->NOMBRE, $p->ORDEN_LIBRO_CLASE, $p->RETIRADO);
                    }

                    for($n=0;$n<$notasRows;$n++){
                        $r =$calificaciones[$n];
                        $notasTabla [$r->COD_REGISTRO_ESC][$r->COLUMNA_ALUMNO_NOTA] = $r->NOTA_ALUMNO_NOTA;
                    }
            
                    $notaF = 0.0;
                    $cantidadF = 0;
                    $promedioF = 0.0;
                    $numeroLista = 1;


                    for($y=0;$y<$estudiantesRows;$y++){
                        //Declaro variables que destruire mas adelante
                        $nota = 0.0;
                        $cantidad = 0;
                        $promedio = 0.0;
                        echo "<tr>";
                        echo "<td style='text-align:center;'>".$numeroLista."</td>";
                        echo "<td>".$estudiantesTabla[$y][1]."</td>";

                            for($c=3;$c<=14;$c++){
                                //Consulto si el arreglo esta vacio
                                    if(empty($notasTabla[$estudiantesTabla[$y][0]][$c])){
                                        echo "<td style='text-align:center;'>-</td>";
                                    }else{
                                        //traspaso los valores a la tabla y luego almaceno los datos de las notas para calcular el promedio

                                        if($notasTabla[$estudiantesTabla[$y][0]][$c]>=6.0){
                                        //Destacar notas sobre 6.0
                                        echo "<td style='color:#001FC8;text-align:center;'><b>".$notasTabla[$estudiantesTabla[$y][0]][$c]."</b></td>";
                                        }else{
                                        echo "<td style='text-align:center;'>".$notasTabla[$estudiantesTabla[$y][0]][$c]."</td>";
                                        }
                                        $nota = $notasTabla[$estudiantesTabla[$y][0]][$c] + $nota;
                                        $cantidad = $cantidad + 1;
                                    }
                                }

                            if($cantidad>0){
                                $promedio = $nota / $cantidad;
                                echo "<td style='text-align:center;' ><b>".number_format($promedio,1,".",",")."</b></td>";
                                }else{
                                echo "<td style='text-align:center;' ><b>-</b></td>";
                            }
                        

                            //Almaceno el promedio, siempre y cuando no este retirado
                            if($promedio>0){
                                if($estudiantesTabla[$y][3] == 0){
                                    $notaF = $notaF + $promedio;
                                    $cantidadF = $cantidadF + 1;
                                }
                            }
                            //Destruyo las variables para dejarlas vacias;
                            unset($nota);
                            unset($cantidad);
                            unset($promedio);
                            echo "</tr>";
                            $numeroLista = ++$numeroLista;
                    }

                    if($promedioF!==0){
                        $promedioF = $notaF / $cantidadF;
                    }else{
                        $promedioF = 0;
                    }
                    echo "<thead class='thead-light'>";
                    echo "<tr class='th-color-cell'>";
                    echo "<td colspan='14'>Promedio Asignatura</td>";
                    echo "<td style='text-align:center;' >".number_format($promedioF,1,".",",")."</td>";
                    echo "</tr>";
                    echo "</thead>";
            ?>
            </table>

        </div>
    </div>

</section>