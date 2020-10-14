<?php

if(!empty($_POST)){

$evaluacion =  new EvaluacionData();
$evaluacion->nombre = $_POST["txt-nombre"];
$evaluacion->objetivo = $_POST["txt-objetivo"];
$evaluacion->habilidades = $_POST["txt-habilidad"];
$evaluacion->asignatura = $_POST["id-asignatura"];
$idRegistro = $evaluacion->addEvaluacion();
$evaluacion->idRUT = $_POST["id-registro"];
$evaluacion->idTest = $idRegistro[1];
$evaluacion->addAutor();

$directorio = $idRegistro[1];

if (file_exists($directorio)) {
    echo "El directorio existe";
} else {
    mkdir("img/imgServer/".$directorio, 0777);
}

}

var_dump($_POST);

?>