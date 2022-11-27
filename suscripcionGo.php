<?php
session_start();
require "includes/config/database.php";
$db = conectarDB();

$auth = $_SESSION['login'];
if (!$auth) {
  header("Location: /index.php");
}

$query = "SELECT * FROM categoria;";
$resultado = mysqli_query($db, $query);

$query2 = "SELECT * FROM giro;";
$resultado2 = mysqli_query($db, $query2);

$IdEvento = $_SESSION['IdEvento'];
$query3 = "SELECT * FROM evento WHERE IdEvento = ${IdEvento};";
$resultado3 = mysqli_query($db, $query3);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombreNegocio = mysqli_real_escape_string($db, $_POST['nombreNegocio']);
  $nombreSucursal = mysqli_real_escape_string($db, $_POST['nombreSucursal']);
  $longitud = mysqli_real_escape_string($db, $_POST['longitud']);
  $latitud = mysqli_real_escape_string($db, $_POST['latitud']);
  $RFC = mysqli_real_escape_string($db, $_POST['RFC']);
  $fechaInauguracion = mysqli_real_escape_string($db, $_POST['fechaInauguracion']);
  list($Año, $Mes, $Dia) = explode('-', $fechaInauguracion);
  $telefonoCelular = mysqli_real_escape_string($db, $_POST['telefonoCelular']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
  $sitioWeb = mysqli_real_escape_string($db, $_POST['sitioWeb']);
  $redesSociales = mysqli_real_escape_string($db, $_POST['redesSociales']);

  $ObtIdMax = "SELECT MAX(IdUbicacion) AS IdMax FROM Ubicacion;";
  $query1 = mysqli_query($db, $ObtIdMax);
  $propiedad = mysqli_fetch_assoc($query1);
  $IdUbicacion = intval($propiedad['IdMax']);
  $IdUbicacion = $IdUbicacion + 1;

  $query2 = "INSERT INTO Ubicacion (IdUbicacion, Longitud, Latitud) VALUES ('$IdUbicacion','$longitud','$latitud');";
  $rUbicacion = mysqli_query($db, $query2);

  $IdDireccion = $_SESSION['IdDireccion'];
  $IdCliente = $_SESSION['IdCliente'];

  $ObtIdMax = "SELECT MAX(IdNegocio) AS IdMax FROM negocio;";
  $query = mysqli_query($db, $ObtIdMax);
  $propiedad = mysqli_fetch_assoc($query);
  $IdNegocio = intval($propiedad['IdMax']);
  $IdNegocio = $IdNegocio + 1;
  $NumReg = rand(99, 999);


  //Asignar files hacia una variable
  $imagen = $_FILES['imagen'];

  if (!$imagen['name'] || $imagen['error']) {
    $errores[] = "La imagen es obligatoria";
  }
  //Validar por tamaño
  $medida = 1000 * 1000;

  if ($imagen['size'] > $medida) {
    $errores[] = 'La imagen excede el tamaño permitido';
  }

  if (empty($errores)) {
    //Subida de archivos

    //Crear una carpeta
    //Define la extensión para el archivo

    if ($imagen['type'] === 'image/jpeg') {
      $exten = '.jpg';
    }

    // Generar nombre único ** Aquí fue donde encontré el problema
    $nombreImagen = md5(uniqid(rand(), true));

    // Subir imagen
    move_uploaded_file($imagen['tmp_name'], "/imagenes/$nombreImagen$exten");
  }

  $queryRFC = "INSERT INTO RFC (RFC, Nombre) VALUES ('$RFC','$nombreNegocio');";
  $insRFC = mysqli_query($db, $queryRFC);

  $queryT = "INSERT INTO negocio (IdUbicacion,IdDireccion,IdCliente,IdNegocio,RFC,Logo,NumReg,Dia,Mes,Año,Telefono,Correo,Descripcion,SitioWeb,NombreSuc) VALUES ('$IdUbicacion','$IdDireccion','$IdCliente','$IdNegocio','$RFC','$nombreImagen','$NumReg','$Dia','$Mes','$Año','$telefonoCelular','$email','$descripcion','$sitioWeb','$nombreSucursal');";
  $insNegocio = mysqli_query($db, $queryT);

  //insertar los valores en la tabla de negocio realiza evento
  $query4 = "INSERT INTO negocio_realiza_evento (IdNegocio, IdEvento) VALUES ('$IdNegocio','$IdEvento');";
  $rNegocioEvento = mysqli_query($db, $query4);

  $query5 = "INSERT INTO negocio_tiene_red (IdNegocio, RedSocial) VALUES ('$IdNegocio','$redesSociales');";
  $rRed = mysqli_query($db, $query5);

  $_SESSION['suscripcion'] = "susGo";
  $_SESSION['IdNegocio'] = $IdNegocio;
  header("Location: /suscripcionP2.php");
}

