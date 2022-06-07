<?php

$host = "localhost";
$user = "root";
$pass = "159357Admin";
$dbname = "crudphp";
$port = 3306;

//Conexão com a porta
$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);

//Conexão sem a porta
//$conn = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);