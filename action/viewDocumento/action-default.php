<?php 

if(isset($_GET["id_rut"]) && !empty($_GET["id_rut"])):

$documentos = DocumentosData::getTestByUser($_GET["id_rut"]);

?>
<section>

    <div class="table-responsive">

        <table class="table table-sm table-bordered table-hover">
            <thead>

                <tr class="th-color-cell">
                    <th scope="col">N°</th>
                    <th width="200" scope="col">Nombre Documento</th>
                    <th scope="col">Objetivo</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>

            <?php

                    $n = 1;
                    

                        if(!empty($documentos)){
                        
                            foreach($documentos as $r):
                            $doc = "doc/docdb/doc-".$r->ID.".".$r->FILEEXTENSION;

                            echo "<tr>";
                            echo "<td>$n</td>";
                            echo "<td>$r->NOMBRE</td>";
                            echo "<td>$r->OBJETIVO</td>";
                            echo '
                            <td width="90">
                            <a class="btn btn-sm btn-primary pull-right" href="'.$doc.'" download="'.$r->NOMBRE.'" style="margin-top: 1px;" ><i class="fas fa-download"></i></a> 
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            </td>';

                            echo "</tr>";

                            $n = ++$n;

                            endforeach;
                        }

            echo "</table>";

        ?>

    </div>

<?php endif;?>


</section>