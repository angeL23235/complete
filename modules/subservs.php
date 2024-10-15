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
    <link rel="stylesheet" href="../css/chat.css">
    <title><?php echo $translations['create_service']; ?></title>
</head>

<body>
    <div class="container-fluid">
        <div class="contservs container text-center">
            <div class="row justify-content-center">
                <div class="col-md-6 myform">
                    <div class="logo mb-3">
                        <div class="text-center">
                            <h1><?php echo $translations['create_service']; ?></h1>
                        </div>
                    </div>
                    <form class="formulario" action="../codigoservs.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label><?php echo $translations['seller_name']; ?></label>
                            <input type="text" name="pn" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $translations['name_placeholder']; ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo $translations['service_type']; ?></label>
                            <select name="cmbservs" class="form-control">
                                <option value="" disabled><?php echo $translations['choose_service']; ?></option>
                                <option value="cocina"><?php echo $translations['kitchen']; ?></option>
                                <option value="alquiler_autos"><?php echo $translations['car_rental']; ?></option>
                                <option value="aseo"><?php echo $translations['cleaning']; ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $translations['service_description']; ?></label>
                            <input type="text" name="desc" class="form-control" placeholder="<?php echo $translations['description_placeholder']; ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo $translations['service_price']; ?></label>
                            <input type="number" name="prec" class="form-control" placeholder="<?php echo $translations['price_placeholder']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="foto"><?php echo $translations['service_photo']; ?></label>
                            <input type="file" name="foto2" class="form-control-file"">
                        </div>
                      
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" name="btn_srvs"><?php echo $translations['create_service_button']; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
