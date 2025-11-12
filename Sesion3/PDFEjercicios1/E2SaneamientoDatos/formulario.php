<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saneamiento Datos</title>
</head>

<body>
    <h1>Deja tu comentario</h1>
    <form action="procesar.php" method="post">
        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre">
        <!-- Comentario -->
        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" rows="6" cols="40" placeholder="Escribe aquí tu comentario"></textarea>
        <!-- Enviar -->
        <input type="submit" value="Enviar">
    </form>
</body>

</html>