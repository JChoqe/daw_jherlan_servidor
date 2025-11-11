<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos la accion del query string
    $accion = $_GET['accion'] ?? '';

    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $sexo = $_POST['sexo'] ?? '';

    $salesestudios = "";
    if (condition) {
        # code...
    } else {
        # code...
    }
    
    $estudios = isset($_POST['estudiosGM']) ? 'Sí' : 'No';

    echo "<h2>Datos recibidos:</h2>";
    echo "Nombre: $nombre<br>";
    echo "Apellidos: $apellidos<br>";
    echo "Dirección: $direccion<br>";
    echo "Sexo: $sexo<br>";
    echo "Estudios de grado medio: $estudios<br>";
} else {
    echo "Error: No se recibieron datos.";
}
?>