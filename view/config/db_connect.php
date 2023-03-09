<?php 

$servername = "localhost";
$usuario = "root";
$contraseña = "";
$dbname = "comprobantes";

// Creando conexión
$connect = new mysqli($servername, $usuario, $contraseña, $dbname);

// Chequeando conexión
if(!$connect->connect_error){
	echo "";
}else{
	die("Error: " . $connect->connect_error);
}

 ?>