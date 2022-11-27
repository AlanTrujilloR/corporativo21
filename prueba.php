<?php
session_start();

require "includes/config/database.php";
$db = conectarDB();

$NombreDeUsuario = $_SESSION['Nombre_de_Usuario'];

$IdCliente = 1;

$direccionR = $_SESSION['idDireccion'];
$query2 = "SELECT * FROM direccion WHERE IdDireccion = ${direccionR};";
$resultado2 =  mysqli_query($db, $query2);

echo "<pre>";
var_dump($resultado2);
echo "</pre>";

$consultaDireccion = mysqli_fetch_assoc($resultado2);
echo "<pre>";
var_dump($consultaDireccion);
echo "</pre>";
