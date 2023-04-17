<?php
// Conexión a la base de datos con PDO
$db = new PDO('mysql:host=localhost;dbname=power', 'admin', 'admin');

// Obtener los valores enviados por AJAX
$id = $_POST['id'];
$column = $_POST['column'];
$value = $_POST['value'];

// Preparar y ejecutar la consulta para actualizar el registro en la base de datos
$stmt = $db->prepare("UPDATE afiliados SET $column = :value WHERE idafiliados = :id");
$stmt->execute([
  ':value' => $value,
  ':id' => $id
]);
?>
