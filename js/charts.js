// Función para generar colores dinámicos
function generateColors(count) {
    const colors = [];
    for (let i = 0; i < count; i++) {
        const r = Math.floor(Math.random() * 255); // Rojo aleatorio
        const g = Math.floor(Math.random() * 255); // Verde aleatorio
        const b = Math.floor(Math.random() * 255); // Azul aleatorio
        colors.push(`rgba(${r}, ${g}, ${b}, 0.6)`); // Color con opacidad
    }
    return colors;
}

// Función para renderizar una gráfica de barras
function renderBarChart(canvasId, labels, data) {
    // Validar si el canvas existe
    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) {
        console.error(`Canvas con ID "${canvasId}" no encontrado.`);
        return;
    }

    // Validar si los datos son arreglos no vacíos
    if (!Array.isArray(labels) || labels.length === 0) {
        console.error('El parámetro "labels" debe ser un arreglo no vacío.');
        return;
    }
    if (!Array.isArray(data) || data.length === 0) {
        console.error('El parámetro "data" debe ser un arreglo no vacío.');
        return;
    }

    // Generar colores dinámicamente
    const colors = generateColors(data.length);

    // Crear la gráfica
    const ctx = canvasElement.getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // Etiquetas (eje x)
            datasets: [{
                label: 'Activaciones', // Etiqueta del dataset
                data: data, // Valores (eje y)
                backgroundColor: colors, // Colores de las barras
                borderColor: colors.map(color => color.replace('0.6', '1')), // Bordes (opacidad 1)
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, // Gráfica adaptable al tamaño del contenedor
            scales: {
                y: {
                    beginAtZero: true // Iniciar eje y desde 0
                }
            }
        }
    });
}

// Función para renderizar una gráfica de pastel
function renderPieChart(canvasId, labels, data) {
    // Validar si el canvas existe
    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) {
        console.error(`Canvas con ID "${canvasId}" no encontrado.`);
        return;
    }

    // Validar si los datos son arreglos no vacíos
    if (!Array.isArray(labels) || labels.length === 0) {
        console.error('El parámetro "labels" debe ser un arreglo no vacío.');
        return;
    }
    if (!Array.isArray(data) || data.length === 0) {
        console.error('El parámetro "data" debe ser un arreglo no vacío.');
        return;
    }

    // Generar colores dinámicamente
    const colors = generateColors(data.length);

    // Crear la gráfica
    const ctx = canvasElement.getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels, // Etiquetas (categorías)
            datasets: [{
                data: data, // Valores (secciones del pastel)
                backgroundColor: colors // Colores de las secciones
            }]
        },
        options: {
            responsive: true // Gráfica adaptable al tamaño del contenedor
        }
    });
}