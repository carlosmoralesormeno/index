<script src="js/jsmatricula.js"></script>
<?php 
$uId = $_SESSION['type_user'];
?>
<section>
    <input type="hidden" id="rut-a" name="rut-a" value="">
    <input type="hidden" id="dv-a" name="dv-a" value="">
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <div class="page-title">
                    <h3><i class="fa fa-user-plus"></i> Administrador de Matricula</h3>
                    <p>Permite mantener la información del los estudiantes que se encuentran en el sistema</p>
                    <div class="alert alert-info fade in" id="alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> <strong>Recuerde </strong> <br>
                        Validar la información con el
                        <b>Certificado de Nacimiento y el Apoderado Titular</b>.
                    </div>
                </div>

                <form class="form" action="">
                    <!--Datos del Estudiante-->
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-menu">
                            <i class="fa fa-user-graduate"></i> Datos del Estudiante
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="alert alert-danger" id="alerta-session" role="alert">
                                    </div>
                                    <div id="run-estudiante" class="form-group">
                                        <label for="run">RUN</label>
                                        <input type="text" class="form-control" id="run" name="run"
                                            placeholder="12.345.678-9" onchange="validaRut(this.value, this.id, 'a')"
                                            required data-error-msg="Ingrese un RUN Válido" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Apellido Paterno">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Apellido Materno</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Apellido Materno">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Nombres</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Nombre del Estudiante">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="sel1">Sexo</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Masculino</option>
                                            <option value="1">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Edad</label>
                                        <input type="text" disabled class="form-control" id="usr" value="0">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="ussel1r">Estado Civil</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Soltero</option>
                                            <option value="1">Casado</option>
                                            <option value="2">Viudo/Separado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sel1">Nacionalidad</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Chilena</option>
                                            <option value="1">Extranjera</option>
                                            <option value="2">Nacionalidado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Comuna</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Seleccione una Comuna">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Bulnes</option>
                                            <option value="1">Chillán</option>
                                            <option value="2">Quillón</option>
                                            <option value="3">Santa Clara</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="usr">Dirección</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese una Dirección">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Teléfono</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Celular</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese un Número">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Email</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN--Datos del Estudiante-->

                    <!--Datos del Apoderado-->
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-menu">
                            <i class="fa fa-user"></i> Datos del Apoderado
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">RUN</label>
                                        <input type="text" class="form-control" id="usr" placeholder="12.345.678-9"
                                            required data-error-msg="Ingrese un RUN Válido">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Apellido Paterno">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="usr">Apellido Materno</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Apellido Materno">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Nombres</label>
                                        <input type="text" class="form-control" id="usr" required
                                            data-error-msg="Ingrese el Nombre">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Edad</label>
                                        <input type="text" disabled class="form-control" id="usr" value="0">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="ussel1r">Estado Civil</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Soltero</option>
                                            <option value="1">Casado</option>
                                            <option value="2">Viudo/Separado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sel1">Parentesco</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Madre</option>
                                            <option value="1">Padre</option>
                                            <option value="2">Abuelo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="usr">Nivel Educacional</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">1°Básico</option>
                                            <option value="1">8°Básico</option>
                                            <option value="2">4°Medio H/C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="usr">Situación Laboral</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Jornada Completa</option>
                                            <option value="1">Jornada Parcial</option>
                                            <option value="2">Cesante o Busca Trabajo</option>
                                            <option value="3">Dueña de Casa, Jubilado, Pensionado, etc. </option>
                                            <option value="4">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="usr">Lugar de Trabajo</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Elija una opción">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">En el Hogar</option>
                                            <option value="1">Fuera del Hogar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN--Datos del Apoderado-->

                    <!--Datos Apoderados Suplentes-->
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-menu">
                            <i class="fa fa-users"></i> Apoderados Suplentes
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Nombre y Apellidos</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class=" col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Edad</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="usr">Nivel Educacional</label>
                                        <select class="form-control" id="sel1">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">1°Básico</option>
                                            <option value="1">8°Básico</option>
                                            <option value="2">4°Medio H/C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sel1">Parentesco</label>
                                        <select class="form-control" id="sel1">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Madre</option>
                                            <option value="1">Padre</option>
                                            <option value="2">Abuelo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="usr">Ocupación</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="collapse" data-target="#collapseDatos"><i
                                                class="fas fa-save"></i>
                                            Agregar Apoderado Suplente</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-hover">
                                            <thead class="th-color">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Edad</th>
                                                    <th>Nivel Edudacional</th>
                                                    <th>Ocupación</th>
                                                    <th>Parentesco</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Juan Carlos</td>
                                                    <td>25 años</td>
                                                    <td>4° Medio H/C</td>
                                                    <td>Ingeniero</td>
                                                    <td>Padre</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN--Datos Apoderados Suplentes-->

                    <!--Datos de Matrícula-->
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-menu">
                            <i class="fa fa-address-book"></i> Registro Escolar
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">N° de Matrícula</label>
                                        <input type="text" class="form-control" id="usr" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="sel1">Tipo de Enseñanza</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Seleccione el Nivel Educacional">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Enseñanza Parvularia</option>
                                            <option value="1">Enseñanza Básica</option>
                                            <option value="2">Enseñanza Media H/C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sel1">Curso</label>
                                        <select class="form-control" id="sel1" required
                                            data-error-msg="Seleccione el Curso">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">1° Básico A</option>
                                            <option value="1">2° Básico B</option>
                                            <option value="2">8° Básico A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="usr">Fecha de Matrícula</label>
                                        <input type="date" class="form-control" id="usr">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sel1">Estado de Matrícula</label>
                                        <select class="form-control" id="sel1">
                                            <option value="" disabled selected>Seleccione</option>
                                            <option value="0">Matrícula Normal</option>
                                            <option value="1">Matrícula Inicial</option>
                                            <option value="2">Validación de Estudios</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN--Datos de Matrícula-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm btn-block pull-right" data-toggle="collapse"
                            data-target="#collapseDatos"><i class="fas fa-save"></i> Guardar
                            Matrícula</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

</section>

<script>
$(function() {
    $('form').validator({
        validHandlers: {
            '.customhandler': function(input) {
                //may do some formatting before validating
                input.val(input.val().toUpperCase());
                //return true if valid
                return input.val() === 'JQUERY' ? true : false;
            }
        }
    });

    $('form').submit(function(e) {
        e.preventDefault();

        if ($('form').validator('check') < 1) {
            alert('Hurray, your information will be saved!');
        }
    })
})
</script>