<?php
   if (isset($_POST['btn_ing'])) {
       include "conexion.php";
       session_start();
       $doc = $_POST['doc'];
       $pass = $_POST['pass'];
       $encrip = md5($pass);
   
       // Usar prepared statements para evitar inyección SQL y compatibilidad con PDO
       if ($con instanceof PDO) {
           $stmt = $con->prepare("SELECT * FROM usuario WHERE numero_documento = :doc AND clave = :clave");
           $stmt->execute([':doc' => $doc, ':clave' => $encrip]);
           $consulta = $stmt;
       } else {
           // Para mysqli tradicional (desarrollo local)
           $doc = mysqli_real_escape_string($con, $doc);
           $encrip = mysqli_real_escape_string($con, $encrip);
           $consulta = mysqli_query($con, "SELECT * FROM usuario WHERE numero_documento='$doc' AND clave='$encrip'");
           if (!$consulta) {
               die("Error en la consulta: " . mysqli_error($con));
           }
       }
       $resultado = mysqli_num_rows($consulta);
   
       if ($resultado == 1) {
           while ($fila = mysqli_fetch_array($consulta)) {
               $_SESSION['doc'] = $fila['numero_documento'];
               $_SESSION['pn'] = $fila['nombres'];
               $_SESSION['ape'] = $fila['apellidos'];
               $_SESSION['em'] = $fila['email'];
               $_SESSION['ft'] = $fila['foto_perfil'];
               $_SESSION['rl'] = $fila['id_rol'];
               $_SESSION['desc'] = $fila['descripcion'];

               // Redirección según el rol
               if ($_SESSION['rl'] == 1 || $_SESSION['rl'] == 2) {
                   header("location:client/dashboard.php");
                   exit();
               } elseif ($_SESSION['rl'] == 3) {
                   header("location:admin/admin.php");
                   exit();
               } else {
                   echo "<script>alert('rectifica tus datos')</script>";
               }
           }
        
       } else {
           echo "<script>alert('revisa los datos ingresados')</script>";
           echo "<script>(window.location='index.php')</script>";

       }
   }
?>