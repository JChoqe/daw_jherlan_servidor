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
$copiamovieTitle = $movieTitles;
// Películas nuevas
$newsMovies = ["Interstellar", "Avatar"];
// Películas a reemplazar
$replaceMovies = ["12 hombres sin piedad", "Uno de los nuestros"];
$i = 0;
foreach ($copiamovieTitle as $indice => $movie) {
    // Si la película está en $replaceMovies
    if (in_array($movie, $replaceMovies)) {
        $copiamovieTitle[$indice] = $newsMovies[$i]; // reemplazar solo el elemento
        $i++; // pasar al siguiente nuevo
    }
}
// Generar la tabla HTML
$shtml .= "<br><table border='1'>";
$shtml .= "<tr><td><b>Haz una copia del array y quita las que no te gusten y cámbialas por otras.</b></td></tr>";
foreach ($copiamovieTitle as $movie) {
    $shtml .= "<tr><td>" . $movie . "</td></tr>";  
}

$shtml .= "</table>";

// // ----------------------
// // Añade al principio de la copia del array la que más te guste.
// // ----------------------
// $copiamovieTitle2 = $movieTitles;
// //Peliculas que mas te gusta
// $bestFilm = "Una batalla tras otra";
// array_push($copiamovieTitle2,$bestFilm)
// // Generar la tabla HTML
// $shtml .= "<br><table border='1'>";
// $shtml .= "<tr><td><b>Añade al principio de la copia del array la que más te guste.</b></td></tr>";
// foreach ($copiamovieTitle2 as $movie) {
//     $shtml .= "<tr><td>" . $movie . "</td></tr>";  
// }
// $shtml .= "</table>";
echo $shtml;
?>