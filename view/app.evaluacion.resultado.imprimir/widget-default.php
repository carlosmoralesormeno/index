<!-- Content Header (Page header) -->

<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Resultados Evaluación</h2>
            <small class="text-muted">Resultado de Evaluacion</small>
        </div>
        <div class="flex"></div>
        <div>
            <button id="btn-new" class="btn btn-info btn-margin"
                onclick="window.print();"><i class="fas fa-print"></i>
            </button>
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
                $estudiante = EvaluacionData::getNombreEstudiante($_GET["id_est"]);
                $idView = 1;
            
                $qt = 1;
        
                if($qt==1){
            
                    $preguntasTabla = array();
            
                    $idArray = 0;
                    $x = 1;
            
                    echo '
                        <input type="hidden" id="estudiante-id" name="estudiante-id" value="">
                        <input type="hidden" id="test-id" name="test-id" value="">
                        <input type="hidden" id="qt" name="qt" value="'.$qt.'">
                    ';
                    echo '
                    <div class="row">
                        <div class="col-sm-6">';
                        echo '<div class="callout callout-info">
                            <small>Nombre Estudiante</small>';
                            echo  '<h5>';
                            echo $estudiante->NOMBRE_USUARIO;
                            echo  '</h5>
                            </div>';
                    echo '</div>
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
                        }
                        
                        echo '
                        <!-- Modulo Edición -->
                        
                            <div class="col-sm-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h6>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h6>
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
                                echo '
                                    <div class="form-group">
                                        <div class="'.(($alt->CORRECTA_ALTERNATIVA=='1')?'alert alert-info':((!empty($respuesta->ID))?'alert alert-danger':'')).'">
                                        '.(($alt->CORRECTA_ALTERNATIVA=='1')?'<small>Alternativa Correcta</small>':((!empty($respuesta->ID))?'<small>Respuesta Estudiante</small>':'')).'
                                            <h6><input type="radio" disabled name="pregunta-id['.$idArray.']" value="'.$alt->ID.'" id="rev-al-'.$alt->ID.'" '.((!empty($respuesta->ID))?'checked':'').'>
                                            <label for="rev-al-'.$alt->ID.'"> '.$letra[$l].'. </label>
                                            <label for="rev-al-'.$alt->ID.'">'.$alt->TEXTO_ALTERNATIVA.'</label>
                                            </h6>
                                        </div>
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
                    }else{
                        if(!empty($alternativas)){
                        
                            foreach($alternativas as $alt):
                                $respuesta = EvaluacionesData::getRespuesta($idEvaluacion->ID, $alt->ID);
                                echo '
                                <div class="form-group">';
                                    if($idView==0){
                                    echo'
                                        <div class="alert alert-warning alert-dismissible">
                                            <h6><i class="icon fas fa-info"></i>Pregunta Abierta | <strong>Puntaje: '.$alt->PUNTAJE_ALTERNATIVA.'</strong></h6>
                                            Para calcular el puntaje, esta pregunta debe ser revisada por el docente.<br>
                                            <label for="puntaje_id" >Puntaje </label> <input style="width: 60px;" type="number" name="puntaje_id" id="'.$respuesta->ID.'" value="'.$respuesta->IN_PUNTAJE.'" maxlength="5" size="5" onblur="guardarPuntajeRespuesta('.$respuesta->ID.',this.value,'.$alt->PUNTAJE_ALTERNATIVA.')">
                                        </div>';
                                    }
                                    echo'
                                    <textarea readonly rows="5" style="
                                    float: left;
                                    width: 100%;
                                    min-height: 75px;
                                    outline: none;
                                    resize: none;
                                    border: 1px solid grey;" 
                                    name="pregunta-id['.$idArray.']" id="rev-al-'.$alt->ID.'"
                                    placeholder="No hay respuesta">'.((!empty($respuesta->ID))?$respuesta->TXT_RESPUESTA:'').'</textarea>
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
                    endforeach;
                echo '</div>';
            
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
