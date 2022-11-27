<?php
require "includes/funciones.php";
incluirTemplate('header', $inicio = false, $index = true)
?>

<img class="imagen" src="build/img/Presentación.png.webp" />
<br><br><br>
<main class="inicio-index">
  <!-- Aqui va el contenido principal -->
  <div class="contenedor contenedor-index">
    <div class="index_iniciar">
      <br><br>
      <h3 class="texto">
        <font color="#967e76" size="50px">Estas <b>a un paso</b> de dar a conocer tu negocio</font>
      </h3>
      <h4 class="texto">
        <font size="06px">NO LO PIENSES MÁS</font>
      </h4>
      <div class="index_boton">
        <br>
        <a href="inicioSesion.php"><input class="boton boton-index" type="submit" value="¡INICIAR!"></a><!-- Aqui se redireccionara al inicio de sesión -->
      </div>
    </div>

    <br><br><br>
    <div class="index_conocenos">
      <img class="img_conocenos" src="build/img/vision.png.webp" />
      <h2 class="in_presenta">Corporativo 21, donde revoluciona la forma de encontrar información<br> empresarial, social, cultural y de entretenimiento en Puebla</h2>
      <p class="in_descrip">Estamos convencidos de que debemos poner a Puebla a la vanguardia y para ello hay que hacer las cosas con pasión y excelencia.
        <br>Por ello nos proponemos a difundir la cultura de una forma innovadora entre los jóvenes fomentando un aprecio creciente por las actividades culturales.
      </p>
      <div class="index_boton_conocenos">
        <a href="acercaNosotros.php"><input class="boton boton-index" type="submit" value="CONOCENOS"></a><!-- Aqui se redireccionara a la página 'acerca de nostros' -->
      </div>
    </div>
  </div>
</main>

<?php incluirTemplate("footer"); ?>