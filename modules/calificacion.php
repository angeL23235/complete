<?php
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

if (isset($_POST['btn_rango'])) {
    $name_cal = $_POST['nombre'];
    $email = $_POST['correo55'];
    $rango = $_POST['rango'];
    $coments = $_POST['comentarios'];
    
    $fk_user = $_SESSION['doc'];

    $calificacion = mysqli_query($con, "INSERT INTO `calificacion`(`fk_user`, `nombre_clien`, `correo_clien`, `num_estrellas`, `comentarios`) 
    VALUES ('$fk_user', '$name_cal', '$email', '$rango', '$coments')");

    // Verificar si la consulta fue exitosa
    if ($calificacion == true) {
        echo "<script>alert('Se ha registrado su calificación');</script>";
        echo "<script>window.location='dashboard.php?mod=calificacion'</script>";
    } else {
        echo "<script>alert('No se ha podido cargar su calificación');</script>";
        echo "<script>window.location='dashboard.php?mod=calificacion'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Satisfacción</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/calificacion.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">Califica este servicio</h2>
        <form method="post" action="dashboard.php?mod=calificacion">
            <div class="mb-3">
                <label for="name" class="form-label"><?php echo $translations['nameee'];?></label>
                <input type="text" class="form-control" id="name" name ="nombre" value="<?php echo $_SESSION['pn']. " ". $_SESSION['ape'];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?php echo $translations['emailsito']?></label>
                <input type="email" class="form-control" id="email" name="correo55" value="<?php echo $_SESSION['em'];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label"><?php echo $translations['rating']?></label>
                <div>
                    <i class="star fas fa-star" data-value="1"></i>
                    <i class="star fas fa-star" data-value="2"></i>
                    <i class="star fas fa-star" data-value="3"></i>
                    <i class="star fas fa-star" data-value="4"></i>
                    <i class="star fas fa-star" data-value="5"></i>
                </div>
                <input type="hidden" id="rango-valor" name="rango" required>
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label"><?php echo $translations['coments']?></label>
                <textarea class="form-control" id="comments" name="comentarios" rows="4" placeholder="Escribe tus comentarios"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_rango"><?php echo $translations['send']?></button>
        </form>
    </div>
    <script src="../js/calificacion.js"></script>
</body>
</html>
