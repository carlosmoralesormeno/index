<?php 
$calificaciones = CalificacionesData::getByAsignatura($_GET["id_nvl"], $_GET["id_ltr"],$_GET["id_asig"],$_GET["id_sem"]);
$estudiantes = EstudiantesData::getEstudiante($_GET["id_nvl"], $_GET["id_ltr"]);
echo '<input type="hidden" id="auto-movimiento-id" value="1">';
echo '<input type="hidden" id="guardado-id" value="1">';
?>
<section>
    <form action="" id="form-edit-calificaciones" onkeypress="return pulsar(event)">

        <?php
    echo '<input type="hidden" name="asignatura-id" value="'.$_GET["id_asig"].'">';
    echo '<input type="hidden" name="semestre-id" value="'.$_GET["id_sem"].'">';
    echo '<input type="hidden" name="curso-id" value="'.$_GET["id_nvl"].'">';
    echo '<input type="hidden" name="letra-id" value="'.$_GET["id_ltr"].'">';
?>
        <div class="panel panel-primary">
            <div class="panel-heading panel-menu"><i class="fa fa-user-graduate"></i> Calificaciones</div>
            <div class="panel-body">
                <div class="alert alert-info fade in" id="alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> <strong>Recuerde </strong> <br>
                    - Presionar <b>Guardar Calificaciones</b> antes de cambiar de asignatura. <br>
                    - Ingresar <b>solo números</b> , sin puntos ni comas. <br>
                    - El <b>promedio</b> se actualizar al presionar <b>Guardar Calificaciones</b>.
                </div>

                <div class="form-group">
                    <span class="label label-primary"><i class="fas fa-caret-square-down"></i> Movimiento
                        Automático Abajo</span><br>
                    <input name="auto-movimiento" id="auto-ok" type="Radio" value="1" checked
                        onclick="movimientoAutomatico(this.value)">
                    <label for="auto-ok">Activado </label>
                    <input name="auto-movimiento" id="auto-no" type="Radio" value="0"
                        onclick="movimientoAutomatico(this.value)">
                    <label for="auto-no">Desactivado </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block pull-right" data-toggle="collapse"
                        data-target="#collapseDatos" onclick="guardarNotas(event)"><i class="fas fa-save"></i> Guardar
                        Calificaciones</button>
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
                                echo "<th style='text-align:center;' >".$nombreColumnas[$c]."</th>";
                            }
                            
                        }
                        echo "</tr>";
                    }
            ?>

                    </thead>

                    <?php 

                    $notasTabla = array();
                    $estudiantesTabla = array();
                    //cantidad de notas en el sistema
                    $cantidadNotas = 12;
                    $totalColumnas = $cantidadNotas + 2;


                    $estudiantesRows = count($estudiantes);
                    $notasRows = count($calificaciones);
                    

                    for($a=0;$a<$estudiantesRows;$a++){
                        $p = $estudiantes[$a];
                        $estudiantesTabla[] = array($p->COD_REGISTRO_ESC, $p->NOMBRE, $p->ORDEN_LIBRO_CLASE, $p->RETIRADO);
                    }

                    for($n=0;$n<$notasRows;$n++){
                        $r =$calificaciones[$n];
                        $notasTabla [$r->COD_REGISTRO_ESC][$r->COLUMNA_ALUMNO_NOTA] = $r->NOTA_ALUMNO_NOTA;
                        $notasID [$r->COD_REGISTRO_ESC][$r->COLUMNA_ALUMNO_NOTA] = $r->ID_NOTA_ALUMNO;
                    }
            
                    $notaF = 0.0;
                    $cantidadF = 0;
                    $promedioF = 0.0;
                    $idArray = 0;
                    $numeroLista = 1;


                    for($y=0;$y<$estudiantesRows;$y++){
                        //Declaro variables que destruire mas adelante
                        $nota = 0.0;
                        $cantidad = 0;
                        $promedio = 0.0;

                        echo "<tr>";

                        echo "<td style='text-align:center;'>".$numeroLista."</td>";

                        if($estudiantesTabla[$y][3] == 1){
                            echo "<td style='text-decoration:line-through; color:#FF0000'>".$estudiantesTabla[$y][1];
                        }else{
                            echo "<td>".$estudiantesTabla[$y][1];
                        }

                        //echo "<td>".$estudiantesTabla[$y][1];
                        echo '<input type="hidden" id="y'.$y.'" value="'.$estudiantesTabla[$y][0].'">';
                        echo "</td>";

                            for($c=3;$c<=$totalColumnas;$c++){
                                //Consulto si el arreglo esta vacio
                                    if(empty($notasTabla[$estudiantesTabla[$y][0]][$c])){
                                        echo "<td style='text-align:center;'><input onfocus='this.select()' type='text' style='text-align:center;' id='idx".$estudiantesTabla[$y][0]."c".$c."' name='nota[".$idArray."]' maxlength='2' size='3' value='' onchange='editNota(".$idArray.",".$estudiantesTabla[$y][0].",".$c.",this.value)' onkeydown='mover(".$y.",".$c.",event,this.value)'>";
                                        echo '<input type="hidden" name="ide['.$idArray.']" value="'.$estudiantesTabla[$y][0].'">';
                                        echo '<input type="hidden" name="idc['.$idArray.']" value="'.$c.'">';
                                        echo '<input type="hidden" id="ida'.$idArray.'" name="ida['.$idArray.']" value="0">';
                                        echo '</td>';
                                    }else{
                                        //traspaso los valores a la tabla y luego almaceno los datos de las notas para calcular el promedio  
                                        echo "<td style='text-align:center;'><input onfocus='this.select()' type='text' ".(($notasTabla[$estudiantesTabla[$y][0]][$c]<=3.9)?'style="color: red;text-align:center;"':'')." ".(($notasTabla[$estudiantesTabla[$y][0]][$c]>=6.0)?'style="color: blue;text-align:center;"':'style="text-align:center;"')." id='idx".$estudiantesTabla[$y][0]."c".$c."' name='nota[".$idArray."]' maxlength='2' size='3' value='".$notasTabla[$estudiantesTabla[$y][0]][$c]."' onchange='editNota(".$idArray.",".$estudiantesTabla[$y][0].",".$c.",this.value)' onkeydown='mover(".$y.",".$c.",event,this.value)'>";
                                        echo '<input type="hidden" name="ide['.$idArray.']" value="'.$estudiantesTabla[$y][0].'">';
                                        echo '<input type="hidden" name="idc['.$idArray.']" value="'.$c.'">';
                                        echo '<input type="hidden" id="ida'.$idArray.'" name="ida['.$idArray.']" value="0">';
                                        echo '</td>';
                                        $nota = $notasTabla[$estudiantesTabla[$y][0]][$c] + $nota;
                                        $cantidad = $cantidad + 1;
                                    }
                                    $idArray = ++$idArray;
                                }

                            if($cantidad>0){
                                $promedio = $nota / $cantidad;
                                echo "<td style='text-align:center;'><b>".number_format($promedio,1,".",",")."</b></td>";
                                }else{
                                echo "<td style='text-align:center;'><b>-</b></td>";
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
                    echo "<td style='text-align:center;' ><strong>".number_format($promedioF,1,".",",")."</strong></td>";
                    echo "</tr>";
                    echo "</thead>";
            ?>
                </table>

            </div>

            <div class="panel-body">
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block pull-right" data-toggle="collapse"
                        data-target="#collapseDatos" onclick="guardarNotas(event);moverPagina()"><i class="fas fa-save"></i> Guardar
                        Calificaciones</button>
                </div>
                <br>
            </div>

        </div>

    </form>

    <!-- Inicio Modal -->
    <div class="modal fade" id="modal-msj" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title bootstrap-dialog-title" id="titulo-modal"></h4>
                </div>
                <div class="modal-body" id="texto-modal"></div>
                <div class="modal-footer" id="footer-modal">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Final Modal -->
</section>