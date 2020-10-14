<?php

if(!empty($_POST)){
$asignatura = $_POST["asignatura-id"];
$semestre = $_POST["semestre-id"];
$nota = $_POST["nota"]; //arreglo con las notas
$estudiante = $_POST["ide"];
$columna = $_POST["idc"];
$typeInsert = $_POST["ida"];
$idCurso = $_POST["curso-id"];
$idLetra = $_POST["letra-id"];
$idIuP = 0;


    for ($i=0;$i < count($nota);$i++){//Consulto la cantidad del Array POST

        if($typeInsert[$i]==1){//ida = Si el valor de la celda ha cambiado

            $update = CalificacionesData::getNota($estudiante[$i],$columna[$i],$asignatura,$semestre);

            if(!empty($update->NOTA_ALUMNO_NOTA)){//verifico si ha tenido un cambio la nota en la bd

                if(!empty($nota[$i])){
                        //actualizar
                        $calificaciones =  new CalificacionesData();
                        $calificaciones->id = $update->ID_NOTA_ALUMNO;
                        $calificaciones->idEstudiante = $estudiante[$i];
                        $calificaciones->idSemestre = $semestre;
                        $calificaciones->idColumna = $columna[$i];
                        $calificaciones->idAsignatura = $asignatura;
                        $calificaciones->nota = $nota[$i];
                        $calificaciones->update();


                    }else{
                        //eliminar
                        $calificaciones =  new CalificacionesData();
                        $calificaciones->id = $update->ID_NOTA_ALUMNO;
                        $calificaciones->idEstudiante = $estudiante[$i];
                        $calificaciones->idSemestre = $semestre;
                        $calificaciones->idColumna = $columna[$i];
                        $calificaciones->idAsignatura = $asignatura;
                        $calificaciones->nota = $nota[$i];
                        $calificaciones->delete();
                    }
                
            }else{
                if(!empty($nota[$i])){
                    //agregar
                    $calificaciones =  new CalificacionesData();
                    $calificaciones->idEstudiante = $estudiante[$i];
                    $calificaciones->idSemestre = $semestre;
                    $calificaciones->idColumna = $columna[$i];
                    $calificaciones->idAsignatura = $asignatura;
                    $calificaciones->nota = $nota[$i];
                    $calificaciones->add();
                    }
            }

        }

    }

    echo '
        <div class="alert alert-success fade in" id="alert-nota" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fas fa-check-circle"></i> Las calificaciones han sido almacenadas correctamente
        </div>
    ';
    

}
?>