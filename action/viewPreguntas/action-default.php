<?php

if(isset($_GET["id_ques"]) && !empty($_GET["id_ques"])){
    
    $preguntas = PreguntasData::getPreguntas($_GET["id_ques"]);
    
    
    if($preguntas > 0){
        $a = 1;
        echo '<option value="">Seleccione la Pregunta</option>';
        foreach($preguntas as $est):
            echo '<option value="'.$est->ID.'">'.$a.' - '.$est->TEXTO_PREGUNTA.'</option>';
            $a = ++$a;
        endforeach;
    }else{
        echo '<option value="">No hay preguntas</option>';
    }
}

if(isset($_GET["id_quest"]) && !empty($_GET["id_quest"])){
    
    $preguntas = PreguntasData::getPreguntas($_GET["id_quest"]);
    $valor = $_GET["id_value"];
    
    
    if($preguntas > 0){
        $a = 1;
        echo '<option value="">Seleccione la Pregunta</option>';
        foreach($preguntas as $est):
            echo '<option value="'.$est->ID.'" '.(($valor==$est->ID)?'selected':'').'>'.$a.' - '.$est->TEXTO_PREGUNTA.'</option>';
            $a = ++$a;
        endforeach;
    }else{
        echo '<option value="">No hay preguntas</option>';
    }
}

if(isset($_GET["id_predit"]) && !empty($_GET["id_predit"])){
   
    $pregunta = PreguntasData::getPreguntasView($_GET["id_predit"]);
    //echo $pregunta->TEXTO_PREGUNTA;
    /*echo'
        <input type="hidden" id="data-texto-pregunta" value="'.$pregunta->TEXTO_PREGUNTA.'">
        <input type="hidden" id="data-tipo-pregunta" value="'.$pregunta->TIPO_PREGUNTA.'">
        ';
    */
    $return_arr[] = array("txtPregunta" => $pregunta->TEXTO_PREGUNTA,
                    "tipoPregunta" => $pregunta->TIPO_PREGUNTA);
    echo json_encode($return_arr);
}

if(isset($_GET["id_aledit"]) && !empty($_GET["id_aledit"])){
   
    $alternativa = AlternativasData::getAlternativaEdit($_GET["id_aledit"]);
    
    echo $alternativa->TEXTO_ALTERNATIVA;

}

if(isset($_GET["id_pru"]) && !empty($_GET["id_pru"])){
    
    $preguntas = PreguntasData::getPreguntasView($_GET["id_pru"]);
    $alternativas = AlternativasData::getAlternativaView($preguntas->ID);
    $preguntasA = PreguntasData::getPreguntas($preguntas->ID_TEST_PREGUNTA);
    $pregunta = $preguntas->ID;
    $letra = array("a","b","c","d","e","f","g","h","i","j","k");
    $l=0;

    $preguntasTabla = array();

    $x = 1;
    foreach($preguntasA as $est):
        $preguntasTabla [$est->ID][0] = $x;
        $x = ++$x;
    endforeach;


    echo'
        <div class="alert alert-success fade in" id="alerta-save" role="alert">
            La alternativa correcta ha sido almacenada
        </div>
    ';

    echo '

    <!-- Modulo Edición -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h4>'.$preguntasTabla[$preguntas->ID][0].'. '.$preguntas->TEXTO_PREGUNTA.'</h4>

        </div>
        <div class="card-body">
        <form action="" id="form-edit-alternativa">
            <input type="hidden" id="pregunta-id" name="pregunta-id" value="'.$pregunta.'">
            <input type="hidden" id="puntaje_id" name="puntaje_id" value="0">
        
    <!-- /.Modulo Edición -->

    ';

    if(!empty($alternativas)){
      
        
        foreach($alternativas as $est):
            echo '
                
                    <input type="radio" name="alternativa-'.$pregunta.'" value="'.$est->ID.'" id="vp-'.$est->ID.'" onclick="editarAlternativaModalV2('.$pregunta.','.$est->ID.')">
                    <label for="vp-'.$est->ID.'"> '.$letra[$l].'. </label>
                    <label for="vp-'.$est->ID.'">'.$est->TEXTO_ALTERNATIVA.'</label>                    
                    <button type="button" class="btn btn-warning btn-sm" onclick="editarAlternativaModalV2('.$pregunta.','.$est->ID.')"><i class="fa fa-edit"></i> Editar</button>
                    <br>
                ';

            $l = $l+1;
        endforeach;
        echo '
                  
                </form>
            </div>
        </div>

        ';
    }else{
        echo '<h5>No se han creado las alternativas</5>';
    }
   
}

