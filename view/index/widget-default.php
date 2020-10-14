<?php 
$uId = $_SESSION['type_user'];
?>

<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Inicio</h2>
            <small class="text-muted">Página de Bienvenida</small>
        </div>
        <div class="flex"></div>

    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">

        <div class="row">
            <div class="col-lg-6">

                <!--CardInicio-->
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <dl>
                            <dt>Hola</dt>
                            <dd>Estamos trabajando para agregar nuevas funciones. Ten un poco de paciencia</dd>
                        </dl>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->

            <div class="col-lg-6">
                <!--CardInicio-->
                <?php if($uId==1):?>
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        Importante
                    </div>
                    <div class="card-body">
                        <dt>Estimado Estudiante</dt>
                        <dd>Para Acceder a las Tareas Pendientes, presione <strong><i class="fas fa-tasks"></i>
                                Tareas</strong></dd>
                        <a href="index.php?view=app.evaluacion.tareas" class="ajax btn btn-primary"><i
                                class="fas fa-tasks"></i> Ver Tareas</a>
                    </div>
                </div>
                <?php endif;?>
                <?php if($uId==2):?>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        Funcionalidades Nuevas
                    </div>
                    <div class="card-body">
                        <dt>Justificacion de Respuesta</dt>
                        <dd>Esta funcion permite agregar un texto en la parte inferior de la alternativa, indicando cual
                            es la respuesta deseada. Este texto aparecerá unicamente cuando <strong>la respuesta sea incorrecta
                            o el puntaje de una pregunta abierta sea inferior al puntaje total de la pregunta</strong></dd>

                        <dt>Configurar Estudiantes</dt>
                        <dd>Se ha agregado esta función con el fin de seleccionar a los estudiantes que <strong>no
                                pueden rendir la evaluación</strong>, la cual esta disponible en el módulo de
                            <strong>Configuración de la Evaluación </strong>
                            <button type="button" class="btn btn-danger btn-sm btn-margin"><i
                                    class="fas fa-sliders-h"></i></button>
                            en donde el nuevo botón <button id="btn-new" class="btn btn-primary btn-sm btn-margin"><i
                                    class="fas fa-users"></i>
                            </button> le permitirá seleccionar a estos estudiantes
                        </dd>

                        <dt>Impresión de Evaluaciones</dt>
                        <dd>Se ha agregado el icono de impresion <button id="btn-new"
                                class="btn btn-warning btn-sm btn-margin"><i class="fas fa-print"></i>
                            </button> en algunos módulos, <strong>Pruébalo</strong></dd>
                    </div>
                </div>

                <div class="card card-danger card-outline">
                    <div class="card-header">
                        Importante
                    </div>
                    <div class="card-body">
                        <dt>Estimado Docente:</dt>
                        <dd>Para Acceder a Evaluaciones Presione <strong><i class="fas fa-file-alt"></i>
                                Evaluaciones</strong></dd>
                        <a href="index.php?view=app.evaluacion.admin" class="ajax btn btn-primary"><i
                                class="fas fa-file-alt"></i> ir a Evaluaciones</a>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
</div>
<!-- /.content -->