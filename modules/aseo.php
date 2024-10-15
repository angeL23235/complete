<?php
include "../conexion.php";
$numero = $_SESSION['doc'];

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "../translation/español.php";
} else {
    $translations = require "../translation/ingles.php";
}

// PROCESO DE ACTUALIZACIÓN DE DATOS CRUD
if (isset($_POST['btn_actualizar2'])) {
    $idserv = $_POST['id_serv'];
    $tipo_s = $_POST['cmbserv'];
    $desc_serv = $_POST['desc_serv'];
    $prec = $_POST['precio_servicio'];

    // Proceso de manejo de imagen
    $ft_servicio = $_FILES['foto_servicio'];
    $direc_des = "../img-servs/";
    $extension = pathinfo($ft_servicio['name'], PATHINFO_EXTENSION); 
    $nombre_archivo = $_SESSION['doc'] . "." . $extension;
    $ubicacion_temporal = $ft_servicio['tmp_name']; 
    $ruta_destino = $direc_des . "." . $nombre_archivo; 
    $es_imagen = getimagesize($ubicacion_temporal);

    if ($es_imagen !== false) {
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
            echo "<script>alert('" . $translations['update_success'] . "');</script>";
        } else {
            echo "<script>alert('Revisa que la imagen sea válida');</script>";
        }
    }

    // Botón de actualización
    $update = "UPDATE serviciosc SET tipo_servs = '$tipo_s', descripcion_servicio = '$desc_serv', 
    precio_servicio = '$prec'";

if ($ruta_destino) {
    $update .= ", ft_servs = '$ruta_destino'"; 
}
$update .= " WHERE id_servicio = '$idserv'";

    if (mysqli_query($con, $update)) { 
        echo "<script>alert('" . $translations['update_success'] . "');</script>";
        echo "<script>window.location='dashboard.php?mod=aseo';</script>"; 
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if (isset($_POST['btn_eliminar2'])) {
    $delete = $_POST['dato_eliminar'];
    $borrar = mysqli_query($con, "DELETE FROM serviciosc WHERE id_servicio = '$delete' and fk_user = '$numero'");

    if ($borrar) {
        echo "<script>alert('" . $translations['delete_success'] . "');</script>";
        echo "<script>window.location='dashboard.php?mod=aseo';</script>"; 
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
    <link rel="stylesheet" href="../css/aseo.css">
    <title><?php echo $translations['service_type']; ?></title>
</head>


<body>
    <div class="container"></div>
    <div class="tabla_m text-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="table-info"><?php echo $translations['service_type']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['seller_name']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['service_description']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['service_price']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['service_photo']; ?></th>
                    <?php
                    if ($_SESSION['rl'] == 2) {
                    ?>
                    <th scope="col" class="table-info"><?php echo $translations['edit']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['delete']; ?></th>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['rl'] == 1) {
                    ?>
                    <th scope="col" class="table-info"><?php echo $translations['contact']; ?></th>
                    <th scope="col" class="table-info"><?php echo $translations['rate_service']; ?></th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SESSION['rl'] == 2) {
                    $result2 = mysqli_query($con, "SELECT * FROM serviciosc WHERE tipo_servs = 'aseo' and fk_user = '$numero'") or die("Error en la consulta de servicio aseo");
                } elseif ($_SESSION['rl'] == 1) {
                    $result2 = mysqli_query($con, "SELECT s.*, u.email FROM serviciosc s JOIN usuario u ON s.fk_user = u.numero_documento WHERE u.id_rol = 2 AND s.tipo_servs = 'aseo'") or die("Error en la consulta");
                }

                while ($fila = mysqli_fetch_array($result2)) {
                    $id_serv = $fila['id_servicio'];
                ?>
                <tr>
                    <th scope="row"><?php echo $fila['tipo_servs']; ?></th>
                    <td><?php echo $fila['nombre_vendedor'];?></td>
                    <td><?php echo $fila['descripcion_servicio']; ?></td>
                    <td><?php echo $fila['precio_servicio']; ?></td>
                    <td><img src="<?php echo $fila['ft_servs']; ?>" alt="service photo" width="50px" height="50px"
                            class="rounded-circle"></td>
                    <?php if ($_SESSION['rl'] == 2) { ?>
                    <td>
                        <i type="button" class="bi bi-pencil-square btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#edit-Modal-<?php echo $id_serv; ?>"></i>
                    </td>
                    <td><button class="bi bi-trash-fill btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-Modal-<?php echo $id_serv; ?>"></button></td>
                    <?php } ?>
                    <?php if ($_SESSION['rl'] == 1) { ?>
                    <td>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $fila['email']; ?>"
                            target="_blank" class='bi bi-chat-right-dots-fill btn btn-success'></a>
                    </td>
                    <td>
                        <a href="dashboard.php?mod=calificacion">
                            <button class="fas fa-star btn btn-primary"></button>
                        </a>
                    </td>
                    <?php } ?>
                </tr>

                <!-- Modal para editar -->
                <div class="modal fade text-center" id="edit-Modal-<?php echo $id_serv; ?>" tabindex="-1"
                    aria-labelledby="editModalLabel-<?php echo $id_serv; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="editModalLabel-<?php echo $id_serv; ?>">
                                    <?php echo $translations['edit_service']; ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="dashboard.php?mod=aseo" enctype="multipart/form-data">
                                    <input type="hidden" name="id_serv" value="<?php echo $id_serv; ?>">
                                    <p><strong><?php echo $translations['edit_service']; ?></strong></p>
                                    <label for="prec<?php echo $id_serv; ?>"
                                        class="form-label"><?php echo $translations['service_type']; ?></label>
                                    <input type="text" name="cmbserv" class="form-control"
                                        id="documentType<?php echo $id_serv; ?>"
                                        value="<?php echo ($fila['tipo_servs']); ?>" readonly>
                                    <label for="descripcion<?php echo $id_serv; ?>"
                                        class="form-label"><?php echo $translations['service_description']; ?></label>
                                    <input type="text" class="form-control" id="descripcion<?php echo $id_serv; ?>"
                                        name="desc_serv" value="<?php echo ($fila['descripcion_servicio']); ?>">
                                    <label for="precio<?php echo $id_serv; ?>"
                                        class="form-label"><?php echo $translations['service_price']; ?></label>
                                    <input type="number" class="form-control" id="precio<?php echo $id_serv; ?>"
                                        name="precio_servicio" value="<?php echo ($fila['precio_servicio']); ?>">
                                    <label for="foto<?php echo $id_serv; ?>"
                                        class="form-label"><?php echo $translations['add_image']; ?></label>
                                    <input type="file" class="form-control" id="foto<?php echo $id_serv; ?>"
                                        name="foto_servicio">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                        <button type="submit" class="btn btn-success"
                                            name="btn_actualizar2"><?php echo $translations['update_service']; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal eliminar -->
                <div class="modal fade" id="delete-Modal-<?php echo $id_serv; ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel<?php echo $id_serv; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="deleteModalLabel<?php echo $id_serv; ?>">
                                    <?php echo $translations['confirm_delete']; ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="dashboard.php?mod=aseo">
                                    <input type="hidden" name="dato_eliminar"
                                        value="<?php echo($fila['id_servicio']); ?>">
                                    <p><?php echo $translations['delete_confirmation']; ?></p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                        <button type="submit" class="btn btn-danger"
                                            name="btn_eliminar2"><?php echo $translations['remove']; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } // while ?>
            </tbody>
        </table>
    </div>
    </div>

</body>

</html>