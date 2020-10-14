<?php
if(!empty($_POST)){
$alternativa =  new AlternativasData();
$alternativa->idAlternativa = $_POST["alternativa-id"];
$alternativa->idPregunta = $_POST["pregunta-id"];
$alternativa->puntajeAlternativa = $_POST["puntaje_id"];
$alternativa->updateByIdPregunta();
$alternativa->updateAlternativa();
}
?>