<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>

<?php
// === FUNCIÓN PARA LIMPIAR ENTRADA ===
function limpiarEntrada($dato) {
    $dato = strip_tags($dato);
    $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
    return $dato;
}

// === VERIFICAR QUE SEA POST ===
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<div class="error">Acceso no permitido.</div>';
    echo '<a href="formulario.php">← Volver al formulario</a>';
    exit;
}

// === RECIBIR Y LIMPIAR DATOS ===
$nombre = limpiarEntrada($_POST["nombre"] ?? '');
$comentario = limpiarEntrada($_POST["comentario"] ?? '');

// === VALIDACIÓN ===
$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}

if (empty($comentario)) {
    $errores[] = "El comentario es obligatorio.";
}

// === MOSTRAR RESULTADO ===
if (!empty($errores)) {
    echo '<div class="error"><strong>Errores:</strong><ul>';
    foreach ($errores as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul></div>';
    echo '<a href="formulario.php">← Corregir formulario</a>';
} else {
    echo '<div class="success">¡Datos enviados correctamente!</div>';
    echo '<p><strong>Nombre:</strong> ' . $nombre . '</p>';
    echo '<p><strong>Comentario:</strong> ' . nl2br($comentario) . '</p>';
    echo '<br><a href="formulario.php">← Enviar otro formulario</a>';
}
?>

</body>
</html>