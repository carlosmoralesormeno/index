<?php

if(!empty($_POST)){
$pregunta =  new PreguntasData();
$pregunta->prueba = $_POST["id_prueba"];
$pregunta->textoPregunta = $_POST["txt_pregunta"];
$pregunta->tipoPregunta = $_POST["tipo_pregunta"];
$idRegistro = $pregunta->add();
echo '<input type="hidden" id="pregunta-id-insert" value="'.$idRegistro[1].'">';

}

?>