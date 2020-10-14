<?php

if(!empty($_POST)){
$texto =  new TextosData();
$texto->idPregunta = $_POST["id_pregunta"];
$texto->txtTexto = $_POST["txt_texto"];
$idRegistro = $texto->add();
echo '<input id="texto-id-insert" value="'.$idRegistro[1].'">';
//var_dump($_POST);
}

?>