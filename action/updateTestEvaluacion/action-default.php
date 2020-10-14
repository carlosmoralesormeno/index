<?php

if(!empty($_POST)){

$evaluacion =  new EvaluacionData();
$evaluacion->id = $_POST["id-prueba"];
$evaluacion->nombre = $_POST["txt-nombre"];
$evaluacion->asignatura = $_POST["id-asignatura"];
$evaluacion->objetivo = $_POST["txt-objetivo"];
$evaluacion->habilidades = $_POST["txt-habilidad"];
$evaluacion->updateEvaluacion();

$directorio = $_POST["id-prueba"];

if (file_exists($directorio)) {
    echo "El directorio existe";
} else {
    mkdir("img/imgServer/".$directorio, 0777);
}

}

//var_dump($_POST);

?>