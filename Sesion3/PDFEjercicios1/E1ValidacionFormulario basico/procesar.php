<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>

<?php
$errores = [];

// Recibir y limpiar datos
$nombre = trim($_POST["nombre"] ?? '');
$apellido = trim($_POST["apellido"] ?? '');
$dni = strtoupper(trim($_POST["dni"] ?? ''));

// Validaciones
if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}

if (empty($apellido)) {
    $errores[] = "El apellido es obligatorio.";
}

if (empty($dni)) {
    $errores[] = "El DNI es obligatorio.";
} elseif (!preg_match('/^\d{8}[A-Z]$/', $dni)) {
    $errores[] = "El DNI debe tener 8 números y una letra mayúscula (ej: 12345678A).";
}

// Mostrar resultado
if (!empty($errores)) {
    echo "<div class='error'><strong>Errores encontrados:</strong><ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
    echo '<a href="formulario.php">← Volver al formulario</a>';
} else {
    echo "<div class='success'>¡Datos enviados correctamente!</div>";
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($nombre) . "</p>";
    echo "<p><strong>Apellido:</strong> " . htmlspecialchars($apellido) . "</p>";
    echo "<p><strong>DNI:</strong> " . htmlspecialchars($dni) . "</p>";
    echo '<br><a href="index.php">← Enviar otro formulario</a>';
}
?>

</body>
</html>