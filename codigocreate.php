<?php
include "conexion.php";

if (isset($_POST["btn_create"])) {
    // Obtener datos del formulario
    $tipodoc = $_POST['cmbident2'];
    $numdoc = $_POST['doc1'];
    $pn = $_POST['pnn'];
    $ape1 = $_POST['ape1'];
    $email = $_POST['email'];
    $id_rol = $_POST['cmb2'];
    $pass = $_POST['pass2']; 
    $passc = $_POST['pass3'];
    
    // Manejo de la imagen de perfil
    $foto = $_FILES['foto2'];
    $directorio_destino = "imagen-user/"; 
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombre_archivo = $numdoc . "." . $extension;
    $ubicacion_temporal = $foto['tmp_name'];
    $ruta_destino = $directorio_destino . $nombre_archivo;

    $es_imagen = getimagesize($ubicacion_temporal);
    if ($es_imagen !== false) {
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
            $rutabd = "../" . $ruta_destino;
            if ($pass == $passc) {
                $encript = md5($pass);
                
                // Verificar si el correo ya existe
                $query = "SELECT COUNT(*) AS revision FROM `usuario` WHERE `email` = '$email'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $veri_correo = $row['revision'];
                
                if ($veri_correo > 0) {
                    echo "El correo ya existe";
                } else {
                    // Registrar el nuevo usuario
                    $registrar = mysqli_query($con, "INSERT INTO `usuario` 
                        (`tipo_documento`, `numero_documento`, `nombres`, `apellidos`, `email`, `id_rol`, `clave`, `foto_perfil`) 
                        VALUES 
                        ('$tipodoc', '$numdoc', '$pn', '$ape1', '$email', '$id_rol', '$encript', '$rutabd')");
                    
                    if ($registrar) {
                        echo "<script>alert('Registro Exitoso');</script>";
                        echo "<script>window.location='admin/admin.php?mod=crear';</script>";
                    } else {
                        echo "<script>alert('No se pudo cargar el registro');</script>";
                    }
                }
            } else {
                echo "Las contraseñas no coinciden.";
            }
        } else {
            echo "Error al mover el archivo a la carpeta de destino.";
        }
    } else {
        echo "El archivo no es una imagen válida.";
    }
}
?>
