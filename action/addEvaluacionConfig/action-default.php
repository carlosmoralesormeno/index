<?php

if(!empty($_POST)){
$evaluacion =  new EvaluacionConfigData();
$evaluacion->idTest = $_POST["test-id"];
$evaluacion->idCurso = $_POST["curso-id"];
$evaluacion->testMax = $_POST["intentos-id"];
$idRegistro = $evaluacion->addConfiguracionEva();
}
?>