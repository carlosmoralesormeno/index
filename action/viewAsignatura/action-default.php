<?php

if(isset($_GET["id_curso"]) && !empty($_GET["id_curso"])){
    
    $asignaturas = AsignaturasData::getAll($_GET["id_curso"]);
   
    if($asignaturas > 0){
        echo '<option value="" disabled selected>Seleccione la Asignatura</option>';
        foreach($asignaturas as $est):
            echo '<option value="'.$est->COD_ASIGNATURA_NOTA_ASIGNATURA_CURSO.'">'.$est->NOMBRE_ASIGNATURA.'</option>';
        endforeach;
    }else{
        echo '<option value="">Sin Asignaturas</option>';
    }
    
}
?>