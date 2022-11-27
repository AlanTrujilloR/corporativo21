<?php
require "includes/funciones.php";
incluirTemplate("header");
?>

<div class="contenedor">
  <main class="validacionLink">
    <!-- Contenido principal -->
    <div class="validacion-link__texto">
      <h3 class="validacion-link__titulo_pag">
        ¡¡AVISO!!
      </h3>
      <p class="validacion-link__texto_aviso">
        Todavia no eres parte de <b>Corporativo 21</b>
      </p>
      <p class="validacion-link__texto_descrip">
        Unete a la gran comunidad que es <b>Corporativo 21</b>, y has que tu negocio o evento crezca con nuestros planes de publicidad.<br>
        ¡NO LO PIENSES MÁS!
      </p>

    </div>

    <div class="validacion-link__secciones">
      <a href="registro.php">
        <div class="validacion-link__seccion">
          <img src="build/img/candado.png">
          <h4 class="validacion-link__titulo">REGISTRATE AQUI</h4>
        </div>
      </a>
      <a href="inicioSesion.php">
        <div class="validacion-link__seccion">
          <img src="build/img/lapiz.png">
          <h4 class="validacion-link__titulo">INICIAR SESIÓN</h4>
      </a>
    </div>
  </main>
</div>

<?php incluirTemplate("footer"); ?>