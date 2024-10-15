<?php
include "../conexion.php";

// Proceso de actualización de datos
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


    if ($ruta_destino) {
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
        } else {
            echo "<script>alert('" . $translations['image_upload_error'] . "');</script>";
        }
    } else {
        echo "<script>alert('" . $translations['not_an_image'] . "');</script>";
    }

    $update = "UPDATE usuario SET numero_documento = '$numdoc', nombres = '$names', apellidos = '$apes'";
    if ($ruta_destino) {
        $update .= ", foto_perfil = '$ruta_destino'";
    }
    $update .= " WHERE numero_documento = '$numdoc'";

    if (mysqli_query($con, $update)) {
        echo "<script>alert('" . $translations['update_success'] . "');</script>";
        echo "<script>window.location='admin.php?mod=gestion';</script>";
    } else {
        echo "Error en la consulta: " . mysqli_error($con);
    }
}

// Proceso de eliminación de usuario
if (isset($_POST['btn_delete'])) {
    $dato_eliminar = $_POST['dato_eliminar'];
    
    $delete_servicios = "DELETE FROM serviciosc WHERE fk_user = '$dato_eliminar'";
    mysqli_query($con, $delete_servicios);

    $delete = "DELETE FROM usuario WHERE numero_documento = '$dato_eliminar'";
    
    if (mysqli_query($con, $delete)) {
        echo "<script>alert('" . $translations['delete_success'] . "');</script>";
        echo "<script>window.location='admin.php?mod=gestion';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gestion.css">
    <title><?php echo $translations['management_title']; ?></title>
</head>

<body>
<div class="container text-center bigtable">

    <section class="buscar">
        <form method="post">
            <input type="text" name="txt_bucar" placeholder="<?php echo $translations['search_placeholder']; ?>">
            <input type="submit" value="<?php echo $translations['search_button']; ?>" name="btn_search">
        </form>
    </section>
    <br>
    
    <!-- Tabla de datos -->
    <table class="table table2">
        <thead>
            <tr>
                <th scope="col"><?php echo $translations['document_type']; ?></th>
                <th scope="col"><?php echo $translations['document_number']; ?></th>
                <th scope="col"><?php echo $translations['names']; ?></th>
                <th scope="col"><?php echo $translations['surnames']; ?></th>
                <th scope="col"><?php echo $translations['email']; ?></th>
                <th scope="col"><?php echo $translations['photo']; ?></th>
                <th scope="col"><?php echo $translations['delete']; ?></th>
                <th scope="col"><?php echo $translations['edit']; ?></th>
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
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $id; ?>"><?php echo $translations['delete_user']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="admin.php?mod=gestion">
                                <input type="hidden" name="dato_eliminar" value="<?php echo($fila['numero_documento']); ?>">
                                <p><?php echo $translations['confirm_delete']; ?></p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-danger" name="btn_delete"><?php echo $translations['delete']; ?></button>
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
                            <h5 class="modal-title" id="editModalLabel<?php echo $id; ?>"><?php echo $translations['edit_user']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="admin.php?mod=gestion" enctype="multipart/form-data">
                                <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                                <div class="mb-3">
                                    <label for="documentType<?php echo $id; ?>" class="form-label"><?php echo $translations['document_type']; ?></label>
                                    <input type="text" class="form-control" id="documentType<?php echo $id; ?>"
                                        name="document_type" value="<?php echo ($fila['tipo_documento']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="documentNumber<?php echo $id; ?>" class="form-label"><?php echo $translations['document_number']; ?></label>
                                    <input type="text" class="form-control" id="documentNumber<?php echo $id; ?>"
                                        name="document_number" readonly value="<?php echo ($fila['numero_documento']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="names<?php echo $id; ?>" class="form-label"><?php echo $translations['names']; ?></label>
                                    <input type="text" class="form-control" id="names<?php echo $id; ?>" name="names" value="<?php echo ($fila['nombres']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="surnames<?php echo $id; ?>" class="form-label"><?php echo $translations['surnames']; ?></label>
                                    <input type="text" class="form-control" id="surnames<?php echo $id; ?>" name="apes" value="<?php echo ($fila['apellidos']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="photo<?php echo $id; ?>" class="form-label"><?php echo $translations['photo']; ?></label>
                                    <img src="../<?php echo($fila['foto_perfil']); ?>" alt="modificar imagen" width="50" height="50" class="rounded-circle">
                                    <input type="file" class="form-control" id="photo<?php echo $id; ?>" name="photo">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-primary" name="btn_edit"><?php echo $translations['save_changes']; ?></button>
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
