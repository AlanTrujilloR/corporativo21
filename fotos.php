<?php
require "includes/config/database.php";
$db = conectarDB();

$queryEvento = "SELECT * FROM evento;";
$rEvento = mysqli_query($db, $queryEvento);

$queryNegocio = "SELECT * FROM negocio;";
$rNegocio = mysqli_query($db, $queryNegocio);

require "includes/funciones.php";
incluirTemplate("header");
?>

<div class="contenedor">
    <main>
        <div class="fotos-contenedor">
            <div class="fotos-evento-titulo">
                <div class="seccionFooter__header">
                    <h2>Eventos</h2>
                </div>
                <div class="fotos-eventos">
                    <?php while ($valoresE = mysqli_fetch_assoc($rEvento)) : ?>
                        <div class="foto-evento">
                            <h3 class="foto-titulo"><?php echo $valoresE['Descripcion'] ?></h3>
                            <img class="galeria-foto" src="/imagenes/<?php echo $valoresE['Foto'] . ".jpg"; ?>" alt="Imagen Evento">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="fotos-evento-titulo">
                <div class="seccionFooter__header">
                    <h2>Negocios</h2>
                </div>
                <div class="fotos-negocio">
                    <?php while ($valoresN = mysqli_fetch_assoc($rNegocio)) : ?>
                        <div class="foto-evento">
                            <h3 class="foto-titulo"><?php echo $valoresN['NombreSuc'] ?></h3>
                            <img class="galeria-foto" src="/imagenes/<?php echo $valoresN['Logo'] . ".jpg"; ?>" alt="Imagen Logo">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </main>
</div>


<?php incluirTemplate("footer"); ?>