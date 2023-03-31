<?php
  // Conectarse a la base de datos con PDO
  $dsn = 'mysql:host=localhost;dbname=goyo';
  $usuario = "admin";
  $contrasena = "admin";
  $opciones = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );
  try {
    $conexion = new PDO($dsn, $usuario, $contrasena, $opciones);
  } catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
    die();
  }
  
  // Obtener valores enviados por AJAX
  $id = $_POST['id'];
  $column = $_POST['column'];
  $value = $_POST['value'];
  
  // Realizar consulta UPDATE en la base de datos
  $query = "UPDATE personas SET $column = :value WHERE id = :id";
  $stmt = $conexion->prepare($query);
  $stmt->bindParam(':value', $value);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
?>