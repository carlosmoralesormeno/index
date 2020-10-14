<?php 
$id=$_GET["id"];
$_SESSION["RF"]["subfolder"] =$id;
?>

<?php echo '<input type="hidden" id="id-prueba" value="'.$id.'">'?>
<input type="hidden" id="id-curso" value="">
<input type="hidden" id="id-letra" value="">
<input type="hidden" id="id-estudiante" value="">
<input type="hidden" id="id-curso-p" value="">
<input type="hidden" id="id-qt" value="">
<input type="hidden" id="id-texto-p" value="">
<input type="hidden" id="id-resolucion-p" value="">

<input type="hidden" id="id-pregunta-a" name="id-pregunta-a" value="">
<input type="hidden" id="pregunta-id-edit" name="pregunta-id-edit" value="">
<input type="hidden" id="alternativa-id-edit" name="alternativa-id-edit" value="">
<input type="hidden" id="update-tipo-pregunta" name="update-tipo-pregunta" value="">
<div id="insert-pregunta"></div>

<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Modo Creativo de Evaluación</h2>
            <small class="text-muted">Crear y Modificar la Evaluación</small>
        </div>
        <div class="flex"></div>
        <div>
            <button class="btn btn-info" onclick="vistaPreviaEvaluacion(event)"><i class="fas fa-eye"></i></button>
            <!--button id="btn-new" class="btn btn-warning btn-margin" onclick="cargar_imprimir_evaluacion(<?php echo $id; ?>)"><i class="fas fa-print"></i></button-->
            <button id="btn-new" class="btn btn-warning btn-margin" onclick="configurar_impresion()"><i class="fas fa-print"></i></button>
            <a href="index.php?view=app.evaluacion.admin" class="ajax btn btn-primary"><i class="fas fa-undo"></i></a>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="sr">
            <div id="preguntas">
                <?php
                    if(isset($id) && !empty($id)){
   
                        $preguntas = PreguntasData::getPreguntas($id);
                        //$maxTest = EvaluacionesData::getMaxTest($_GET["id_eval_vista"]);
                        $puntajeTest = EvaluacionesData::getQuestPts($id);
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
                    ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->


<div class="modal fade" id="modal-msj" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-modal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="texto-modal">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="" id="" class="btn btn-primary" data-dismiss="modal"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-pregunta -->
<div class="modal fade" id="modal-preg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="far fa-check-circle"></i> Pregunta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tipo-pregunta">Tipo de Pregunta</label>
                    <select name="tipo-pregunta" id="tipo-pregunta" class="form-control"
                        onchange="DetectarCambioTipoPregunta()">
                        <option value="0">Alternativas</option>
                        <option value="1">Pregunta Abierta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txt-pregunta">Redate la Pregunta</label>
                    <textarea class="mceEditor" id="txt-pregunta" name="txt-pregunta"></textarea><br>
                </div>

                <div class="form-group">
                    <button id="btn-guardar-pregunta" class="btn btn-success" onclick="guardarPregunta(event)"><i
                            class="fas fa-save"></i> Guardar</button>
                    <button id="btn-actualizar-pregunta" class="btn btn-info" onclick="actualizarPregunta(event)"><i
                            class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-pregunta" class="btn btn-danger" onclick="eliminarPregunta(event)"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo-alt"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-alternativa-->
<div class="modal fade" id="modal-alt" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-list"></i> Alternativas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="vista-previa-pregunta-a"></div>
                <label for="txt-alternativa">Ingrese o modifique las alternativas</label>
                <textarea class="mceEditor" id="txt-alternativa" name="txt-alternativa"></textarea><br>

                <div class="accion-alternativa">
                    <button id="btn-guardar-alternativa" class="btn btn-success" onclick="guardarAlternativa(event)"><i
                            class="fas fa-plus"></i> Agregar</button>
                    <button id="btn-actualizar-alternativa" class="btn btn-info"
                        onclick="actualizarAlternativa(event)"><i class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-alternativa" class="btn btn-danger" onclick="eliminarAlternativa(event)"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-texto-->
<div class="modal fade" id="modal-texto" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="far fa-newspaper"></i> Textos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="vista-previa-pregunta-a"></div>
                <label for="txt-texto">Ingrese el texto para visualizar, antes de cada pregunta</label>
                <textarea class="mceEditorTxt" id="txt-texto" name="txt-texto"></textarea><br>

                <div class="accion-texto">
                    <button id="btn-guardar-texto" class="btn btn-success" onclick="guardarTexto(event)"><i
                            class="fas fa-plus"></i> Agregar</button>
                    <button id="btn-actualizar-texto" class="btn btn-info" onclick="actualizarTexto()"><i
                            class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-texto" class="btn btn-danger" onclick="eliminarTexto()"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-vista -->
<div class="modal fade" id="vista-previa" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-eye"></i> Vista Previa Evaluación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="texto-vista">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="" id="" class="btn btn-primary" data-dismiss="modal"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-vista -->

<!-- modal-impresion -->
<div class="modal fade" id="configurar-impresion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-print"></i> Configurar Impresion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="texto-impresion">
                <div class="form-group">
                    <label for="id-columnas">Columnas</label>
                    <input type="number" class="form-control" value="2" id="id-columnas" aria-describedby="helpId" placeholder="">
                </div>
                <button id="btn-guardar-configuracion" class="btn btn-block btn-success" onclick="cargar_imprimir_evaluacion(<?php echo $id; ?>)"><i class="fas fa-print"></i> Imprimir</button>
            </div>
            <div class="modal-footer">
                <button type="button" name="" id="" class="btn btn-primary" data-dismiss="modal"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-impresion -->

<!-- modal-resolucion-->
<div class="modal fade" id="modal-resolucion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-chalkboard-teacher"></i> Justificacion de Respuesta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="vista-previa-pregunta-a"></div>
                <label for="txt-resolucion">Ingrese el texto que justifica la respuesta como correcta. Este texto aparecerá si el estudiante selecciona una pregunta erronea o si el puntaje de una pregunta abierta es inferior al puntaje total de la pregunta.</label>
                <textarea class="mceEditorTxt" id="txt-resolucion" name="txt-resolucion"></textarea><br>

                <div class="accion-resolucion">
                    <button id="btn-guardar-resolucion" class="btn btn-success" onclick="guardarResolucion(event)"><i
                            class="fas fa-plus"></i> Agregar</button>
                    <button id="btn-actualizar-resolucion" class="btn btn-info" onclick="actualizarResolucion()"><i
                            class="fas fa-edit"></i> Actualizar</button>
                    <button id="btn-eliminar-resolucion" class="btn btn-danger" onclick="eliminarResolucion()"><i
                            class="fas fa-trash-alt"></i> Eliminar</button>
                    <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                            class="fas fa-undo"></i> Volver</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-resolucion-->

<!-- TinyMCe -->
<script src="plugins/tinymce5/tinymce.min.js"></script>
<!-- WIRIS script -->
<?php echo '<script src="js/wirislib.js?'.rand(1,1000).'"></script>';?>
<?php echo '<script src="js/wirislibtxt.js?'.rand(1,1000).'"></script>';?>
<?php //echo '<script src="js/jseditortexto.js?'.rand(1,1000).'"></script>';?>