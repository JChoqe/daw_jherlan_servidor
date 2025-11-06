<?php
// Archivo funciones.php solo una vez
require_once "../app/funciones.php";
// Guardo todos los la lista de Comics en esta variable. Es caso de vacío, asigno un array vacío.
$comics = listarComics() ? : [];
$editar = null;
// Tanto mensaje como error recoge un parametro en caso de no existir se asigan cadena vacia.
$mensaje = $_GET['msg'] ?? '';
$error = $_GET['error'] ?? '';

// Devuelve true si existe la URL
if (isset($_GET['editar'])) {
    // Convierte en entero el comic que queremos editar
    $id = (int)$_GET['editar'];
    // Buscar comic por id
    foreach ($comics as $comic) {
        if ($comic->id == $id) {
            $editar = $comic;
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
    <script src="js/funciones.js" defer></script>
</head>
<body>

<div class="container">

    <h1>Gestor de Cómics</h1>
    
    <!-- Mensajes (Guardado correctamente) y Errores(Para que no dejen espacios en blanco) -->
    <?php if ($mensaje): ?>
        <p class="success">¡Cómic guardado correctamente!</p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="error">Todos los campos son obligatorios.</p>
    <?php endif; ?>
    
    <form method="post" action="../app/funciones.php" class="form-comic">
        
        <!-- Cuadno se quiere editar value será guardar(editar), si no añadir, que pasara a funciones.php -->
        <input type="hidden" name="action" value="<?= $editar ? 'guardar' : 'anadir' ?>">
        <?php
            if ($editar): ?>  <!-- En caso de editar pasamos el id del comic que vamos a editar a funcion.php-->
            <input type="hidden" name="id" value="<?= $editar->id ?>">
        <?php endif; ?>
        <!-- el htmlspecialchars es para evitar inyecciones de codigo -->
        <label>Título:</label> <!-- Muestra el título del cómic si estamos editando uno; si no, deja el campo vacío. -->
        <input type="text" name="titulo" value="<?= htmlspecialchars($editar->titulo ?? '') ?>">

        <label>Autor:</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($editar->autor ?? '') ?>">

        <label>Estado:</label>
        <select name="estado" required>
            <option value="pendiente de leer" <?= ($editar->estado ?? '') === 'pendiente de leer' ? 'selected' : '' ?>>Pendiente de leer</option>
            <option value="leyendo" <?= ($editar->estado ?? '') === 'leyendo' ? 'selected' : '' ?>>Leyendo</option>
            <option value="leido" <?= ($editar->estado ?? '') === 'leido' ? 'selected' : '' ?>>leido</option>
        </select>

        <label>Prestado:</label>
        <div class="checkbox">
            <input type="checkbox" name="prestado" <?= ($editar->prestado ?? false) ? 'checked' : '' ?>>
            <span>Sí, está prestado</span>
        </div>

        <label>Localización:</label>
        <select name="localizacion" required>
            <option value="estanteria1" <?= ($editar->localizacion ?? '') === 'estanteria1' ? 'selected' : '' ?>>Estantería 1</option>
            <option value="estanteria2" <?= ($editar->localizacion ?? '') === 'estanteria2' ? 'selected' : '' ?>>Estantería 2</option>
            <option value="mueble" <?= ($editar->localizacion ?? '') === 'mueble' ? 'selected' : '' ?>>Mueble</option>
        </select>

        <div class="actions">
            <button type="submit"><?= $editar ? 'Guardar Cambios' : '💾 Añadir Cómic' ?></button>
            <?php if ($editar): ?>
                <a href="index.php" class="btn-cancel">Cancelar</a>
            <?php endif; ?>
        </div>
    </form>

    <hr>

    <h2>Mis Cómics (<?= count($comics) ?>)</h2>

    <div id="filtro">
        <input type="text" id="filTitulo" placeholder="Buscar por título..." onkeyup="filtrar()">
        <select id="filEstado" onchange="filtrar()">
            <option value="">Todos los estados</option>
            <option value="pendiente de leer">Pendiente</option>
            <option value="leyendo">Leyendo</option>
            <option value="leido">leido</option>
        </select>
        <select id="filLocalizacion" onchange="filtrar()">
            <option value="">Todas las ubicaciones</option>
            <option value="estanteria1">Estantería 1</option>
            <option value="estanteria2">Estantería 2</option>
            <option value="mueble">Mueble</option>
        </select>
    </div>

    <?php 
        if (empty($comics)): ?>
        <p style="text-align:center; color:#777;">No hay cómics aún. ¡Añade el primero!</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Estado</th>
                <th>Prestado</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comics as $comic): ?>
            <tr>
                <td><?= htmlspecialchars($comic->titulo) ?></td>
                <td><?= htmlspecialchars($comic->autor) ?></td>
                <td><span class="estado <?= $comic->estado ?>"><?= ucfirst(str_replace(' de ', ' ', $comic->estado)) ?></span></td>
                <td><?= $comic->prestado ? 'Sí' : 'No' ?></td>
                <td><?= htmlspecialchars($comic->localizacion) ?></td>
                <td class="acciones">
                    <a href="index.php?editar=<?= $comic->id ?>" class="edit">Editar</a>
                    <form method="post" action="../app/funciones.php" style="display:inline;" onsubmit="return confirm('¿Seguro que quieres eliminar este cómic?')">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="hidden" name="id" value="<?= $comic->id ?>">
                        <button type="submit" class="delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

</body>
</html>