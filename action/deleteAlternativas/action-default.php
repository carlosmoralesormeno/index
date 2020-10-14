<?php

if(!empty($_POST)){
$pregunta =  new PreguntasData();
$pregunta->id = $_POST["id_pregunta"];
$pregunta->deleteAllAlternativas();
}

?>