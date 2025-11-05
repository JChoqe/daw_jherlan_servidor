<?php

// Controlador
//¿Se ha enviado el formulario?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la accion del query string
    $accion = $_POST['action'] ?? '';

    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $estado = $_POST['estado'] ?? '';
    $prestado = isset($_POST['prestado']);
    $localizacion = $_POST['localizacion'] ?? '';
    $id = $_POST['id'] ?? '';

    // Validación básica
    if ($accion === 'anadir' || $accion === 'guardar') {
        if (empty($titulo) || empty($autor) || empty($estado) || empty($localizacion)) {
            header('Location: ../public/index.php?error=1');
            exit();
        }
    }

    switch ($accion) {
        case 'guardar':
            modificarComic($titulo, $autor, $estado, $prestado, $localizacion, $id);
            break;

        case 'eliminar':
            eliminarComic($id);
            break;

        case 'anadir':
            anadirComic($titulo, $autor, $estado, $prestado, $localizacion);
            break;
    }

    header('Location: ../public/index.php?msg=1');
    exit();
}

// ─── Crear Comic ────────────────────────────────────────────
function anadirComic($titulo, $autor, $estado, $prestado, $localizacion) {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    $id = generarIdComic($comics);

    $nuevoComic = (object)[
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'estado' => $estado,
        'prestado' => $prestado,
        'localizacion' => $localizacion
    ];

    $comics[] = $nuevoComic;
    return guardarJSON(__DIR__ . '/../data/datos.json', $comics);
}

// ─── Modificar ──────────────────────────────────────────────
function modificarComic($titulo, $autor, $estado, $prestado, $localizacion, $id) {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    if ($comics === false) return false;

    foreach ($comics as &$comic) {
        if ($comic->id == $id) {
            $comic->titulo = $titulo;
            $comic->autor = $autor;
            $comic->estado = $estado;
            $comic->prestado = $prestado;
            $comic->localizacion = $localizacion;
            break;
        }
    }
    unset($comic);
    return guardarJSON(__DIR__ . '/../data/datos.json', $comics);
}

// ─── Eliminar ──────────────────────────────────────────────
function eliminarComic($id) {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    if ($comics === false) return false;

    foreach ($comics as $index => $comic) {
        if ($comic->id == $id) {
            unset($comics[$index]);
            break;
        }
    }

    $comics = array_values($comics);
    return guardarJSON(__DIR__ . '/../data/datos.json', $comics);
}

// ─── ID Autoincremental ────────────────────────────────────
function generarIdComic($comics): int {
    $maximo = obtenerElementoMaximo($comics, 'id');
    for ($i = 1; $i <= $maximo + 1; $i++) {
        $existe = array_filter($comics, fn($c) => $c->id == $i);
        if (empty($existe)) return $i;
    }
    return $maximo + 1;
}

function obtenerElementoMaximo($datos, $propiedad) {
    if (empty($datos)) return 0;
    $max = 0;
    foreach ($datos as $item) {
        if ($item->$propiedad > $max) $max = $item->$propiedad;
    }
    return $max;
}

// ─── Listar con filtro ─────────────────────────────────────
function listarComics($titulo = '', $estado = '', $localizacion = '') {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    if ($comics === false) return [];

    return array_filter($comics, function ($comic) use ($titulo, $estado, $localizacion) {
        $okTitulo = $titulo === '' || stripos($comic->titulo, $titulo) !== false;
        $okEstado = $estado === '' || $comic->estado === $estado;
        $okLocalizacion = $localizacion === '' || $comic->localizacion === $localizacion;
        return $okTitulo && $okEstado && $okLocalizacion;
    });
}

// ─── JSON Helpers ──────────────────────────────────────────
function cargarJSON($ruta) {
    if (!file_exists($ruta)) return [];
    $data = file_get_contents($ruta);
    $decoded = json_decode($data);
    return is_array($decoded) ? $decoded : [];
}

function guardarJSON($ruta, $data) {
    return file_put_contents($ruta, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}