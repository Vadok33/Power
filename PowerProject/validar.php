<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "goyo";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar si se ha establecido la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del formulario
$username = $_POST["username"];
$password = $_POST["password"];

// Comprobar si los datos son correctos
$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iniciar sesión
    session_start();
    $_SESSION["username"] = $username;

    // Redirigir al usuario a la página de inicio
    header("Location: inicio.php");
} else {
    // Si los datos no son correctos, volver al formulario de inicio de sesión
    header("Location: login.html");
}

$conn->close();
?>
