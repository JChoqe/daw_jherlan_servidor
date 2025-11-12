<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>

<body>
    <?php
    // === VERIFICAR MÉTODO POST ===
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo '<div>Acceso no permitido.</div>';
        echo '<a href="formulario.php"> Volver al formulario</a>';
        exit;
    }

    // === RECIBIR Y LIMPIAR EMAIL ===
    $email = trim($_POST['email'] ?? '');

    // === VALIDACIÓN ===
    $errores = [];

    if (empty($email)) {
        $errores[] = "El email es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no tiene un formato válido.";
    }

    // === MOSTRAR RESULTADO ===
    if (!empty($errores)) {
        echo '<div><strong>Errores:</strong><ul>';
        foreach ($errores as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul></div>';
        echo '<a href="formulario.php">← Corregir formulario</a>';
    } else {
        echo '<div >¡Datos enviados correctamente!</div>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
        echo '<br><a href="formulario.php">← Enviar otro</a>';
    }
    ?>
</body>
</html>