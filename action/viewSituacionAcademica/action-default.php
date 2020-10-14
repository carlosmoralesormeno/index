<?php 
$calificaciones = CalificacionesData::getAll($_GET["id_reg"],$_GET["id_sem"]);
$curso = EstudiantesData::getCurso($_GET["id_reg"]);
$asignaturas = AsignaturasData::getAll($curso->COD_CUR_MINED_AL);
$asistencia = AsistenciaData::getAll($_GET["id_reg"]);
$asistenciaDias = AsistenciaData::getDiasTrabajo($curso->COD_CUR_MINED_AL, $curso->LETRA_CUR_ALUM);
?>
<section>

    <!-- Panel Notas -->

    <div class="panel panel-primary">
        <div class="panel-heading panel-menu"><i class="fa fa-user-graduate"></i> Calificaciones del Estudiante</div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-light">
                    <?php
                        $nombreColumnas = ["Asignatura", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "N8", "N9", "N10", "N11", "N12", "PF"];
                        for ($f=0;$f<1;$f++) {
                            echo "<tr class='th-color-cell'>";
                            for ($c=0;$c<=13;$c++){
                                if($c==0){
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
                    $asignaturaTabla = array();

                    $asignaturasRows = count($asignaturas);
                    $notasRows = count($calificaciones);
                    
                    for($a=0;$a<$asignaturasRows;$a++){
                        $p = $asignaturas[$a];
                        $asignaturaTabla[] = array($p->COD_ASIGNATURA_NOTA_ASIGNATURA_CURSO, $p->NOMBRE_ASIGNATURA, $p->ORDEN_NOTA_ORDEN_ASIGNATURA_CURSO, $p->CONCEPTO_ASIGNATURA);
                    }

                    for($n=0;$n<$notasRows;$n++){
                        $r =$calificaciones[$n];
                        $notasTabla [$r->COD_ASIGNATURA_ALUMNO_NOTA][$r->COLUMNA_ALUMNO_NOTA] = $r->NOTA_ALUMNO_NOTA;
                    }
                    
                    $notaF = 0.0;
                    $cantidadF = 0;
                    $promedioF = 0.0;
                    $notasInsuficientes = 0;
                    $cantidadInsuficientes = 0;

                    function observacionAutomatica($notaOa, $asistenciaOa, $insuficientesOa){
                        $notaAprobacion = 4.0;
                        $notaSuperior = 6.0;
                        $asistenciaAprobacion = 85;
                        $textoObservacion = "";

                        $txt1 = "El estudiante no cuenta con asignaturas insuficientes";
                        $txt2 = "cuenta con un <b>Excelente Rendimiento</b>, <b>¡¡Felicitaciones!!</b>";
                        $txt3 = "El estudiante cuenta con <b>".$insuficientesOa. "</b> calificación menor a <b>" .number_format($notaAprobacion,1,",",".")."</b>";
                        $txt4 = "El estudiante cuenta con <b>".$insuficientesOa. "</b> calificaciones menores a <b>".number_format($notaAprobacion,1,",",".")."</b>";
                        $txt5 = "Para ser promovido, su promedio final debe ser mayor o igual a <b>".number_format($notaAprobacion,1,",",".")."</b>";
                        $txt6 = "No presenta problemas de asistencia";
                        $txt7 = "y no presenta problemas de asistencia";
                        $txt8 = "También, posee problemas de asistencia, la que debe ser mayor al <b>" .$asistenciaAprobacion."%</b>";
                        $txt9 = "pero posee problemas de asistencia, la que debe ser mayor al <b>" .$asistenciaAprobacion."%</b>";
                        $txt10 = "y afecta su situación final para ser promovido de curso";
                        $txt11 = "Ambas afectan su situación final para ser promovido de curso";
                        $txt12 = "afectando su situación final para ser promovido de curso";
                        $txt13 = "El estudiante cuenta con un promedio menor a <b>".number_format($notaAprobacion,1,",",".")."</b>";
                        $txt14 = "Además cuenta con <b>".$insuficientesOa. "</b> calificación menor a <b>" .number_format($notaAprobacion,1,",",".")."</b>";
                        $txt15 = "Además cuenta con <b>".$insuficientesOa. "</b> calificaciones menores a <b>" .number_format($notaAprobacion,1,",",".")."</b>";
                        $txt16 = "pero su promedio final afecta su situación para ser promovido";
                        $txt17 = "cuenta con problemas de asistencia, la que debe ser mayor al <b>" .$asistenciaAprobacion."%</b>";
                        $txt18 = "pero no presenta problemas de asistencia";
                        $esp = " ";
                        $com = ", ";
                        $pun = ". ";
                        
                        if($notaOa >= $notaSuperior){
                            //Nota Superior
                  
                            if($insuficientesOa == 0){
                                $textoObservacion = $txt1.$com.$txt2;
                            }elseif($insuficientesOa == 1){
                                $textoObservacion = $txt3;
                            }elseif($insuficientesOa >= 2){
                                $textoObservacion = $txt4;
                            }        

                            if($asistenciaOa >= $asistenciaAprobacion){
                                if($insuficientesOa > 0){
                                    $textoObservacion = $textoObservacion.$com.$txt18.$pun;
                                }else{
                                    $textoObservacion = $textoObservacion.$com.$txt7.$pun;
                                }
                                
                            }
                            if($asistenciaOa < $asistenciaAprobacion){
                                if($insuficientesOa > 0){
                                    $textoObservacion = $textoObservacion.$com.$txt17.$com.$txt12.$pun;
                                }else{
                                    $textoObservacion = $textoObservacion.$com.$txt9.$com.$txt10.$pun;
                                }
                                
                            }
                        }elseif($notaOa < $notaSuperior){
                            
                            if($notaOa < $notaAprobacion){
                                //Nota menor a nota de aprobación
                                $textoObservacion = $txt13.$pun;
                                if($insuficientesOa == 1){
                                    $textoObservacion = $textoObservacion.$txt14.$pun;
                                }elseif($insuficientesOa >= 2){
                                    $textoObservacion = $textoObservacion.$txt15.$pun;
                                }

                                $textoObservacion = $textoObservacion.$txt5.$pun;
    
                                if($asistenciaOa >= $asistenciaAprobacion){
                                    $textoObservacion = $textoObservacion.$txt6.$com.$txt16.$pun;
                                }
                                if($asistenciaOa < $asistenciaAprobacion){
                                    $textoObservacion = $textoObservacion.$txt8.$pun.$txt11.$pun;
                                }

                            }else{
                                //nota mayor a nota de aprobación
                                if($insuficientesOa == 0){
                                    $textoObservacion = $txt1;
                                }elseif($insuficientesOa == 1){
                                    $textoObservacion = $txt3;
                                }elseif($insuficientesOa >= 2){
                                    $textoObservacion = $txt4;
                                }
    
                                if($asistenciaOa >= $asistenciaAprobacion){
                                    if($insuficientesOa > 0){
                                        $textoObservacion = $textoObservacion.$com.$txt18.$pun;
                                    }else{
                                        $textoObservacion = $textoObservacion.$com.$txt7.$pun;
                                    }
                                    
                                }
                                if($asistenciaOa < $asistenciaAprobacion){
                                    if($insuficientesOa > 0){
                                        $textoObservacion = $textoObservacion.$com.$txt17.$com.$txt12.$pun;
                                    }else{
                                        $textoObservacion = $textoObservacion.$com.$txt9.$com.$txt10.$pun;
                                    }
                                    
                                }
                            }
                        }

                        return $textoObservacion;
                    };

                    function notaConcepto($notaConcepto) {
                        $valueConcepto = "";
                        switch (true){
                            case $notaConcepto <= 3.9: 
                                $valueConcepto = "I";
                            break;
                            case $notaConcepto <= 4.9: 
                                $valueConcepto = "S";
                            break;
                            case $notaConcepto <= 5.9: 
                                $valueConcepto = "B";
                            break;
                            case $notaConcepto >= 6.0: 
                                $valueConcepto = "MB";
                            break;
                        }

                        return $valueConcepto;
                    }

                    for($y=0;$y<$asignaturasRows;$y++){
                        //Declaro variables que destruire mas adelante
                        $nota = 0.0;
                        $cantidad = 0;
                        $promedio = 0.0;
                        $ocultaFilaVacia = 0;

                        //Revisar si hay alguna nota para colocar
                        for($c=3;$c<=14;$c++){
                            if(!empty($notasTabla[$asignaturaTabla[$y][0]][$c])){
                                $ocultaFilaVacia = $ocultaFilaVacia + 1;
                            }
                        }
                        //Inserto la Fila, solo si hay un promedio
                        if($ocultaFilaVacia>0){
                            echo "<tr>";
                            echo "<td>".$asignaturaTabla[$y][1]."</td>";

                            for($c=3;$c<=14;$c++){
                                //Consulto si el arreglo esta vacio
                                    if(empty($notasTabla[$asignaturaTabla[$y][0]][$c])){
                                        echo "<td style='text-align:center;'>-</td>";
                                    }else{
                                        //traspaso los valores a la tabla y luego almaceno los datos de las notas para calcular el promedio
                                        if($notasTabla[$asignaturaTabla[$y][0]][$c]>=6.0){
                                        //Destacar notas sobre 6.0
                                        echo "<td style='color:#001FC8; text-align:center'><b>".$notasTabla[$asignaturaTabla[$y][0]][$c]."</b></td>";
                                        }else{
                                        echo "<td style='text-align:center;'>".$notasTabla[$asignaturaTabla[$y][0]][$c]."</td>";
                                        }
                                        $nota = $notasTabla[$asignaturaTabla[$y][0]][$c] + $nota;
                                        $cantidad = $cantidad + 1;
                                    }
                                }

                            if($cantidad>0){
                                $promedio = $nota / $cantidad;
                                //Modificacion 27-08-2019
                                //Compruebo si una nota es concepto, para ingresarla como letras
                                    if($asignaturaTabla[$y][3] == 0){
                                        echo "<td style='text-align:center;'><b>".number_format($promedio,1,",",".")."</b></td>";
                                        if($promedio<4.0){
                                            $cantidadInsuficientes = ++$cantidadInsuficientes;
                                        }
                                    }else{
                                        echo "<td style='text-align:center;'><b>".notaConcepto(number_format($promedio,1,",","."))."</b></td>";
                                    }
                                }else{
                                echo "<td style='text-align:center;'><b>-</b></td>";
                            }
                        
                            //Almaceno el promedio, siempre y cuando no sea un concepto
                            if($promedio>0){
                                if($asignaturaTabla[$y][3] == 0){
                                    $notaF = $notaF + number_format($promedio,1,".",",");;
                                    $cantidadF = $cantidadF + 1;
                                }
                            }
                            //Destruyo las variables para dejarlas vacias;
                            unset($nota);
                            unset($cantidad);
                            unset($promedio);
                            echo "</tr>";
                        }
                    }
                    $promedioF = number_format($notaF,1,".",",") / $cantidadF;
                    echo "<thead class='thead-light'>";
                    echo "<tr class='th-color-cell'>";
                    echo "<td colspan='13'>PROMEDIO SEMESTRE</td>";
                    echo "<td style='text-align:center;'>".number_format($promedioF,1,",",".")."</td>";
                    echo "</tr>";
                    echo "</thead>";
            ?>
            </table>

        </div>

    </div>

    <!-- Panel Asistencia -->

    <div class="panel panel-primary">
        <div class="panel-heading panel-menu"><i class="far fa-calendar-alt"></i> Asistencia del Estudiante</div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-light">
                    <?php
                        $nombreColumnas = ["Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
                        for ($f=0;$f<1;$f++) {
                            echo "<tr class='th-color-cell'>";
                            for ($c=0;$c<=9;$c++){
                                echo "<th style='text-align:center;'>".$nombreColumnas[$c]."</th>";
                            }
                            echo "</tr>";
                        }
                    ?>

                </thead>

                <?php 

                    $asistenciaTabla = array();
                    $asistenciaRows = count($asistencia);
                    
                    for($n=0;$n<$asistenciaRows;$n++){
                        $r =$asistencia[$n];
                        $asistenciaTabla [$r->COLUMNA_ALUMNO_ASISTENCIA] = $r->ASISTENCIA_ALUMNO_ASISTENCIA;
                    }
                    
                    $AsistenciaTotal = 0;
                    $cantidadF = 0;


                    for($y=0;$y<1;$y++){
                        //Declaro variables que destruire mas adelante
                        $AsistenciaValue = 0.0;
                        $cantidad = 0;
                        $promedio = 0.0;
                        echo "<tr>";
                        //echo "<td>".'valor'."</td>";
                            for($c=3;$c<=12;$c++){
                                //Consulto si el arreglo esta vacio
                                    if(empty($asistenciaTabla[$c])){
                                        echo "<td style='text-align:center;'>-</td>";
                                    }else{
                                        //traspaso los valores a la tabla y luego almaceno los datos de las notas para calcular el promedio
                                        if($asistenciaTabla[$c]>=12){
                                        //Destacar notas sobre 6.0
                                        echo "<td style='color:#001FC8; text-align:center'><b>".$asistenciaTabla[$c]."</b></td>";
                                        }else{
                                        echo "<td style='text-align:center;'>".$asistenciaTabla[$c]."</td>";
                                        }
                                        $AsistenciaValue = $asistenciaTabla[$c] + $AsistenciaValue;
                                        $cantidad = $cantidad + 1;
                                    }
                                }

                            if($cantidad>0){
                                $promedio = $AsistenciaValue / $cantidad;
                                $AsistenciaTotal = $AsistenciaValue;
                                //echo "<td><b>".number_format($AsistenciaValue,0,",",".")."</b></td>";
                                }else{
                                //echo "<td><b>-</b></td>";
                            }
                        
                            //Almaceno el promedio, siempre y cuando no sea un concepto
                            if($promedio>0){
                                if($asignaturaTabla[$y][3] == 0){
                                    $notaF = $notaF + $promedio;
                                    $cantidadF = $cantidadF + 1;
                                }
                            }
                            //Destruyo las variables para dejarlas vacias;
                            unset($AsistenciaValue);
                            unset($cantidad);
                            unset($promedio);
                            echo "</tr>";
                    }

                    $totalAsistencia = $asistenciaDias->TOTAL_DIAS;
                    $promedioAsistencia =  ($AsistenciaTotal / $totalAsistencia) * 100;
                    echo "<thead class='thead-light'>";
                    echo "<tr class='th-color-cell'>";
                    echo "<td colspan='9'>TOTAL ASISTENCIA</td>";
                    echo "<td style='text-align:center;'>".number_format($promedioAsistencia,0,",",".")."%</td>";
                    echo "</tr>";
                    echo "</thead>";
            ?>
            </table>

        </div>

    </div>


    <!-- Panel Observación Automática -->

    <div class="panel panel-primary">
        <div class="panel-heading panel-menu"><i class="fas fa-laptop"></i> Observación Automática de SAIE</div>
        <div class="panel-body">
            <?php
                echo observacionAutomatica(number_format($promedioF,1,",","."),$promedioAsistencia,$cantidadInsuficientes);
            ?>
        </div>

    </div>

    </div>


</section>