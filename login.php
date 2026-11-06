
<?php
session_start();

$mensaje = "";

// Revisamos si se presiono el boton de ingresar
if (isset($_POST['ingresar'])) {

    // Obtenemos los datos del formulario
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    // Comprobamos si el usuario esta registrado
    if (isset($_SESSION['usuarios'][$usuario])) {

        // Obtenemos la contraseña protegida
        $hash = $_SESSION['usuarios'][$usuario]['password'];

        // Comparamos la contraseña escrita con la guardada
        if (password_verify($password, $hash)) {

            $nombre = $_SESSION['usuarios'][$usuario]['nombre'];

            $mensaje = "Bienvenido al sistema, " . $nombre;

        } else {
            $mensaje = "La contraseña es incorrecta.";
        }

    } else {
        $mensaje = "El usuario no esta registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <!-- Encabezado de la pagina -->
    <div class="encabezado">
        <h1>Sistema de usuarios</h1>
    </div>

    <!-- Formulario para iniciar sesion -->
    <div class="contenido">

        <h2>Inicio de sesion</h2>
        <p class="descripcion">Ingresa tu usuario y contraseña.</p>

        <form method="POST">

            <label>Nombre de usuario</label>
            <input type="text" name="usuario" placeholder="Escribe tu usuario" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Escribe tu contraseña" required>

            <button type="submit" name="ingresar">Ingresar</button>

        </form>

        <!-- Mostramos el resultado del inicio de sesion -->
        <p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p>

        <p>¿No tienes cuenta? <a href="registro.php">Registrate aqui</a></p>

    </div>

</body>
</html>
