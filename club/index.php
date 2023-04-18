<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Club de Fútbol</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Club de Fútbol</h1>
    <?php
      // Obtener la información del club
      $club_id = $_SESSION['club_id'];
      $query = "SELECT * FROM clubes WHERE id = $club_id";
      $result = mysqli_query($conn, $query);
      $club = mysqli_fetch_assoc($result);

      // Obtener la información de los participantes
      $query = "SELECT * FROM participantes WHERE club_id = $club_id";
      $result = mysqli_query($conn, $query);
      $participantes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <h2><?php echo $club['nombre']; ?></h2>
    <p>ID: <?php echo $club['id']; ?></p>
    <p>Número de Participantes: <?php echo $club['numero_participantes']; ?></p>
    <table class="table">
      <thead>
        <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>DNI</th>
        <th>Edad</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($participantes as $participante): ?>
      <tr>
        <td><?php echo $participante['nombre']; ?></td>
        <td><?php echo $participante['apellidos']; ?></td>
        <td><?php echo $participante['dni']; ?></td>
        <td><?php echo $participante['edad']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>