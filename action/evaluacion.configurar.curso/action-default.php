<?php

if(!empty($_POST)){
$curso = $_POST["id-curso"];
$test = $_POST["id-test"];
$evaluacionCurso =  new EvaluacionConfigData();
$evaluacionCurso->idTestConfig = $test;
$evaluacionCurso->deleteAllConfiguracionEstudiante();

    if(!empty($_POST["estudiante"])){
        $estudiantes = $_POST["estudiante"];
        for ($i=0;$i < count($estudiantes);$i++){
            $evaluacionCurso->idEstudiante = $estudiantes[$i];
            $evaluacionCurso->addConfiguracionEstudiante();
        }
    }

}
?>