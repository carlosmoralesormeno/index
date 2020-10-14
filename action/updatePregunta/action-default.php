<?php

if(!empty($_POST)){
$pregunta =  new PreguntasData();
$pregunta->id = $_POST["id_pregunta"];
$pregunta->textoPregunta = $_POST["txt_pregunta"];
$pregunta->tipoPregunta = $_POST["tipo_pregunta"];
$pregunta->update();
}

?>