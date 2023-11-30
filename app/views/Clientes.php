<?php
require_once('../controllers/ClienteControllers.php');

$tipoDocumento =  ClienteControllers::getTipoDocumentos();
$tipoClientes = ClienteControllers::getTipoClientes();
$mostrarclientes = ClienteControllers::getDatosCliente();


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/aplicacionCompleta.css">
    <title>Clientes</title>
</head>

<body>


    <?php
    include_once('./menu.php');
    ?>
    <div>

        <div class="container">
            <h1 class="is-size-2">Gestion de clientes</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">
                Nuevo Cliente
            </button>
        </div>

    </div>


    <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro del cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <form class="form" action="" method="POST" id="formCliente">
                        <h3>Registro del cliente</h3>

                        <div class="mb-3">
                            
                            <input type="text" class="form-control" id="txtIdCliente" hidden name="txtIdCliente" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="txtNombreCompleto" name="txtNombreCompleto" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Tipo documento</label>
                            <select class="form-select" aria-label="Default select example" id="listTipoDocumento" name="listTipoDocumento">
                                <option selected>Seleccione</option>
                                <?php foreach ($tipoDocumento as $dato) : ?>
                                    <option value="<?= $dato['id_tipo_documentos'] ?>"><?= $dato['tipo_documentos'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Número de identificación</label>
                            <input type="text" class="form-control" id="txtnumeroIdentificacion" name="txtnumeroIdentificacion">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="txtTelefono" name="txtTelefono">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="txtDireccion" name="txtDireccion">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Tipo cliente</label>
                            <select class="form-select" aria-label="Default select example" id="listTipoCliente" name="listTipoCliente">
                                <option selected>Seleccione</option>
                                <?php foreach ($tipoClientes as $datos) : ?>
                                    <option value="<?= $datos['id_tipo_clientes'] ?>"><?= $datos['tipo_clientes'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form" action="" method="POST" id="formCliente">
                    <h3>Modificar del cliente</h3>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">id</label>
                        <input type="text" disabled class="form-control" id="txtIdClienteM"  name="txtIdClienteM" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="txtNombreCompletoM" name="txtNombreCompletoM" aria-describedby="emailHelp">

                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tipo documento</label>
                        <select class="form-select" aria-label="Default select example" id="listTipoDocumentoM" name="listTipoDocumentoM">
                            <option selected>Seleccione</option>
                            <?php foreach ($tipoDocumento as $dato) : ?>
                                <option value="<?= $dato['id_tipo_documentos'] ?>"><?= $dato['tipo_documentos'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Número de identificación</label>
                        <input type="text" class="form-control" id="txtnumeroIdentificacionM" name="txtnumeroIdentificacionM">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="txtTelefonoM" name="txtTelefonoM">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccionM" name="txtDireccionM">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tipo cliente</label>
                        <select class="form-select" aria-label="Default select example" id="listTipoClienteM" name="listTipoClienteM">
                            <option selected>Seleccione</option>
                            <?php foreach ($tipoClientes as $datos) : ?>
                                <option value="<?= $datos['id_tipo_clientes'] ?>"><?= $datos['tipo_clientes'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <button type="button" class="btn btn-primary" id="btnEditarM" name="btnEditarM">Editar</button>
                </form>
            </div>
        </div>
    </div>


    <div class="columns">
        <div class="column">


            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>identificacion</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Tipo documento</th>
                        <th>Tipo cliente</th>
                        <th>Botones</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">

                    <?php foreach ($mostrarclientes as $datos) : ?>
                        <tr>

                            <td><?= $datos['id_clientes'] ?></td>
                            <td><?= $datos['nombre'] ?></td>
                            <td><?= $datos['numero_identificacion'] ?></td>
                            <td><?= $datos['telefono'] ?></td>
                            <td><?= $datos['direccion'] ?></td>
                            <td><?= $datos['tipo_documentos'] ?></td>
                            <td><?= $datos['tipo_clientes'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" id="btnEditar<?= $datos['id_clientes'] ?>" data-id="<?= $datos['id_clientes'] ?>" data-bs-toggle="modal" data-bs-target="#modalEditarCliente" onclick="editarCliente(<?= $datos['id_clientes'] ?>);">
                                    Editar
                                </button>
                            </td>
                            <!---td><button type="button" class="btn btn-primary" id="btnEliminar" data-id="<?= $datos['id_clientes'] ?>" onclick="eliminarCliente(<?= $datos['id_clientes'] ?>);">Eliminar</button></td---->


                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>


    <script src="../assets/js/ClientesFuntion.js"></script>



    
</body>

</html>