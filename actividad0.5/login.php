<html>
<?php

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["pass"];

    // Conecta a la base de datos (debes proporcionar tus propias credenciales)
    $conexion = new mysqli("localhost", "root", "", "test");

    // Verifica la conexión a la base de datos
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Escapa los valores para prevenir SQL injection (usando sentencias preparadas)
    $correo = $conexion->real_escape_string($correo);
    $contrasena = $conexion->real_escape_string($contrasena);

    // Consulta para verificar las credenciales en la base de datos
    $consulta = "SELECT * FROM login WHERE correo = '$correo' AND password = '$contrasena'";

    $resultado = $conexion->query($consulta);

    // Verifica si la consulta fue exitosa
    if ($resultado && $resultado->num_rows > 0) {
        // Inicia la sesión
        session_start();

        // Almacena el correo electrónico en la sesión (puedes agregar más datos si es necesario)
        $_SESSION["correo"] = $correo;

        // Redirige a recursos.php
        header("Location: recursos.php");

        // Asegúrate de detener la ejecución del script después de la redirección
        exit();
    } else {
        // Muestra un mensaje de error si las credenciales son incorrectas
        echo "<p>Credenciales incorrectas. Inténtalo de nuevo. O si no esta registrado</p>";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>
<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="pass" required><br>

    <input type="submit" value="Iniciar sesión">
</form>
<br>
<a href="registro.php">Registrarse</a>
</html>
