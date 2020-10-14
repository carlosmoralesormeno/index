<?php

if(!empty($_POST)){
$texto =  new TextosData();
$texto->id = $_POST["id_txt"];
$idRegistro = $texto->delete();
}

?>