<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $estado_civil = $_POST['estado_civil'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO form (nombre, apellido, edad, sexo, estado_civil, direccion, correo, fecha_nacimiento, telefono)
            VALUES ('$nombre', '$apellido', $edad, '$sexo', '$estado_civil', '$direccion', '$correo', '$fecha_nacimiento', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registro exitoso";
    } else {
        $_SESSION['message'] = "Error al registrar: " . $conn->error;
    }

    // Redireccionar para evitar el reenvío de formulario
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Obtener el mensaje de la sesión y luego borrarlo
$message = "";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <h1>Formulario De Registro</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-row">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="">Seleccione un sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="estado_civil">Estado civil:</label>
                <select id="estado_civil" name="estado_civil" required>
                    <option value="">Seleccione un estado civil</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
        </div>
        <button type="submit">Enviar</button>
        <br>
        <p><?php echo $message; ?></p>

    </form>

</body>
</html>
