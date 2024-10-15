<?php
include "conexion.php";
session_start();

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "translation/español.php";
} else {
    $translations = require "translation/ingles.php";
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register.css">
    <title><?php echo $translations['register_title']; ?></title>
</head>

<body>
    <style>
        body {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-size: 16px;
            background-color: #EBEBEB;
        }

        .titulo h1 {
            font-family: "Bebas Neue", sans-serif;
            font-size: 36px;
            font-weight: 700;
            margin-top: 20px;
        }

        .myform h1 {
            font-family: "Bebas Neue", sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .foto_traslapp {
            background-color: aliceblue;
            border-color: aliceblue;
            border-style: inset;
        }
    </style>

    <section class="container encabezado text-center">
        <header>
            <div class="row">
                <div class="col-12 col-md-4">
                    <img class="foto_traslapp rounded-circle" width="120px" height="100px" src="img/Traslapp.jpg" alt="imagen traslapp">
                </div>
                <div class="titulo col-12 col-md-4">
                    <h1 style="color: white;">Traslapp</h1>
                </div>
            </div>
        </header>
    </section>

    <div class="contenedor-register container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6 myform">
                <div class="logo mb-3">
                    <div class="text-center">
                        <h1><?php echo $translations['register']; ?></h1>
                    </div>
                </div>
                <form class="formulario" action="codigoregistrar.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <select name="cmbident" id="" class="form-control">
                            <option value=""><?php echo $translations['choose_document']; ?></option>
                            <option value="RC"><?php echo $translations['civil_registry']; ?></option>
                            <option value="TI"><?php echo $translations['identity_card']; ?></option>
                            <option value="CC"><?php echo $translations['citizenship_card']; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="num"><?php echo $translations['document_number']; ?></label>
                        <input type="text" name="doc" class="form-control" id="num" aria-describedby="emailHelp" placeholder="<?php echo $translations['document_placeholder']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="primer"><?php echo $translations['first_name']; ?></label>
                        <input type="text" name="pn2" class="form-control" id="primer" aria-describedby="emailHelp" placeholder="<?php echo $translations['first_name_placeholder']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ape"><?php echo $translations['last_name']; ?></label>
                        <input type="text" name="ape1" class="form-control" id="ape" aria-describedby="emailHelp" placeholder="<?php echo $translations['last_name_placeholder']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo $translations['email']; ?></label>
                        <input type="email" name="email2" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $translations['email_placeholder']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="cmb1" id="rol" class="form-control">
                            <option value="" disabled><?php echo $translations['role']; ?></option>
                            <option value="1"><?php echo $translations['client']; ?></option>
                            <option value="2"><?php echo $translations['seller']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto"><?php echo $translations['profile_photo']; ?></label>
                        <input type="file" name="foto" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="pass"><?php echo $translations['password']; ?></label>
                        <input type="password" name="pass2" class="form-control" placeholder="<?php echo $translations['password_placeholder']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="pass11"><?php echo $translations['confirm_password']; ?></label>
                        <input type="password" name="cpass" class="form-control" placeholder="<?php echo $translations['confirm_password_placeholder']; ?>">
                    </div>

                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm" name="btn_registrar"><?php echo $translations['register_button']; ?></button>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="text-center"><?php echo $translations['already_have_account']; ?><br><a href="index.php"><?php echo $translations['login_here']; ?></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
