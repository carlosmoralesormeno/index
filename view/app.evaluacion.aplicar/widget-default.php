<?php
$idTest = $_GET['id'];
$idEstudiante = $_SESSION['user_id'];
?>

<?php
    echo '<script src="js/jstareas.js?'.rand(1,1000).'"></script>';
?>

<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">

<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Completar Tarea</h2>
            <small class="text-muted">Lee detenidamente y contesta las preguntas que aparecen</small>
        </div>
        <div class="flex"></div>
        <div>
            <a href="index.php?view=app.evaluacion.tareas" class="ajax btn btn-primary btn-margin"><i
                    class="fas fa-undo"></i><span> Salir</span></a>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <?php //echo '<script> cargarEvaluacionTest('.$idTest.','.$idEstudiante.')</script>';?>
        <div id="resultado">
        </div>

        <div class="sr">
            <div id="evaluacion">
                <?php
                    if(isset($idTest) && !empty($idTest)){
                        //$preguntas = PreguntasData::getPreguntasRandom($_GET["id_eval"]);
                        $preguntas = PreguntasData::getPreguntas($idTest);
                        $maxTest = EvaluacionesData::getMaxTest($idTest);
                        $questTest = EvaluacionesData::getQuestTest($idEstudiante, $idTest);
                        $qt = $questTest->QUEST_TEST + 1;

                        
                        if($maxTest->MAX_TEST>$questTest->QUEST_TEST){

                            $preguntasTabla = array();

                            $idArray = 0;
                            $x = 1;

                            echo '
                                <form id="form-evaluacion" method="" action="">
                                <input type="hidden" id="estudiante-id" name="estudiante-id" value="'.$idEstudiante.'">
                                <input type="hidden" id="test-id" name="test-id" value="'.$idTest.'">
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

                ?>

            </div>
        </div>
        <div class="callout callout-info" id="alerta-save">
            <h5><i class="fas fa-info"></i> La tarea ha sido enviada:</h5>
            Revisa si tienes otra tarea <a name="" id="" class="ajax btn btn-info"
                href="index.php?view=app.evaluacion.tareas" role="button"><i class="fas fa-sync-alt"></i> Revisar</a>
        </div>
    </div>
</div>
<!-- /.content -->
<!-- WIRIS script -->
<script type="text/javascript" src="js/wirislibest.js"></script>