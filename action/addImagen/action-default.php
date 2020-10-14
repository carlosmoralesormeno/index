<?php

function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){  
    $ext = explode(".", $nombreimg);  
    $ext = $ext[count($ext)-1];  

    if($ext == "jpg" || $ext == "jpeg")  
        $imagen = imagecreatefromjpeg($rutaimg);  
    elseif($ext == "png")  
        $imagen = imagecreatefrompng($rutaimg);  
    elseif($ext == "gif")  
        $imagen = imagecreatefromgif($rutaimg);  
    
    $x = imagesx($imagen);  
    $y = imagesy($imagen);  
    
    if($x <= $xmax && $y <= $ymax){
        echo '
            <div class="alert alert-info">
                <strong><i class="fas fa-check-circle"></i> Guardado</strong> <br> La Captura ha sido Almacenada y está Optimizada al tamaño máximo deseado.
            </div>
            ';
        return $imagen;  
    }

    if($x >= $y) {  
        $nuevax = $xmax;  
        $nuevay = $nuevax * $y / $x;  
    }  
    else {  
        $nuevay = $ymax;  
        $nuevax = $x / $y * $nuevay;  
    }  
    
    $img2 = imagecreatetruecolor($nuevax, $nuevay);  
    imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);  
    echo '
        <div class="alert alert-success">
            <strong><i class="fas fa-check-circle"></i> Guardado</strong> <br> La Captura ha sido Almacenada.
        </div>
        ';
    return $img2;   
}

if(isset($_POST["id-registro"]) && !empty($_POST["id-registro"])){

    $idRegistro = $_POST["id-registro"];
    $carpetaDestino = "img/imgdb/".$idRegistro.".jpg";

    if (($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/gif")) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $carpetaDestino)) {
            
            $imagen_optimizada = redimensionar_imagen($idRegistro.".jpg","img/imgdb/".$idRegistro.".jpg",800,800);
            imagejpeg($imagen_optimizada, "img/imgdb/".$idRegistro.".jpg");

        } else {
            echo '
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-circle"></i> No Guardado</strong> <br> El formato de la captura no está permitido.
                </div>
                ';
        }
    } else {
        echo ' 
            <div class="alert alert-danger">
                <strong><i class="fas fa-exclamation-circle"></i> No Guardado</strong> <br> El formato de la captura no está permitido.
            </div>
        ';
    }
}

if(isset($_POST["img"]) && !empty($_POST["img"])){

    $idRegistro = $_POST["id-registro-js"];
    $img = $_POST["img"];
    $carpetaDestino = "img/imgdb/".$idRegistro.".jpg";

    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $im = imagecreatefromstring($data);  //convertir text a imagen
    if ($im !== false) {
        imagejpeg($im, $carpetaDestino); //guardar a server 
        imagedestroy($im); //liberar memoria  
        echo '
                <div class="alert alert-success fade in" style="margin-bottom: 0px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fas fa-check-circle"></i> Guardado</strong> <br> La Captura ha sido Almacenada.
                </div>
            ';
    }else {
        echo ' 
                <div class="alert alert-danger fade in" style="margin-bottom: 0px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fas fa-exclamation-circle"></i> No Guardado</strong> <br> Ha ocurrido un error al almacenar la imagen.
                </div>
            ';
    }
}

if(isset($_POST["id-registro-img"]) && !empty($_POST["id-registro-img"])){

    $idRegistro = $_POST["id-registro-img"];
    $carpetaDestino = "img/imgdb/".$idRegistro.".jpg";

    $rotacion = $_POST["rotate-img"];
    $image = $carpetaDestino;
    $image_rotate = $carpetaDestino;
    $degrees = $rotacion;
    $source = imagecreatefromjpeg($image);
    $rotate = imagerotate($source, $degrees, 0);
    imagejpeg($rotate, $image_rotate);
    echo '<img id="img" class="img-responsive" alt="Responsive image" src="'.$carpetaDestino.'?'.rand(1,1000).'">';
    //echo '<img src="">';
}

if(isset($_POST["id-registro-vista"]) && !empty($_POST["id-registro-vista"])){
    $idRegistro = $_POST["id-registro-vista"];
    $estudiante = EstudiantesData::getDatosEstudiante($idRegistro);

    $img = "img/imgdb/".$idRegistro.".jpg";
    $imgdefault = "img/default-user-img.jpg";

        if(file_exists($img)){
            echo '
                <div class="img-view">
                <img id="img" class="img-responsive img-thumbnail" alt="Responsive image" src="'.$img.'?'.rand(1,1000).'">
                <div class="txt-name-photo text-center">
                    <p>'.$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION.'</p>
                </div>
                <a class="btn btn-sm btn-primary pull-right" href="'.$img.'" download="'.$estudiante->APAT_INSCRIPCION. " ". $estudiante->AMAT_INSCRIPCION. " ". $estudiante->NOMBRE_INSCRIPCION.'" style="margin-top: 1px;" ><i class="fas fa-download"></i></a>
                <button type="button" class="btn btn-margin btn-sm btn-primary" onclick="girarImagen(event, 90)" ><i class="fas fa-undo"></i></button>
                <button type="button" class="btn btn-margin btn-sm btn-primary" onclick="girarImagen(event, -90)"><i class="fas fa-redo"></i></button>
                <button type="button" class="btn btn-margin btn-sm btn-danger" onclick="eliminarImagen()"><i class="fas fa-trash-alt"></i></button>
                </div>
            ';
        }else{
            echo '<img id="img" class="img-responsive img-thumbnail" alt="Responsive image" src="'.$imgdefault.'">';
        }
    }

if(isset($_POST["id-registro-eliminar"]) && !empty($_POST["id-registro-eliminar"])){
    $idRegistro = $_POST["id-registro-eliminar"];
    $carpetaDestino = "img/imgdb/".$idRegistro.".jpg";
    $imgdefault = "img/default-user-img.jpg";
    unlink($carpetaDestino);
    echo ' 
            <div class="alert alert-danger fade in" style="margin-bottom: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fas fa-exclamation-circle"></i> Eliminada</strong> <br> La Captura ha sido Eliminada.
            </div>
        ';
}

?>