if(isset($_GET["id_pru_a"]) && !empty($_GET["id_pru_a"])){
    
    $preguntas = PreguntasData::getPreguntasView($_GET["id_pru_a"]);
    $alternativas = AlternativasData::getAlternativaView($preguntas->ID);
    $preguntasA = PreguntasData::getPreguntas($preguntas->ID_TEST_PREGUNTA);
    $pregunta = $preguntas->ID;
    $letra = array("a","b","c","d","e","f","g","h","i","j","k");
    $l=0;

    $preguntasTabla = array();

    $x = 1;

    
    foreach($preguntasA as $est):
        $preguntasTabla [$est->ID][0] = $x;
        $x = ++$x;
    endforeach;

    echo'
        <div class="alert alert-success fade in" id="alerta-save" role="alert">
            La alternativa correcta ha sido almacenada
        </div>
    ';

    echo '

    <!-- Modulo Edición -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h4>'.$preguntasTabla[$preguntas->ID][0].'. '.$preguntas->TEXTO_PREGUNTA.'</h4>
            <button type="button" class="btn btn-primary btn-block btn-sm" data-dismiss="modal" onclick="cargarPreguntaEditar('.$preguntas->ID.')"><i class="fa fa-edit"></i> Editar Pregunta</button>
            <br>
        </div>
        <div class="card-body">
        <form action="" id="form-edit-alternativa">
            <input type="hidden" id="pregunta-id" name="pregunta-id" value="'.$pregunta.'">
            <input type="hidden" id="puntaje_id" name="puntaje_id" value="0">
        
    <!-- /.Modulo Edición -->

    ';

    if($preguntas->TIPO_PREGUNTA == 0){
        if(!empty($alternativas)){
        
            foreach($alternativas as $est):
                echo '
                    <input type="radio" name="alternativa-id" value="'.$est->ID.'" id="'.$est->ID.'"  '.(($est->CORRECTA_ALTERNATIVA=='1')?'checked':'').' onclick="guardarAlternativaCorrecta(event)">
                    <label for="'.$est->ID.'"> '.$letra[$l].'. </label>
                    <label for="'.$est->ID.'">'.$est->TEXTO_ALTERNATIVA.'</label>
                    <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal" onclick="editarAlternativaV2('.$est->ID.','.$alt->ID.')"><i class="fa fa-edit"></i></button>
                    '.(($est->CORRECTA_ALTERNATIVA=='1')?' Puntaje: <input type="text" name="puntaje_id" value="'.(($est->PUNTAJE_ALTERNATIVA>'0')?$est->PUNTAJE_ALTERNATIVA:'0').'" maxlength="5" size="5" onblur="guardarAlternativaCorrecta(event)">':'').' 
                    <br>
                    ';
                $l = $l+1;
            endforeach;
            echo '
                        <div class="accion-alternativa-editar">
                            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="collapse" data-target="#collapseDatos" onclick="btnPreguntaAlternativa(1)"><i class="fa fa-list-ul"></i> Agregar Alternativas</button>
                        </div>

                </form>

                </div>
            </div>

            ';
        }else{
            echo '<h5>No se han creado las alternativas</h5>
            <div class="accion-alternativa-editar">
                <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="collapse" data-target="#collapseDatos" onclick="btnPreguntaAlternativa(1)">Crear Alternativa</button>
            </div>
            ';

        }
    }else{

        if(!empty($alternativas)){
        
            foreach($alternativas as $est):
                echo '
                    <input type="radio" name="alternativa-id" value="'.$est->ID.'" id="'.$est->ID.'"  '.(($est->CORRECTA_ALTERNATIVA=='1')?'checked':'').' onclick="guardarAlternativaCorrecta(event)">
                    <label for="'.$est->ID.'">Respuesta Abierta </label>
                    '.(($est->CORRECTA_ALTERNATIVA=='1')?' Puntaje: <input type="text" name="puntaje_id" value="'.(($est->PUNTAJE_ALTERNATIVA>'0')?$est->PUNTAJE_ALTERNATIVA:'0').'" maxlength="5" size="5" onblur="guardarAlternativaCorrecta(event)">':'').' 
                    <br>
                    ';
                $l = $l+1;
            endforeach;
            echo ' 
                    </form>
                </div>
            </div>

            ';
        }else{
            echo '<label>Ha ocurrido un error al almacenar la respuesta abierta</label>
            ';

        }
    }
    
}

