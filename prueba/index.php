
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        $(document).ready(function() {
    //Agregar el evento onclick a cada celda editable
    $(".editable").on("blur", function() {
        var filaId = $(this).parent().attr("id");
        var columnaNombre = $(this).attr("class");

        //Enviar una solicitud a tu archivo PHP utilizando Ajax para actualizar los datos en la base de datos
        $.ajax({
            url: "actualizar.php",
            type: "POST",
            data: {
                filaId: filaId,
                columnaNombre: columnaNombre,
                nuevoValor: $(this).text()
            },
            success: function(data) {
                alert(data);
            }
        });
    });
});

    </script>
<table id="miTabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
    <?php
            //Conectarse a la base de datos y obtener los datos
            $dsn = "mysql:host=localhost;dbname=goyo";
            $usuario = "admin";
            $contraseña = "admin";

            try {
                $conexion = new PDO($dsn, $usuario, $contraseña);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $consulta = "SELECT * FROM personas";
            $resultado = $conexion->query($consulta);

            //Mostrar los datos en la tabla
            foreach ($resultado as $fila) {
                echo "<tr id='" . $fila['id'] . "'>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $fila['nombre'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $fila['apellido'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $fila['edad'] . "</td>";
                echo "<td class='editable' contenteditable='true'>" . $fila['fecha_nacimiento'] . "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

</body>
</html>




