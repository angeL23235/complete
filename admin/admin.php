<?php
include "../conexion.php";
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
    <title>Plantilla Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilinos.css">
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <div class="icono-sidebar my-3 text-center">
                <img src="../img/Traslapp.jpg" alt="traslapp" class="rounded-circle" width="90" height="60">
            </div>
            <a href="#"><i class="fas fa-home"></i> Dashboard</a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServicios"
                aria-expanded="false" aria-controls="collapseServicios">
                <i class="fas fa-concierge-bell"></i> Gestion
                <i class="fas fa-angle-down"></i>
            </a>
            <div class="collapse" id="collapseServicios">
                <nav class="sb-sidenav-menu-nested nav">
                    <a href="admin.php?mod=crear" class="nav-link"><?php echo $translations['Create']; ?></a>
                    <a href="admin.php?mod=CRUD" class="nav-link"><?php echo $translations['CRUD'];?></a>
                </nav>
            </div>
            </div>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <div class="navbar-brand mx-auto">
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
                                <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn btn-outline-light" type="submit"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <div class="dropdown ms-3 d-flex align-items-center">
                            <span class="text-white me-2">
                                <?php echo $_SESSION['pn'] ?>
                            </span>

                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $_SESSION['ft']?>" alt="Usuario" class="rounded-circle" width="40"
                                    height="40">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item" href="admin.php?mod=perfil"><?php echo $translations['profile']; ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" id="toggle-dark-mode">
                                        <i class="fas fa-moon me-2"></i> <?php echo $translations['Active']?>
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="../exit.php">Salir</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- modulacion -->
            <?php
     if (@$_GET['mod'] == "") {
        require_once("admin.php");
    } else
            if (@$_GET['mod'] == "crear") {
        require_once("../modules/crear.php");
    } else
            if (@$_GET['mod'] == "gestion") {
        require_once("../modules/gestion.php");
    }else
            if (@$_GET['mod'] == "CRUD") {
        require_once("../modules/gestion.php");
    }else 
            if(@$_GET['mod']=="perfil"){
        require_once("../modules/profileadmin.php");
    }
?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- para el cambio de modo oscuro -->
     <script src="../js/modoosc.js"></script>
</body>

</html>