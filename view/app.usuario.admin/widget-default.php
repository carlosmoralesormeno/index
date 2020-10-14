<?php
//$uId = $_SESSION['user_id'];
//echo '<input type="hidden" id="id-registro" name="id-registro" value="'.$uId.'">';
//$curso = EstudiantesData::getCurso($uId);
//$estudiante = $uId;
//var_dump($curso);
?>


<!-- Content Header (Page header) -->
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Administrador de Usuarios</h2>
            <small class="text-muted">Visualizar los usuarios del sistema</small>
        </div>
        <div class="flex"></div>
        <div>
            <button type="button" name="" id="" class="btn btn-primary" onclick="nuevoUsuario()"><i
                    class="fas fa-plus-square"></i></button>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="sr">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Carlos Morales</td>
                        <td>Administrador</td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td>Macarena Ramirez</td>
                        <td>Docente</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content -->

<!-- modal-evaluacion-->
<div class="modal fade" id="modal-usuario" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-evaluacion"><i class="fas fa-user"></i> Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="alert alert-danger" id="alerta-session" role="alert">
                        </div>
                        <div id="run-estudiante" class="form-group">
                            <label for="run">RUN</label>
                            <input type="text" class="form-control" id="run" name="run" placeholder="12.345.678-9"
                                onchange="validaRut(this.value, this.id, 'a')" required
                                data-error-msg="Ingrese un RUN Válido" autofocus>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Apellido Paterno</label>
                            <input type="text" id="txt-nombre" class="form-control" placeholder="Apellido Paterno"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Apellido Materno</label>
                            <input type="text" id="txt-nombre" class="form-control" placeholder="Apellido Materno"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nombres</label>
                            <input type="text" id="txt-nombre" class="form-control" placeholder="Ingrese los Nombres"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">Correo Electrónico</label>
                            <input type="text" id="txt-nombre" class="form-control" placeholder="Ingrese el Correo Electrónico"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="usr">Tipo de Usuario</label>
                            <select class="form-control" id="sel1" required data-error-msg="Seleccione el Permiso">
                                <option value="" disabled selected>Seleccione</option>
                                <option value="1">Docente</option>
                                <option value="2">Administrador</option>
                            </select>
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