<?php
require_once('../controllers/ProductosControllers.php');

$bodegas =  ProductosControllers::getBodegas();
$estadoProductos = ProductosControllers::getEstadoProductos();
$tipoProducto =  ProductosControllers::getTipoProducto();
$ListaProductos = ProductosControllers::getDatosProductos();
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
  <title>Productos</title>
</head>

<body>


  <?php
  include_once('./menu.php');
  ?>

  <div class="container">
    <h1 class="is-size-2">Gestion de Productos</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoProducto">
      Nuevo Producto
    </button>
    <br>
    <br>
    <label for="">Buscar:</label>
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por nombre">
 
 
  </div>


  <div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro del producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
          <form class="form" action="" method="POST">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" required ="txtNombre" name="txtNombre" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Costo</label>
              <input type="number" class="form-control" id="txtCosto" name="txtCosto">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Color</label>
              <input type="text" class="form-control" id="txtColor" name="txtColor">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Descripcion</label>
              <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Tipo Producto</label>
              <select class="form-select" aria-label="Default select example" id="txtTipoProducto" name="txtTipoProducto">
                <option selected>Seleccione</option>
                <?php foreach ($tipoProducto as $datos) : ?>
                  <option value="<?= $datos['id_tipo_productos'] ?>"><?= $datos['tipo_productos'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Bodega</label>
              <select class="form-select" aria-label="Default select example" id="txtBodega" name="txtBodega">
                <option selected>Seleccione</option>
                <?php foreach ($bodegas as $datos) : ?>
                  <option value="<?= $datos['id_bodegas'] ?>"><?= $datos['bodegas'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Estado del producto</label>
              <select class="form-select" aria-label="Default select example" id="txtEstadoProducto" name="txtEstadoProducto">
                <option selected>Seleccione</option>
                <?php //foreach ($estadoProductos as $datos) : ?>
                  <option value="3">Disponible</option>
                <?php //endforeach; ?>
              </select>
            </div>


            <button type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar</button>
          </form>


        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form" action="" method="POST">
          <div class="mb-3">
            <label for="txtIdProductoM" class="form-label">ID</label>
            <input type="text" class="form-control" disabled id="txtIdProductoM" name="txtIdProductoM" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="txtNombreM" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="txtNombreM" name="txtNombreM" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="txtCostoM" class="form-label">Costo</label>
            <input type="number" class="form-control" id="txtCostoM" name="txtCostoM">
          </div>

          <div class="mb-3">
            <label for="txtColorM" class="form-label">Color</label>
            <input type="text" class="form-control" id="txtColorM" name="txtColorM">
          </div>

          <div class="mb-3">
            <label for="txtDescripcionM" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="txtDescripcionM" name="txtDescripcionM">
          </div>

          <div class="mb-3">
            <label for="txtTipoProductoM" class="form-label">Tipo Producto</label>
            <select class="form-select" aria-label="Default select example" id="txtTipoProductoM" name="txtTipoProductoM">
              <option selected>Seleccione</option>
              <?php foreach ($tipoProducto as $datos) : ?>
                <option value="<?= $datos['id_tipo_productos'] ?>"><?= $datos['tipo_productos'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="txtBodegaM" class="form-label">Bodega</label>
            <select class="form-select" aria-label="Default select example" id="txtBodegaM" name="txtBodegaM">
              <option selected>Seleccione</option>
              <?php foreach ($bodegas as $datos) : ?>
                <option value="<?= $datos['id_bodegas'] ?>"><?= $datos['bodegas'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="txtEstadoProductoM" class="form-label">Estado del producto</label>
            <select class="form-select" aria-label="Default select example" id="txtEstadoProductoM" name="txtEstadoProductoM">
              <option selected>Seleccione</option>
              <?php foreach ($estadoProductos as $datos) : ?>
                <option value="<?= $datos['id_estado_productos'] ?>"><?= $datos['estado_productos'] ?></option>
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
            <th>Costor</th>
            <th>color</th>
            <th>Descripcion</th>
            <th>Tipo producto</th>
            <th>Bodega</th>
            <th>Estado del producto</th>
            <th>Botones</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla">

          <?php foreach ($ListaProductos as $datos) : ?>
            <tr>

              <td><?= $datos['id_productos'] ?></td>
              <td><?= $datos['nombre'] ?></td>
              <td><?= $datos['costo'] ?></td>
              <td><?= $datos['color'] ?></td>
              <td><?= $datos['descripcion'] ?></td>
              <td><?= $datos['tipo_productos'] ?></td>
              <td><?= $datos['bodegas'] ?></td>
              <td><?= $datos['estado_productos'] ?></td>

              <td>
                <button type="button" class="btn btn-primary" id="btnEditar" data-id="<?= $datos['id_productos'] ?>" data-bs-toggle="modal" data-bs-target="#modalEditarProducto" onclick="editarCliente(<?= $datos['id_productos'] ?>);">
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

  <script src="../assets/js/ProductosFuntion.js"></script>
</body>

</html>