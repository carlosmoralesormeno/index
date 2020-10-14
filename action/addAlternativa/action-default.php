<?php
if(!empty($_POST)){
$alternativa =  new AlternativasData();
$alternativa->idPregunta = $_POST["id_pregunta"];
$alternativa->textoAlternativa = $_POST["txt_alternativa"];
$alternativa->add();
}
?>