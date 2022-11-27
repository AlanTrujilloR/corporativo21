<?php 
require "includes/config/database.php";
$db = conectarDB();

if($_SERVER["REQUEST_METHOD"] === "POST") {

  $nombreContacto = mysqli_real_escape_string( $db, $_POST["nombreContacto"] );
  $apellidoPaternoContacto = mysqli_real_escape_string( $db, $_POST["apellidoPaternoContacto"] );
  $apellidoMaternoContacto = mysqli_real_escape_string( $db, $_POST["apellidoMaternoContacto"] );
  $correoContacto = mysqli_real_escape_string( $db, $_POST["correoContacto"] );
  $asuntoContacto = mysqli_real_escape_string( $db, $_POST["asuntoContacto"] );
  
  $query = "INSERT INTO contacto (nombreContacto, apellidoPaternoContacto, apellidoMaternoContacto, correoContacto, asuntoContacto) VALUES ('$nombreContacto', '$apellidoPaternoContacto', '$apellidoMaternoContacto', '$correoContacto', '$asuntoContacto')";

  $resultado = mysqli_query($db, $query);

  if($resultado) {
    header("Location:/contacto.php");
  }
}

require "includes/funciones.php";
incluirTemplate("header"); 

?>

<main class="contacto">
  <div class="seccionFooter__header">
    <h3>Contacto</h3>
  </div>
  <div class="contenedor contenedor-formulario">
    <form class="formulario formulario-contacto" method="POST" action="/contacto.php">
      <p class="formulario-texto">
        Escríbenos y en breve nos pondremos en contacto contigo
      </p>
      <div class="campo">
        <label class="campo__label" for="nombreContacto">Nombre(s):</label>
        <input
          class="campo__field"
          type="text"
          placeholder="Ingresa tu Nombre"
          id="nombreContacto"
          name="nombreContacto"
          required
        />
      </div>
      <div class="campo">
        <label class="campo__label" for="apellidoPaternoContacto">Apellido Paterno:</label>
        <input
          class="campo__field"
          type="text"
          placeholder="Ingresa tu Apellido Paterno"
          id="apellidoPaternoContacto"
          name="apellidoPaternoContacto"
          required
        />
      </div>
      <div class="campo">
        <label class="campo__label" for="apellidoMaternoContacto">Apellido Materno:</label>
        <input
          class="campo__field"
          type="text"
          placeholder="Ingresa tu Apellido Materno"
          id="apellidoMaternoContacto"
          name="apellidoMaternoContacto"
          required
        />
      </div>
      <div class="campo">
        <label class="campo__label" for="correoContacto">Correo:</label>
        <input
          class="campo__field"
          type="email"
          placeholder="Ingresa tu Correo"
          id="correoContacto"
          name="correoContacto"
          required
        />
      </div>
      <div class="campo">
        <label class="campo__label" for="asuntoContacto">Asunto:</label>
        <textarea
          class="campo__field campo__field--textarea"
          id="asuntoContacto"
          name="asuntoContacto"
          required
        ></textarea>
      </div>

      <div class="campo campo-boton">
        <input type="submit" value="Enviar" class="boton boton__contacto" />
      </div>
    </form>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>
