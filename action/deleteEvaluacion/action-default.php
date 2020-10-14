<?php

if(!empty($_POST)){

$EvaluacionId = EvaluacionesData::getIdEvaluacion($_POST["id_estudiante"], $_POST["id_ntest"], $_POST["id_test"]);

$evaluacion =  new EvaluacionCursoData();
$evaluacion->idTest = $_POST["id_test"];
$evaluacion->idEvaluacion = $EvaluacionId->ID;
$evaluacion->deleteRespuestas();
$evaluacion->deleteEvaluacion();
}

?>