<?php
// ✅ Iniciar buffer de salida para evitar errores antes del JSON
ob_start();

// ✅ Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conexion.php';
session_start();

// ✅ Cabecera para JSON
header('Content-Type: application/json');

// ✅ Verificar que haya ID de pedido válido
if (!isset($_SESSION['pedido_id'])) {
    echo json_encode([
        'success' => false,
        'error' => 'No hay ID de pedido en sesión',
        'session_id' => session_id(),
        'cookies' => $_COOKIE
    ]);
    exit;
}

$pedido_id = $_SESSION['pedido_id'];

// ✅ Obtener datos enviados por JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// ✅ Validar que haya carrito
if (!isset($data['carrito']) || !is_array($data['carrito'])) {
    echo json_encode(['success' => false, 'error' => 'No se envió el carrito correctamente']);
    exit;
}

$carrito = $data['carrito'];

// ✅ Preparar la consulta
$stmt = $conn->prepare("INSERT INTO detalle_pedido (pedido_id, nombre_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Error al preparar consulta: ' . $conn->error]);
    exit;
}

// ✅ Ejecutar para cada producto
foreach ($carrito as $item) {
    $producto = $item['nombre'] ?? '';
    $cantidad = (int)($item['cantidad'] ?? 0);
    $precio = (float)($item['precio'] ?? 0);

    $stmt->bind_param("isid", $pedido_id, $producto, $cantidad, $precio);
    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'error' => 'Error al insertar detalle: ' . $stmt->error]);
        exit;
    }
}

$stmt->close();
$conn->close();

// ✅ Limpiar sesión
unset($_SESSION['pedido_id']);

// ✅ Enviar respuesta JSON
echo json_encode(['success' => true]);
?>
