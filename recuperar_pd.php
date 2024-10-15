<?php
include "conexion.php";
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'es';
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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
    <title><?php echo $translations['recover_title']; ?></title>
</head>
<body>
<style>
body {
    font-family: "Bebas Neue", sans-serif;
    font-weight: 400;
    font-size: 16px;
    background-color:#EBEBEB;
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
                    <h1><?php echo $translations['recover_pass']; ?></h1>
                </div>
            </div>
            <form action="recuperar_pd.php" method="post">
                <div class="form-group">
                    <label for="num"><?php echo $translations['doc_number']; ?></label>
                    <input type="text" name="doc" class="form-control" id="num" aria-describedby="emailHelp" placeholder="<?php echo $translations['doc_placeholder']; ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?php echo $translations['email']; ?></label>
                    <input type="email" name="email2" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $translations['email_placeholder']; ?>">
                </div>
                <div class="col-md-12 text-center mb-3">
                    <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm" name="btn_ing"><?php echo $translations['recover_button']; ?></button>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="text-center"><?php echo $translations['no_account']; ?><br><a href="register.php"><?php echo $translations['register_here']; ?></a></p>
                        <p class="text-center"><?php echo $translations['have_account']; ?><br><a href="index.php"><?php echo $translations['login_here']; ?></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
