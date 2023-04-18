<?php
// Conexión a la base de datos con PDO
$db = new PDO('mysql:host=localhost;dbname=power', 'admin', 'admin');

// Obtener el valor enviado por AJAX
$id = $_POST['id'];

// Preparar y ejecutar la consulta para eliminar el registro de la base de datos
$stmt = $db->prepare("DELETE FROM afiliados WHERE idafiliados = :id");
$stmt->execute([
  ':id' => $id
]);
?>
