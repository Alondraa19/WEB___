<?php
include 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['contraseña'];

    // Buscar usuario por email
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $usuario['contraseña'])) {
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['email'] = $usuario['email'];

            // Redirigir a la página principal
            header("Location: http://localhost/PAGINAA-WEB/html/html/main.html");

            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../html/login.php?error=1");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: ../html/login.php?error=2");
        exit();
    }
}
?>

