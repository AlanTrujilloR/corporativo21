<?php
//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

//Autenticar el usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";

  $Nombre_de_Usuario = mysqli_real_escape_string($db, $_POST['Nombre_de_Usuario']);
  $password = mysqli_real_escape_string($db, $_POST['password']);



  if (!$Nombre_de_Usuario) {
    $errores[] = "El Nombre de Usuario es obligatorio o no es válido";
  }
  if (!$password) {
    $errores[] = "Debes de insertar una contraseña";
  }

  // echo "<pre>";
  // var_dump($errores);
  // echo "</pre>";

  if (empty($errores)) {
    $query = "SELECT * FROM Usuario_General WHERE Nombre_de_Usuario = '${Nombre_de_Usuario}'";
    $resultado = mysqli_query($db, $query);



    if ($resultado->num_rows) {
      //Revisar si el password es correcto
      $usuario = mysqli_fetch_assoc($resultado);
      // echo "<pre>";
      // var_dump($usuario);
      // echo "</pre>";
      if (strcmp($password, $usuario['password'])) {
        $auth = true;
      } else {
        $auth = false;
      }

      if ($auth) {
        //El Usuario esta autenticado
        session_start();

        //Llenar el arreglo de la sesion
        $_SESSION['Nombre_de_Usuario'] = $usuario['Nombre_de_Usuario'];
        $_SESSION['login'] = true;
        // echo "<pre>";
        // var_dump($_SESSION['usuario']);
        // echo "</pre>";
        header('Location: /login.php');
      } else {
        $errores[] = "El password es incorrecto";
      }
    } else {
      $errores[] = "El usuario no existe";
    }
  }
}


require "includes/funciones.php";
incluirTemplate('header', $inicio = true)
?>

<main class="iniciodesesion">
  <form class="formulario-inicio contenedor" method="POST" action="inicioSesion.php">
    <h1 class="h1-inicio">Inicio de sesión</h1>
    <?php foreach ($errores as $error) : ?>
      <div class="alerta error">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>
    <div class="contenedor">
      <div class="input-contenedor">
        <i class="fas fa-user icon"></i>
        <input class="input-inicio" type="text" placeholder="Nombre de Usuario" name="Nombre_de_Usuario" />
      </div>

      <div class="input-contenedor">
        <i class="fas fa-key icon"></i>
        <input class="input-inicio" type="password" placeholder="Contraseña" name="password" />
      </div>

      <input type="submit" value="Iniciar sesion" class="button" />
      <p class="parrafo-registro">
        ¿No tienes una cuenta?
        <a class="link" href="registro.php">Registrate </a>
      </p>
    </div>
  </form>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>