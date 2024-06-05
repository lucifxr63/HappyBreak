<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña

// Verificar si el email ya existe
$sql = "SELECT * FROM Usuarios WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('El email ya está registrado.'); window.location.href='../../registro.html';</script>";
} else {
    // Insertar nuevo usuario
    $sql = "INSERT INTO Usuarios (Nombre, Usuario, Correo, Contrasena) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $usuario, $correo, $contrasena);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location.href='../../login.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
