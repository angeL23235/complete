<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>Gestion</title>
    <style>
        body {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-size: 16px;
            background-color: #EBEBEB;
        }

        .bigtable {
            margin-top: 200px;
            margin-left: 199px;
        }
    </style>
</head>

<body>
    <div class="container text-center bigtable">
        <section class="buscar">
            <form action="" method="post">
                <input type="text" placeholder="Busque por documento">
                <input type="submit" value="Buscar" name="btn_search">
            </form>
        </section>
        <br>

        <table class="table table2">
            <thead>
                <tr>
                    <th scope="col" class="table-dark">Tipo de documento</th>
                    <th scope="col" class="table-dark">Documento</th>
                    <th scope="col" class="table-dark">Nombres</th>
                    <th scope="col" class="table-dark">Apellidos</th>
                    <th scope="col" class="table-dark">Email</th>
                    <th scope="col" class="table-dark">Foto</th>
                    <th scope="col" class="table-dark">Borrar</th>
                    <th scope="col" class="table-dark">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  include "../conexion.php";  
                  $con = mysqli_query($con, "SELECT * FROM usuario") or die("REVISE PAAA");

                  while ($fila = mysqli_fetch_array($con)) {
                    $id = $fila['id_user'];
                ?>
                <tr>
                    <td scope="row"><?php echo $fila['tipo_documento']; ?></td>
                    <td><?php echo $fila['numero_documento']; ?></td>
                    <td><?php echo $fila['nombres']; ?></td>
                    <td><?php echo $fila['apellidos']; ?></td>
                    <td><?php echo $fila['email']; ?></td>
                    <td><img src="../imagen-user/<?php echo $fila['foto_perfil']; ?>" alt="imagen_usuario" width="50px"
                            height="50px" class="rounded-circle"></td>
                    <td><i type="button" class="bi bi-trash3-fill" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo $id; ?>">Delete</i></td>
                    <td><i type="button" class="bi bi-pencil-square" data-bs-toggle="modal"
                            data-bs-target="#editModal<?php echo $id; ?>">Editar</i></td>
                </tr>

                <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1"
                    aria-labelledby="editModalLabel<?php echo $id; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="editModalLabel<?php echo $id; ?>">Actualizar
                                    datos del usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                                    <div class="mb-3">
                                        <label for="documentType<?php echo $id; ?>" class="form-label">Tipo de
                                            documento</label>
                                        <input type="text" class="form-control" id="documentType<?php echo $id; ?>"
                                            name="document_type" value="<?php echo $fila['tipo_documento']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="documentNumber<?php echo $id; ?>" class="form-label">Número de
                                            documento</label>
                                        <input type="text" class="form-control" id="documentNumber<?php echo $id; ?>"
                                            name="document_number" value="<?php echo $fila['numero_documento']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="names<?php echo $id; ?>" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="names<?php echo $id; ?>"
                                            name="names" value="<?php echo $fila['nombres']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="surnames<?php echo $id; ?>" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="surnames<?php echo $id; ?>"
                                            name="apes" value="<?php echo $fila['apellidos']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo<?php echo $id; ?>" class="form-label">Foto</label>
                                        <img src="../imagen-user/<?php echo $fila['foto_perfil']; ?>" alt="modificar imagen"
                                            width="50px" height="50px" class="rounded-circle">
                                        <input type="file" class="form-control" id="photo<?php echo $id; ?>"
                                            name="photo">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-7ZWcsy">
