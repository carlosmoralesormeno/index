<?php

if(!empty($_POST)){
$evaluacion =  new EvaluacionConfigData();
$evaluacion->idTest = $_POST["test-id"];
$evaluacion->idCurso = $_POST["curso-id"];
$evaluacion->idDocente = $_POST["docente-id"];
$idRegistro = $evaluacion->addConfiguracionPerm();
}
?>