<<<<<<< HEAD
<?php
session_start();

// comprobar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // obtener los datos del formulario
  $username = $_POST['username'];
  $password = $_POST['password'];

  // conectar a la base de datos con PDO
  $dsn = 'mysql:host=localhost;dbname=goyo';
  $user = 'admin';
  $pass = 'admin';
  $pdo = new PDO($dsn, $user, $pass);

  // preparar la consulta preparada
  $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  // verificar si las credenciales son válidas
  if ($user && password_verify($password, $user['password'])) {
    //Guardar la caché de usuario 3600 segundos (1 hora)
    header('Cache-Control: max-age=3600, public');
    header('Expires: '.gmdate('D, d M Y H:i:s', time() + 3600).' GMT');
    // las credenciales son válidas, iniciar sesión
    $_SESSION["username"] = $username;
    header('Location: ../club/indexclub.php');
    exit;
  } else {
    // las credenciales son inválidas, mostrar un mensaje de error
    $error = 'Nombre de usuario o contraseña incorrectos.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <form method="post" action="login.php">
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Iniciar sesión">
  </form>
</body>
=======
<?php
session_start();

// comprobar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // obtener los datos del formulario
  $username = $_POST['username'];
  $password = $_POST['password'];

  // conectar a la base de datos con PDO
  $dsn = 'mysql:host=localhost;dbname=goyo';
  $user = 'admin';
  $pass = 'admin';
  $pdo = new PDO($dsn, $user, $pass);

  // preparar la consulta preparada
  $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  // verificar si las credenciales son válidas
  if ($user && password_verify($password, $user['password'])) {
    //Guardar la caché de usuario 3600 segundos (1 hora)
    header('Cache-Control: max-age=3600, public');
    header('Expires: '.gmdate('D, d M Y H:i:s', time() + 3600).' GMT');
    // las credenciales son válidas, iniciar sesión
    $_SESSION["username"] = $username;
    header('Location: inicio.php');
    exit;
  } else {
    // las credenciales son inválidas, mostrar un mensaje de error
    $error = 'Nombre de usuario o contraseña incorrectos.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <form method="post" action="login.php">
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Iniciar sesión">
  </form>
</body>
>>>>>>> 5f9faba9e41a80640c530226c5aa2ed820497b9a
</html>