<?php
require "includes/config/database.php";
$db = conectarDB();

$consulta = $_GET['area'];

$queryEtA = "SELECT * FROM evento_tiene_area WHERE IdArea = ${consulta};";
$rEventosArea = mysqli_query($db, $queryEtA);

$queryAr = "SELECT * FROM area WHERE IdArea = ${consulta};";
$rArea = mysqli_query($db, $queryAr);
$valorA = mysqli_fetch_assoc($rArea);
require "includes/funciones.php";
incluirTemplate("header");
?>

<div class="seccionFooter__header">
    <h1>Eventos: <?php echo $valorA['Nombre']; ?></h1>
</div>
<div class="eventos-area">
    <main>
        <div class="contenedor contenedor-dirEvento">
            <?php while ($valorEtC = mysqli_fetch_assoc($rEventosArea)) : ?>
                <?php
                $IdEvento = $valorEtC['IdEvento'];
                $queryE = "SELECT * FROM evento WHERE IdEvento = ${IdEvento};";
                $rEvento = mysqli_query($db, $queryE);
                ?>
                <?php while ($valoresE = mysqli_fetch_assoc($rEvento)) : ?>
                    <?php
                    $queryEtC = "SELECT * FROM evento_tiene_costo WHERE IdEvento = ${IdEvento};";
                    $rEventosCosto = mysqli_query($db, $queryEtC);
                    $valoresEtC = mysqli_fetch_assoc($rEventosCosto);

                    $queryEtD = "SELECT * FROM evento_tiene_direccion WHERE IdEvento = ${IdEvento};";
                    $rEventosDireccion = mysqli_query($db, $queryEtD);
                    $valoresEtD = mysqli_fetch_assoc($rEventosDireccion);

                    $queryEtF = "SELECT * FROM evento_tiene_fecha WHERE IdEvento = ${IdEvento};";
                    $rEventosFecha = mysqli_query($db, $queryEtF);
                    $valoresEtF = mysqli_fetch_assoc($rEventosFecha);

                    $IdFecha = $valoresEtF['IdFecha'];

                    $queryF = "SELECT * FROM fecha WHERE IdFecha = ${IdFecha};";
                    $rFecha = mysqli_query($db, $queryF);
                    $valoresF = mysqli_fetch_assoc($rFecha);

                    //Guardar la Id Direccion
                    $IdDireccion = $valoresEtD['IdDireccion'];

                    $queryPasoDireccion = "SELECT * FROM direccion WHERE IdDireccion = ${IdDireccion};";
                    $resultadoD = mysqli_query($db, $queryPasoDireccion);
                    $valDireccion = mysqli_fetch_assoc($resultadoD);


                    //Consultar los valores de la tabla Codigo Postal
                    $CP = $valDireccion['CP'];
                    $queryPasoCP = "SELECT * FROM codigopostal WHERE CP = ${CP};";
                    $resultadoCP = mysqli_query($db, $queryPasoCP);
                    $valCP = mysqli_fetch_assoc($resultadoCP);


                    //Consultar los valores de la tabla Municipio
                    $Municipio = $valCP['Municipio'];
                    $queryPasoMunicipio = "SELECT * FROM municipio WHERE Municipio = '${Municipio}';";
                    $resultadoM = mysqli_query($db, $queryPasoMunicipio);
                    $valMunicipio = mysqli_fetch_assoc($resultadoM);
                    ?>
                    <div class="contenedor-evento">
                        <div class="titulo-evento">
                            <h3 class="catalogo-titulo"><?php echo $valoresE['Descripcion']; ?></h3>
                        </div>
                        <div class="imagen-evento">
                            <img class="imagenreal-evento" src="/imagenes/<?php echo $valoresE['Foto'] . ".jpg"; ?>" alt="Foto Negocio">
                        </div>
                        <div class="catalogo-direccion">
                            <h2 class="catalogo-titulo">Evento </h2>
                            <div class="catalogo-direccion-datos">
                                <p class="catalogo-parrafo"><span>Fecha: </span><?php echo $valoresF['Dia'] . "-" . $valoresF['Mes'] . "-" . $valoresF['Año']; ?></p>
                                <p class="catalogo-parrafo"><span>Hora: </span><?php echo $valoresEtF['Hora']; ?></p>
                                <p class="catalogo-parrafo"><span>Costo: </span><?php echo $valoresEtC['Costo']; ?></p>
                                <p class="catalogo-parrafo"><span>Telefono: </span><?php echo $valoresE['Telefono']; ?></p>
                                <a class="catalogo-parrafo" href="<?php echo $valoresE['link']; ?>"><?php echo $valoresE['link']; ?></a>
                            </div>
                        </div>
                        <div class="catalogo-direccion">
                            <h2 class="catalogo-titulo">Direccion </h2>
                            <div class="catalogo-direccion-datos">
                                <p class="catalogo-parrafo"><span>Calle:</span> <?php echo $valDireccion['Calle']; ?></p>
                                <p class="catalogo-parrafo"><span>Numero Exterior: </span><?php echo $valDireccion['Num_ext']; ?></p>
                                <?php if ($valDireccion['Num_int'] != NULL) : ?>
                                    <p class="catalogo-parrafo"><span>Numero Interior: </span><?php echo $valDireccion['Num_int']; ?></p>
                                <?php endif; ?>
                                <?php if ($valDireccion['Lote'] != NULL) : ?>
                                    <p class="catalogo-parrafo"><span>Lote: </span><?php echo $valDireccion['Lote']; ?></p>
                                <?php endif; ?>
                                <?php if ($valDireccion['Departamento'] != NULL) : ?>
                                    <p class="catalogo-parrafo"><span>Departamento: </span><?php echo $valDireccion['Departamento']; ?></p>
                                <?php endif; ?>
                                <?php if ($valDireccion['Piso'] != NULL) : ?>
                                    <p class="catalogo-parrafo"><span>Piso: </span><?php echo $valDireccion['Piso']; ?></p>
                                <?php endif; ?>
                                <?php if ($valDireccion['Asentamiento'] != NULL) : ?>
                                    <p class="catalogo-parrafo"><span>Asentamiento: </span><?php echo $valDireccion['Asentamiento']; ?></p>
                                <?php endif; ?>
                                <p class="catalogo-parrafo"><span>Codigo Postal:</span> <?php echo $valCP['CP']; ?></p>
                                <p class="catalogo-parrafo"><span>Municipio:</span> <?php echo $valCP['Municipio']; ?></p>
                                <p class="catalogo-parrafo"><span>Estado: </span> <?php echo $valMunicipio['Estado']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endwhile; ?>
        </div>
    </main>
</div>

<?php incluirTemplate("footer"); ?>