<!-- Content Header (Page header) -->
<?php 
$evaluacion = EvaluacionData::getEvaluacion($_GET["id_eval_r"]); 
$estudiante = EvaluacionData::getNombreEstudiante($_GET["id_est"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Carlos Morales Ormeño">
    <meta name="description"
        content="Sistema Administrativo Integral Educacional (SAIE), es un sistema de gestión escolar capaz de ayudar al proceso administrativo dentro de las instituciones educativas">
    <meta property="og:title" content="Sistema Administrativo Institucional Educacional SAIE">
    <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <title><?php echo ucwords(mb_strtolower(($evaluacion->NOMBRE_TEST))).' - '. $estudiante->NOMBRE_USUARIO; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- style -->
    <!-- build:css ./assets/css/site.min.css -->
    <link rel="stylesheet" href="libs/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/theme.css" type="text/css" />
    <?php echo '<link rel="stylesheet" href="assets/css/style.css?'.rand(1,1000).'">';?>
    <link type="text/css" rel="stylesheet" href="css/prism.css" />
    <!-- System -->
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<style>
    body {
        color: #000000;
    }
    .form-group {
        margin-bottom: 0rem;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        margin-bottom: 0rem;
        font-weight: 500;
        line-height: 1.0;
    }
    .alert {
        position: relative;
        padding: 0.2rem 1.1rem;
        margin-bottom: 0.2rem;
        border: 2px solid transparent;
        border-radius: 0.25rem;
    }
    .alert-info {
        color: #000;
        background: #ffffff;
        border-color: #148ea1;
    }
    .alert-danger {
        color: #f00;
        background: #ffffff;
        border-color: #d32535;
    }
    .card {
        border: 1px solid rgb(27 27 27);
    }
    .callout {
        border-left: 0px solid #e9ecef;
        border: 1px solid rgb(27 27 27);
    }
 
</style>

<body>

    <div class="page-hero page-container " id="page-hero">
        <div class="padding d-flex">
            <div class="page-title">
                <h2 class="text-md text-highlight"><?php echo ucwords(mb_strtolower(($evaluacion->NOMBRE_TEST))); ?></h2>
                <small >OA: <?php echo ucwords(strtolower(($evaluacion->OBJETIVO_APRENDIZAJE_TEST))); ?></small>
            </div>
            <div class="flex"></div>
            <div>
                
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <?php
            if(isset($_GET["id_eval_r"]) && !empty($_GET["id_eval_r"])){
   
                $preguntas = PreguntasData::getPreguntas($_GET["id_eval_r"]);
                $idEvaluacion = EvaluacionesData::getIdEvaluacion($_GET["id_est"], $_GET["id_ntest"], $_GET["id_eval_r"]);
                
                $idView = 1;
                
                
            
                $qt = 1;

                $columnas   = $_GET["id_column"]?:2;
                $column     = 0;
                

                if ($columnas>0){
                    if($columnas == 1){
                        $column = 12;
                    }else if($columnas == 2){
                        $column = 6;
                    }else if($columnas == 3){
                        $column = 4;
                    }else if($columnas == 4){
                        $column = 3;
                    }else{
                        $columnas = 4;
                        $column = 3;
                    }
                }
        
                if($qt==1){
            
                    $preguntasTabla = array();
            
                    $idArray = 0;
                    $x = 1;
                    $parNumber = 0;
            
                    echo '
                        <input type="hidden" id="estudiante-id" name="estudiante-id" value="">
                        <input type="hidden" id="test-id" name="test-id" value="">
                        <input type="hidden" id="qt" name="qt" value="'.$qt.'">
                    ';
                    echo '
                        <div class="callout callout-info">
                            <small>Nombre Estudiante</small>';
                            echo  '<h5>';
                            echo $estudiante->NOMBRE_USUARIO;
                            echo  '</h5>
                        </div>';
                    echo '
                    <div class="row">
                    ';
            
                    foreach($preguntas as $est):
            
                        $textos = TextosData::getTexto($est->ID);
                        $mostrarRespuesta = 0;
                       
            
                        if(!empty($textos)){
                            echo '
                            <div class="col-sm-12">
                                <div class="callout callout-info">
                                        <div>
                                            '.$textos->TXT_TEXTO.'
                                        </div>
                                </div>
                            </div>
                            ';

                            if($idArray>0){
                                echo '</div>';
                                if($idArray<count($preguntas)){
                                    echo '<div class="row" style="page-break-inside: avoid;">';
                                }
                                
                            }

                            $parNumber = 0;
                            
                        }
                        
                        echo '
                        <!-- Modulo Edición -->
                        
                            <div class="col-sm-'.$column.' py-2">
                                <div class="card card-primary h-100">
                                    <div class="card-header">
                                        <h5>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="tipo-pregunta['.$idArray.']" value="'.$est->TIPO_PREGUNTA.'">
                            
                    ';
            
                    $alternativas = AlternativasData::getAlternativaView($est->ID);
                    $letra = array("a","b","c","d","e","f","g","h","i","j","k");
                    $l=0;
            
                    //$jp = 0;
                    //echo (($jp=='0')?'1':'0');
            
                    if($est->TIPO_PREGUNTA == 0){
                        if(!empty($alternativas)){
                        
                            foreach($alternativas as $alt):
                                $respuesta = EvaluacionesData::getRespuesta($idEvaluacion->ID, $alt->ID);
                                if($alt->CORRECTA_ALTERNATIVA!='1' && !empty($respuesta->ID)){$mostrarRespuesta = 1;}
                                echo '
                                    <div class="form-group">
                                        <div class="'.(($alt->CORRECTA_ALTERNATIVA=='1')?'alert alert-info':((!empty($respuesta->ID))?'alert alert-danger':'')).'">
                                        '.(($alt->CORRECTA_ALTERNATIVA=='1')?'<small>Alternativa Correcta</small>':((!empty($respuesta->ID))?'<small>Respuesta Estudiante</small>':'')).'
                                            <h5><input type="radio" disabled name="pregunta-id['.$idArray.']" value="'.$alt->ID.'" id="rev-al-'.$alt->ID.'" '.((!empty($respuesta->ID))?'checked':'').'>
                                            <label for="rev-al-'.$alt->ID.'"> '.$letra[$l].'. </label>
                                            <label for="rev-al-'.$alt->ID.'">'.$alt->TEXTO_ALTERNATIVA.'</label>
                                            </h5>
                                        </div>
                                    </div>
                                    ';
            
                                $l = $l+1;
                            endforeach;
            
                        }
                    }else{
                        if(!empty($alternativas)){
                        
                            foreach($alternativas as $alt):
                                $respuesta = EvaluacionesData::getRespuesta($idEvaluacion->ID, $alt->ID);
                                if($alt->PUNTAJE_ALTERNATIVA > $respuesta->IN_PUNTAJE){$mostrarRespuesta=1;}
                                echo '
                                <div class="form-group">';
                                    if($idView==0){
                                    echo'
                                        <div class="alert alert-warning alert-dismissible">
                                            <h5><i class="icon fas fa-info"></i>Pregunta Abierta | <strong>Puntaje: '.$alt->PUNTAJE_ALTERNATIVA.'</strong></h5>
                                            Para calcular el puntaje, esta pregunta debe ser revisada por el docente.<br>
                                            <label for="puntaje_id" >Puntaje </label> <input style="width: 60px;" type="number" name="puntaje_id" id="'.$respuesta->ID.'" value="'.$respuesta->IN_PUNTAJE.'" maxlength="5" size="5" onblur="guardarPuntajeRespuesta('.$respuesta->ID.',this.value,'.$alt->PUNTAJE_ALTERNATIVA.')">
                                        </div>';
                                    }
                                    echo'
                                    <textarea readonly rows="5" style="
                                    width: 100%;
                                    min-height: 75px;
                                    outline: none;
                                    resize: none;
                                    border: 1px solid white;
                                    font-size: 17px;
                                    font-weight: 400;
                                    name="pregunta-id['.$idArray.']" id="rev-al-'.$alt->ID.'"
                                    placeholder="No hay respuesta">'.((!empty($respuesta->ID))?$respuesta->TXT_RESPUESTA:'').'</textarea>
                                    <input type="hidden" name="txt-id['.$idArray.']" value="'.$alt->ID.'">
                                </div>
                                    ';
            
                                $l = $l+1;
                            endforeach;
            
                           
                        }
                    }

                    $resolucion = ResolucionData::getResolucion($est->ID);
                    
                    if($mostrarRespuesta==1){

                        if(!empty($resolucion)){
                            echo '
                                <div class="callout callout-success">
                                    <div>
                                    <h5>Respuesta Correcta</h5>
                                        '.$resolucion->TXT_RESOLUCION.'
                                    </div><br>
                
                                </div>
                            ';
                        }
            
                    }
            
                    echo '  
                                 </div>
                            </div>
                        </div>
                        <!-- /.Modulo Edición -->
            
                        ';
            
                    $x = ++$x;
                    $idArray = ++$idArray;
                    $parNumber = ++$parNumber;
                    $par = $parNumber % $columnas;

                    if($idArray>0 && $par == 0){
                        echo '</div>';
                        if($idArray<count($preguntas)){
                            echo '<div class="row" style="page-break-inside: avoid;">';
                        }
                        
                    }
                    
                    endforeach;
               
            
                }else{
            
                    echo '
                    <div class="alert alert-danger fade in" id="alerta-error" role="alert">
                        Se ha exedido la cantidad máxima de evaluaciones realizadas
                    </div>
                    ';
            
                }
            }            
        ?>
        </div>
    </div>
    <script>
        window.print();
    </script>
    <!-- /.content -->
</body>

</html>