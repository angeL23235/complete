<?php
include "../conexion.php";
$numero = $_SESSION['doc'];

$lang = $_SESSION['lang'];
if ($lang == 'es') {
    $translations = require "../translation/español.php";
} else {
    $translations = require "../translation/ingles.php";
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['public_transport_title']; ?></title>
</head>

<body>

    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <img src="../img/metro.svg" alt="Metro" style="width: 50px;">
                    </div>
                    <div>
                        <h2 class="fw-bold">Metro</h2>
                        <p><?php echo $translations['metro_description']; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card shadow-sm p-3 line-a">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <span class="fs-3 fw-bold">A</span>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold">Niquía - La Estrella</h5>
                                </div>
                            </div>
                            <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-a"
                                class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm p-3 line-b">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <span class="fs-3 fw-bold">B</span>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold">San Antonio - San Javier</h5>
                                </div>
                            </div>
                            <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-b"
                                class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row align-items-center">

                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <img src="../img/cable.svg" alt="MetroCable" style="width: 50px;">
                        </div>
                        <div>
                            <h2 class="fw-bold"><?php echo $translations['metrocable']; ?></h2>
                            <p><?php echo $translations['metrocable_description']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-j">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">J</spa>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">San Javier - La Aurora</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-j"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-k">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">K</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Acevedo - Santo Domingo</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-k"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-l">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-brown text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">L</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Santo Domingo - Arví</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-l"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-h">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-pink text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">H</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Oriente - Villa Sierra</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-h"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-p">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">P</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Acevedo - El Progreso</h5>
                                    </div>
                                </div>
                                <a href="https://metrodemedellin.gov.co/usuarios/sistema-integrado/linea-p"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-m">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-purple text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">M</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Miraflores - Trece de Noviembre</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-m"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <img src="../img/tranvia.svg" alt="Tranvía" style="width: 50px;">
                        </div>
                        <div>
                            <h2 class="fw-bold"><?php echo $translations['tram']; ?></h2>
                            <p><?php echo $translations['tram_description']; ?></p>
                            <p>Próximamente sumaremos a nuestro sistema el Metro de la 80.</p>
                            <a href="https://acortar.link/nOGgRd" class="btn btn-success"><?php echo $translations['metro_80']; ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-t">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">T</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">San Antonio - Oriente</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-t"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <img src="../img/buses.svg" alt="Buses" style="width: 50px;">
                        </div>
                        <div>
                            <h2 class="fw-bold"><?php echo $translations['buses']; ?></h2>
                            <p><?php echo $translations['buses_description']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-1">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">1</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">U. de M. - Parque Aranjuez</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-1"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 line-2">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fs-3 fw-bold">2</span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Caribe - La Palma</h5>
                                    </div>
                                </div>
                                <a href="https://www.metrodemedellin.gov.co/usuarios/sistema-integrado/linea-o"
                                    class="text-decoration-none"><?php echo $translations['see_line']; ?> &gt;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>