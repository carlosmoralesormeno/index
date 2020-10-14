<?php

if(!empty($_POST)){
$pregunta = $_POST["pregunta-id"];
$tipoPregunta = $_POST["tipo-pregunta"];
$txtId = $_POST["txt-id"];

$evaluacion =  new EvaluacionesData();
$evaluacion->idEstudiante = $_POST["estudiante-id"];
$evaluacion->idTest = $_POST["test-id"];
$evaluacion->numberTest = $_POST["qt"];
$idRegistro = $evaluacion->addEvaluacion();

for ($i=0;$i < count($pregunta);$i++){

    if($tipoPregunta[$i]==0){
        if(isset($pregunta[$i]) && !empty($pregunta[$i])){
            $evaluacion->idEvaluacion = $idRegistro[1];
            $evaluacion->idAlternativa = $pregunta[$i];
            $evaluacion->addRespuestas();
        }
    }else{
        if(isset($pregunta[$i]) && !empty($pregunta[$i])){
            $evaluacion->idEvaluacion = $idRegistro[1];
            $evaluacion->idAlternativa = $txtId[$i];
            $evaluacion->txtRepuesta = $pregunta[$i];
            $evaluacion->addRespuestas();
            $evaluacion->txtRepuesta = "";
        }
    }
}

echo '<input type="hidden" id="ider" value="'.$idRegistro[1].'">';

}

//var_dump($_POST);



?>