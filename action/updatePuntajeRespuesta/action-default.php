<?php
if(!empty($_POST)){
$respuesta = new RespuestasData();
$respuesta->idRespuesta = $_POST["respuesta-id"];
$respuesta->idPuntaje = $_POST["puntaje_id"];
$respuesta->updateByIdRespuesta();

var_dump($_POST);

}
?>