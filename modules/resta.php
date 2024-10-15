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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['restaurants_title']; ?></title>
    <link rel="stylesheet" href="../css/resta.css">
</head>

<body>
    <div class="container mt-7">
        <div class="row">

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta1.jpg" class="card-img-top" alt="Restaurante 1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_okus_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_okus_description']; ?></p>
                        <a href="https://www.instagram.com/restauranteokus/" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta2.jpg" class="card-img-top" alt="Restaurante 2">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_barbaro_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_barbaro_description']; ?></p>
                        <a href="https://barbarococinaprimitiva.com/" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta3.jpg" class="card-img-top" alt="Restaurante 3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_sabor_fuego_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_sabor_fuego_description']; ?></p>
                        <a href="https://saborygusto.com/cartas/carta_mar_y_fuego.html" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta4.jpg" class="card-img-top" alt="Restaurante 4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_egeo_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_egeo_description']; ?></p>
                        <a href="https://www.instagram.com/egeo.mde/?hl=es" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta5.jpg" class="card-img-top" alt="Restaurante 5">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_elcielo_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_elcielo_description']; ?></p>
                        <a href="https://elcielorestaurant.com/" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="../img/resta6.jpg" class="card-img-top" alt="Restaurante 6">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $translations['restaurant_albenzupaisa_title']; ?></h5>
                        <p class="card-text"><?php echo $translations['restaurant_albenzupaisa_description']; ?></p>
                        <a href="https://www.instagram.com/albenzupaisa/?hl=es" class="btn btn-primary"><?php echo $translations['see_more']; ?></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
