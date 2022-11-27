<?php 
require "includes/funciones.php";
incluirTemplate("header"); 
?>

<main class="blog">
  <div class="contenedor-seleccion-pago">
    <div class="tabla">
      <h2>Efectivo o cheque</h2>
      <img src="png/1.png" alt="" />
      <h3>Una forma segura y efectiva de pagar</h3>
      <li><a href="encuentro/encuentro.php" class="boton">Paga ahora</a></li>
    </div>
    <div class="tabla hover">
      <h2>Tarjeta de Credito</h2>
      <img src="png/2.png" alt="" />
      <h3>Una forma segura y rapida de pagar</h3>
      <li><a href="card/tarjeta.php" class="boton">Paga ahora</a></li>
    </div>
    <div class="tabla">
      <h2>Tarjeta de Debito</h2>
      <img src="png/3.png" alt="" />
      <h3>Una forma segura y rapida de pagar</h3>
      <a href="card/tarjeta.php" class="boton">Paga ahora</a>
    </div>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>
