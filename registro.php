<?php
require "includes/config/database.php";
$db = conectarDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $usuario = mysqli_real_escape_string($db, $_POST["usuario"]);

  // Consultar, convertir y sumar 1 a la IdUsuario
  $ObtenerIdMaxima = "SELECT MAX(idUsuario) AS idMaxima FROM Usuario_General;";
  $query = mysqli_query($db, $ObtenerIdMaxima);
  $propiedad = mysqli_fetch_assoc($query);
  $resultadoIdM = intval($propiedad['idMaxima']);
  $resultadoIdM = $resultadoIdM + 1;

  $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
  $apellidoPaterno = mysqli_real_escape_string($db, $_POST["apellidoPaterno"]);
  $apellidoMaterno = mysqli_real_escape_string($db, $_POST["apellidoMaterno"]);
  $fechaNacimiento = mysqli_real_escape_string($db, $_POST["fechaNacimiento"]);
  list($Año_nac, $Mes_nac, $Dia_nac) = explode('-', $fechaNacimiento);
  $telefonoCelular = mysqli_real_escape_string($db, $_POST["telefonoCelular"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $SuscripcionAño = date('Y');
  $SuscripcionMes = date('m');
  $SuscripcionDia = date('d');
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $sexo = $_POST["sexo"];

  $query1 = "INSERT INTO persona (Nombre_de_Usuario,celular,correo) VALUES ('$usuario','$telefonoCelular','$email')";
  $resultado1 = mysqli_query($db, $query1);

  if (!$resultado1) {
    exit;
  } else {
    $query2 = "INSERT INTO Usuario_General (Nombre_de_Usuario,idUsuario,Año_nac,Mes_nac,Dia_nac,ApellidoP,ApellidoN,Nombre,Años_sus,Mes_sus,Dia_sus,Contraseña,Sexo)
     VALUES ('$usuario','$resultadoIdM','$Año_nac','$Mes_nac','$Dia_nac','$apellidoPaterno','$apellidoMaterno','$nombre','$SuscripcionAño','$SuscripcionMes','$SuscripcionDia','$password','$sexo');";
    $resultado2 = mysqli_query($db, $query2);
    if (!$resultado2) {
      exit;
    } else {
      session_start();
      $_SESSION['Nombre_de_Usuario'] = $usuario;
      $_SESSION['login'] = true;
      var_dump($_SESSION);
      header("Location:/direccion.php");
    }
  }
}

require "includes/funciones.php";
incluirTemplate('header', $inicio = true)
?>

<main class="blog">
  <!-- Contenido Principal -->
  <form class="formulario-inicio contenedor" method="POST" action="registro.php">
    <h1 class="h1-inicio">Registrate</h1>
    <div class="contenedor">
      <div class="input-contenedor">
        <i class="fas fa-user icon"></i>
        <input class="input-inicio" type="text" placeholder="Nombre de usuario" name="usuario" />
      </div>

      <div class="input-contenedor">
        <i class="fas fa-user icon"></i>
        <input class="input-inicio" type="text" placeholder="Nombre(s)" name="nombre" />
      </div>

      <div class="input-contenedor">
        <i class="fas fa-user icon"></i>
        <input class="input-inicio" type="text" placeholder="Apellido Paterno" name="apellidoPaterno" />
      </div>
      <div class="input-contenedor">
        <i class="fas fa-user icon"></i>
        <input class="input-inicio" type="text" placeholder="Apellido Materno" name="apellidoMaterno" />
      </div>

      <div class="input-contenedor">
        <h4 class="h4-inicio" type="text">Fecha de nacimiento</h4>
        <input class="input-inicio" class="date" type="date" name="fechaNacimiento" />
      </div>

      <div class="input-contenedor">
        <i class="fa-sharp fa-solid fa-mobile-screen-button"></i>
        <input class="input-inicio" type="text" placeholder="Ingrese su numero de celular" name="telefonoCelular" maxlength="10" />
      </div>

      <div class="input-contenedor">
        <h4 class="h4-inicio" type="text">Genero</h4>
        <i class="fa-sharp fa-solid fa-restroom"></i>
        <select name="sexo" id="sexo" class="input-inicio">
          <option value="" disabled selected>--Selecciona--</option>
          <option value="0">Mujer</option>
          <option value="1">Hombre</option>
        </select>
      </div>

      <div class="input-contenedor">
        <i class="fas fa-envelope icon"></i>
        <input class="input-inicio" type="text" placeholder="Correo Electronico" name="email" />
      </div>

      <div class="input-contenedor">
        <i class="fas fa-key icon"></i>
        <input class="input-inicio" type="password" placeholder="Contraseña" name="password" />
      </div>
      <input type="submit" value="Registrate" class="button" />
      <p class="parrafo-registro">
        Al registrarte, aceptas nuestras Condiciones de uso y Política de
        privacidad.
      </p>
      <p class="parrafo-registro">
        ¿Ya tienes una cuenta?
        <a class="link" href="index.php">Iniciar Sesion</a>
      </p>
    </div>
  </form>
</main>

<?php incluirTemplate("footer"); ?>