<?php
require "includes/config/database.php";
$db = conectarDB();

$consulta = $_GET['catalogo'];

$query = "SELECT * FROM negocio_tiene_catalogo WHERE IdCatalogo =  ${consulta};";
$rConsulta = mysqli_query($db, $query);

$queryCat = "SELECT * FROM catalogo WHERE IdCatalogo = ${consulta};";
$rCat = mysqli_query($db, $queryCat);
$valCat = mysqli_fetch_assoc($rCat);

require "includes/funciones.php";
incluirTemplate("header");
?>

<div class="seccionFooter__header">
    <h3>Catalogo: <?php echo $valCat['Nombre']; ?></h3>
</div>
<main class="negocio-directorio contenedor">

    <?php while ($valores = mysqli_fetch_assoc($rConsulta)) : ?>
        <?php
        //Consultar los valores de la tabla Negocio
        $IdNegocio = $valores['IdNegocio'];
        $queryPaso = "SELECT * FROM negocio WHERE IdNegocio = ${IdNegocio};";
        $resultadoA = mysqli_query($db, $queryPaso);
        $valArea = mysqli_fetch_assoc($resultadoA);

        $queryPasoRedSocial = "SELECT * FROM negocio_tiene_red WHERE IdNegocio = ${IdNegocio};";
        $resultadoRS = mysqli_query($db, $queryPasoRedSocial);
        $valRedSocial = mysqli_fetch_assoc($resultadoRS);

        //Consultar los valores de la tabla Direccion
        $IdDireccion = $valArea['IdDireccion'];
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
        <div class="contenedor-directorio">
            <div class="catalogo-negocio">
                <!-- Mostrar los valores de Negocio y Direccion -->
                <div class="catalogo-sucursal">
                    <h2 class="catalogo-titulo"><?php echo $valArea['NombreSuc']; ?></h2>
                </div>
                <div class="catalogo-imagen-directorio">
                    <img class="catalogo-imagen" src="/imagenes/<?php echo $valArea['Logo'] . ".jpg"; ?>" alt="Imagen Logo">

                </div>
                <div class="catalogo-datosnegocio">
                    <h2 class="catalogo-titulo">Contacto: </h2>
                    <div class="datosnegocio-datos">
                        <h3 class="catalogo-titulomenor"><span>Telefono: </span> <?php echo $valArea['Telefono']; ?></h3>
                        <h3 class="catalogo-titulomenor"><span>Correo: </span> <?php echo $valArea['Correo']; ?></h3>
                        <h3 class="catalogo-titulomenor"><span>Red Social: </span><?php echo $valRedSocial['RedSocial']; ?></h3>
                    </div>
                </div>

                <div class="catalogo-direccion">
                    <h2 class="catalogo-titulo">Direccion: </h2>
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
                <div class="catalogo-descripcion">
                    <h2 class="catalogo-titulo">Descripicion: </h2>
                    <p class="catalogo-parrafo catalogo-parrafo-descripcion"><?php echo $valArea['Descripcion']; ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</main>


<?php incluirTemplate("footer"); ?>