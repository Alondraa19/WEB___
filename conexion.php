<?php
$host = "localhost";
$usuario = "root";
$clave = "";
$bd = "tienda"; // nombre correcto de la BD según tu captura

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}
?>
