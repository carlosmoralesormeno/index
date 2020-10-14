<?php

if(!empty($_POST)){

    $fileTmpPath = $_FILES['filename']['tmp_name'];
    $fileName = $_FILES['filename']['name'];
    $fileSize = $_FILES['filename']['size'];
    $fileType = $_FILES['filename']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $documento =  new DocumentosData();
    $documento->textoNombre = $_POST["txt_nombre"];
    $documento->textoObjetivo = $_POST["txt_objetivo"];
    $documento->idRUN = $_POST["id-rut"];
    $documento->fileExtension = $fileExtension;
    $idRegistro = $documento->add();
    $idDoc = $idRegistro[1];

    $carpetaDestino = "doc/docdb/doc-".$idDoc.".".$fileExtension;

    move_uploaded_file($_FILES["filename"]["tmp_name"], $carpetaDestino);

}
?>