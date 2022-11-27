<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location: /index.php");
}
require "includes/config/database.php";
$db = conectarDB();

$IdArea = $_SESSION['IdArea'];

$query = "SELECT * FROM area_tiene_categoria WHERE IdArea = ${IdArea};";
$resultado = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoria = mysqli_real_escape_string($db, $_POST['categoria']);

    $_SESSION['IdCategoria'] = $categoria;
    header("Location: /suscripcionP5.php");
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
                <h4 class="formulario-texto">PASO 4</h4>
                <h4 class="elecc">TU ELECCIÓN</h4>
            </div>
            <p class="formulario-texto">
                Para completar el registro de sus suscripción seleccione la categoria mas proxima a su negocio
            </p>
            <div class="contenedor contenedor-formulario">
                <form class="formulario formulario-suscripciones" method="POST" action="suscripcionP4.php">
                    <div class="campo">
                        <label class="campo__label" for="categoria">Seleccione la Categoria:</label>
                        <select name="categoria" id="categoria" class="campo__field">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php while ($valores = mysqli_fetch_assoc($resultado)) : ?>
                                <?php
                                $IdCategoria = $valores['IdCategoria'];
                                $queryPaso = "SELECT * FROM categoria WHERE IdCategoria = ${IdCategoria};";
                                $resultadoA = mysqli_query($db, $queryPaso);
                                $valoresA = mysqli_fetch_assoc($resultadoA);
                                ?>
                                <option value="<?php echo $valoresA['IdCategoria']; ?>"><?php echo $valoresA['Nombre']; ?></option>
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