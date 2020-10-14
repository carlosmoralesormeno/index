<?php

if(!empty($_POST)){
$texto =  new TextosData();
$texto->id = $_POST["id_txt"];
$texto->txtTexto = $_POST["txt_texto"];
$idRegistro = $texto->update();
}

?>