// Cargar Evaluacion

if(isset($_GET["id_eval"]) && !empty($_GET["id_eval"])){
   
    //$preguntas = PreguntasData::getPreguntasRandom($_GET["id_eval"]);
    $preguntas = PreguntasData::getPreguntas($_GET["id_eval"]);
    $maxTest = EvaluacionesData::getMaxTest($_GET["id_eval"]);
    $questTest = EvaluacionesData::getQuestTest($_GET["id_reg_est"], $_GET["id_eval"]);
    $qt = $questTest->QUEST_TEST + 1;

    
    if($maxTest->MAX_TEST>$questTest->QUEST_TEST){

        $preguntasTabla = array();

        $idArray = 0;
        $x = 1;

        echo '
            <form id="form-evaluacion" method="" action="">
            <input type="hidden" id="estudiante-id" name="estudiante-id" value="">
            <input type="hidden" id="test-id" name="test-id" value="">
            <input type="hidden" id="qt" name="qt" value="'.$qt.'">

            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Recuerda:</h5>
                  <p>Leer atentamente cada pregunta y responder. Para terminar presiona <strong><i class="fas fa-paper-plane"></i> Enviar Tarea</strong></p>
            </div>
          
        ';
        
        foreach($preguntas as $est):

            $textos = TextosData::getTexto($est->ID);

            if(!empty($textos)){
                echo '
                <div class="callout callout-info">
                        <div>
                            '.$textos->TXT_TEXTO.'
                        </div>
                </div>
                ';
            }
            
            echo '
            <!-- Modulo Edición -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h4>
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
                <!-- /.Modulo Edición -->

                ';
            }
        }else{
            if(!empty($alternativas)){
            
                foreach($alternativas as $alt):
                    echo '

                    <div class="form-group">
                        <textarea rows="5" style="
                        float: left;
                        width: 100%;
                        min-height: 75px;
                        outline: none;
                        resize: none;
                        border: 1px solid grey;" 
                        name="pregunta-id['.$idArray.']" id="'.$alt->ID.'"
                        placeholder="Escribe tu respuesta"></textarea>
                        <input type="hidden" name="txt-id['.$idArray.']" value="'.$alt->ID.'">
                    </div>
                        ';

                    $l = $l+1;
                endforeach;

                echo '
                    </div>
                </div>
                <!-- /.Modulo Edición -->

                ';
            }
        }

        $x = ++$x;
        $idArray = ++$idArray;
        endforeach;

        echo '
            <div class="accion-alternativa-editar">
                <button type="submit" class="btn btn-block btn-primary" id="enviar-evaluacion" onclick="guardarEvaluacion(event)"><i class="fas fa-paper-plane"></i> Enviar Tarea</button>
            </div>
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
}

// Revisar Evaluación

