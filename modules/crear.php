<?php

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $translations['create']; ?></title>
    <link rel="stylesheet" href="../css/crear.css">
</head>
<body>
    <div class="modulo-content">
        <div class="contenedor-register container text-center">
            <div class="row justify-content-center ">
                <div class="col-md-6 myform">
                    <div class="logo mb-3">
                        <div class="text-center">
                            <h1><?php echo $translations['create']; ?></h1>
                        </div>
                    </div>
                    <form class="formulario11" action="../codigocreate.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <select name="cmbident2" id="" class="form-control">
                                <option value=""><?php echo $translations['choose_document']; ?></option>
                                <option value="RC">Registro civil</option>
                                <option value="TI">Tarjeta de identidad</option>
                                <option value="CC">Cédula de ciudadanía</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="num"><?php echo $translations['document_number']; ?></label>
                            <input type="text" name="doc1" class="form-control" id="num" placeholder="<?php echo $translations['document_number']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="primer"><?php echo $translations['names']; ?></label>
                            <input type="text" name="pnn" class="form-control" id="primer" placeholder="<?php echo $translations['names']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="ape"><?php echo $translations['surnames']; ?></label>
                            <input type="text" name="ape1" class="form-control" id="ape" placeholder="<?php echo $translations['surnames']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo $translations['email']; ?></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $translations['email']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <select name="cmb2" id="rol" class="form-control">
                                <option value="" disabled><?php echo $translations['role']; ?></option>
                                <option value="1"><?php echo $translations['customer']; ?></option>
                                <option value="2"><?php echo $translations['seller']; ?></option>
                            </select>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="foto"><?php echo $translations['profile_picture']; ?></label>
                            <br>
                            <input type="file" name="foto2" class="form-control-file">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pass"><?php echo $translations['password']; ?></label>
                            <input type="password" name="pass2" id="pass" class="form-control" placeholder="<?php echo $translations['password']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="pass11"><?php echo $translations['confirm_password']; ?></label>
                            <input type="password" name="pass3" id="pass11" class="form-control" placeholder="<?php echo $translations['confirm_password']; ?>">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm" name="btn_create"><?php echo $translations['create_button']; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
