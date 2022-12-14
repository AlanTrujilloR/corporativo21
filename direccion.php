<?php
require "includes/config/database.php";
$db = conectarDB();
session_start();

$auth = $_SESSION['login'];
if (!$auth) {
  header("Location: /validacionLink.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Consultar, convertir y sumar 1 a la IdUsuario
  $ObtenerIdMaxima = "SELECT MAX(IdDireccion) AS idMaxima FROM direccion;";
  $query = mysqli_query($db, $ObtenerIdMaxima);
  $propiedad = mysqli_fetch_assoc($query);
  $resultadoIdM = intval($propiedad['idMaxima']);
  $resultadoIdM = $resultadoIdM + 1;

  //Guardar los resultados del formulario en variables
  $calle = mysqli_real_escape_string($db, $_POST["calle"]);                 //
  $piso = mysqli_real_escape_string($db, $_POST["piso"]);
  if ($piso == '') {
    $piso = 'NULL';
  }
  $codigoPostal = mysqli_real_escape_string($db, $_POST["codigoPostal"]);   //
  $municipio = mysqli_real_escape_string($db, $_POST["municipio"]);
  $numeroInterno = mysqli_real_escape_string($db, $_POST["numeroInterno"]); //
  if ($numeroInterno == '') {
    $numeroInterno = 'NULL';
  }
  $numeroExterno = mysqli_real_escape_string($db, $_POST["numeroExterno"]); //
  $lote = mysqli_real_escape_string($db, $_POST["lote"]);                   //
  $asentamiento = mysqli_real_escape_string($db, $_POST["asentamiento"]);   //
  $estado = mysqli_real_escape_string($db, $_POST["estado"]);               //
  $departamento = mysqli_real_escape_string($db, $_POST["departamento"]);   //
  $pais = mysqli_real_escape_string($db, $_POST["pais"]);                   //
  $solicitud = mysqli_real_escape_string($db, $_POST["solicitud"]);                   //


  //Final?
  //Consultar si el estado existe
  $consultaEstado = "SELECT * FROM estado WHERE Estado = '${estado}';";
  $resultadoCEstado = mysqli_query($db, $consultaEstado);
  //Si no existe, insertarlo en la tabla estado
  if (!$resultadoCEstado->num_rows) {
    $query1 = "INSERT INTO estado (Estado, Pais) VALUES ('$estado', '$pais');";
    $resultado1 = mysqli_query($db, $query1);
  }


  //Consultar si municipio existe
  $consultaMunicipio = "SELECT * FROM municipio WHERE municipio = '${municipio}';";
  $resultadoCMunicipio = mysqli_query($db, $consultaMunicipio);
  //Si no existe, insertar en la tabla
  if (!$resultadoCMunicipio->num_rows) {
    $query2 = "INSERT INTO municipio(Municipio, Estado) VALUES ('$municipio','$estado');";
    $resultado2 = mysqli_query($db, $query2);
  }

  //Consultar si el codigo postal ya existe
  $consultaCCP = "SELECT * FROM codigopostal WHERE CP = '${codigoPostal}';";
  $resultadoCCP = mysqli_query($db, $consultaCCP);
  //Si no existe, insertar en la tabla codigo postal
  if (!$resultadoCCP->num_rows) {
    $query3 = "INSERT INTO codigopostal(CP, Municipio) VALUES ('$codigoPostal','$municipio');";
    $resultado3 = mysqli_query($db, $query3);
  }


  //Insertar datos a la tabla direccion
  $query4 = "INSERT INTO direccion (IdDireccion,CP,Calle, Num_ext, Lote, Num_int, Departamento, Piso, Asentamiento) VALUES ('$resultadoIdM','$codigoPostal','$calle', '$numeroExterno', '$lote', $numeroInterno, '$departamento', $piso, '$asentamiento');";
  $resultado4 = mysqli_query($db, $query4);

  //Obtener la id Maxima de la tabla Cliente Potencial
  $ObtenerIdMax = "SELECT MAX(ID_CP) AS idMax FROM cliente_potencial;";
  $query = mysqli_query($db, $ObtenerIdMax);
  $propiedad = mysqli_fetch_assoc($query);
  $ID_CP = intval($propiedad['idMax']);
  $ID_CP = $ID_CP + 1;

  //Guardar el nombre de usuario en una variable
  $NombreDeUsuario = $_SESSION['Nombre_de_Usuario'];

  //Revisar si exite el cliente potencial
  $consultaCClienteP = "SELECT * FROM cliente_potencial WHERE Nombre_de_Usuario = '${NombreDeUsuario}';";
  $resultadoConsultaClienteP = mysqli_query($db, $consultaCClienteP);
  //Si no existe, guardarlo en la tabla
  if (!$resultadoConsultaClienteP->num_rows) {
    //Insertar los datos de cliente potencial en la tabla
    $query5 = "INSERT INTO cliente_potencial (Nombre_de_Usuario,ID_CP,Solicitud) VALUES ('$NombreDeUsuario','$ID_CP','$solicitud');";
    $resultado5 = mysqli_query($db, $query5);
  }



  //Consultar los datos del Usuario de la tabla Usuario_General
  $ConsultaUsGeneral = "SELECT * FROM Usuario_General WHERE Nombre_de_Usuario = '${NombreDeUsuario}';";
  $query = mysqli_query($db, $ConsultaUsGeneral);
  $ResultadoUSGeneral = mysqli_fetch_assoc($query);

  //Guardar los datos consultados en una variable
  $nombre = $ResultadoUSGeneral['Nombre'];
  $apellidoPaterno = $ResultadoUSGeneral['ApellidoP'];
  $apellidoMaterno = $ResultadoUSGeneral['ApellidoN'];
  $contrase??a = $ResultadoUSGeneral['Contrase??a'];
  $dia =  $ResultadoUSGeneral['Dia_nac'];
  $mes =  $ResultadoUSGeneral['Mes_nac'];
  $a??o =  $ResultadoUSGeneral['A??o_nac'];

  //Obtener la ID Maxima de Cliente
  $ObtIdMax = "SELECT MAX(IdCliente) AS IdMax FROM cliente;";
  $query = mysqli_query($db, $ObtIdMax);
  $propiedad = mysqli_fetch_assoc($query);
  $IdCliente = intval($propiedad['IdMax']);
  $IdCliente = $IdCliente + 1;

  //Consultar la id del Cliente_Potencial
  $NombreDeUsuario = $_SESSION['Nombre_de_Usuario'];

  $consultaCClienteP = "SELECT * FROM cliente_potencial WHERE Nombre_de_Usuario = '${NombreDeUsuario}';";
  $resultadoConsultaClienteP = mysqli_query($db, $consultaCClienteP);
  $resultadoIdCP = mysqli_fetch_assoc($resultadoConsultaClienteP);

  $idClienteP = $resultadoIdCP['ID_CP'];

  //Insertar los datos en la tabla cliente

  $consultaCCliente = "SELECT * FROM cliente WHERE ID_CP = '${idClienteP}';";
  $resultadoConsultaCliente = mysqli_query($db, $consultaCCliente);
  //Si no existe, guardarlo en la tabla
  if (!$resultadoConsultaCliente->num_rows) {
    //Insertar los datos de cliente potencial en la tabla
    $query7 = "INSERT INTO cliente (ID_CP, IdDireccion, IdCliente, Nombre, ApellidoPaterno, ApellidoMaterno, Contrase??a, Dia, Mes, A??o) VALUES ('$idClienteP','$resultadoIdM','$IdCliente','$nombre','$apellidoPaterno','$apellidoMaterno','$contrase??a','$dia','$mes','$a??o');";
    $resultado7 = mysqli_query($db, $query7);
  }


  $_SESSION['IdDireccion'] = $resultadoIdM;
  $_SESSION['ID_CP'] = $ID_CP;
  $_SESSION['IdCliente'] = $IdCliente;
  header("Location: /agregarEvento.php");
}


require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="direccion">
  <div class="seccionFooter__header">
    <h3>Direcci??n</h3>
  </div>
  <div class="contenedor contenedor-formulario">
    <form class="formulario formulario-contacto" method="POST" action="/direccion.php">

      <p class="formulario-texto">
        Ingresa la direcci??n de tu negocio
      </p>
      <div class="campo">
        <label class="campo__label" for="calle">*Calle:</label>
        <input class="campo__field" type="text" placeholder="Ingresa la Calle" id="calle" maxlength="40" name="calle" required value="<?php echo $calle; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="piso">Piso:</label>
        <input class="campo__field" type="number" placeholder="Ingresa el Piso" id="piso" name="piso" value="<?php echo $piso; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="codigoPostal">*C??digo Postal:</label>
        <input class="campo__field" type="number" placeholder="Ingresa el C??digo Postal" id="codigoPostal" name="codigoPostal" required value="<?php echo $codigoPostal; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="municipio">*Municipio:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Municipio" id="municipio" maxlength="20" name="municipio" required value="<?php echo $municipio; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="numeroInterno">N??mero Interno:</label>
        <input class="campo__field" type="number" placeholder="Ingresa el N??mero Interno" id="numeroInterno" name="numeroInterno" value="<?php echo $numeroInterno; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="numeroExterno">*N??mero Externo:</label>
        <input class="campo__field" type="number" placeholder="Ingresa el N??mero Externo" id="numeroExterno" name="numeroExterno" required value="<?php echo $numeroExterno; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="lote">Lote:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Lote" id="lote" maxlength="20" name="lote" value="<?php echo $lote; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="asentamiento">Asentamiento:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Asentamiento" id="asentamiento" maxlength="50" name="asentamiento" value="<?php echo $asentamiento; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="estado">*Estado:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Estado" id="estado" name="estado" maxlength="20" required value="<?php echo $estado; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="departamento">Departamento:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Departamento" id="departamento" maxlength="3" name="departamento" value="<?php echo $departamento; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="pais">*Pa??s:</label>
        <input class="campo__field" type="text" placeholder="Ingresa el Pa??s" id="pais" name="pais" maxlength="20" required value="<?php echo $pais; ?>" />
      </div>
      <div class="campo">
        <label class="campo__label" for="solicitud">*Solicitud:</label>
        <textarea placeholder="Ejemplo: Deseo promocionar mi negocio de articulos deportivos" maxlength="299" class="campo__field campo__field--textarea" id="solicitud" name="solicitud" required></textarea>
      </div>

      <div class="campo campo-boton">
        <input type="submit" value="Enviar" class="boton boton__contacto" />
      </div>
    </form>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>