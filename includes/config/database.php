<?php

function conectarDB(): mysqli
{
    $dbhost = 'remotemysql.com';
    $dbuser = 'oSZVC1bM5b';
    $dbpass = 'su0J44GnMS';
    $dbname = 'oSZVC1bM5b';


    $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$db) {
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}
