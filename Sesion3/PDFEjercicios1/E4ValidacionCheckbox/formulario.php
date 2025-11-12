<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Formulario de Intereses</title>
</head>

<body>
    <h1>Selecciona tus intereses</h1>

    <form action="procesar_intereses.php" method="post">
        
        <p>Elige uno o varios intereses:</p>

        <input type="checkbox" id="deporte" name="intereses[]" value="Deporte">
        <label for="deporte">Deporte</label><br>

        <input type="checkbox" id="musica" name="intereses[]" value="Música">
        <label for="musica">Música</label><br>

        <input type="checkbox" id="tecnologia" name="intereses[]" value="Tecnología">
        <label for="tecnologia">Tecnología</label><br>

        <input type="checkbox" id="viajes" name="intereses[]" value="Viajes">
        <label for="viajes">Viajes</label><br>

        <input type="checkbox" id="lectura" name="intereses[]" value="Lectura">
        <label for="lectura">Lectura</label><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>

</html>