if(isset($_GET["id_eval_r"]) && !empty($_GET["id_eval_r"])){
   
    $preguntas = PreguntasData::getPreguntas($_GET["id_eval_r"]);
    $idEvaluacion = EvaluacionesData::getIdEvaluacion($_GET["id_est"], $_GET["id_ntest"], $_GET["id_eval_r"]);
    $estudiante = EvaluacionData::getNombreEstudiante($_GET["id_est"]);
    $idView = $_GET["id_view"];

    $qt = 1;
    //echo (($jp=='0')?'1':'0');
    /*$respuestasRows = count($respuestas);
    $respuestasTabla = array();

    for($n=0;$n<$respuestasRows;$n++){
        $r =$respuestas[$n];
        $respuestasTabla [$r->ID_ALTERNATIVA] = array($r->TXT_RESPUESTA, $r->IN_PUNTAJE);
    }

    var_dump($respuestasTabla);

    if(empty($respuestasTabla[450][1])){
        echo 'Hola: '.$respuestasTabla[450][1];
    }*/

    if($qt==1){

        $preguntasTabla = array();

        $idArray = 0;
        $x = 1;


        echo '
            <input type="hidden" id="estudiante-id" name="estudiante-id" value="">
            <input type="hidden" id="test-id" name="test-id" value="">
            <input type="hidden" id="qt" name="qt" value="'.$qt.'">
                    
            <style>
            .form-control:disabled, .form-control[readonly] {
                background-color: #ffffff;
                opacity: 1;
            }
            </style>
            
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
        ';

        foreach($preguntas as $est):

            $textos = TextosData::getTexto($est->ID);
            $mostrarRespuesta = 0;

            if(!empty($textos)){
                echo '
                <div class="callout callout-info">
                        <div>
                            '.$textos->TXT_TEXTO.'
                        </div>
                </div>
                ';
            }
            
            echo '
            <!-- Modulo Edición -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h4>
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
                        <textarea class="form-control" readonly rows="5" style="
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
            <!-- /.Modulo Edición -->

            ';



        $x = ++$x;
        $idArray = ++$idArray;

        endforeach;

    }else{

        echo '
        <div class="alert alert-danger fade in" id="alerta-error" role="alert">
            Se ha exedido la cantidad máxima de evaluaciones realizadas
        </div>
        ';

    }
}

// Vista Previa Evaluacion

