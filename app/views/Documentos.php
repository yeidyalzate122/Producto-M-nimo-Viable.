<?php
require_once('../controllers/DocumentosControllers.php');
$datoMostras = DocumentosControllers::getDatos();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
</head>
<body>

<?php
  include_once('./menu.php');
  ?>
    
    <div class="container">
      <h1 class="is-size-2">Documentos</h1>
   
      <br>
      <br>
      <label for="Buscar">Buscar</label>
      <input type="text" id="inputIdOrden"  placeholder="ID Orden">
      <input type="text" id="inputIdPedido" placeholder="ID Pedido">
      <button onclick="buscar()"  class="btn btn-primary">Buscar</button>
      <button onclick="imprimirTabla()"  class="btn btn-primary">Imprimir</button>
    </div>

    <div class="columns">
        <div class="column">


            <table class="table">
                <thead>
                    <tr>
                        <th>Pedidos</th>
                        <th>Orden</th>
                        <th>Fecha despacho</th>
                        <th>Direccion Entrega</th>
                        <th>Nombre del cliente</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">

                    <?php foreach ($datoMostras as $datos) : ?>
                        <tr>

                            <td><?= $datos['id_pedidos'] ?></td>
                            <td><?= $datos['id_orden'] ?></td>
                            <td><?= $datos['fecha_despacho'] ?></td>
                            <td><?= $datos['direccion_entrega'] ?></td>
                            <td><?= $datos['nombre_cliente'] ?></td>
                           

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

<script src="../assets/js/DocumentosFuntion.js"></script>
</body>
</html>l