<?php $nombreCurso =  CursosData::getCursoById($_GET["id-curso"]);?>

<input type="hidden" name="name-curso" id="name-curso" value="<?php echo $nombreCurso->NOMBRE_CURSO;?>">

<table class="table table-hover text-nowrap curso-table">
    <thead>
        <tr>
            <th scope="col"><input type="checkbox" id="allcheckbox" /></th>
            <th scope="col">#</th>
            <th scope="col">Nombre Estudiante</th>
        </tr>
    </thead>

    <?php

        $curso = CursosData::getByIdCurso($_GET["id-curso"]);
        
        $registro = RegistroData::getCursoActives($curso->ID_CURSO_REG, $curso->ID_LETRA_REG, $_GET["id-test"]);

        $registroRow = count($registro);

        for($i=0;$i<$registroRow;$i++){

        $r =$registro[$i];
        $nombreEstudiante = $r->APAT_INSCRIPCION. " ". $r->AMAT_INSCRIPCION. " ". $r->NOMBRE_INSCRIPCION;
    
        if($r->RETIRADO == 1){
            echo "<tr style='text-decoration:line-through; color:#FF0000'>";
            }else{
                if($r->PREMATR == 0){
                    echo "<tr style='color:#001FC8'>";
                }else{
                echo "<tr>";
                }
        }

        echo '<td>
        <input type="checkbox" name="estudiante[]" value="'.$r->COD_REGISTRO_ESC.'"';
        if($r->ID_TEST!=null){echo 'checked';}
        echo '>
        </td>';
        echo "<td>$r->ORDEN_LIBRO_CLASE</td>";
        echo "<td>$nombreEstudiante</td>";
        echo "</tr>";
        }
    ?>                   
</table>

<script>
$(document).ready(function() {
    $('.curso-table tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    $('#allcheckbox').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
});
</script>