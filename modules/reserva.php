<?php
include "../conexion.php";
$numero = $_SESSION['doc'];

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "../translation/español.php";
} else {
    $translations = require "../translation/ingles.php";
}
$query = "SELECT * FROM reserva_hoteles WHERE fk_usuario_ = '$numero'";
$result2 = mysqli_query($con, $query);

if (!$result2) {
    die("Error en la consulta: " . mysqli_error($con));
}

// PROCESO DE ACTUALIZACION DATOS CRUD
if (isset($_POST['btn_actualizar'])) {
    $id_hotel = $_POST['id_hotel'];
    $n_h = $_POST['n_h'];
    $valor = $_POST['vl'];
    $tipo_h = $_POST['t_h'];
    $fecha = $_POST['date'];

    // Botón de actualización
    $update = "UPDATE reserva_hoteles SET nombre_hotel = '$n_h', valor_reserva = '$valor', 
    tipo_habitacion = '$tipo_h', fecha_reserva = '$fecha' WHERE id_hotel = '$id_hotel'";

    if (mysqli_query($con, $update)) {
        echo "<script>alert('Actualización exitosa');</script>";
        echo "<script>window.location='dashboard.php?mod=reserva';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// PROCESO DE ELIMINACIÓN
if (isset($_POST['btn_eliminar'])) {
    $delete = $_POST['dato_eliminar'];
    $borrar = mysqli_query($con, "DELETE FROM reserva_hoteles WHERE id_hotel = '$delete' AND fk_usuario_ = '$numero'");

    if ($borrar) {
        echo "<script>alert('Eliminación exitosa');</script>";
        echo "<script>window.location='dashboard.php?mod=reserva';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// PROCESO DE ADICIÓN DE NUEVO REGISTRO
if (isset($_POST['btn_agregar'])) {
    $id_hotel = $_POST['id_hotel']; 
    $n_h = $_POST['n_h'];
    $valor = $_POST['vl'];
    $tipo_h = $_POST['t_h'];
    $fecha = $_POST['date'];
    $fk_usuario = $_POST['fk_usuario_'];

    // Inserción de nuevo registro
    $insert = "INSERT INTO reserva_hoteles (id_hotel, nombre_hotel, valor_reserva, tipo_habitacion, fecha_reserva, fk_usuario_)
               VALUES ('$id_hotel', '$n_h', '$valor', '$tipo_h', '$fecha', '$fk_usuario')";

    if (mysqli_query($con, $insert)) {
        echo "<script>alert('Registro añadido exitosamente');</script>";
        echo "<script>window.location='dashboard.php?mod=reserva';</script>";
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
</head>

<body>

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col">
                <h2 class="text-center"><?php echo $translations['reservation_number']; ?></h2>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?php echo $translations['reservation_number']; ?></th>
                    <th scope="col"><?php echo $translations['hotel_name']; ?></th>
                    <th scope="col"><?php echo $translations['price']; ?></th>
                    <th scope="col"><?php echo $translations['room_type']; ?></th>
                    <th scope="col"><?php echo $translations['reservation_date']; ?></th>
                    <th scope="col"><?php echo $translations['edit_reservation']; ?></th>
                    <th scope="col"><?php echo $translations['cancel_reservation']; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result2 = mysqli_query($con, "SELECT * FROM reserva_hoteles r JOIN hotel h ON r.fk_hotel = h.id_ho WHERE fk_usuario_ = '$numero'");
                while ($fila = mysqli_fetch_array($result2)) {
                    $id_hotel = $fila['id_hotel'];
                    ?>
                    <tr>
                        <td><?php echo $fila['id_hotel']; ?></td>
                        <td><?php echo $fila['nombre_hotel']; ?></td>
                        <td><?php echo $fila['valor_reserva']; ?></td>
                        <td><?php echo $fila['tipo_habitacion']; ?></td>
                        <td><?php echo $fila['fecha_reserva']; ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#edit-Modal-<?php echo $id_hotel; ?>">
                                <?php echo $translations['edit_reservation']; ?>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete-Modal-<?php echo $id_hotel; ?>">
                                <?php echo $translations['cancel_reservation']; ?>
                            </button>
                        </td>
                    </tr>
                    <?php
                    // Modal para editar
                    ?>
                    <div class="modal fade" id="edit-Modal-<?php echo $id_hotel; ?>" tabindex="-1"
                        aria-labelledby="editModalLabel-<?php echo $id_hotel; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $translations['edit_reservation']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="dashboard.php?mod=reserva">
                                        <input type="hidden" name="id_hotel" value="<?php echo $id_hotel; ?>">
                                        <div class="mb-3">
                                            <label for="nombre_hotel<?php echo $id_hotel; ?>" class="form-label">
                                                <?php echo $translations['hotel_name']; ?>
                                            </label>
                                            <input type="text" name="n_h" class="form-control"
                                                id="nombre_hotel<?php echo $id_hotel; ?>"
                                                value="<?php echo $fila['nombre_hotel']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="valor_reserva<?php echo $id_hotel; ?>" class="form-label">
                                                <?php echo $translations['price']; ?>
                                            </label>
                                            <input type="text" class="form-control"
                                                id="valor_reserva<?php echo $id_hotel; ?>" name="vl"
                                                value="<?php echo $fila['valor_reserva']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipo_habitacion<?php echo $id_hotel; ?>" class="form-label">
                                                <?php echo $translations['room_type']; ?>
                                            </label>
                                            <input type="text" class="form-control"
                                                id="tipo_habitacion<?php echo $id_hotel; ?>" name="t_h"
                                                value="<?php echo $fila['tipo_habitacion']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_reserva<?php echo $id_hotel; ?>" class="form-label">
                                                <?php echo $translations['reservation_date']; ?>
                                            </label>
                                            <input type="date" class="form-control"
                                                id="fecha_reserva<?php echo $id_hotel; ?>" name="date"
                                                value="<?php echo $fila['fecha_reserva']; ?>" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                            <button type="submit" class="btn btn-success"
                                                name="btn_actualizar"><?php echo $translations['update']; ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal eliminar -->
                    <div class="modal fade" id="delete-Modal-<?php echo $id_hotel; ?>" tabindex="-1"
                        aria-labelledby="deleteModalLabel<?php echo $id_hotel; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $translations['cancel_reservation']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="dashboard.php?mod=reserva">
                                        <input type="hidden" name="dato_eliminar" value="<?php echo $id_hotel; ?>">
                                        <p>¿Está seguro de que desea eliminar este servicio?</p>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                            <button type="submit" class="btn btn-danger"
                                                name="btn_eliminar"><?php echo $translations['cancel_reservation']; ?></button>
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

    <!-- Modal para añadir -->
    <div class="modal fade" id="add-Modal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $translations['add_reservation']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="dashboard.php?mod=reserva">
                        <input type="hidden" name="fk_usuario_" value="<?php echo $numero; ?>">
                        <div class="mb-3">
                            <label for="tipo_habitacion_new" class="form-label"><?php echo $translations['room_type']; ?></label>
                            <input type="text" class="form-control" id="tipo_habitacion_new" name="t_h" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                            <button type="submit" class="btn btn-success" name="btn_agregar"><?php echo $translations['add_reservation']; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
