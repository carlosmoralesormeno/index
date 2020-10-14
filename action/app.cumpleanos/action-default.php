<?php if(isset($_GET["key-app"]) && !empty($_GET["key-app"])):
setlocale(LC_ALL,"es_ES");
$appkey = $_GET["key-app"];
$key = "gH65JhszJkjf77sjf54djH";
if ($appkey==$key):
$cumpleanos = RegistroData::getCumpleanos();
//var_dump($cumpleanos);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Cumpleaños</title>
    <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<style>
body {
    /* background-image: url(/web/images/background-photo-3.jpg); */
    background-color: #030d17;
    color: #ffffff;
}

.card {
    background-color: #02070c;
    border: 1px solid white;
}
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="img/torta.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">¡¡Feliz Cumpleaños!!</h4>
                        <h5>Hoy Saludamos en su cumpleaños a:</h5>
                        <span><?php echo strftime("%A %d de %B"); ?></span><br />
                        <?php
                        if(!empty($cumpleanos)):
                            foreach($cumpleanos as $r):
                                echo '<span style="font-size: 1.09375rem; font-weight: 500">'.$r->NOMBRE.' - '.$r->CURSO.'</span><br />';
                        ?>
                            <?php endforeach;
                            echo '<span style="font-size: 1.09375rem">Que tu día este lleno de buenos recuerdos del ayer, la alegria de hoy y los sueños del mañana.</span><br />';
                            ?>
                            <?php else:?>
                                <?php echo '<span style="font-size: 1.09375rem; font-weight: 500">No hay cumpleaños hoy :(</span><br />
                                <img src="img/triste.png" width="173" class="img-fluid" alt="">
                                '; ?>
                            <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>
<?php endif;?>
<?php endif;?>