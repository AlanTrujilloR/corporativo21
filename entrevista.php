<?php 
require "includes/funciones.php";
incluirTemplate("header"); 
?>

<main class="entrevista">
  <div class="seccionFooter__header">
    <h3>Entrevista</h3>
  </div>
  <div class="contenedor">
    <form class="formulario">
      <p class="formulario-texto">¡Programa tu entrevista!</p>

      <div class="campo">
        <label class="campo__label" for="asunto">Asunto</label>
        <textarea
          class="campo__field campo__field--textarea"
          name="asunto"
          id="asunto"
          required
        ></textarea>
      </div>
      <div class="campo">
        <label class="campo__label" for="fecha">Fecha</label>
        <input
          class="campo__field"
          type="date"
          name="fecha"
          id="fecha"
          required
        />
      </div>

      <div class="campo campo-boton">
        <input type="submit" value="Enviar" class="boton boton__contacto" />
      </div>
    </form>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>
