<?php
// Conexión a la base de datos utilizando PDO
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "goyo";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Obtener el ID de la persona a eliminar
  $persona_id = $_POST['id'];

  // Eliminar la persona de la base de datos
  $stmt = $conn->prepare("DELETE FROM personas WHERE id = :id");
  $stmt->bindParam(':id', $persona_id);
  $stmt->execute();

  // Redirigir al usuario de vuelta a la página principal
  header("Location: index.php");
  exit();

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>