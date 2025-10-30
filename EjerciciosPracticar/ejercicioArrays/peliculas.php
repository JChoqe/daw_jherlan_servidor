<?php
// Importo los datos de la libreria externa
require_once "../../data/datos.php";

// ----------------------
// Tabla: Todas las películas
// ----------------------
$shtml = "<table border='1'>";
$shtml .= "<tr><td><b>Todas las peliculas</b></td></tr>";  

foreach ($movieTitles as $movie){
    $shtml .= "<tr><td>" . $movie . "</td></tr>";  
}

$shtml .= "</table>";

// ----------------------
// Tabla: Películas ordenadas alfabéticamente
// ----------------------
$movieSort = $movieTitles;
sort($movieSort);
$shtml .= "<br><table border='1'>"; // Concateno para no perder la primera tabla
$shtml .= "<tr><td><b>Ordena por orden alfabético</b></td></tr>";  
foreach ($movieSort as $movie){
    $shtml .= "<tr><td>" . $movie . "</td></tr>";  
}
$shtml .= "</table>";

// ----------------------
// Tabla: Saca de la 11 a la 15 en otra variable
// ----------------------
$desde = 11;
$hasta = 15;
$oncequincepeliculas = array_slice($movieTitles, $desde, $hasta - $desde + 1);
$shtml .= "<br><table border='1'>"; // Concateno para no perder la primera tabla
$shtml .= "<tr><td><b>Saca de la 11 a la 15 en otra variableo</b></td></tr>";  
foreach ($oncequincepeliculas as $movie){
    $shtml .= "<tr><td>" . $movie . "</td></tr>";  
}
$shtml .= "</table>";

// ----------------------
// Haz una copia del array y quita las que no te gusten y cambialas por otras.
// ----------------------
$copiamovieSort = $movieSort;
$deleteFirstFilm = "12 hombres sin piedad";
$deleteSecondFilm = "Uno de los nuestros";
// // Primero ver si el elemento que queremos sustituir existe (array_search) devuelve si existe.
// $pos = buscarIndice($deleteFirstFilm)
// $shtml .= "<p></p> ";
// $shtml .= "<br><table border='1'>"; // Concateno para no perder la primera tabla
// $shtml .= "<tr><td><b>Haz una copia del array y quita las que no te gusten y cambialas por otras.</b></td></tr>";

// // Muestro el HTML
// echo $shtml;
// function buscarIndice($elemento,$array){
//     return array_search($elemento,$array);
// }
?>

// $objetivofinal="$diasemana $i de ". $mes['nombre'] ." de $anio";