<?php
include "../conexion.php";

// Idioma
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

// La lógica para guardar cambios en la base de datos 
if (isset($_POST['btn_add'])) {
    $desc = $_POST['description'];
    $document = $_SESSION['doc'];
    $ft = $_FILES['fotito'];
    $directorio = "../imagen-user/";
    $extension = pathinfo($ft['name'], PATHINFO_EXTENSION);
    $nombreft = $document . "." . $extension; 
    $ubicacion_temporal = $ft['tmp_name'];
    $rutades = $directorio . $nombreft;
    $img= getimagesize($ubicacion_temporal);

    if ($img != false) {
        if (move_uploaded_file($ubicacion_temporal, $rutades)) {
            echo "<script>alert('La imagen se cargó bien mi lidel');</script>";   
            $update = "UPDATE usuario SET foto_perfil = '$rutades', descripcion = '$desc' WHERE numero_documento = '$document'";
            if (mysqli_query($con, $update)) {
                echo "<script>alert('Actualización exitosa');</script>";
                echo "<script>window.location='admin.php?mod=perfil';</script>";
            } else {
                echo "<script>alert('Error al actualizar la base de datos');</script>";
            }
        } else {
            echo "<script>alert('Falla al cargar la imagen');</script>";
        }
    } else {
        echo "<script>alert('El archivo subido no es una imagen');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<style>
    .profile-container{
        margin-top:-670px;
    }
</style>

<body>
    <!-- Pero la queria tanto :,v -->
    <div class="profile-container">
        <form action="admin.php?mod=perfil" method="post" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="<?php echo $_SESSION['ft']; ?>" alt="Imagen de perfil" id="profileImage">
                <label for="profilePicInput" class="edit-icon">
                    <i class="fas fa-edit"></i>
                </label>
                <input type="file" id="profilePicInput" name="fotito" style="display:none;">
            </div>

            <div class="profile-info">
                <label for="username"><?php echo $translations['Name_user']; ?></label>
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['pn']; ?>" readonly>

                <label for="email"><?php echo $translations['Email']; ?></label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['em']; ?>" readonly>

                <label for="description"><?php echo $translations['description']?></label>
                <textarea id="description" name="description" rows="4"
                    placeholder="<?php echo $_SESSION['desc']; ?>"></textarea>
            </div>

            <button type="submit" class="save-btn" name="btn_add"><?php echo $translations['save_changes']; ?></button>
        </form>
    </div>
</body>

</html>