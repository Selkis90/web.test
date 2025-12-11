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

// ✅ Función mejorada para renderizar una gráfica de barras
function renderBarChart(canvasId, labels, data, multiple = false) {
    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) {
        console.error(`Canvas con ID "${canvasId}" no encontrado.`);
        return;
    }

    if (!Array.isArray(labels) || labels.length === 0) {
        console.error('El parámetro "labels" debe ser un arreglo no vacío.');
        return;
    }

    const ctx = canvasElement.getContext('2d');

    let datasets = [];

    if (multiple) {
        // Múltiples datasets (grupos)
        if (!Array.isArray(data) || !data.every(arr => Array.isArray(arr))) {
            console.error('El parámetro "data" debe ser un arreglo de arreglos.');
            return;
        }

        const defaultLabels = ['Grupo 1', 'Grupo 2', 'Grupo 3'];
        datasets = data.map((dataset, index) => {
            const colors = generateColors(dataset.length);
            return {
                label: defaultLabels[index] || `Grupo ${index + 1}`,
                data: dataset,
                backgroundColor: colors[0],
                borderColor: colors[0].replace('0.6', '1'),
                borderWidth: 1
            };
        });
    } else {
        // Un solo dataset
        if (!Array.isArray(data) || data.length === 0) {
            console.error('El parámetro "data" debe ser un arreglo no vacío.');
            return;
        }

        const colors = generateColors(data.length);
        datasets = [{
            label: 'Activaciones',
            data: data,
            backgroundColor: colors,
            borderColor: colors.map(color => color.replace('0.6', '1')),
            borderWidth: 1
        }];
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Función para renderizar una gráfica de pastel
function renderPieChart(canvasId, labels, data) {
    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) {
        console.error(`Canvas con ID "${canvasId}" no encontrado.`);
        return;
    }

    if (!Array.isArray(labels) || labels.length === 0) {
        console.error('El parámetro "labels" debe ser un arreglo no vacío.');
        return;
    }
    if (!Array.isArray(data) || data.length === 0) {
        console.error('El parámetro "data" debe ser un arreglo no vacío.');
        return;
    }

    const colors = generateColors(data.length);

    const ctx = canvasElement.getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true
        }
    });
}
