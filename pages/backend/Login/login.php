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
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Verificar el email y la contraseña
$sql = "SELECT * FROM Usuarios WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($contrasena, $user['Contrasena'])) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['user_id'] = $user['ID_Usuarios'];
        $_SESSION['user_name'] = $user['Nombre'];
        echo "<script>alert('Inicio de sesión exitoso.'); window.location.href='../../inicio.php';</script>";
    } else {
        echo "<script>alert('Contraseña incorrecta.'); window.location.href='../../login.html';</script>";
    }
} else {
    echo "<script>alert('No se encontró una cuenta con ese email.'); window.location.href='../../login.html';</script>";
}

$stmt->close();
$conn->close();
?>
