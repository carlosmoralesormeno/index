<!-- Content Header (Page header) -->
<?php 
$evaluacion = EvaluacionData::getEvaluacion($_GET["id_eva_prevista"]); 
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
    <title><?php echo ucwords(mb_strtolower(($evaluacion->NOMBRE_TEST))); ?></title>
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

    @media print {
        .btn {
            display: none !important;
        }
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
                <button id="btn-new" class="btn btn-primary btn-margin" onclick="window.print();"><i
                        class="fas fa-print"></i>
                </button>
            <div>
                
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <?php
            if(isset($_GET["id_eva_prevista"]) && !empty($_GET["id_eva_prevista"])){
   
                //$preguntas = PreguntasData::getPreguntasRandom($_GET["id_eval"]);
                $preguntas = PreguntasData::getPreguntas($_GET["id_eva_prevista"]);
                
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
                        <form id="form-evaluacion" method="" action="">
            
                        <div class="callout callout-info">
                            <h5>Nombre Estudiante:</h5>
                            <h5>Curso:</h5>
                        </div>
                        <div class="row">
                    ';
                    
                    foreach($preguntas as $est):
            
                        $textos = TextosData::getTexto($est->ID);
                        
            
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
            
                    $alternativas = AlternativasData::getAlternativaViewRandom($est->ID);
                    $letra = array("a","b","c","d","e","f","g","h","i","j","k");
                    $l=0;
            
                    if($est->TIPO_PREGUNTA == 0){
                        if(!empty($alternativas)){
                        
                            foreach($alternativas as $alt):
                                echo '
                                
                                    <h5><input type="radio" name="pregunta-id['.$idArray.']" value="'.$alt->ID.'" id="'.$alt->ID.'" >
                                    <label for="'.$alt->ID.'"> '.$letra[$l].'. </label>
                                    <label for="'.$alt->ID.'">'.$alt->TEXTO_ALTERNATIVA.'</label></h5>
                                    ';
            
                                $l = $l+1;
                            endforeach;
            
                            echo '
                                    </div>
                                </div>
                            </div>
                            <!-- /.Modulo Edición -->
            
                            ';
                        }
                    }else{
                        if(!empty($alternativas)){
                        
                            foreach($alternativas as $alt):
                                echo '
            
                                <div class="form-group">
                                    <textarea rows="10" style="
                                    float: left;
                                    width: 100%;
                                    min-height: 75px;
                                    outline: none;
                                    border: 1px solid grey;" 
                                    name="pregunta-id['.$idArray.']" id="'.$alt->ID.'"
                                    ></textarea>
                                    <input type="hidden" name="txt-id['.$idArray.']" value="'.$alt->ID.'">
                                </div>
                                    ';
            
                                $l = $l+1;
                            endforeach;
            
                            echo '
                                    </div>
                                </div>
                            </div>
                            <!-- /.Modulo Edición -->
            
                            ';
                        }
                    }
            
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
            
                    echo '
                       
                    </form>
                    ';
            
                }else{
            
                    echo '
                    <div class="alert alert-danger alert-dismissible" id="alerta-max">
                    <h5><i class="icon fas fa-info"></i> Limite Excedido</h5>
                    No puedes acceder a esta evaluación.
                    </div>
                    ';
            
                }
            
                echo '<script type="text/javascript" src="js/wirislibest.js"></script>';
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