<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
$mensaje = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'correo') $mensaje = "⚠️ Este correo ya está registrado.";
    elseif ($_GET['error'] == 'registro') $mensaje = "❌ Error al registrar. Inténtalo de nuevo.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Registro</title>
</head>
<body>
    <section>
        <div class="form-box">

            <?php if ($mensaje): ?>
                <div style="color: red; text-align:center;">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <div class="form-value">

                    <form action="../PHP/registro_backend.php" method="POST">

                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="nombre" required>
                        <label>Nombre</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="contraseña" required>
                        <label>Password</label>
                    </div>
                    <button type="submit">Registrarse</button>
                    <div class="register">
                        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>