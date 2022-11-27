<?php
if (!isset($_SESSION)) {
  session_start();
}

$auth = $_SESSION['login'] ?? false;

require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="blog">
  <!-- Contenido Principal -->
  <div class="seccionFooter__header">
    <h3>Suscribe tu negocio</h3>
  </div>

  <div class="contenedor">
    <div class="texto">
      <p class="texto_descrip">
        En <b>Corporativo 21</b> queremos ponernos en tu lugar.
        <b>Seguimos innovando para que a tu negocio le vaya mucho mejor!</b><br />
        Para que de esta forma, tus clientes puedan solicitarte de forma muy
        rápida:
      </p>
      <ul>
        <li type="circle">Cotizaciones</li>
        <li type="circle">Reservas</li>
        <li type="circle">Servicios y pedido a domicilio</li>
        <li type="circle">Agendas citas/servicio</li>
        <li type="circle">Consultas médicas</li>
      </ul>
      <p class="texto_descrip">
        Y mucho más!<br />
        Escoge el plan para dar de alta a tu negocio y puedas recibir estos y
        muchos beneficios más
      </p>
    </div>
  </div>
  <div class="secciones">
    <div class="seccion">
      <img src="build/img/Suscrip1.webp" />
      <h4 class="titulo">Sitio GO</h4>
      <h4 class="pago"><b>$99</b>/mes</h4>
      <div class="seccion_texto">
        <p>
          Suscripción mensual con un sitio de clase mundial para que te
          contacten con un solo clic.
        </p>
        <ul>
          <li type="disc">Banner mediano con tu logo</li>
          <li type="disc">Info breve de tu negocio</li>
          <li type="disc">Servicios y pedido a domicilio</li>
          <li type="disc">Botones de contacto</li>
          <li type="disc"><del>Horario de atencion</del></li>
          <li type="disc"><del>Blogs/fotos</del></li>
        </ul>
      </div>
      <div class="botones">
        <a href="<?php echo $auth ? 'suscripcionGo.php' : 'validacionLink.php'; ?>" class="enlace_contrato">INICIAR SUSCRIPCIÓN</a>
      </div>
    </div>
    <div class="seccion">
      <img src="build/img/Suscrip2.webp" />
      <h4 class="titulo">Sitio GO PLUS</h4>
      <h4 class="pago"><b>$290</b>/mes</h4>
      <div class="seccion_texto">
        <p>
          Suscripción mensual con un sitio de clase mundial para que te
          contacten con un solo clic.
        </p>
        <ul>
          <li type="disc">Banner mediano con tu logo</li>
          <li type="disc">Info breve de tu negocio</li>
          <li type="disc">Servicios y pedido a domicilio</li>
          <li type="disc">Botones de contacto</li>
          <li type="disc">Horario de atencion</li>
          <li type="disc">Blogs/fotos</li>
        </ul>
      </div>
      <div class="botones">
        <a href="<?php echo $auth ? 'suscripcionGoPlus.php' : 'validacionLink.php'; ?>" class="enlace_contrato">INICIAR SUSCRIPCIÓN</a>
      </div>
    </div>
    <div class="seccion">
      <img src="build/img/Suscrip2.webp" />
      <h4 class="titulo">Sitio a tu medida</h4>
      <h4 class="pago"></h4>
      <div class="seccion_texto">
        <p>
          Personalizamos una suscripción mensual que se ajuste a tu modelo de
          negocios de manera eficiente.
        </p>
        <ul>
          <li type="disc">Todo lo que inlcuye el SITIO GO PLUS</li>
          <li type="disc">Horario de atencion</li>
          <li type="disc">Mención en nuestras redes sociales</li>
          <li type="disc">Promociones</li>
          <li type="disc">Eventos</li>
        </ul>
        <br />
      </div>
      <div class="botones">
        <a href="contacto.php" class="enlace_contrato">QUIERO SER CONTACTADO</a>
      </div>
    </div>
  </div>
</main>
<div class="contenedor">
  <br>
  <p class="facilidades-texto">Estas son las facilidades que ofrecemos:</p>

  <ul class="listado-facilidades">
    <li>Facilidad 1: cuenta con 1 mes y genera una comisión del 0%</li>
    <li>Facilidad 2: cuenta con 3 meses y genera una comisión del 10%</li>
    <li>Facilidad 3: cuenta con 6 meses y genera una comisión del 20%</li>
    <li>Facilidad 4: cuenta con 12 meses y genera una comisión del 45%</li>
  </ul>
</div>
<div class="texto__promocion">
  <h3>¡Contrata y disfruta de los beneficios!</h3>
</div>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>