if(isset($_GET["id_eval_vista"]) && !empty($_GET["id_eval_vista"])){
   
    $preguntas = PreguntasData::getPreguntas($_GET["id_eval_vista"]);
    //$maxTest = EvaluacionesData::getMaxTest($_GET["id_eval_vista"]);
    $puntajeTest = EvaluacionesData::getQuestPts($_GET["id_eval_vista"]);
    $qt = count($preguntas);
    $cantidadPreguntas = count($preguntas);

    
    if($qt>0){

        $preguntasTabla = array();

        $idArray = 0;
        $x = 1;

        echo '

        <!-- Modulo Vista -->

                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-question-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Preguntas</span>
                                    <span class="info-box-number">'; 
                                    echo $cantidadPreguntas;
                                    echo'<small> Preg.</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-md-3">';
                        if(!empty($puntajeTest->PUNTAJE_TEST>0)){
                        echo'
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Puntaje Total</span>
                                    <span class="info-box-number">'; 
                                    echo $puntajeTest->PUNTAJE_TEST;
                                    echo'<small> Ptos.</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>';
                        }
                        echo'
                        </div>
                    </div>

               
                    <input type="hidden" id="estudiante-id" name="estudiante-id" value="">
                    <input type="hidden" id="test-id" name="test-id" value="">
                    <input type="hidden" id="qt" name="qt" value="'.$qt.'">
          
        ';
        
        foreach($preguntas as $est):

            $textos = TextosData::getTexto($est->ID);

            if(!empty($textos)){
                echo '
                <div class="callout callout-info">
                        <div>
                            '.$textos->TXT_TEXTO.'
                        </div><br>
                        <button type="button" class="btn btn-info btn-block" onclick="editarTexto('.$textos->ID.')"><i class="far fa-newspaper"></i> Editar Texto</button>
                </div>
                ';
            }else{
                echo '
                <button type="button" class="btn btn-info btn-block" onclick="nuevoTexto('.$est->ID.')">
                    <i class="far fa-newspaper"></i> Agregar Texto</button><br>
                ';
            }
            
            echo '

            <!-- Modulo Edición -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h4>
                    <button type="button" class="btn btn-primary btn-block" onclick="editarPreguntaV2('.$est->ID.')"><i class="fa fa-edit"></i> Editar Pregunta</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="tipo-pregunta['.$idArray.']" value="'.$est->TIPO_PREGUNTA.'">
        ';

        $alternativas = AlternativasData::getAlternativaView($est->ID);
        $letra = array("a","b","c","d","e","f","g","h","i","j","k");
        $l=0;

        if($est->TIPO_PREGUNTA == 0){
            if(!empty($alternativas)){
                foreach($alternativas as $alt):
                    echo '
                    
                    <input type="radio" name="alternativa-'.$idArray.'" value="'.$alt->ID.'" id="'.$alt->ID.'"  '.(($alt->CORRECTA_ALTERNATIVA=='1')?'checked':'').' onclick="guardarAlternativaCorrectaV2('.$est->ID.','.$alt->ID.',0)">
                    <label for="'.$alt->ID.'"> '.$letra[$l].'. </label>
                    <label for="'.$alt->ID.'">'.$alt->TEXTO_ALTERNATIVA.'</label>
                    <button type="button" class="btn btn-warning btn-sm" onclick="editarAlternativaV2('.$est->ID.','.$alt->ID.')"><i class="fa fa-edit"></i> Editar</button>
                    '.(($alt->CORRECTA_ALTERNATIVA=='1')?' Puntaje: <input style="width: 60px;" type="number" id="ptj-'.$est->ID.'" value="'.(($alt->PUNTAJE_ALTERNATIVA>'0')?$alt->PUNTAJE_ALTERNATIVA:'0').'" maxlength="5" size="5" onblur="guardarAlternativaCorrectaV2('.$est->ID.','.$alt->ID.',this.value)">':'').' 
                    <br>
                        ';

                    $l = $l+1;
                endforeach;

                echo '
                    <button type="button" class="btn btn-block btn-warning" onclick="agregarAlternativaV2('.$est->ID.',1)"><i class="fas fa-plus-square"></i> Agregar Alternativas</button>
                ';
            }else{
                echo '
                    <h5>No se han creado las alternativas</h5>
                    <button type="button" class="btn btn-block btn-warning" onclick="agregarAlternativaV2('.$est->ID.',1)"><i class="fas fa-plus-square"></i> Crear Alternativa</button>
                ';
            }
        }else{
            if(!empty($alternativas)){
            
                foreach($alternativas as $alt):
                    echo '
                    <input type="radio" name="alternativa-'.$idArray.'" value="'.$alt->ID.'" id="'.$alt->ID.'"  '.(($alt->CORRECTA_ALTERNATIVA=='1')?'checked':'').' onclick="guardarAlternativaCorrectaV2('.$est->ID.','.$alt->ID.')">
                    <label for="'.$alt->ID.'">Respuesta Abierta </label>
                    '.(($alt->CORRECTA_ALTERNATIVA=='1')?' Puntaje: <input style="width: 60px;" type="number" id="ptj-'.$est->ID.'" value="'.(($alt->PUNTAJE_ALTERNATIVA>'0')?$alt->PUNTAJE_ALTERNATIVA:'0').'" maxlength="5" size="5" onblur="guardarAlternativaCorrectaV2('.$est->ID.','.$alt->ID.',this.value)">':'').' 
                    <br>
                        ';

                    $l = $l+1;
                endforeach;

                echo '
                ';
            }else{
                echo '
                    <h5>No se han creado las alternativas</h5>
                    <button type="button" class="btn btn-block btn-primary" onclick="agregarAlternativaV2('.$est->ID.',1)"><i class="fas fa-plus-square"></i> Crear Alternativa</button> 
                ';
    
            }
        }

        $resolucion = ResolucionData::getResolucion($est->ID);
                    
        if(!empty($resolucion)){
            echo '
                <br><div class="callout callout-success">
                    <div>
                    <h5>Respuesta Correcta</h5>
                        '.$resolucion->TXT_RESOLUCION.'
                    </div><br>
                    <button type="button" class="btn btn-secondary btn-block" onclick="editarResolucion('.$resolucion->ID.')"><i class="fas fa-chalkboard-teacher"></i> Editar Justificacion de Respuesta</button>
            </div>
            ';
        }else{
            echo '
            <button type="button" class="btn btn-block btn-secondary" onclick="nuevaResolucion('.$est->ID.')"><i class="fas fa-chalkboard-teacher"></i> Justificacion de Respuesta</button>
            ';
        }


        $x = ++$x;
        $idArray = ++$idArray;
        echo '
                </div>
            </div>
   
        <!-- /.Modulo Edición -->
        ';
        endforeach;
        echo'
            <button type="button" class="btn btn-success btn-block" onclick="NuevaPreguntaV2(0,2)"><i
            class="far fa-question-circle"></i> Agregar Pregunta</button>
        ';
    
    }else{

        echo '
            
                    <div class="callout callout-danger">
                        <div class="d-flex justify-content-between">
                            <h5><i class="icon fas fa-info"></i> No hay preguntas</h5>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-block" onclick="NuevaPreguntaV2(0,2)"><i
                    class="far fa-question-circle"></i> Agrega la Primera Pregunta</button>
                
        ';

    }

    echo '<script type="text/javascript" src="js/wirislibest.js"></script>';
}

