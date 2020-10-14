<?php

if(isset($_GET["id_curso"]) && !empty($_GET["id_curso"])){
    
    $cursos = CursosData::getByIdCurso($_GET["id_curso"]);
   
        echo '
            <input type="hidden" id="id-nvl-n" value="'.$cursos->ID_CURSO_REG.'">
            <input type="hidden" id="id-ltr-n" value="'.$cursos->ID_LETRA_REG.'">
        ';
    
}
?>