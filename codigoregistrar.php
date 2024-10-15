<?php
include "conexion.php";

if (isset($_POST["btn_registrar"])) {
    $tipodoc = $_POST['cmbident'];
    $numdoc = $_POST['doc'];
    $pn = $_POST['pn2'];
    $ape1 = $_POST['ape1'];
    $email = $_POST['email2'];
    $id_rol = $_POST['cmb1'];
    $pass = $_POST['pass2'];
    $cpass = $_POST['cpass'];
    

    $query = "SELECT COUNT(*) AS revision FROM `usuario` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $email_count = $row['revision'];

    if ($email_count > 0) {
        echo "<script>alert('El correo electrónico ya está registrado. Por favor, utiliza otro correo.');</script>";
        echo "<script>window.location='register.php';</script>";
    } else {
        $foto = $_FILES['foto'];
        $directorio_destino = "imagen-user/";
        $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $nombre_archivo = $numdoc . "." . $extension;
        $ubicacion_temporal = $foto['tmp_name'];
        $ruta_destino = $directorio_destino . $nombre_archivo;

        
            if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
                $ruta_destino = "../" . $ruta_destino;

                if ($pass == $cpass) {
                    $encrip = md5($pass);
                    $registrar = mysqli_query($con, "INSERT INTO `usuario` 
                    (`tipo_documento`, `numero_documento`, `nombres`, `apellidos`, `email`, `id_rol`, `clave`, `foto_perfil`) 
                    VALUES 
                    ('$tipodoc', '$numdoc', '$pn', '$ape1', '$email', '$id_rol', '$encrip', '$ruta_destino')");

                    if ($registrar) {
                        echo "<script>alert('Registro Exitoso');</script>";
                        echo "<script>window.location='index.php';</script>";
                    } else {
                        echo "<script>alert('No se pudo cargar el registro');</script>";
                    }
                } else {
                    echo "<script>alert('Revisa la contraseña');</script>";
                }
            } else {
                echo "<script>alert('No se encuentra imagen');</script>"; 
            
        }
    }
}
?>