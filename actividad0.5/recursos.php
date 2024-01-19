<!-- recursos.php -->
<?php
// Inicia la sesión
session_start();

// Verifica si hay una sesión iniciada
if (!isset($_SESSION["correo"])) {
    // Si no hay una sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos</title>
</head>
<body>

<h1>Página de Recursos</h1>

<!-- Contenido exclusivo para usuarios autenticados -->
<p>Bienvenido, <?php echo $_SESSION["correo"]; ?>. Este es el contenido exclusivo para usuarios autenticados.</p>

<p>Contenido de la página de recursos...</p>
<br>
<p>Aqui se encuentra el <a href="doc/archivo1.pdf" target="_blank">archivo 1</a></p><br>
<p>Aqui se encuentra el <a href="doc/archivo2.pdf" target="_blank">archivo 2</a></p><br>

<p><a href="logout.php">Cerrar sesión</a></p>

</body>
</html>