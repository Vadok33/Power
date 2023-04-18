<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- DataTable -->
    <title>Administrador</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
           // Eliminar registro
           $(document).on('click', '.delete-button', function() {
  var id = $(this).data('id');

  $.ajax({
    url: 'delete.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(response) {
      //Refrescar pagina
      location.reload();
      // Aquí puedes manejar la respuesta del servidor
      alert('Registro eliminado con éxito');
    }
  });
});

  // Actualizar registro
  $(document).on('blur', '.editable', function() {
  var id = $(this).data('id');
  var column = $(this).data('column');
  var value = $(this).text();

  $.ajax({
    url: 'update.php',
    type: 'POST',
    data: {
      id: id,
      column: column,
      value: value
    },
    success: function(response) {
      //Refrescar pagina
      location.reload();
      // Aquí puedes manejar la respuesta del servidor
      alert('Registro actualizado con éxito');
    }
  });
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
    $dsn = 'mysql:host=localhost;dbname=power';
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
    $query = "SELECT * FROM afiliados";
    $stmt = $conexion->query($query);
    $personas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  
     <!--Logo-->
    <div class="container text-center mt-3 mb-3">
        <a href="https://powerhispania.net/"><img src="../cropped-logo-AEP.png" alt="logo" width="300px" ></a>
    </div>
    <!--Navbar Bootstrap-->
    <nav class="navbar navbar-expand-md navbar-dark"style="background-color: black">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="https://powerhispania.net/">INICIO</a>
            <a class="navbar-brand" href="https://powerhispania.net/antidopaje/">ANTIDOPAJE</a>
            <a class="navbar-brand" href="https://powerhispania.net/noticias/">NOTICIAS</a>
            <a class="navbar-brand" href="indexadmin.php">ADMINISTRAR</a>
            <a class="navbar-brand" href="../altaClub/indexaltaclub.html">ALTA CLUB</a>
        </div>
    </nav>

<button id="toggle-editable-button" class="btn btn-outline-dark btn-lg text-uppercase mt-3 ml-3">Habilitar/Deshabilitar modificaciones</button>



    <div class="container my-4">
        <div class="row">
            <h1>REVISION AFILIADOS</h1>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table id="datatable_users" class="table table-striped" >
                    
                    <thead style="background-color: black; color:white">
                        <tr>
                            <th class="centered">ID</th>
                            <th class="centered">Nombre</th>
                            <th class="centered">Apellido 1</th>
                            <th class="centered">DNI</th>
                            <th class="centered">F.Nacimiento</th>
                            <th class="centered">Sexo</th>
                            <th class="centered">Licencia</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_users">

                    <?php foreach ($personas as $persona): ?>
    <tr>
      <td><?php echo $persona['idafiliados']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="NombreAtleta"><?php echo $persona['NombreAtleta']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="ApellidosAtleta"><?php echo $persona['ApellidosAtleta']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="DNI"><?php echo $persona['DNI']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="FechaNac"><?php echo $persona['FechaNac']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="Sexo"><?php echo $persona['Sexo']; ?></td>
      <td contenteditable="false" class="editable" data-id="<?php echo $persona['idafiliados']; ?>" data-column="Licencia"><?php echo $persona['Licencia']; ?></td>
      <td>
        <span class="delete-button" data-id="<?php echo $persona['idafiliados']; ?>">Eliminar</span>
        <span class="toggle-details-button">▼</span>
      </td>
    </tr>
    <tr class="details-row">
      <td colspan="5" class="details-cell">
        Detalles de <?php echo $persona['NombreAtleta'] . ' ' . $persona['ApellidosAtleta']; ?>:
        <ul>
          <li>ID: <?php echo $persona['idafiliados']; ?></li>
          <li>Nombre: <?php echo $persona['NombreAtleta']; ?></li>
          <li>Apellido: <?php echo $persona['ApellidosAtleta']; ?></li>
          <li>Fecha de nacimiento: <?php echo $persona['FechaNac']; ?></li>
          <li>DNI: <?php echo $persona['DNI']; ?></li>
          <li>Licencia: <?php echo $persona['Licencia']; ?></li>
        </ul>
      </td>
    </tr>
    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <h1>EDITAR</h1>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table id="datatable_users2" class="table table-striped" >
                  
                    <thead style="background-color: black; color:white">
                        <tr>
                            <th class="centered">Nombre</th>
                            <th class="centered">Apellido 1</th>
                            <th class="centered">Apellido 2</th>
                            <th class="centered">DNI</th>
                            <th class="centered">F.Nacimiento</th>
                            <th class="centered">Sexo</th>
                            <th class="centered">Licencia</th>
                            <th class="centered">tipo via</th>
                            <th class="centered">Nombre via</th>
                            <th class="centered">Número</th>
                            <th class="centered">Poblacion</th>
                            <th class="centered">Provincia</th>
                            <th class="centered">CP</th>
                            <th class="centered">Telefono fijo</th>
                            <th class="centered">Telefono movil</th>

                        </tr>
                    </thead>
                    <tbody id="tableBody_users"></tbody>
                </table>
            </div>
        </div>
    </div>
         <!-- jQuery -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <!-- DataTable -->
         <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
         
         <script>
$(document).ready(function() {
   // Obtener la instancia del plugin DataTables para la tabla #datatable_users
var table = $('#datatable_users').DataTable();

// Destruir la instancia del plugin DataTables
table.destroy();

// Volver a inicializar el plugin DataTables en la tabla #datatable_users
$('#datatable_users').DataTable();
});
$(document).ready(function() {
    // Obtener la instancia del plugin DataTables para la tabla #datatable_users
var table = $('#datatable_users2').DataTable();

// Destruir la instancia del plugin DataTables
table.destroy();

// Volver a inicializar el plugin DataTables en la tabla #datatable_users
$('#datatable_users2').DataTable();
});
</script>

    </body>
    </html>