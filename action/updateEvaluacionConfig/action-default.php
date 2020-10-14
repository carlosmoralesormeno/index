<?php

if(!empty($_POST)){
$evaluacion =  new EvaluacionConfigData();
$evaluacion->id = $_POST["id-evconfig"];
$evaluacion->testMax = $_POST["intentos-id"];
$idRegistro = $evaluacion->updateEvaluacionConfig();
}
?>