<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Cómic Favorito</title>
    <link rel="stylesheet" href="formulario_style.css">
</head>

<body>
    <div class="caja">
        <h1>Mis Cómics Favoritos</h1>
        <form action="procesar.php" method="POST">
            <!-- 1. ELIGE TU EDITORIAL -->
            <label>1. ¿Qué editorial te gusta más?</label>
            <select name="editorial" required>
                <option value="">-- Elige una --</option>
                <option value="Marvel">Marvel</option>
                <option value="DC">DC</option>
                <option value="Image">Image</option>
            </select>
            <!-- 2. ELIGE GUIONISTAS (mínimo 1) -->
            <label>2. ¿Qué guionistas te gustan? (marca los que quieras)</label>
            <div class="nota">Puedes elegir varios</div>
            <input type="checkbox" name="guionistas[]" value="Stan Lee"> Stan Lee<br>
            <input type="checkbox" name="guionistas[]" value="Alan Moore"> Alan Moore<br>
            <input type="checkbox" name="guionistas[]" value="Neil Gaiman"> Neil Gaiman<br>
            <input type="checkbox" name="guionistas[]" value="Grant Morrison"> Grant Morrison<br>
            <input type="checkbox" name="guionistas[]" value="Brian K. Vaughan"> Brian K. Vaughan<br>
            <!-- 3. ELIGE PERSONAJES (mínimo 1) -->
            <label>3. ¿Qué personajes te gustan más?</label>
            <div class="nota">Puedes elegir varios (usa Ctrl)</div>
            <select name="personajes[]" multiple size="6" required>
                <option>Spider-Man</option>
                <option>Batman</option>
                <option>Wolverine</option>
                <option>Wonder Woman</option>
                <option>Saga (Marko)</option>
                <option>The Sandman</option>
            </select>
            <!-- BOTÓN ENVIAR -->
            <button type="submit">Enviar mis elecciones</button>
        </form>
    </div>

</body>

</html>