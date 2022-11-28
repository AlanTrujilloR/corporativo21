<!-- Obtener el ultimo id -->
<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
  header("Location: /validacionLink.php");
}

require "includes/config/database.php";
$db = conectarDB();

//Consultar todas las areas
$query = "SELECT * FROM area";
$resultado = mysqli_query($db, $query);

//Consultar las direcciones del usuario
//forEach

$direccionR = $_SESSION['IdDireccion'];
$query2 = "SELECT IdDireccion, Calle FROM direccion WHERE IdDireccion = ${direccionR};";
$resultado2 = mysqli_query($db, $query2);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fecha = mysqli_real_escape_string($db, $_POST["fecha"]);
  list($Año, $Mes, $Dia) = explode('-', $fecha);
  $hora = mysqli_real_escape_string($db, $_POST["hora"]);
  $telefono = mysqli_real_escape_string($db, $_POST["telefonoCelular"]);
  $costo = mysqli_real_escape_string($db, $_POST["costo"]);
  $link = mysqli_real_escape_string($db, $_POST["link"]);
  $area = mysqli_real_escape_string($db, $_POST["area"]);
  $direccion = mysqli_real_escape_string($db, $_POST["direccion"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);

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
    $carpetaImagen = 'imagenes';

    if (!is_dir($carpetaImagen)) {
      mkdir($carpetaImagen);
    }

    //Define la extensión para el archivo

    if ($imagen['type'] === 'image/jpeg') {
      $exten = '.jpg';
    }

    // Generar nombre único ** Aquí fue donde encontré el problema
    $nombreImagen = md5(uniqid(rand(), true));

    // Subir imagen
    move_uploaded_file($imagen['tmp_name'], "$carpetaImagen/$nombreImagen$exten");
  }

  $ObtIdMax = "SELECT MAX(IdEvento) AS IdMax FROM evento;";
  $query = mysqli_query($db, $ObtIdMax);
  $propiedad = mysqli_fetch_assoc($query);
  $IdEvento = intval($propiedad['IdMax']);
  $IdEvento = $IdEvento + 1;

  $insEvento = "INSERT INTO evento (IdEvento, Descripcion, Foto, Telefono, link) VALUES ('$IdEvento','$descripcion','$nombreImagen','$telefono','$link');";
  $query = mysqli_query($db, $insEvento);
  if ($query) {
    $_SESSION['IdEvento'] = $IdEvento;
  }

  $insEventoArea = "INSERT INTO evento_tiene_area (IdEvento, IdArea) VALUES ('$IdEvento','$area');";
  $query1 = mysqli_query($db, $insEventoArea);

  $insEventoCosto = "INSERT INTO evento_tiene_costo (IdEvento, Costo) VALUES ('$IdEvento','$costo');";
  $query2 = mysqli_query($db, $insEventoCosto);

  $insEventoDireccion = "INSERT INTO evento_tiene_direccion (IdEvento, IdDireccion) VALUES ('$IdEvento','$direccion');";
  $query3 = mysqli_query($db, $insEventoDireccion);

  //insertar fechas
  $ObtIdMaxima = "SELECT MAX(IdFecha) AS IdMaxima FROM fecha;";
  $query4 = mysqli_query($db, $ObtIdMaxima);
  $propiedad = mysqli_fetch_assoc($query4);
  $IdFecha = intval($propiedad['IdMaxima']);
  $IdFecha = $IdFecha + 1;

  $insFecha = "INSERT INTO fecha (IdFecha, Dia, Mes, Año) VALUES ('$IdFecha','$Dia','$Mes','$Año');";
  $query5 = mysqli_query($db, $insFecha);

  $insEventoFecha = "INSERT INTO evento_tiene_fecha (IdEvento, IdFecha, Hora) VALUES ('$IdEvento','$IdFecha','$hora');";
  $query6 = mysqli_query($db, $insEventoFecha);



  $_SESSION['IdEvento'] = $IdEvento;
  header("Location: /suscribeNegocio.php");
}



require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="agregarEvento">
  <div class="seccionFooter__header">
    <h3>Eventos</h3>
  </div>
  <div class="contenedor contenedor-formulario">
    <?php foreach ($errores as $error) : ?>
      <div class="alerta error">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>
    <form class="formulario formulario-contacto" method="POST" enctype="multipart/form-data" action="/agregarEvento.php">
      <p class="formulario-texto">
        Ingresa la información correspondiente para su evento
      </p>
      <div class="campo">
        <label class="campo__label" for="fecha">*Fecha:</label>
        <input class="campo__field" type="date" placeholder="Ingresa la Fecha del Evento" id="fecha" name="fecha" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="hora">*Hora:</label>
        <input class="campo__field" type="time" placeholder="Ingresa la Hora del Evento" id="hora" name="hora" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="telefonoCelular">*Teléfono:</label>
        <input class="campo__field" type="tel" placeholder="Ingresa tu Teléfono" id="telefonoCelular" name="telefonoCelular" maxlength="10" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="costo">*Costo:</label>
        <input class="campo__field" type="number" placeholder="Ingresa el Costo" id="costo" name="costo" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="link">*Link:</label>
        <input class="campo__field" type="url" maxlength="40" placeholder="Ingresa el link de su evento" id="link" name="link" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="area">*Seleccione el Area:</label>
        <select class="campo__field" name="area" id="area">
          <option value="" selected disabled>--Seleccione--</option>
          <?php while ($valores = mysqli_fetch_assoc($resultado)) : ?>
            <option value="<?php echo $valores['IdArea']; ?>"><?php echo $valores['Nombre']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="campo">
        <label for="direccion" class="campo__label">*Seleccione la Direccion:</label>
        <select class="campo__field" name="direccion" id="direccion">
          <option value="" selected disabled>--Seleccione--</option>
          <?php while ($consultaD = mysqli_fetch_assoc($resultado2)) : ?>
            <option value="<?php echo $consultaD['IdDireccion']; ?>"><?php echo $consultaD['Calle']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="campo">
        <label class="campo__label" for="imagen">*Imagen:</label>
        <input class="campo__field" type="file" accept="image/jpeg" id="imagen" name="imagen" required />
      </div>
      <div class="campo">
        <label class="campo__label" for="descripcion">*Descripcion:</label>
        <textarea class="campo__field campo__field--textarea" maxlength="255" id="descripcion" name="descripcion" required></textarea>
      </div>

      <div class="campo campo-boton">
        <input type="submit" value="Enviar" class="boton boton__contacto" />
      </div>
    </form>
  </div>
</main>

<?php incluirTemplate("footer"); ?>