require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="suscripcionGo">
  <div class="contenedor-suscripcion">
    <div class="cuadro">
      <br />
      <div class="cabecera">
        <h4 class="formulario-texto">Suscripción Go</h4>
        <h4 class="formulario-texto">PASO 1</h4>
        <h4 class="elecc">TU ELECCIÓN</h4>
      </div>
      <div class="cuadro_cont">
        <img class="logo-suscripciones" src="build/img/Logo_Pagina_Web_black_F.webp" />
        <h4 class="pag"><b>$99</b>/mes</h4>
        <h4 class="titulo">Sitio GO</h4>
        <img class="pago" src="build/img/Suscrip1.webp" />
      </div>

      <p class="formulario-texto">
        Para completar el registro de sus suscripción llene el siguiente
        formulario
      </p>

      <h4>DATOS</h4>
      <div class="contenedor contenedor-formulario">
        <form class="formulario formulario-suscripciones" method="POST" action="suscripcionGo.php" enctype="multipart/form-data">
          <div class="campo">
            <label class="campo__label" for="nombreNegocio">Nombre del Negocio:</label>
            <input class="campo__field" type="text" placeholder="Ingresa el Nombre del Negocio" id="nombreNegocio" name="nombreNegocio" value="<?php echo $nombreNegocio; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="nombreSucursal">Nombre de la Sucursal:</label>
            <input class="campo__field" type="text" placeholder="Ingresa el Nombre de la Sucursal" id="nombreSucursal" name="nombreSucursal" value="<?php echo $nombreSucursal; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="longitud">Longitud:</label>
            <input class="campo__field" type="number" placeholder="Ingresa la Longitud" id="longitud" name="longitud" value="<?php echo $longitud; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="latitud">Latitud:</label>
            <input class="campo__field" type="number" placeholder="Ingresa la Latitud" id="latitud" name="latitud" value="<?php echo $latitud; ?>" required />
          </div>
          <div class="campo">
            <label for="imagen" class="campo__label">Logo:</label>
            <input type="file" class="campo__field" id="imagen" name="imagen" accept="image/jpeg" />
          </div>
          <div class="campo">
            <label class="campo__label" for="RFC">RFC:</label>
            <input class="campo__field" type="text" placeholder="Ingresa tu RFC" id="RFC" name="RFC" value="<?php echo $RFC; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="fechaInauguracion">Fecha de Inauguracion:</label>
            <input class="campo__field" type="date" placeholder="Ingresa la Fecha de Inauguracion" id="fechaInauguracion" name="fechaInauguracion" value="<?php echo $fechaInauguracion; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="telefonoCelular">Telefono:</label>
            <input class="campo__field" type="tel" maxlength="10" placeholder="Ingresa el Telefono del Negocio" id="telefonoCelular" value="<?php echo $telefonoCelular; ?>" name="telefonoCelular" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="email">Email:</label>
            <input class="campo__field" type="email" placeholder="Ingresa el Email de tu Negocio" id="email" name="email" value="<?php echo $email; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="sitioWeb">Sitio Web:</label>
            <input class="campo__field" type="link" placeholder="Ingresa el link de tu Sitio Web" id="sitioWeb" value="<?php echo $sitioWeb; ?>" name="sitioWeb" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="redesSociales">Red Social:</label>
            <input class="campo__field" type="text" placeholder="Facebook: Ejemplo" id="redesSociales" name="redesSociales" value="<?php echo $redesSociales; ?>" required />
          </div>
          <div class="campo">
            <label class="campo__label" for="descripcion">Descripcion:</label>
            <textarea class="campo__field campo__field--textarea" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required></textarea>
          </div>

          <div class="campo campo-boton">
            <input type="submit" value="Continuar" class="boton boton__contacto" />
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>
