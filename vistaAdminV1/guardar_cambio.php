<?php
    //Conectarse a la base de datos utilizando PDO
    $servidor = "localhost";
    $usuario = "admin";
    $contrasena = "admin";
    $basededatos = "goyo";

    $dsn = "mysql:host=$servidor;dbname=$basededatos;charset=UTF8";
    $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $conexion = new PDO($dsn, $usuario, $contrasena, $opciones);
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
        exit;
    }

    //Obtener los datos enviados por Ajax
    $filaId = $_POST['filaId'];
    $columnaNombre = $_POST['columnaNombre'];
    $nuevoValor = $_POST['nuevoValor'];

    //Actualizar los valores correspondientes en la base de datos utilizando PDO
    $consulta = "UPDATE personas SET $columnaNombre=:nuevoValor WHERE id=:filaId";
    $statement = $conexion->prepare($consulta);

    $statement->bindParam(':nuevoValor', $nuevoValor, PDO::PARAM_STR);
    $statement->bindParam(':filaId', $filaId, PDO::PARAM_INT);

    try {
        $statement->execute();
        echo "Datos actualizados correctamente";
    } catch (PDOException $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
    }

    //Cerrar la conexión a la base de datos
    $conexion = null;
?>