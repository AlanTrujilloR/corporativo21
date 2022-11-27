<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location: /index.php");
}
require "includes/config/database.php";
$db = conectarDB();

$IdCatalogo = $_SESSION['IdCatalogo'];

$query = "SELECT * FROM catalogo_tiene_area WHERE IdCatalogo = ${IdCatalogo};";
$resultado = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $area = mysqli_real_escape_string($db, $_POST['area']);

    $_SESSION['IdArea'] = $area;
    header("Location: /suscripcionP4.php");
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
                <h4 class="formulario-texto">PASO 3</h4>
                <h4 class="elecc">TU ELECCIÓN</h4>
            </div>
            <p class="formulario-texto">
                Para completar el registro de sus suscripción seleccione el area mas proxima a su negocio
            </p>
            <div class="contenedor contenedor-formulario">
                <form class="formulario formulario-suscripciones" method="POST" action="suscripcionP3.php">
                    <div class="campo">
                        <label class="campo__label" for="area">Seleccione el Area:</label>
                        <select name="area" id="area" class="campo__field">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php while ($valores = mysqli_fetch_assoc($resultado)) : ?>
                                <?php
                                $IdArea = $valores['IdArea'];
                                $queryPaso = "SELECT * FROM area WHERE IdArea = ${IdArea};";
                                $resultadoA = mysqli_query($db, $queryPaso);
                                $valoresA = mysqli_fetch_assoc($resultadoA);
                                ?>
                                <option value="<?php echo $valoresA['IdArea']; ?>"><?php echo $valoresA['Nombre']; ?></option>
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