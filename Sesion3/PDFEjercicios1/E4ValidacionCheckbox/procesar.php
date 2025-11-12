<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    $intereses = $_POST['intereses'] ?? [];

    // === VALIDACIÓN ===
    $errores = [];

    if (empty($intereses)) {
        $errores[] = "Selecciona al menos un interes.";
    }

    // === MOSTRAR RESULTADO ===
    if (!empty($errores)) {
        echo '<div><strong>Errores:</strong><ul>';
        foreach ($errores as $error) {
            echo '<li>' . ($error) . '</li>';
        }
        echo '</ul></div>';
        echo '<a href="formulario.php">← Corregir formulario</a>';
    } else {
        echo '<div >¡Datos enviados correctamente!</div>';
        echo '<p>Tus intereses:</p>';
        echo '<ul>';
        foreach ($intereses as $interes) {
            echo '<li>' . $interes . '</li>';
        }
        echo '</ul>';
        echo '<br><a href="formulario.php">← Enviar otro</a>';
    }
    ?>
</body>

</html>