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
            // Mensaje de error en caso de que algun camso este vacio
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
    // Mensaje de hecho en caso de que la funcion funcione correctamte
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

// Modificar
function modificarComic($titulo, $autor, $estado, $prestado, $localizacion, $id) {
    // __DIR__ constante que devulve la ruta absoluta del directorio donde se encunetra el archivo actual
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    if ($comics === null) return false;

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
    // Para evitar errores por referencia despues
    unset($comic);
    guardarJSON(__DIR__ . '/../data/datos.json', $comics);
    return true;
}

// Eliminar
function eliminarComic($id) {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    if ($comics === null) return false;

    foreach ($comics as $index => $comic) {
        if ($comic->id == $id) {
            unset($comics[$index]);
            break;
        }
    }
    // Reinciar el array para tener indices consecutivos
    $comics = array_values($comics);
    guardarJSON(__DIR__ . '/../data/datos.json', $comics);
    return true;
}

// ID Autoincremental
function generarIdComic($comics): int {
    // Elemento maximno
    $maximo = obtenerElementoMaximo($comics, 'id');
    // Primer id libre
    for ($i = 1; $i <= $maximo + 1; $i++) {
        // Recibe cada comic  comparo su id(filter que devulve un elemento) con la i del array.
        $existe = array_filter($comics, fn($comic) => $comic->id == $i);
        if (empty($existe)) return $i;
    }
    return $maximo + 1;
}

function obtenerElementoMaximo($datos, $propiedad) {
    if (empty($datos)) return null;
    // Para guardar el mayor valor encontrado en el array
    $max = 0;
    // Si el valor es mayor que el maximo se actualiza
    foreach ($datos as $item) {
        if ($item->$propiedad > $max) $max = $item->$propiedad;
    }
    return $max;
}

// ─── Listar con filtro ─────────────────────────────────────
function listarComics($titulo = '', $estado = '', $localizacion = '') {
    $comics = cargarJSON(__DIR__ . '/../data/datos.json');
    // Error o datos vacios
    if ($comics === false) return [];

    $filtrados = array_filter($comics, fn($comic) => //Funcion flecha , devuleve true o flase
        // Si titulo esta vacio, no filtra, pero si tiene contenido filtra sin importar mayusculas o minusculas
        ($titulo === '' || stripos($comic->titulo, $titulo) !== false) &&
        // Si no tiene estado, no filtra en caso caso contrario si y tiene que coincidir exactamente
        ($estado === '' || $comic->estado === $estado) && 
        ($localizacion === '' || $comic->localizacion === $localizacion)
    );
    return $filtrados;
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