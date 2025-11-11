<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="procesos_style.css">
</head>

<body>
<div class="caja">
    <h1>Combinaciones</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitizar datos
        $editorial = htmlspecialchars($_POST['editorial'] ?? 'Ninguna');
        $guionistas = $_POST['guionistas'] ?? [];
        $personajes = $_POST['personajes'] ?? [];

        // Validación: al menos 1 guionista y 1 personaje
        if (empty($guionistas) || empty($personajes)) {
            echo "<div class='error'>
                    Por favor, selecciona al menos <strong>un guionista</strong> y <strong>un personaje</strong>.
                  </div>";
        } else {
            $total = count($guionistas) * count($personajes);
            echo "<div class='total'>
                    Total de combinaciones: <strong>$total</strong> para la editorial <strong>$editorial</strong>
                  </div>";

            // Generar todas las combinaciones
            foreach ($guionistas as $guionista) {
                foreach ($personajes as $personaje) {
                    $guionista = htmlspecialchars($guionista);
                    $personaje = htmlspecialchars($personaje);
                    echo "<div class='combo'>
                            <strong>Editorial:</strong> $editorial<br>
                            <strong>Guionista:</strong> $guionista<br>
                            <strong>Personaje:</strong> $personaje
                          </div>";
                }
            }
        }
    } else {
        echo "<div class='error'>Acceso no permitido. Usa el formulario.</div>";
    }
    ?>

    <a href="formulario_comics.php" class="volver">
      Volver al formulario
    </a>
  </div>
</body>

</html>