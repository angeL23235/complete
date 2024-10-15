<?php
session_start();
include "../conexion.php";

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
    <title>TRASLAPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilinos.css">
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" style="background-color: #5DC1B9;">
            <div class="icono-sidebar my-3 text-center">
                <img src="../img/Traslapp.jpg" alt="traslapp" class="rounded-circle" width="90" height="60">
            </div>
            <a href="dashboard.php" class="nav-link" style="color: #000;"><i class="fas fa-home"></i> <?php echo $translations['dashboard']; ?></a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServices"
                aria-expanded="false" aria-controls="collapseServices" style="color: #000;">
                <i class="fas fa-concierge-bell"></i> <?php echo $translations['services']; ?>
                <i class="fas fa-angle-down"></i>
            </a>
            <div class="collapse" id="collapseServices">
                <nav class="sb-sidenav-menu-nested nav">
                    <?php if($_SESSION['rl'] == 2){?>
                    <a href="dashboard.php?mod=servicios" class="nav-link" style="color: #000;"><?php echo $translations['load_services']; ?></a> 
                    <?php } ?>
                    <a href="dashboard.php?mod=buscarservs" class="nav-link" style="color: #000;"><?php echo $translations['explore_services']; ?></a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseNavigation"
                aria-expanded="false" aria-controls="collapseNavigation" style="color: #000;"> 
                <i class="fas fa-map-marked-alt"></i> <?php echo $translations['navigation']; ?>
                <i class="fas fa-angle-down"></i>
            </a>
            <div class="collapse" id="collapseNavigation">
                <nav class="sb-sidenav-menu-nested nav">
                    <a href="dashboard.php?mod=transporte" class="nav-link" style="color: #000;"><?php echo $translations['public_transport']; ?></a>
                    <a href="dashboard.php?mod=resta" class="nav-link" style="color: #000;"><?php echo $translations['restaurants']; ?></a> 
                    <a href="dashboard.php?mod=hotel" class="nav-link" style="color: #000;"><?php echo $translations['hotels']; ?></a>
                    <a href="dashboard.php?mod=reserva" class="nav-link" style="color: #000;"><?php echo $translations['reservation']; ?></a> 
                </nav>
            </div>
        </div>

        <div class="content">

            <nav class="navbar navbar-expand-lg" style="background-color: #5DC1B9;"> 
                <div class="container-fluid">
                    <div class="navbar-brand mx-auto" style="color: #ffffff;"> 
                        TRASLAPP
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="form-inline my-2 my-lg-0 ms-auto">
                            <div class="input-group">
                                <input class="form-control" style="color: #000;" placeholder="<?php echo $translations['search_placeholder']; ?>" aria-label="<?php echo $translations['search_placeholder']; ?>"> <!-- Letra negra en el campo de búsqueda -->
                            </div>
                        </form>
                        <div class="dropdown ms-3 d-flex align-items-center">
                            <span class="text-black me-2">
                                <?php echo $_SESSION['pn'] ?>
                            </span>
                            <a href="#"
                                class="d-flex align-items-center text-black text-decoration-none dropdown-toggle"
                                id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $_SESSION['ft']?>" alt="User" class="rounded-circle" width="40" height="40">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item" href="dashboard.php?mod=perfil"><?php echo $translations['profile']; ?></a></li>
                                <li><a class="dropdown-item" href="#"><?php echo $translations['settings']; ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" id="toggle-dark-mode">
                                        <i class="fas fa-moon me-2"></i> <?php echo $translations['dark_mode']; ?>
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="../exit.php"><?php echo $translations['logout']; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../js/modoosc.js"></script>

            <?php
     if (@$_GET['mod'] == "") {
        require_once("dashboard.php");
    } else
            if (@$_GET['mod'] == "transporte") {
        require_once("../modules/mediotrans.php");
    } else
            if (@$_GET['mod'] == "servicios") {
        require_once("../modules/subservs.php");
    }else
            if (@$_GET['mod'] == "buscarservs") {
        require_once("../modules/servs.php");   
    }else
            if (@$_GET['mod'] == "cocina") {
        require_once("../modules/cocina.php");
    }
    else
            if (@$_GET['mod'] == "aseo") {
        require_once("../modules/aseo.php");
    }
    else
            if (@$_GET['mod'] == "autos") {
        require_once("../modules/autos.php");
    }else
            if (@$_GET['mod'] == "hotel") {
        require_once("../modules/hoteles.php");
    }else
            if (@$_GET['mod'] == "resta") {
        require_once("../modules/resta.php");
    }else 
            if(@$_GET['mod'] == "perfil"){
        require_once("../modules/profile.php");
    }else 
            if(@$_GET['mod'] == "calificacion"){
        require_once("../modules/calificacion.php");
    }else 
            if(@$_GET['mod'] == "reserva"){
        require_once("../modules/reserva.php");
    }
?>


</body>

</html>