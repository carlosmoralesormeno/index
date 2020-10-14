<?php

if(!empty($_POST)){

$evaluacion =  new EvaluacionData();
$evaluacion->id = $_POST["id-prueba"];
$evaluacion->deleteEvaluacion();
}

//var_dump($_POST);

?>