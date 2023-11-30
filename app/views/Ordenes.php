<?php

require_once('../controllers/OrdenControllers.php');

$pedidos = OrdenControllers::getPedidos();
$linea = OrdenControllers::getLineaProductos();
$producto = OrdenControllers::getProductos();
$estadoProducto = OrdenControllers::getEstadoProducto();
$estadoOrden = OrdenControllers::getEstadoOrden();
$transportadora = OrdenControllers::getTransportadora();
$getOrdenes = OrdenControllers::getOrdenes();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ordenes</title>
</head>

<body>
  <?php
  include_once('./menu.php');
  ?>


  <div>

    <div class="container">
      <h1 class="is-size-2">Gestion de Ordenes</h1>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaOrden">
        Nueva Orden
      </button>
      <br>
      <br>
      <label for="Buscar">Buscar</label>
      <input type="text" id="inputIdOrden"  placeholder="ID Orden">
      <input type="text" id="inputIdPedido" placeholder="ID Pedido">
      <button onclick="buscar()"  class="btn btn-primary">Buscar</button>
      <button onclick="limpiarTabla()"  class="btn btn-primary">Limpiar Tabla</button>

    </div>

  </div>


  <div class="modal fade" id="modalNuevaOrden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro del orden</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
          <form class="form" action="" method="POST" id="formCliente">
            <h3>Registro del cliente</h3>

            <div class="mb-3">

              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Numero Pedido</label>
                <select class="form-select" aria-label="Default select example" requiredid id="listPedido" name="listPedido">
                  <option selected>Seleccione</option>
                  <?php foreach ($pedidos as $datos) : ?>
                    <option value="<?= $datos['id_pedidos'] ?>"><?= $datos['id_pedidos'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número de la orden</label>
                <input type="text" class="form-control" id="txtNumeroOrden" requiredid name="txtNumeroOrden" aria-describedby="emailHelp">

              </div>
              <label for="exampleInputEmail1" class="form-label">Codigo Fabricacion</label>
              <button type="button" class="btn btn-secondary" data-toggle="tooltip"  data-placement="top" title="Solo ingresa el código de fabricación si la línea de producto es MTO">
                ?
              </button>
              <input type="text" class="form-control" id="txtCodigoFabricar" requiredid name="txtCodigoFabricar" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Fecha entrega</label>
              <input type="date" class="form-control" id="txtFechaEntrega" requiredid name="txtFechaEntrega" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Fecha despacho</label>
              <input type="date" class="form-control" id="txtFechaDespacho" requiredid name="txtFechaDespacho" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Cantidad</label>
              <input type="text" class="form-control" id="txtCantidad" requiredid name="txtCantidad" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Direccion entrega</label>
              <input type="text" class="form-control" id="txtDireccionEntrega" requiredid name="txtDireccionEntrega" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Linea pedido</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listLineaPedido" name="listLineaPedido">
                <option selected>Seleccione</option>
                <?php foreach ($linea as $datos) : ?>
                  <option value="<?= $datos['id_linea_pedidos'] ?>"><?= $datos['linea_pedidos'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Producto</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listProducto" name="listProducto">
                <option selected>Seleccione</option>
                <?php foreach ($producto as $datos) : ?>
                  <option value="<?= $datos['id_productos'] ?>"><?= $datos['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Estado producto</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listEstadolistProducto" name="listEstadolistProducto">
                <option selected>Seleccione</option>
                <?php foreach ($estadoProducto as $datos) : ?>
                  <option value="<?= $datos['id_estado_productos'] ?>"><?= $datos['estado_productos'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Estado de la orden</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listEstadoOrden" name="listEstadoOrden">
                <option selected>Seleccione</option>
                <?php foreach ($estadoOrden as $datos) : ?>
                  <option value="<?= $datos['id_estado_orden'] ?>"><?= $datos['estado_orden'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>


            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Trasportadora</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listTrasportadora" name="listTrasportadora">
                <option selected>Seleccione</option>
                <?php foreach ($transportadora as $datos) : ?>
                  <option value="<?= $datos['id_transportadora'] ?>"><?= $datos['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">

              <input type="text" class="form-control" id="txtObservaciones" hidden value="ninguna" name="txtObservaciones">
            </div>

            <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalModificarOrden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar del orden</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
          <form class="form" action="" method="POST" id="formClienteM">
            <div class="mb-3">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Número Pedido</label>
                <select class="form-select" aria-label="Default select example" disabled id="listPedidoM" name="listPedidoM">
                  <option selected>Seleccione</option>
                  <?php foreach ($pedidos as $datos) : ?>
                    <option value="<?= $datos['id_pedidos'] ?>"><?= $datos['id_pedidos'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número de la orden</label>
                <input type="text" class="form-control" id="txtNumeroOrdenM" disabled name="txtNumeroOrdenM" aria-describedby="emailHelp">
              </div>

              <label for="exampleInputEmail1" class="form-label">Codigo Fabricacion</label>
              <label class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Solo ingresa el código de fabricación si la línea de producto es MTO">
                ?
              </label>
              <input type="text" class="form-control" id="txtCodigoFabricarM" disabled name="txtCodigoFabricarM" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Fecha entrega</label>
              <input type="date" class="form-control" requiredid id="txtFechaEntregaM" name="txtFechaEntregaM" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Fecha despacho</label>
              <input type="date" class="form-control" requiredid id="txtFechaDespachoM" name="txtFechaDespachoM" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Cantidad</label>
              <input type="text" class="form-control" requiredid id="txtCantidadM" name="txtCantidadM" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Direccion entrega</label>
              <input type="text" class="form-control" requiredid id="txtDireccionEntregaM" name="txtDireccionEntregaM" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Linea pedido</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listLineaPedidoM" name="listLineaPedidoM">
                <option selected>Seleccione</option>
                <?php foreach ($linea as $datos) : ?>
                  <option value="<?= $datos['id_linea_pedidos'] ?>"><?= $datos['linea_pedidos'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Producto</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listProductoM" name="listProductoM">
                <option selected>Seleccione</option>
                <?php foreach ($producto as $datos) : ?>
                  <option value="<?= $datos['id_productos'] ?>"><?= $datos['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Estado producto</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listEstadolistProductoM" name="listEstadolistProductoM">
                <option selected>Seleccione</option>
                <?php foreach ($estadoProducto as $datos) : ?>
                  <option value="<?= $datos['id_estado_productos'] ?>"><?= $datos['estado_productos'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Estado de la orden</label>
              <select class="form-select" aria-label="Default select example" requiredid id="listEstadoOrdenM" name="listEstadoOrdenM">
                <option selected>Seleccione</option>
                <?php foreach ($estadoOrden as $datos) : ?>
                  <option value="<?= $datos['id_estado_orden'] ?>"><?= $datos['estado_orden'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Trasportadora</label>
              <select class="form-select" aria-label="Default select example"requiredid id="listTrasportadoraM" name="listTrasportadoraM">
                <option selected>Seleccione</option>
                <?php foreach ($transportadora as $datos) : ?>
                  <option value="<?= $datos['id_transportadora'] ?>"><?= $datos['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>



            <h3>Evidencia de entrega</h3>
            <label class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Solo ingresa la url de la imagen y solamente llene los campos cuando el estado de la orden sea 'Entregado'">
              ?
            </label>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">ID Evidencia</label>
              <input type="text" class="form-control" id="txtEvidenciaM" name="txtEvidenciaM" disabled aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">URL firma del cliente (URL de la foto)</label>
              <input type="text" class="form-control" id="txtFotoClienteM" name="txtFotoClienteM" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">URL Prueba entrega (URL de la foto)</label>
              <input type="text" class="form-control" id="txtPruebaEntregaM" name="txtPruebaEntregaM" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="txtDescripcionM" name="txtDescripcionM" aria-describedby="emailHelp">
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
            <th>Codigo pedido</th>
            <th>codigo orden</th>
            <th>identificacion</th>
            <th>Fecha_entrega</th>
            <th>Fecha_despacho</th>

            <th>Botones</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla">

          <?php foreach ($getOrdenes as $datos) : ?>
            <tr>

              <td><?= $datos['id_pedidos'] ?></td>
              <td><?= $datos['id_orden'] ?></td>
              <td><?= $datos['fecha_entrega'] ?></td>
              <td><?= $datos['fecha_despacho'] ?></td>
              <td><?= $datos['estado_orden'] ?></td>

              <td>
                <button type="button" class="btn btn-primary" id="btnEditar" data-id="<?= $datos['id_orden'] ?>" data-bs-toggle="modal" data-bs-target="#modalModificarOrden" onclick="EditarOrden(<?= $datos['id_orden'] ?>);">
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



</body>
<script src="../assets/js/OrdenFuntion.js"></script>


</html>