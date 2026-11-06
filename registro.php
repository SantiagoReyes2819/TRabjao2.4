
<?php
session_start();

// Guardamos los usuarios en un arreglo durante la sesion
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = array();
}

$mensaje = "";

// Revisamos si se presiono el boton
if (isset($_POST['registrar'])) {

    // Obtenemos los datos del formulario
    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    // Comprobamos que todos los campos tengan informacion
    if ($nombre == "" || $usuario == "" || $password == "" || $confirmar == "") {
        $mensaje = "Todos los campos son obligatorios.";
    }

    // Comprobamos la longitud de la contraseña
    elseif (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
    }

    // Revisamos que las contraseñas sean iguales
    elseif ($password != $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    }

    // Verificamos que el usuario no exista
    elseif (isset($_SESSION['usuarios'][$usuario])) {
        $mensaje = "Este usuario ya esta registrado.";
    }

    else {
        // Protegemos la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Guardamos los datos del usuario
        $_SESSION['usuarios'][$usuario] = array(
            "nombre" => $nombre,
            "password" => $hash
        );

        $mensaje = "Usuario registrado correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <!-- Encabezado de la pagina -->
    <div class="encabezado">
        <h1>Sistema de usuarios</h1>
    </div>

    <!-- Formulario de registro -->
    <div class="contenido">

        <h2>Registro de usuarios</h2>
        <p class="descripcion">Ingresa tus datos para crear una cuenta.</p>

        <form method="POST">

            <label>Nombre completo</label>
            <input type="text" name="nombre" placeholder="Escribe tu nombre" required>

            <label>Nombre de usuario</label>
            <input type="text" name="usuario" placeholder="Elige un usuario" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Minimo 6 caracteres" required>

            <label>Confirmar contraseña</label>
            <input type="password" name="confirmar" placeholder="Repite tu contraseña" required>

            <button type="submit" name="registrar">Registrar</button>

        </form>

        <!-- Mensaje del resultado -->
        <p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesion</a></p>
    </div>
</body>
</html>
