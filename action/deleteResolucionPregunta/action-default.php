<?php

if(!empty($_POST)){
$texto =  new ResolucionData();
$texto->id = $_POST["id_resolucion"];
$idRegistro = $texto->delete();
}

?>