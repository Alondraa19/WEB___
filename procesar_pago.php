<?php
// Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar datos obligatorios
    if (
        empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['celular']) ||
        empty($_POST['direccion']) || empty($_POST['fecha']) || empty($_POST['total']) ||
        empty($_POST['metodo'])
    ) {
        die("❌ Faltan datos en el formulario.");
    }

    // Recuperar datos
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $fecha_entrega = $_POST['fecha'];
    $total = (float) $_POST['total'];
    $metodo_pago = $_POST['metodo'];

    // Insertar pedido
    $stmt = $conn->prepare("INSERT INTO pedidos (nombre, email, celular, direccion, fecha_entrega, metodo_pago, total, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    if (!$stmt) {
        die("❌ Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssssd", $nombre, $email, $celular, $direccion, $fecha_entrega, $metodo_pago, $total);

    if ($stmt->execute()) {
        // Guardar ID del pedido en sesión
        $_SESSION['pedido_id'] = $stmt->insert_id;

        // ✅ Redirigir correctamente (por PHP, no JS)
        header("Location: ../html/guardar_detalle.html");
        exit();
    } else {
        die("❌ Error al registrar el pedido: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