if(isset($_GET["id_evadit"]) && !empty($_GET["id_evadit"])){
   
    $evaluacion = EvaluacionData::getEvaluacion($_GET["id_evadit"]);
    $return_arr[] = array("txtNombre" => $evaluacion->NOMBRE_TEST,
                    "txtAsignatura" => $evaluacion->ASIGNATURA_TEST,
                    "txtOA" => $evaluacion->OBJETIVO_APRENDIZAJE_TEST,
                    "txtHabilidades" => $evaluacion->HABILIDADES_TEST
                );
    echo json_encode($return_arr);
}

if(isset($_GET["id_txtedit"]) && !empty($_GET["id_txtedit"])){
   
    $textos = TextosData::getTextoById($_GET["id_txtedit"]);
    //echo $pregunta->TEXTO_PREGUNTA;
    /*echo'
        <input type="hidden" id="data-texto-pregunta" value="'.$pregunta->TEXTO_PREGUNTA.'">
        <input type="hidden" id="data-tipo-pregunta" value="'.$pregunta->TIPO_PREGUNTA.'">
        ';
    */
    $return_arr[] = array("txtTexto" => $textos->TXT_TEXTO);
    echo json_encode($return_arr);
}

if(isset($_GET["id_resoedit"]) && !empty($_GET["id_resoedit"])){
   
    $resolucion = ResolucionData::getResolucionById($_GET["id_resoedit"]);
    //echo $pregunta->TEXTO_PREGUNTA;
    /*echo'
        <input type="hidden" id="data-texto-pregunta" value="'.$pregunta->TEXTO_PREGUNTA.'">
        <input type="hidden" id="data-tipo-pregunta" value="'.$pregunta->TIPO_PREGUNTA.'">
        ';
    */
    $return_arr[] = array("txtResolucion" => $resolucion->TXT_RESOLUCION);
    echo json_encode($return_arr);
}

//Vista Previa Editor

if(isset($_GET["id_eva_prevista"]) && !empty($_GET["id_eva_prevista"])){
   
    //$preguntas = PreguntasData::getPreguntasRandom($_GET["id_eval"]);
    $preguntas = PreguntasData::getPreguntas($_GET["id_eva_prevista"]);
    $qt = 1;

    
    if($qt==1){

        $preguntasTabla = array();

        $idArray = 0;
        $x = 1;

        echo '
            <form id="form-evaluacion" method="" action="">

            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Recuerda:</h5>
                  <p>Leer atentamente cada pregunta y responder. Para terminar presiona <strong><i class="fas fa-paper-plane"></i> Enviar Tarea</strong></p>
            </div>
          
        ';
        
        foreach($preguntas as $est):

            $textos = TextosData::getTexto($est->ID);

            if(!empty($textos)){
                echo '
                <div class="callout callout-info">
                        <div>
                            '.$textos->TXT_TEXTO.'
                        </div>
                </div>
                ';
            }
            
            echo '
            <!-- Modulo Edición -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>'.$x.'. '.$est->TEXTO_PREGUNTA.'</h4>
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
                <!-- /.Modulo Edición -->

                ';
            }
        }else{
            if(!empty($alternativas)){
            
                foreach($alternativas as $alt):
                    echo '

                    <div class="form-group">
                        <textarea rows="5" style="
                        float: left;
                        width: 100%;
                        min-height: 75px;
                        outline: none;
                        resize: none;
                        border: 1px solid grey;" 
                        name="pregunta-id['.$idArray.']" id="'.$alt->ID.'"
                        placeholder="Escribe tu respuesta"></textarea>
                        <input type="hidden" name="txt-id['.$idArray.']" value="'.$alt->ID.'">
                    </div>
                        ';

                    $l = $l+1;
                endforeach;

                echo '
                    </div>
                </div>
                <!-- /.Modulo Edición -->

                ';
            }
        }

        $x = ++$x;
        $idArray = ++$idArray;
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