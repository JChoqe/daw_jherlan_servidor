// Filtracion dinamica en la tabla html, AJAX
function filtrar() {
    const titulo = document.getElementById('filTitulo').value.toLowerCase().trim();
    const estado = document.getElementById('filEstado').value;
    const localizacion = document.getElementById('filLocalizacion').value;

    const filas = document.querySelectorAll('table tbody tr');

    filas.forEach(fila => {
        const cols = fila.querySelectorAll('td');
        const tit = cols[0].textContent.toLowerCase();
        const est = cols[2].textContent.trim();
        const loc = cols[4].textContent;
        // Si la cumple los filtros (true false).
        const mostrar = 
            (titulo === '' || tit.includes(titulo)) &&
            (estado === '' || est === estado) &&
            (localizacion === '' || loc === localizacion);
        // mostrar las filas que cumplan las condiciones: fila visible u ocultar
        fila.style.display = mostrar ? '' : 'none';
    });
}