<?php
include "../conexion.php";
$numero = $_SESSION['doc'];

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "../translation/español.php";
} else {
    $translations = require "../translation/ingles.php";
}

if (isset($_POST['btn_agregar'])) {
    $id_hotel = $_POST['id_hotel'];
    $n_h = $_POST['n_h'];
    $valor = $_POST['vl'];
    $tipo_h = $_POST['t_h'];
    $fecha = $_POST['date'];
    $fk_usuario = $_POST['fk_usuario_'];
    $fk_hotel = $_POST['fk_hotel'];
    
    $insert = "INSERT INTO reserva_hoteles (id_hotel, nombre_hotel, valor_reserva, tipo_habitacion, fecha_reserva, fk_usuario_, fk_hotel)
               VALUES ('$id_hotel', '$n_h', '$valor', '$tipo_h', '$fecha', '$fk_usuario', '$fk_hotel')";

    if (mysqli_query($con, $insert)) {
        echo "<script>alert('" . $translations['success_message'] . "');</script>";
        echo "<script>window.location='dashboard.php?mod=hotel';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hoteles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card first-card" style="width: 100%;">
                    <img src="../img/reserva-hotel.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h4 class="card-title"><strong><?php echo $translations['reservation_title']; ?></strong></h4>
                        <h5 class="card-title"><?php echo $translations['find_info']; ?></h5>
                        <p class="card-text"><?php echo $translations['modify_delete']; ?></p>
                        <a href="dashboard.php?mod=reserva" class="btn btn-primary"><?php echo $translations['manage_reservations']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-4"><?php echo $translations['hotels_title']; ?></h2>
        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../img/hotel4.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ibis budget Itagui</h5>
                        <p class="card-text">Calle 50 # 40 -17, 55413 Medellín, Colombia</p>
                        <p><?php echo $translations['Price']?>: 160.000 COP</p>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-Modal-1"><?php echo $translations['reserve_hotel']; ?></a>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="add-Modal-1" tabindex="-1" aria-labelledby="addModalLabel-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel-1"><?php echo $translations['reserve_ibis']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="dashboard.php?mod=hotel">
                                <input type="hidden" name="fk_usuario_" value="<?php echo $numero; ?>">
                                <input type="hidden" name="fk_hotel" value="123"> 
                                <input type="hidden" name="n_h" value="Ibis Budget Itagui"> 
                                <div class="mb-3">
                                    <label for="id_hotel_new" class="form-label"><?php echo $translations['hotel_number']; ?></label>
                                    <input type="text" name="id_hotel" class="form-control" id="id_hotel_new" required>
                                </div>
                                <div class="mb-3">
                                    <label for="valor_reserva_new" class="form-label"><?php echo $translations['reservation_value']; ?></label>
                                    <input type="text" class="form-control" id="valor_reserva_new" name="vl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_habitacion_new" class="form-label"><?php echo $translations['room_type']; ?></label>
                                    <input type="text" class="form-control" id="tipo_habitacion_new" name="t_h" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_reserva_new" class="form-label"><?php echo $translations['reservation_date']; ?></label>
                                    <input type="date" class="form-control" id="fecha_reserva_new" name="date" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn_agregar"><?php echo $translations['submit_reservation']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../img/hny.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">NH Collection Medellín Royal</h5>
                        <p class="card-text">Carrera 42 No 5 Sur 130, Medellín, Colombia</p>
                        <p><?php echo $translations['Price']?> 437.000 COP</p>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-Modal-2"><?php echo $translations['reserve_hotel']; ?></a>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="add-Modal-2" tabindex="-1" aria-labelledby="addModalLabel-2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel-2"><?php echo $translations['reserve_nh']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="dashboard.php?mod=hotel">
                                <input type="hidden" name="fk_usuario_" value="<?php echo $numero; ?>">
                                <input type="hidden" name="fk_hotel" value="124"> 
                                <input type="hidden" name="n_h" value="NH Collection Medellín Royal"> 
                                <div class="mb-3">
                                    <label for="id_hotel_new" class="form-label"><?php echo $translations['hotel_number']; ?></label>
                                    <input type="text" name="id_hotel" class="form-control" id="id_hotel_new" required>
                                </div>
                                <div class="mb-3">
                                    <label for="valor_reserva_new" class="form-label"><?php echo $translations['reservation_value']; ?></label>
                                    <input type="text" class="form-control" id="valor_reserva_new" name="vl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_habitacion_new" class="form-label"><?php echo $translations['room_type']; ?></label>
                                    <input type="text" class="form-control" id="tipo_habitacion_new" name="t_h" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_reserva_new" class="form-label"><?php echo $translations['reservation_date']; ?></label>
                                    <input type="date" class="form-control" id="fecha_reserva_new" name="date" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn_agregar"><?php echo $translations['submit_reservation']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../img/mmh.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Medellín Marriott Hotel</h5>
                        <p class="card-text">Calle 1a Sur n.º 43a-83, Medellín, Colombia</p>
                        <p><?php echo $translations['Price']?>: 1'482.000 COP</p>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-Modal-3"><?php echo $translations['reserve_hotel']; ?></a>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="add-Modal-3" tabindex="-1" aria-labelledby="addModalLabel-3" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel-3"><?php echo $translations['reserve_marriott']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="dashboard.php?mod=hotel">
                                <input type="hidden" name="fk_usuario_" value="<?php echo $numero; ?>">
                                <input type="hidden" name="fk_hotel" value="125"> 
                                <input type="hidden" name="n_h" value="Medellín Marriott Hotel"> 
                                <div class="mb-3">
                                    <label for="id_hotel_new" class="form-label"><?php echo $translations['hotel_number']; ?></label>
                                    <input type="text" name="id_hotel" class="form-control" id="id_hotel_new" required>
                                </div>
                                <div class="mb-3">
                                    <label for="valor_reserva_new" class="form-label"><?php echo $translations['reservation_value']; ?></label>
                                    <input type="text" class="form-control" id="valor_reserva_new" name="vl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_habitacion_new" class="form-label"><?php echo $translations['room_type']; ?></label>
                                    <input type="text" class="form-control" id="tipo_habitacion_new" name="t_h" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_reserva_new" class="form-label"><?php echo $translations['reservation_date']; ?></label>
                                    <input type="date" class="form-control" id="fecha_reserva_new" name="date" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn_agregar"><?php echo $translations['submit_reservation']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../img/fp.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Four Points by Sheraton Medellin</h5>
                        <p class="card-text">Carrera 43 C #6 Sur 100, Medellín, Colombia</p>
                        <p><?php echo $translations['Price']?>: 360.000 COP</p>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-Modal-4"><?php echo $translations['reserve_hotel']; ?></a>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add-Modal-4" tabindex="-1" aria-labelledby="addModalLabel-4" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel-4"><?php echo $translations['reserve_four_points']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="dashboard.php?mod=hotel">
                                <input type="hidden" name="fk_usuario_" value="<?php echo $numero; ?>">
                                <input type="hidden" name="fk_hotel" value="126"> 
                                <input type="hidden" name="n_h" value="Four Points by Sheraton Medellin"> 
                                <div class="mb-3">
                                    <label for="id_hotel_new" class="form-label"><?php echo $translations['hotel_number']; ?></label>
                                    <input type="text" name="id_hotel" class="form-control" id="id_hotel_new" required>
                                </div>
                                <div class="mb-3">
                                    <label for="valor_reserva_new" class="form-label"><?php echo $translations['reservation_value']; ?></label>
                                    <input type="text" class="form-control" id="valor_reserva_new" name="vl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_habitacion_new" class="form-label"><?php echo $translations['room_type']; ?></label>
                                    <input type="text" class="form-control" id="tipo_habitacion_new" name="t_h" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_reserva_new" class="form-label"><?php echo $translations['reservation_date']; ?></label>
                                    <input type="date" class="form-control" id="fecha_reserva_new" name="date" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $translations['close']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn_agregar"><?php echo $translations['submit_reservation']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
