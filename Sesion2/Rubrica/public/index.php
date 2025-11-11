<?php
require_once "../app/funciones.php";

$comics = listarComics();
$editar = null;
$mensaje = $_GET['msg'] ?? '';

// Si hay ID para editar
if (isset($_GET['editar'])) {
    $id = (int)$_GET['editar'];
    foreach ($comics as $c) {
        if ($c->id == $id) {
            $editar = $c;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Cómics</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Gestor de Cómics</h1>

<?php if ($mensaje): ?>
    <p style="color:green; text-align:center;">¡Acción realizada con éxito!</p>
<?php endif; ?>

<form method="post" action="../app/funciones.php">
    <input type="hidden" name="action" value="<?= $editar ? 'guardar' : 'anadir' ?>">
    <?php if ($editar): ?>
        <input type="hidden" name="id" value="<?= $editar->id ?>">
    <?php endif; ?>

    <label>Título:</label>
    <input type="text" name="titulo" value="<?= $editar->titulo ?? '' ?>" required><br>

    <label>Autor:</label>
    <input type="text" name="autor" value="<?= $editar->autor ?? '' ?>" required><br>

    <label>Estado:</label>
    <select name="estado" required>
        <option value="pendiente de leer" <?= ($editar->estado ?? '') === 'pendiente de leer' ? 'selected' : '' ?>>Pendiente</option>
        <option value="leyendo" <?= ($editar->estado ?? '') === 'leyendo' ? 'selected' : '' ?>>Leyendo</option>
        <option value="leído" <?= ($editar->estado ?? '') === 'leído' ? 'selected' : '' ?>>Leído</option>
    </select><br>

    <label>Prestado:</label>
    <input type="checkbox" name="prestado" <?= ($editar->prestado ?? false) ? 'checked' : '' ?>><br>

    <label>Localización:</label>
    <select name="localizacion" required>
        <option value="estanteria1" <?= ($editar->localizacion ?? '') === 'estanteria1' ? 'selected' : '' ?>>Estantería 1</option>
        <option value="estanteria2" <?= ($editar->localizacion ?? '') === 'estanteria2' ? 'selected' : '' ?>>Estantería 2</option>
        <option value="mueble" <?= ($editar->localizacion ?? '') === 'mueble' ? 'selected' : '' ?>>Mueble</option>
    </select><br>

    <button type="submit"><?= $editar ? 'Guardar Cambios' : 'Añadir Cómic' ?></button>
    <?php if ($editar): ?>
        <a href="index.php" style="margin-left:10px;">Cancelar</a>
    <?php endif; ?>
</form>

<hr>

<h2>Mis Cómics</h2>

<!-- Filtros -->
<div id="filtro">
    <input type="text" id="filTitulo" placeholder="Título..." onkeyup="filtrar()">
    <select id="filEstado" onchange="filtrar()">
        <option value="">Todos los estados</option>
        <option value="pendiente de leer">Pendiente</option>
        <option value="leyendo">Leyendo</option>
        <option value="leído">Leído</option>
    </select>
    <select id="filLocalizacion" onchange="filtrar()">
        <option value="">Todas las ubicaciones</option>
        <option value="estanteria1">Estantería 1</option>
        <option value="estanteria2">Estantería 2</option>
        <option value="mueble">Mueble</option>
    </select>
</div>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Estado</th>
        <th>Prestado</th>
        <th>Ubicación</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($comics as $comic): ?>
    <tr>
        <td><?= htmlspecialchars($comic->titulo) ?></td>
        <td><?= htmlspecialchars($comic->autor) ?></td>
        <td><?= htmlspecialchars($comic->estado) ?></td>
        <td><?= $comic->prestado ? 'Sí' : 'No' ?></td>
        <td><?= htmlspecialchars($comic->localizacion) ?></td>
        <td>
            <a href="index.php?editar=<?= $comic->id ?>" style="color:blue;">Editar</a>
            <form method="post" action="../app/funciones.php" style="display:inline;" onsubmit="return confirm('¿Eliminar este cómic?')">
                <input type="hidden" name="action" value="eliminar">
                <input type="hidden" name="id" value="<?= $comic->id ?>">
                <button type="submit" style="color:red; background:none; border:none; cursor:pointer;">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<script src="js/funciones.js"></script>
</body>
</html>