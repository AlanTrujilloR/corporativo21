<?php
session_start();
require "includes/config/database.php";
$db = conectarDB();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $facilidad = $_POST['facilidad'];
    $metodoDePago = $_POST['metodoPago'];

    if ($facilidad == 1) {
        $Duracion = 1;
    } elseif ($facilidad == 2) {
        $Duracion = 3;
    } elseif ($facilidad == 3) {
        $Duracion = 6;
    } elseif ($facilidad == 4) {
        $Duracion = 12;
    }

    $SuscripcionAño = date('Y');
    $SuscripcionMes = date('m');
    $SuscripcionDia = date('d');

    $IdNegocio = $_SESSION['IdNegocio'];
    $IdCliente = $_SESSION['IdCliente'];
    $folio = rand(0, 1000);
    if (strcmp($_SESSION['suscripcion'], 'susGo')) {
        $IdPlan = 1;
    } else if (strcmp($_SESSION['suscripcion'], 'susPlus')) {
        $IdPlan = 2;
    }

    $query = "INSERT INTO contrato (IdNegocio, IdPlan, Id_Facilidad, IdCliente, Folio, Duracion, Dia, Mes, Año, ModoPago) VALUES ('$IdNegocio','$IdPlan','$facilidad','$IdCliente','$folio','$Duracion','$SuscripcionDia','$SuscripcionMes','$SuscripcionAño','$metodoDePago');";
    $rContrato = mysqli_query($db, $query);

    header("Location: /index.php");
}

require "includes/funciones.php";
incluirTemplate("header");
?>


<div class="seccionFooter__header">
    <h1>Facilidades</h1>
</div>
</br>


<main class="facilidades">
    <div class="contenedor">
        <p class="facilidades-texto">Estas son las facilidades que ofrecemos:</p>

        <ul class="listado-facilidades">
            <li>Facilidad 1: cuenta con 1 mes y genera una comisión del 0%</li>
            <li>Facilidad 2: cuenta con 3 meses y genera una comisión del 10%</li>
            <li>Facilidad 3: cuenta con 6 meses y genera una comisión del 20%</li>
            <li>Facilidad 4: cuenta con 12 meses y genera una comisión del 45%</li>
        </ul>
    </div>
</main>
<div class="seccionFooter__header">
    <h2>Eliga la facilidad que más le convenga</h2>
</div>
<div class="contenedor">
    <div class="contenedor-facilidades">
        <form class="formulario formulario-suscripciones" method="POST" action="facilidades.php">
            <h2>Facilidades</h2>
            <select name="facilidad" id="facilidad" class="select-facilidades" required>
                <option disabled selected value="">--- Selecciona ---</option>
                <option value="1"><a href="facilidad1.php">Facilidad 1</a></option>
                <option value="2"><a href="facilidad2.php">Facilidad 2</a></option>
                <option value="3"><a href="facilidad3.php">Facilidad 3</a></option>
                <option value="4"><a href="facilidad4.php">Facilidad 4</a></option>
            </select>
            <h2>Metodo de Pago</h2>
            <select name="metodoPago" id="metodoPago" class="select-facilidades" required>
                <option disabled selected value="">--- Selecciona ---</option>
                <option value="efectivo">Efectivo</option>
                <option value="credito">Tarjeta de Credito</option>
                <option value="debito">Tarjeta de Debito</option>
            </select>
            <div class="campo campo-boton">
                <input type="submit" value="Enviar" class="boton boton__contacto" />
            </div>
        </form>
    </div>

</div>


<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>