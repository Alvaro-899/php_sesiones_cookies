<!-- register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

<h1>Registro</h1>

<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $confirmarContrasena = $_POST["confirmar_contrasena"];
    $politica = isset($_POST["politica"]) ? 1 : 0; // 1 si está marcada, 0 si no

    // Validación básica (puedes agregar validaciones más robustas según tus necesidades)
    if ($contrasena != $confirmarContrasena) {
        echo "<p>Las contraseñas no coinciden. Inténtalo de nuevo.</p>";
    } else {
        // Conecta a la base de datos (debes proporcionar tus propias credenciales)
        $conexion = new mysqli("localhost", "root", "", "test");

        // Verifica la conexión a la base de datos
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Escapa los valores para prevenir SQL injection (usando sentencias preparadas)
        $correo = $conexion->real_escape_string($correo);
        $contrasena = $conexion->real_escape_string($contrasena);

        // Consulta para insertar los datos en la base de datos
        $consulta = "INSERT INTO test.login (correo, password, politica) VALUES ('$correo', '$contrasena', $politica)";

        if ($conexion->query($consulta) === TRUE) {
            echo "<p>Registro exitoso. Serás redirigido a <a href='login.php'>iniciar sesión</a> en unos segundos.</p>";

            // Cierra la conexión a la base de datos
            $conexion->close();

            // Espera 2 segundos antes de redirigir automáticamente
            header("refresh:2; url=login.php");
            exit();
        } else {
            echo "<p>Error al registrar el usuario: " . $conexion->error . "</p>";
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}
?>

<!-- Formulario de registro -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>

    <label for="confirmar_contrasena">Confirmar contraseña:</label>
    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required><br>

    <label for="politica">Acepta las políticas de esta página</label>
    <input type="checkbox" id="politica" name="politica" required><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>
