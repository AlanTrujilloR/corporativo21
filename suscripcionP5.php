<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location: /index.php");
}
require "includes/config/database.php";
$db = conectarDB();

$IdCategoria = $_SESSION['IdCategoria'];

$query = "SELECT * FROM categoria_tiene_giro WHERE IdCategoria = ${IdCategoria};";
$resultado = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IdNegocio = $_SESSION['IdNegocio'];

    //Paso 2
    $catalogo = $_SESSION['IdCatalogo'];
    $query = "INSERT INTO negocio_tiene_catalogo (IdNegocio, IdCatalogo) VALUES ('$IdNegocio','$catalogo');";
    $insCatalogo = mysqli_query($db, $query);

    //Paso 3
    $area = $_SESSION['IdArea'];
    $query = "INSERT INTO negocio_pertenece_area (IdNegocio, IdArea) VALUES ('$IdNegocio','$area');";
    $insEvento = mysqli_query($db, $query);

    //Paso 4
    $categoria = $_SESSION['IdCategoria'];
    $query = "INSERT INTO negocio_pertenece_categoria (IdNegocio, IdCategoria) VALUES ('$IdNegocio','$categoria');";
    $insEvento = mysqli_query($db, $query);

    //Paso 5
    $giro = mysqli_real_escape_string($db, $_POST['giro']);
    $IdNegocio = $_SESSION['IdNegocio'];
    $query = "INSERT INTO negocio_pertenece_giro (IdNegocio, IdGiro) VALUES ('$IdNegocio','$giro');";
    $insEvento = mysqli_query($db, $query);

    $_SESSION['IdGiro'] = $giro;
    header("Location: /facilidades.php");
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
                <h4 class="formulario-texto">PASO 5</h4>
                <h4 class="elecc">TU ELECCIÓN</h4>
            </div>
            <p class="formulario-texto">
                Para completar el registro de sus suscripción seleccione el giro mas proximo a su negocio
            </p>
            <div class="contenedor contenedor-formulario">
                <form class="formulario formulario-suscripciones" method="POST" action="suscripcionP5.php">
                    <div class="campo">
                        <label class="campo__label" for="giro">Seleccione el Giro:</label>
                        <select name="giro" id="giro" class="campo__field">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php while ($valores = mysqli_fetch_assoc($resultado)) : ?>
                                <?php
                                $IdGiro = $valores['IdGiro'];
                                $queryPaso = "SELECT * FROM giro WHERE IdGiro = ${IdGiro};";
                                $resultadoA = mysqli_query($db, $queryPaso);
                                $valoresA = mysqli_fetch_assoc($resultadoA);
                                ?>
                                <option value="<?php echo $valoresA['IdGiro']; ?>"><?php echo $valoresA['Nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="campo campo-boton">
                        <input type="submit" value="Ir al Pago" class="boton boton__contacto" />
                    </div>
                </form>
            </div>

        </div>


</main>

<?php incluirTemplate("footer"); ?>