<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
</head>
<body>
	<?php
	// Comprobar si se ha iniciado sesión
	session_start();
	if (!isset($_SESSION["username"])) {
	header("Location: login.html");
	exit();
	}
	?>

	<h1>Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
	<a href="logout.php">Cerrar sesión</a>

	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
				<th>Fecha de nacimiento</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Configuración de la conexión a la base de datos
			$servername = "localhost";
			$username = "admin";
			$password = "admin";
			$dbname = "goyo";

			// Crear la conexión
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Comprobar si se ha establecido la conexión
			if ($conn->connect_error) {
			    die("Error al conectar a la base de datos: " . $conn->connect_error);
			}

			// Obtener los datos de la tabla "personas"
			$sql = "SELECT nombre, apellido, edad, fecha_nacimiento FROM personas";
			$result = $conn->query($sql);

			// Imprimir los datos en una tabla
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["apellido"] . "</td><td>" . $row["edad"] . "</td><td>" . $row["fecha_nacimiento"] . "</td></tr>";
			    }
			} else {
			    echo "No se encontraron resultados";
			}

			$conn->close();
			?>
		</tbody>
	</table>
</body>
</html>
