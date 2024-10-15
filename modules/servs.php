<?php
include "../conexion.php";
$numero = $_SESSION['doc'];

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "../translation/español.php";
} else {
    $translations = require "../translation/ingles.php";
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $translations['services_title']; ?></title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">

            <!-- Tarjeta de Cocina juaz juaz -->
            <div class="col-md-4 mb-3">
                <div class="card" style="width: 100%; height: 100%;">
                    <img src="../img/cocina.png" class="card-img-top" alt="Cociname" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title text-center"><strong><?php echo $translations['cocina_title']; ?></strong></h4>
                        <h5 class="card-title"><?php echo $translations['cocina_subtitle']; ?></h5>
                        <p class="card-text"><?php echo $translations['cocina_description']; ?></p>
                        <p><?php echo $translations['cocina_at_your_hand']; ?></p>
                        <a href="dashboard.php?mod=cocina" class="btn btn-primary"><?php echo $translations['cocina_button']; ?></a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Autos :vv -->
            <div class="col-md-4 mb-3">
                <div class="card" style="width: 100%; height: 100%;">
                    <img src="../img/autos.jpg" class="card-img-top" alt="Alquiler de autos" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title text-center"><strong><?php echo $translations['autos_title']; ?></strong></h4>
                        <h5 class="card-title"><?php echo $translations['autos_subtitle']; ?></h5>
                        <p class="card-text"><?php echo $translations['autos_description']; ?></p>
                        <p><?php echo $translations['autos_today']; ?></p>
                        <a href="dashboard.php?mod=autos" class="btn btn-primary"><?php echo $translations['autos_button']; ?></a>
                    </div>
                </div>
            </div>

            <!-- tarjeta de Aseo :0 -->
            <div class="col-md-4 mb-3">
                <div class="card" style="width: 100%; height: 100%;">
                    <img src="../img/aseo.jpg" class="card-img-top" alt="Servicio de aseo" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title text-center"><strong><?php echo $translations['aseo_title']; ?></strong></h4>
                        <h5 class="card-title"><?php echo $translations['aseo_subtitle']; ?></h5>
                        <p class="card-text"><?php echo $translations['aseo_description']; ?></p>
                        <p><?php echo $translations['aseo_hire_cleaning']; ?></p>
                        <a href="dashboard.php?mod=aseo" class="btn btn-primary"><?php echo $translations['aseo_button']; ?></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
