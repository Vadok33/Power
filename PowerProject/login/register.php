<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // obtener los datos del formulario
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

// generar una cadena hash de la contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// guardar la cadena hash en la base de datos
$dsn = 'mysql:host=localhost;dbname=goyo';
$user = 'admin';
$pass = 'admin';
$pdo = new PDO($dsn, $user, $pass);
$stmt = $pdo->prepare('INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)');
$stmt->execute([$username, $hash, $email]);
}
?>
