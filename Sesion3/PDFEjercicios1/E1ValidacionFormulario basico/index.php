<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Básico</title>
</head>

<body>
    <form action="procesar.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre"><br><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido"><br><br>

        <label for="dni">DNI:</label><br>
        <input type="text" id="dni" name="dni" placeholder="Ingresa tu DNI"><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>