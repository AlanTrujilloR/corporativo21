<?php

if (!isset($_SESSION)) {
  session_start();
}

$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Corporativo 21</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://kit.fontawesome.com/15c61725a7.js" crossorigin="anonymous"></script>

  <!-- prefetch -->
  <link rel="prefetch" href="index.php" as="document" />

  <!-- Referencia a archivos CSS -->
  <link rel="preload" href="/build/css/app.css" />
  <link rel="stylesheet" href="build/css/app.css" />
</head>

<body class="<?php echo $inicio ? "inicio-sesion" : ""; ?>">
  <header class=" <?php echo $index ? "inicio header" : "header"; ?>">
    <div class="header__barra">
      <!-- Logo -->
      <div class="barra__detalles">
        <div class="barra__imagen">
          <a href="index.php" class="logo__imagen">
            <img src="<?php echo $index ? "build/img/Logo_Pagina_Web_white_SF.webp" : "build/img/Logo_Pagina_Web_black_F.webp"; ?>" class="logo-principal" alt="logo" />
          </a>
        </div>
        <!-- Definimos nuestra barra de busqueda -->
        <div class="barra__busqueda">
          <input type="text" name="headerbusqueda" />
          <button class="boton">Buscar</button>
        </div>
        <!-- Creamos botones para el inicio -->

        <?php if (!$auth) : ?>
          <div class="barra__registro">
            <a class="boton" href="inicioSesion.php"> Iniciar Sesión </a>
            <a class="boton" href="registro.php">Registrarse</a>
          </div>
        <?php elseif ($auth) : ?>
          <div class="barra_cerrarSesion">
            <p><span>Bienvenido: </span><?php echo $_SESSION['Nombre_de_Usuario']; ?></p>
            <a class="boton-cerrarsesion" href="cerrar-sesion.php"> Cerrar Sesión </a>
          </div>
        <?php endif; ?>

      </div>

      <!-- Barra de navegación -->
      <nav class="navegacion__header">
        <div class="navegacion__principal">
          <a href="index.php" class="navegacion_enlace">Inicio</a>
          <a href="eventos.php" class="navegacion__enlace">Eventos</a>
          <a href="directorio.php" class="navegacion__enlace">Directorio</a>
          <a href="fotos.php" class="navegacion__enlace">Fotos</a>
          <a href="contacto.php" class="navegacion__enlace">Contacto</a>
        </div>
        <div class="navegacion__usuario">
          <a href="direccion.php" class="navegacion__enlase">Agregar direccion</a>
          <a href="suscribeNegocio.php" class="navegacion__enlace">Suscribe tu negocio</a>
          <a href="<?php echo $auth ? 'agregarEvento.php' : 'validacionLink.php'; ?>" class="navegacion__enlace">Agrega tu evento</a>
        </div>
      </nav>

      <?php if ($index) : ?>
        <div class="header__texto">
          <div class="header__texto-contenido">
            <h1>Corporativo 21</h1>
            <p>"tu mejor opción para promocionar tu negocio o evento"</p>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </header>