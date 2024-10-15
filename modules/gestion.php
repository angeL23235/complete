<?php
include "../conexion.php";


if (isset($_POST['btn_edit'])) {
    $id_user = $_POST['id_user'];
    $numdoc = $_POST['document_number'];
    $names = $_POST['names'];
    $apes = $_POST['apes'];
    $foto = $_FILES['photo'];
    $directorio_destino = "../imagen-user/";
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombre_archivo = $numdoc . "." . $extension;
    $ubicacion_temporal = $foto['tmp_name'];
    $ruta_destino = $directorio_destino . $nombre_archivo;

    $es_imagen = getimagesize($ubicacion_temporal);

    if ($es_imagen !== false) {
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
        } else {
            echo "<script>alert('No se pudo cargar la imagen');</script>";
        }
    } else {
        echo "<script>alert('El archivo subido no es una imagen');</script>";
    }

    // update a la bd
    $update = "UPDATE usuario SET numero_documento = '$numdoc', nombres = '$names', apellidos = '$apes'";
    if ($ruta_destino) {
        $update .= ", foto_perfil = '$ruta_destino'";
    }
    $update .= " WHERE numero_documento = '$numdoc'";

    if (mysqli_query($con, $update)) {
        echo "<script>alert('Actualización exitosa');</script>";
        echo "<script>window.location='admin.php?mod=gestion';</script>";
    } else {
        echo "Error en la consulta: " . mysqli_error($con);
    }
}

// borrar todo lo del usuario
if (isset($_POST['btn_delete'])) {
    $dato_eliminar = $_POST['dato_eliminar'];
    
    $delete_servicios = "DELETE FROM serviciosc WHERE fk_user = '$dato_eliminar'";
    mysqli_query($con, $delete_servicios);

    $delete = "DELETE FROM usuario WHERE numero_documento = '$dato_eliminar'";
    
    if (mysqli_query($con, $delete)) {
        echo "<script>alert('Eliminación exitosa');</script>";
        echo "<script>window.location='admin.php?mod=gestion';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gestion.css">
    <title>Gestión</title>
</head>

<body>
<div class="container text-center bigtable">

    <section class="buscar">
        <form method="post">
            <input type="text" name="txt_bucar" placeholder="Busque por documento">
            <input type="submit" value="Buscar" name="btn_search">
        </form>
    </section>
    <br>
    
    <!-- Tabla de datos -->
    <table class="table table2">
        <thead>
            <tr>
                <th scope="col">Tipo de documento</th>
                <th scope="col">Documento</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Foto</th>
                <th scope="col">Borrar</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($con, "SELECT * FROM usuario") or die("Error en la consulta");

            while ($fila = mysqli_fetch_array($result)) {
                $id = $fila['numero_documento'];
            ?>
            <tr>
                <td scope="row"><?php echo($fila['tipo_documento']); ?></td>
                <td><?php echo ($fila['numero_documento']); ?></td>
                <td><?php echo ($fila['nombres']); ?></td>
                <td><?php echo ($fila['apellidos']); ?></td>
                <td><?php echo ($fila['email']); ?></td>
                <td><img src="<?php echo $fila['foto_perfil']; ?>" alt="imagen_usuario" width="50" height="50"
                        class="rounded-circle"></td>
                <td>
                    <button class="bi bi-trash-fill btn btn-danger" type="button" data-bs-toggle="modal"
                        data-bs-target="#deleteModal<?php echo $id; ?>"></button>
                </td>
                <td><i type="button" class="bi bi-pencil-fill juaz" data-bs-toggle="modal"
                        data-bs-target="#editModal<?php echo $id; ?>"></i></td>
            </tr>

    
            <!-- Modal para eliminar usuario -->
            <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1"
                aria-labelledby="deleteModalLabel<?php echo $id; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $id; ?>">Eliminar usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="admin.php?mod=gestion">
                                <input type="hidden" name="dato_eliminar" value="<?php echo($fila['numero_documento']); ?>">
                                <p>¿Está seguro de que desea eliminar este usuario?</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger" name="btn_delete">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar usuario -->
            <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1"
                aria-labelledby="editModalLabel<?php echo $id; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?php echo $id; ?>">Actualizar datos del usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="admin.php?mod=gestion" enctype="multipart/form-data">
                                <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                                <div class="mb-3">
                                    <label for="documentType<?php echo $id; ?>" class="form-label">Tipo de documento</label>
                                    <input type="text" class="form-control" id="documentType<?php echo $id; ?>"
                                        name="document_type" value="<?php echo ($fila['tipo_documento']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="documentNumber<?php echo $id; ?>" class="form-label">Número de documento</label>
                                    <input type="text" class="form-control" id="documentNumber<?php echo $id; ?>"
                                        name="document_number" readonly value="<?php echo ($fila['numero_documento']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="names<?php echo $id; ?>" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="names<?php echo $id; ?>" name="names" value="<?php echo ($fila['nombres']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="surnames<?php echo $id; ?>" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="surnames<?php echo $id; ?>" name="apes" value="<?php echo ($fila['apellidos']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="photo<?php echo $id; ?>" class="form-label">Foto</label>
                                    <img src="../<?php echo($fila['foto_perfil']); ?>" alt="modificar imagen" width="50" height="50" class="rounded-circle">
                                    <input type="file" class="form-control" id="photo<?php echo $id; ?>" name="photo">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" name="btn_edit">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>

</html>