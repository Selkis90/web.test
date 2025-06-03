let casos = [];
const casosPorPagina = 10;
let paginaActual = 1;

const inputCedula = document.getElementById("inputCedula");
const inputAfiliaciones = document.getElementById("inputAfiliaciones");

function mostrarCasos(pagina) {
  const inicio = (pagina - 1) * casosPorPagina;
  const fin = inicio + casosPorPagina;
  const casosPagina = casos.slice(inicio, fin);

  const lista = document.getElementById("casos-list");
  lista.innerHTML = "";

  if (casosPagina.length === 0) {
    lista.innerHTML = '<div class="alert alert-warning">No se encontraron casos.</div>';
    return;
  }

  casosPagina.forEach((caso, i) => {
    const numeroCaso = inicio + i + 1;

    const casoHTML = `
      <div class="card shadow-sm border-0 rounded-4 p-4 bg-white mb-4 mx-2">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
          <div>
            <div class="text-uppercase text-primary small fw-semibold mb-1">Caso #${numeroCaso}</div>
            <div class="fs-5 fw-bold text-dark mb-1">${caso.nombre}</div>
            <div class="text-secondary small">Cédula: <span class="fw-medium">${caso.cedula}</span></div>
            <div class="text-secondary small">Afiliación: <span class="fw-medium">${caso.afiliacion}</span></div>
          </div>
          <div>
            <button class="btn btn-sm btn-primary rounded-pill px-4">Ver Detalles</button>
          </div>
        </div>
      </div>
    `;

    lista.insertAdjacentHTML("beforeend", casoHTML);
  });
}

function crearPaginacion() {
  const totalPaginas = Math.ceil(casos.length / casosPorPagina);
  const contenedor = document.getElementById("pagination");
  contenedor.innerHTML = "";

  const botonAnterior = document.createElement("button");
  botonAnterior.textContent = "Anterior";
  botonAnterior.className = "btn btn-outline-primary";
  botonAnterior.disabled = paginaActual === 1;
  botonAnterior.addEventListener("click", () => cambiarPagina(paginaActual - 1));
  contenedor.appendChild(botonAnterior);

  for (let i = 1; i <= totalPaginas; i++) {
    const botonPagina = document.createElement("button");
    botonPagina.textContent = i;
    botonPagina.className = "btn " + (paginaActual === i ? "btn-primary" : "btn-outline-primary");
    botonPagina.addEventListener("click", () => cambiarPagina(i));
    contenedor.appendChild(botonPagina);
  }

  const botonSiguiente = document.createElement("button");
  botonSiguiente.textContent = "Siguiente";
  botonSiguiente.className = "btn btn-outline-primary";
  botonSiguiente.disabled = paginaActual === totalPaginas;
  botonSiguiente.addEventListener("click", () => cambiarPagina(paginaActual + 1));
  contenedor.appendChild(botonSiguiente);
}

function cambiarPagina(pagina) {
  const totalPaginas = Math.ceil(casos.length / casosPorPagina);
  if (pagina < 1 || pagina > totalPaginas) return;

  paginaActual = pagina;
  mostrarCasos(paginaActual);
  crearPaginacion();
}

async function obtenerCasosFiltrados() {
  const cedula = inputCedula.value.trim();
  const afiliacion = inputAfiliaciones.value.trim();

  const params = new URLSearchParams();
  if (cedula) params.append('cedula', cedula);
  if (afiliacion) params.append('afiliacion', afiliacion);

  try {
    const respuesta = await fetch(`/php/obtener_casos.php?${params.toString()}`);
    casos = await respuesta.json();
    paginaActual = 1;
    mostrarCasos(paginaActual);
    crearPaginacion();
  } catch (error) {
    console.error("Error al cargar los casos:", error);
  }
}

window.onload = async () => {
  await obtenerCasosFiltrados(); // carga inicial
};

// Listeners para búsqueda en tiempo real
inputCedula.addEventListener("input", obtenerCasosFiltrados);
inputAfiliaciones.addEventListener("input", obtenerCasosFiltrados);
