<?php
include 'datos.php';
// action="funciones.php?accion=listado"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos la accion del query string
    $accion = $_GET['accion'] ?? '';

    $anio = $_POST['anio']?? '';

    echo "<h2>Listado a partir del año ingresado por formulario:</h2>";
    echo "Anio: $anio<br>";
} else {
    echo "Error: No se recibieron datos.";
}
foreach ($Meses as $indiceMes => $mes) {
    echo "Mes: " . $mes["nombre"] . " que tiene " . $mes["dias"] . "<br>";

    for ($dia=1; $dia <= $mes['dias'] ; $dia++) { 
        $fecha = $anio.()
    }
}
?>

<!-- foreach ($Meses as $indiceMes => $mes) {
    echo "<h2>" . strtoupper($mes['nombre']) . "</h2>";

    for ($dia = 1; $dia <= $mes['dias']; $dia++) {
        $fecha = "$anio-" . ($indiceMes + 1) . "-$dia";
        $numDia = date('w', strtotime($fecha));
        echo ucfirst($diasSemana[$numDia]) . " $dia de " . strtolower($mes['nombre']) . " de $anio<br>";
    }
} -->