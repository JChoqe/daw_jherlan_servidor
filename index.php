<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona de Trabajo PHP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="card">
        <h1>Bienvenido a mi zona de trabajo PHP</h1>
        <div class="server-line">
            <i class="fas fa-server"></i>
            <span>Servidor <span class="tag">Apache</span> en <span class="tag">XAMPP</span></span>
            <i class="fas fa-check-circle" style="color:#27ae60;"></i>
        </div>
        <p>Entorno listo para <strong>desarrollar</strong>, <strong>aprender</strong> y <strong>experimentar</strong> con PHP.</p>
        <div class="status">
            <i class="fas fa-circle"></i>
            Sistema activo y funcionando
        </div>
    </div>
    <footer>
        <p>Desarrollado con paciencia <span class="coffee">y café</span> —
            <strong>
                <?php
                    setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                    echo date("d/m/Y");
                ?>
            </strong>
        </p>
        <div class="divider"></div>
        <p>© <?php echo date("Y"); ?> Jherlan Choque</p>
    </footer>
</body>
</html>