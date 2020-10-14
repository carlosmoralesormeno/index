<?php

if (empty($_SESSION['id.rut.eval'])){
    $uId = $_SESSION['user_id'];
}else{
    $uId = $_SESSION['id.rut.eval'];
}

echo '<input type="hidden" id="id-registro" value="'.$uId.'">';
$asignaturas = AsignaturasData::getAllEvaluacion();
$cursos = CursosData::getAll();
$evaluaciones = EvaluacionData::getEvaluaciones($uId);
$personas = PersonasData::getAllPersonas();
$cursos = CursosData::getAll();
$docentes = EvaluacionData::getEvaluacionDocente();
//contar el total de evaluaciones
$totalEval = count($evaluaciones);
?>
<input type="hidden" id="id-prueba" name="id-prueba" value="">
<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Evaluaciones</h2>
            <small class="text-muted">Administrador de Evaluaciones</small>
        </div>
        <div class="flex"></div>
        <div>
            <a href="index.php?view=app.evaluacion.reporte" class="ajax btn btn-warning btn-margin"><i
                    class="fas fa-share-square"></i><span> Compartidas</span></a>
            <button type="button" name="" id="" class="btn btn-primary" onclick="cargarNuevaEvaluacion()"><i
                    class="fas fa-plus-square"></i></button>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">

        <?php

            if ($_SESSION['admin']==10){

                echo '
                        <div class="form-group">
                            <label for="id-docente"><strong>Docente</strong></label>
                            <select id="id-docente" data-plugin="select2" class="form-control" onchange="sessionEvaluacion(this.value)">
                ';
                            
                    if(!empty($docentes)){
                        foreach($docentes as $d):
                        echo '<option value="'.$d->ID_RUT.'"'.(($uId==$d->ID_RUT)?'selected':'').'>'.$d->NOMBRE.'</option>';
                        endforeach;
                    }
                                
                echo '
                            </select>
                        </div>
                ';
                            }
        ?>

        <div id="evaluaciones">
            <?php if($totalEval>0): ?>

            <div class="table-responsive">
                <table class="table table-theme table-row v-middle">
                    <thead>
                        <tr>
                            <th class="text-muted" style="width:20px;">#</th>
                            <th class="text-muted" style="width:200px;">Nombre</th>
                            <th class="text-muted" style="width:150px;">Asignatura</th>
                        </tr>
                    </thead>

                    <?php
                $n = 1;
                    if(!empty($evaluaciones)){
                        foreach($evaluaciones as $r):
                        $OASub = "";
                        $OALen = strlen($r->OBJETIVO_APRENDIZAJE_TEST);
                        if ($OALen>50){
                            $OASub = substr($r->OBJETIVO_APRENDIZAJE_TEST, 0, 50)."...";
                        }else{
                            $OASub = $r->OBJETIVO_APRENDIZAJE_TEST;
                        }
                        $HASub = "";
                        $HALen = strlen($r->HABILIDADES_TEST);
                        if ($HALen>50){
                            $HASub = substr($r->HABILIDADES_TEST, 0, 50)."...";
                        }else{
                            $HASub = $r->HABILIDADES_TEST;
                        }
                        echo "<td>$n</td>";
                        echo '<td class="flex">
                        <a href="index.php?view=app.evaluacion.editar&id='.$r->ID_TEST.'" class="ajax item-title text-color "><strong>'.ucwords(mb_strtolower(($r->NOMBRE_TEST))).'</strong></a><br>
                        <small><strong>OA: </strong>'.$OASub.'</small><br>
                        <small><strong>Habilidades: </strong> '.$HASub.'</small><br>';
                        echo '
                        <button type="button" class="btn btn-warning btn-margin" onclick="cargarEvaluacionEditar('.$r->ID_TEST.')"><i class="fas fa-pencil-alt"></i></button>
                        <a href="index.php?view=app.evaluacion.editar&id='.$r->ID_TEST.'" class="ajax btn btn-primary"><i class="fas fa-file-alt"></i></i></a>
                        <button type="button" class="btn btn-danger btn-margin" onclick="cargarConfigurarEvaluacion('.$r->ID_TEST.')"><i class="fas fa-sliders-h"></i></button>
                        <a href="index.php?view=app.evaluacion.resultado&id='.$r->ID_TEST.'" class="ajax btn btn-info"><i class="fas fa-poll-h"></i></i></a></td>';
                        //echo "<td>$r->OBJETIVO_APRENDIZAJE_TEST</td>";
                        echo "<td>$r->NOMBRE_ASIGNATURA</td>";
                        echo "</tr>";
                        $n = ++$n;
                        endforeach;
                    }
                    echo "</table>";
                ?>
            </div>

            <?php else: ?>


            <div class="callout callout-danger">
                <div class="d-flex justify-content-between">
                    <h5><i class="icon fas fa-info"></i> No hay evaluaciones</h5>
                </div>
            </div>


            <?php endif; ?>

        </div>
    </div>
