<?php

$host = "localhost";
$user = "root";
$pass = "159357Admin";
$dbname = "crudphp";
$port = 3306;

//Conexão com a porta
try{

    $conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);

} catch (Exception $ex){
    echo "Erro: Conexão com banco de dados não realizada!";
}


//Conexão sem a porta
//$conn = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);