<?php
if(!empty($_POST)){
$alternativa =  new AlternativasData();
$alternativa->idAlternativa = $_POST["id_alternativa"];
$alternativa->textoAlternativa = $_POST["txt_alternativa"];
$alternativa->update();
}
?>