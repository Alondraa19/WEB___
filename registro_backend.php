<?php
include 'conexion.php'; // Conexión a la base de datos

// Verifica que el método de envío sea POST (es decir, que provenga del formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Encripta la contraseña usando el algoritmo por defecto de PHP (actualmente bcrypt)
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Verifica si el correo ya está registrado en la base de datos
    $verificar = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $verificar->bind_param("s", $email);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
        // Si el email ya existe, redirige con un mensaje de error
        header("Location: http://localhost/PAGINAA-WEB/html/html/registro.php?error=correo");
        exit();
    }

    // Si no existe, prepara el registro del nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $contraseña);

    // Ejecuta la inserción y verifica si fue exitosa
    if ($stmt->execute()) {
        // Registro exitoso → redirige al login con parámetro de éxito
        header("Location: http://localhost/PAGINAA-WEB/html/html/login.php?registro=ok");
    } else {
        // Si hubo un error al registrar, redirige con mensaje de fallo
        header("Location: http://localhost/PAGINAA-WEB/html/html/registro.php?error=registro"); 
    }

    // Cierra la conexión con la base de datos
    $conn->close();
    exit();
}
?>

