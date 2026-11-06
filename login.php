
<?php
session_start();
$mensaje = "";
if (isset($_POST['ingresar'])) {

    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    if (isset($_SESSION['usuarios'][$usuario])) {

        $hash = $_SESSION['usuarios'][$usuario]['password'];
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

    <div class="encabezado">
        <h1>Sistema de usuarios</h1>
    </div>

    <div class="contenido">

        <h2>Inicio de sesion</h2>

        <img src="imagenes/login.png" alt="Imagen de inicio de sesion" class="imagen">

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
