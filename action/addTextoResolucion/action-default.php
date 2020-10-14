<?php

if(!empty($_POST)){
$texto =  new ResolucionData();
$texto->idPregunta = $_POST["id_pregunta"];
$texto->txtResolucion = $_POST["txt_resolucion"];
$idRegistro = $texto->add();
echo '<input id="resolucion-id-insert" value="'.$idRegistro[1].'">';
//var_dump($_POST);
}

?>