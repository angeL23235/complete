<?php
   // Iniciar sesión ANTES de cualquier output
   session_start();
   
   if (isset($_POST['btn_ing'])) {
       include "conexion.php";
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
               $_SESSION['error'] = "Error en la consulta: " . mysqli_error($con);
               header("location:index.php");
               exit();
           }
       }
       $resultado = mysqli_num_rows($consulta);
   
       if ($resultado == 1) {
           $fila = mysqli_fetch_array($consulta);
           if ($fila) {
               $_SESSION['doc'] = $fila['numero_documento'];
               $_SESSION['pn'] = $fila['nombres'];
               $_SESSION['ape'] = $fila['apellidos'];
               $_SESSION['em'] = $fila['email'];
               $_SESSION['ft'] = $fila['foto_perfil'];
               $_SESSION['rl'] = $fila['id_rol'];
               $_SESSION['desc'] = $fila['descripcion'];

               // Limpiar cualquier output antes de redirigir
               if (ob_get_level() > 0) {
                   ob_clean();
               }
               
               // Redirección según el rol
               if ($_SESSION['rl'] == 1 || $_SESSION['rl'] == 2) {
                   header("Location: client/dashboard.php");
                   exit();
               } elseif ($_SESSION['rl'] == 3) {
                   // Verificar si existe el archivo admin antes de redirigir
                   if (file_exists("admin/admin.php")) {
                       header("Location: admin/admin.php");
                   } else {
                       // Si no existe, redirigir al dashboard del cliente
                       header("Location: client/dashboard.php");
                   }
                   exit();
               } else {
                   $_SESSION['error'] = "Rol no válido. Rectifica tus datos.";
                   header("Location: index.php");
                   exit();
               }
           } else {
               $_SESSION['error'] = "No se pudo obtener los datos del usuario.";
               header("Location: index.php");
               exit();
           }
       } else {
           $_SESSION['error'] = "Revisa los datos ingresados. Usuario o contraseña incorrectos.";
           header("Location: index.php");
           exit();
       }
   } else {
       // Si no hay POST, redirigir al index
       header("Location: index.php");
       exit();
   }
?>