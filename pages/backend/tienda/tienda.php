<?php
header('Content-Type: application/json');

$servername = "127.0.0.1:3306";  // Dirección del servidor
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos (en blanco si no hay contraseña)
$dbname = "cafeteria";  // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
}

$response = array("status" => "success", "message" => "Conexión exitosa");
echo json_encode($response);

// Cerrar conexión
$conn->close();
?>
