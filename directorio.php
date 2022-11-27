<?php
require "includes/config/database.php";
$db = conectarDB();

$queryA = "SELECT * FROM area";
$rArea = mysqli_query($db, $queryA);

$queryC = "SELECT * FROM categoria";
$rCategoria = mysqli_query($db, $queryC);

require "includes/funciones.php";
incluirTemplate("header");
?>

<div class="seccionFooter__header">
    <h1>Directorio de los Negocios</h1>
</div>
</div>
<main>
    <div class="contenedor">
        <div class="directorio">
            <div class="directorio-catalogo">
                <h3 class="seccionFooter__header">Catalogo</h3>
                <ol>
                    <li><a href="<?php echo 'consultaCatalogo.php?catalogo=1'; ?>">Productos</a></li>
                    <li><a href="<?php echo 'consultaCatalogo.php?catalogo=2'; ?>">Servicios</a></li>
                </ol>
            </div>
            <div class="directorio-area">
                <h3 class="seccionFooter__header">Area</h3>
                <ol>
                    <?php while ($valoresA = mysqli_fetch_assoc($rArea)) : ?>
                        <li><a href="consultaArea.php?area=<?php echo $valoresA['IdArea']; ?>"><?php echo $valoresA['Nombre']; ?></a></li>
                    <?php endwhile; ?>
                </ol>
            </div>
            <div class="directorio-categoria">
                <h3 class="seccionFooter__header">Categoria</h3>
                <ol>
                    <?php while ($valoresC = mysqli_fetch_assoc($rCategoria)) : ?>
                        <li><a href="consultaCategoria.php?categoria=<?php echo $valoresC['IdCategoria']; ?>"><?php echo $valoresC['Nombre']; ?></a></li>
                    <?php endwhile; ?>
                </ol>
            </div>
        </div>


    </div>
</main>

<?php incluirTemplate("footer"); ?>