</div>
<div id="reporte"></div>
<!-- /.content -->
<!-- modal-evaluacion-->
<div class="modal fade" id="modal-evaluacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-evaluacion"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" id="txt-nombre" class="form-control"
                                placeholder="Ingrese el Nombre de la Evaluación" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="id-asignatura">Asignatura</label>
                            <select name="asignatura" id="id-asignatura" class="form-control">
                                <option value="" disabled selected>Seleccione la Asignatura</option>
                                <?php foreach($asignaturas as $cur):?>
                                <option value="<?php echo $cur->COD_ASIGNATURA; ?>">
                                    <?php echo $cur->NOMBRE_ASIGNATURA; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Objetivos de Aprendizaje</label>
                            <textarea class="form-control" id="txt-objetivo" rows="3"
                                placeholder="Ingrese el Objetivo de Aprendizaje"
                                style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Habilidades</label>
                            <textarea class="form-control" id="txt-habilidad" rows="3"
                                placeholder="Ingrese las habilidades"
                                style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                        </div>
                    </div>
                </div>

                <button id="btn-guardar-evaluacion" class="btn btn-success" onclick="guardarNuevaEvaluacion()"><i
                        class="fas fa-save"></i> Guardar</button>
                <button id="btn-actualizar-evaluacion" class="btn btn-info" onclick="actualizarEvaluacion()"><i
                        class="fas fa-edit"></i> Actualizar</button>
                <button id="btn-eliminar-evaluacion" class="btn btn-danger" onclick="eliminarEvaluacion()"><i
                        class="fas fa-trash-alt"></i> Eliminar</button>
                <button id="btn-volver-menu" data-dismiss="modal" class="btn btn-primary float-right"><i
                        class="fas fa-undo-alt"></i> Volver</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal-aplicar-->
<div class="modal fade" id="modal-aplicacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-aplicacion"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="id-curso-c">Curso</label>
                            <select name="curso" id="id-curso-c" class="form-control">
                                <option value="" disabled selected>Seleccione el Curso</option>
                                <?php foreach($cursos as $cur):
                                    ?>
                                <option value="<?php echo $cur->ID_CURSO; ?>">
                                    <?php echo $cur->NOMBRE_CURSO.' '.$cur->NOMBRE_LETRA; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="id-intentos">Registro</label>
                            <input type="number" class="form-control" name="Intentos" id="id-intentos"
                                aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                </div>

                <button id="btn-guardar-configuracion" class="btn btn-block btn-success"
                    onclick="guardarConfigurarEvaluacion()"><i class="fas fa-plus"></i> Agregar</button><br>
                <div id="tabla-evaluacion"></div>
                <button id="btn-volver-menu" data-dismiss="modal" class="btn float-right btn-primary"><i
                        class="fas fa-undo"></i> Volver</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>