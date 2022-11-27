<?php
require "includes/config/database.php";
$db = conectarDB();

session_start();

if (!$_SESSION['login']) {
    header("Login: /index.php");
}
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
// echo "<br>";

$NombreDeUsuario = $_SESSION['Nombre_de_Usuario'];

$consultaClientePotencial = "SELECT * FROM cliente_potencial WHERE Nombre_de_Usuario = '${NombreDeUsuario}';";
$query = mysqli_query($db, $consultaClientePotencial);
$resultadoClientePotencial = mysqli_fetch_assoc($query);
// echo "<pre>";
// var_dump($resultadoClientePotencial);
// echo "</pre>";
// echo "<br>";

$ID_CP = $resultadoClientePotencial['ID_CP'];
// echo $ID_CP;

$consultaCliente = "SELECT * FROM cliente WHERE ID_CP = '${ID_CP}';";
$query = mysqli_query($db, $consultaCliente);
$resultadoCliente = mysqli_fetch_assoc($query);
// echo "<pre>";
// var_dump($resultadoCliente);
// echo "</pre>";
// echo "<br>";



//FOR EACH
$IdDireccion = $resultadoCliente['IdDireccion'];

//Eventos


$IdCliente = $resultadoCliente['IdCliente'];

$_SESSION['ID_CP'] = $ID_CP;
$_SESSION['IdDireccion'] = $IdDireccion;
$_SESSION['IdCliente'] = $IdCliente;

$consultaEventosDireccion = "SELECT * FROM evento_tiene_direccion WHERE IdDireccion = ${IdDireccion};";
$query = mysqli_query($db, $consultaEventosDireccion);
$resultadoEventosDireccion = mysqli_fetch_assoc($query);

$_SESSION['IdEvento'] = $resultadoEventosDireccion['IdEvento'];


header("Location: /index.php");
