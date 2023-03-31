<!DOCTYPE html>
<html>
  <head>
    <title>Ejemplo de tabla de personas con eliminación segura y detalles desplegables</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        $(".delete-button").click(function() {
          if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            var id = $(this).data("id");
            $.ajax({
              url: "eliminar_persona.php",
              type: "POST",
              data: {id: id},
              success: function() {
                location.reload();
              }
            });
          }
        });
        
        $(".toggle-details-button").click(function() {
          var detailsRow = $(this).closest("tr").next(".details-row");
          if (detailsRow.is(":visible")) {
            detailsRow.hide();
            $(this).html("&#9660;");
          } else {
            detailsRow.show();
            $(this).html("&#9650;");
          }
        });
        $(document).on("blur", ".editable", function() {
  var id = $(this).data("id");
  var column = $(this).data("column");
  var value = $(this).text();
  $.ajax({
    url: "actualizar_persona.php",
    type: "POST",
    data: {id: id, column: column, value: value},
    success: function() {
      location.reload();
    }
  });
});
$("#toggle-editable-button").click(function() {
  $(".editable").each(function() {
    if ($(this).attr("contenteditable") == "true") {
      $(this).attr("contenteditable", "false");
    } else {
      $(this).attr("contenteditable", "true");
    }
  });
});
      });
    </script>
    <style>
      table {
        border-collapse: collapse;
      }
      th, td {
        padding: 10px;
        border: 1px solid black;
      }
      .details-cell {
        padding: 0;
      }
      .details-row {
        display: none;
      }
      .delete-button {
        color: red;
        cursor: pointer;
      }
      .toggle-details-button {
        cursor: pointer;
      }
    </style>
  </head>
  <body>
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
      
      // Obtener datos de la tabla personas
      $query = "SELECT id, nombre, apellido, edad, fecha_nacimiento FROM personas";
      $stmt = $conexion->query($query);
      $personas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <button id="toggle-editable-button">Habilitar/Deshabilitar modificaciones</button>
    <table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Edad</th>
      <th>Fecha de nacimiento</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($personas as $persona): ?>
    <tr>
      <td><?php echo $persona['id']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['id']; ?>" data-column="nombre"><?php echo $persona['nombre']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['id']; ?>" data-column="apellido"><?php echo $persona['apellido']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['id']; ?>" data-column="edad"><?php echo $persona['edad']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['id']; ?>" data-column="fecha_nacimiento"><?php echo $persona['fecha_nacimiento']; ?></td>
      <td>
        <span class="delete-button" data-id="<?php echo $persona['id']; ?>">Eliminar</span>
        <span class="toggle-details-button">▼</span>
      </td>
    </tr>
    <tr class="details-row">
      <td colspan="5" class="details-cell">
        Detalles de <?php echo $persona['nombre'] . ' ' . $persona['apellido']; ?>:
        <ul>
          <li>ID: <?php echo $persona['id']; ?></li>
          <li>Nombre: <?php echo $persona['nombre']; ?></li>
          <li>Apellido: <?php echo $persona['apellido']; ?></li>
          <li>Edad: <?php echo $persona['edad']; ?></li>
          <li>Fecha nacimiento: <?php echo $persona['fecha_nacimiento']; ?></li>
        </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
        
          </body>
        </html>
