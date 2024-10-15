<?php
session_start();
include "conexion.php";
if(isset($_POST['btn_srvs'])){
    $num =  $_SESSION['doc'];
    $cmbservs = $_POST['cmbservs'];
    $desc = $_POST['desc'];
    $prec = $_POST['prec'];
    $foto = $_FILES['foto2'];
    $pn = $_POST['pn'];

    $directorio_destino = "img-servs/";
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombre_archivo = $num. "." . $extension;
    $ubicacion_temporal = $foto['tmp_name'];
            
     $ruta_destino = $directorio_destino . $nombre_archivo;
     if(move_uploaded_file($ubicacion_temporal,$ruta_destino)){
        $db = "../". $ruta_destino;

        $subirservs = mysqli_query($con," INSERT INTO `serviciosc`(`nombre_vendedor`,`tipo_servs`, `descripcion_servicio`, `precio_servicio`,`fk_user`, `ft_servs`) 
        VALUES ('$pn','$cmbservs','$desc','$prec','$num', '$db')");
        echo "<script>alert('a buena hora subiste el servicio')</script>";
        echo "<script>window.location=('client/dashboard.php?mod=servicios')</script>";
    }else{
         echo "<script>alert('revise y verifique bien los datos')</script>";
}
}
?>