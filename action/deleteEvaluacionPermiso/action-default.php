<?php

if(!empty($_POST)){
$evaluacion =  new EvaluacionConfigData();
$evaluacion->id = $_POST["id-evperm"];
$idRegistro = $evaluacion->deleteEvaluacionPerm();
}
?>