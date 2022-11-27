<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location: /index.php");
}
require "includes/config/database.php";
$db = conectarDB();

$query = "SELECT * FROM catalogo;";
$resultado = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $catalogo = mysqli_real_escape_string($db, $_POST['catalogo']);

    $_SESSION['IdCatalogo'] = $catalogo;
    header("Location: /suscripcionP3.php");
}

require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="suscripcionGo">
    <div class="contenedor">
        <div class="cuadro">
            <br />
            <div class="cabecera">
                <h4 class="formulario-texto">Suscripción Go</h4>
                <h4 class="formulario-texto">PASO 2</h4>
                <h4 class="elecc">TU ELECCIÓN</h4>
            </div>
            <p class="formulario-texto">
                Para completar el registro de sus suscripción seleccione si es un producto o servicio
            </p>
            <div class="contenedor contenedor-formulario">
                <form class="formulario formulario-suscripciones" method="POST" action="suscripcionP2.php">
                    <div class="campo">
                        <label class="campo__label" for="catalogo">Seleccione el catalogo:</label>
                        <select name="catalogo" id="catalogo" class="campo__field">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php while ($valores = mysqli_fetch_assoc($resultado)) : ?>
                                <option value="<?php echo $valores['IdCatalogo']; ?>"><?php echo $valores['Nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="campo campo-boton">
                        <input type="submit" value="Continuar" class="boton boton__contacto" />
                    </div>
                </form>
            </div>

        </div>


</main>

<?php incluirTemplate("footer"); ?>