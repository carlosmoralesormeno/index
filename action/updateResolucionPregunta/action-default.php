<?php

if(!empty($_POST)){
$texto =  new ResolucionData();
$texto->id = $_POST["id_txt"];
$texto->txtResolucion = $_POST["txt_resolucion"];
$idRegistro = $texto->update();
}

?>