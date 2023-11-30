<?php
require_once('../controllers/PedidosControllers.php');

$clientes = PedidosControllers::getClientes();
$estado = PedidosControllers::getEstadoEntrega();
$pedi = PedidosControllers::getPedidos();



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>

<body>
    <?php
    include_once('./menu.php');
    ?>

    <div>

        <div class="container">
            <h1 class="is-size-2">Gestion de Pedidos</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoPedido">
                Nuevo Pedido
            </button>
            <br>
            <br>
            <label for="Buscar">Buscar</label>
            <input type="text"  class="form-control" id="txtBuscarPedido" placeholder="Buscar por código de pedido">

        </div>

    </div>


    <div class="modal fade" id="modalNuevoPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="exampleInputEmail1" class="form-label">Cliente</label>
                            <select class="form-select" aria-label="Default select example" requiredid id="listCliente" name="listCliente">
                                <option selected>Seleccione</option>
                                <?php foreach ($clientes as $datos) : ?>
                                    <option value="<?= $datos['id_clientes'] ?>"><?= $datos['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Costo total</label>
                            <input type="text" class="form-control" disabled id="txtCosto" value="0" name="txtCosto" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Codigo de la factura</label>
                            <input type="text" class="form-control" id="txtCodigoFactura"  requiredid name="txtCodigoFactura" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Estado del pedido</label>
                            <select class="form-select" aria-label="Default select example" disabled id="listEstado" name="listEstado">
                                <option selected>Seleccione</option>
                                <?php foreach ($estado as $datos) : ?>
                                    <option value="<?= $datos['id_estado_Entregas'] ?>"><?= $datos['estado_Entregas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                            <input type="text" class="form-control" id="txtObservaciones" name="txtObservaciones">
                        </div>




                        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEditarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar del cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">ID</label>
                            <input type="text" class="form-control" disabled id="txtIdPedidoM" name="txtIdPedidoM" aria-describedby="emailHelp">

                        </div>

                    <form class="form" action="" method="POST" id="formCliente">
                        <h3>Editar del cliente</h3>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cliente</label>
                            <select class="form-select" aria-label="Default select example" id="listClienteM" name="listClienteM">
                                <option selected>Seleccione</option>
                                <?php foreach ($clientes as $datos) : ?>
                                    <option value="<?= $datos['id_clientes'] ?>"><?= $datos['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Costo total</label>
                            <input type="text" class="form-control" disabled id="txtCostoM"  name="txtCostoM" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Codigo de la factura</label>
                            <input type="text" disabled class="form-control" id="txtCodigoFacturaM" name="txtCodigoFacturaM" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Estado del pedido</label>
                            <select class="form-select" aria-label="Default select example" id="listEstadoM" name="listEstadoM">
                                <option selected>Seleccione</option>
                                <?php foreach ($estado as $datos) : ?>
                                    <option value="<?= $datos['id_estado_Entregas'] ?>"><?= $datos['estado_Entregas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                            <input type="text" class="form-control" id="txtObservacionesM" name="txtObservacionesM">
                        </div>




                        <button type="button" class="btn btn-primary" id="btnEditarM">Editar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


  
   

    <div class="columns">
        <div class="column">


            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Cliente</th>
                        <th>Costo total</th>
                        <th>Codigo factura</th>
                        <th>Estado</th>
                        <th>Botones</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">

                    <?php foreach ($pedi as $datos) : ?>
                        <tr>

                            <td><?= $datos['id_pedidos'] ?></td>
                            <td><?= $datos['nombre'] ?></td>
                            <td><?= $datos['costo_total'] ?></td>
                            <td><?= $datos['id_factura'] ?></td>
                            <td><?= $datos['estado_Entregas'] ?></td>

                            <td>
                                <button type="button" class="btn btn-primary" id="btnEditar" data-id="<?= $datos['id_pedidos'] ?>" data-bs-toggle="modal" data-bs-target="#modalEditarPedido" onclick="editarPedido(<?= $datos['id_pedidos'] ?>);">
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



    <script src="../assets/js/PedidosFuntion.js"></script>

</body>

</html>