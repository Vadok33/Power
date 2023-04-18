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
    <title>Club</title>
</head>
<body>

    

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
            <a class="navbar-brand" href="indexclub.php">MI CLUB</a>
            <a class="navbar-brand" href="../admin/indexadmin.php">REVISIONES</a>
            <a class="navbar-brand" href="indexafiliar.html">AFILIAR</a>
        </div>
    </nav>
    
        <div class="container my-4">
            <div class="row">
                <h1>CLUB USERA POWERLIFTING</h1>
            </div>
            <div class="row">
                <p>Afiliados</p>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <table id="datatable_users" class="table table-striped" >
                        
                        <thead style="background-color: black; color:white">
                            <tr>
                                <th class="centered">ID</th>
                                <th class="centered">DNI</th>
                                <th class="centered">Nombre</th>
                                <th class="centered">Apellido</th>
                                <th class="centered">Fecha nacimiento</th>
                                <th class="centered">Sexo</th>
                                <th class="centered">Licencia</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody_users">

                        <?php
// Conexión a la base de datos
$dbhost = "localhost";
$dbuser = "admin";
$dbpass = "admin";
$dbname = "power";

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

// Consulta a la base de datos
$query = "SELECT * FROM afiliados INNER JOIN clubs on afiliados.clubs_idclubs = clubs.idclubs where afiliados.clubs_idclubs= 2";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Imprimir los resultados en la tabla
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td class='centered'>" . $row['idafiliados'] . "</td>";
    echo "<td class='centered'>" . $row['DNI'] . "</td>";
    echo "<td class='centered'>" . $row['NombreAtleta'] . "</td>";
    echo "<td class='centered'>" . $row['ApellidosAtleta'] . "</td>";
    echo "<td class='centered'>" . $row['FechaNac'] . "</td>";
    echo "<td class='centered'>" . $row['Sexo'] . "</td>";
    echo "<td class='centered'>" . $row['Licencia'] . "</td>";
    echo "</tr>";
}

// Cerrar la conexión a la base de datos
$pdo = null;
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <button class=""></button>
        </div>
     <!-- jQuery -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- DataTable -->
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
     <script>
$(document).ready(function() {
    $('#datatable_users').DataTable();
});
</script>
</body>
</html>