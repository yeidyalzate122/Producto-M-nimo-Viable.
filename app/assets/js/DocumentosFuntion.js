function buscar() {
    var inputIdOrden = document.getElementById('inputIdOrden').value;
    var inputIdPedido = document.getElementById('inputIdPedido').value;
  
    // Filtra las filas de la tabla según el ID de la orden y el ID del pedido
    var filas = document.getElementById('cuerpoTabla').getElementsByTagName('tr');
    for (var i = 0; i < filas.length; i++) {
      var celdas = filas[i].getElementsByTagName('td');
      var idOrden = celdas[1].textContent; // Índice 1 es la columna del código de la orden
      var idPedido = celdas[0].textContent; // Índice 0 es la columna del código del pedido
  
      // Oculta la fila si no coincide con la búsqueda
      if (idOrden.includes(inputIdOrden) && idPedido.includes(inputIdPedido)) {
        filas[i].style.display = '';
      } else {
        filas[i].style.display = 'none';
      }
    }
  }


  function imprimirTabla() {
    window.print();
}