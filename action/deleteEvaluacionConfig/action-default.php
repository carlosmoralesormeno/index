<?php

if(!empty($_POST)){
$evaluacion =  new EvaluacionConfigData();
$evaluacion->id = $_POST["id-evconfig"];
$idRegistro = $evaluacion->deleteEvaluacionConfig();
}
?>