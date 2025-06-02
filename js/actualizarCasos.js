const casos = [
  { cedula: "1127602548", nombre: "LAURA JULIANA MALDONADO ROJAS" },
  { cedula: "1000620180", nombre: "ANNA MARIA ABRIL PAEZ" },
  { cedula: "1098805415", nombre: "DIANA CAROLINA MACHUCA GALVAN" },
  { cedula: "79619657", nombre: "JUAN FANDINO PARRA" },
  { cedula: "18881673", nombre: "WILMER ANTONIO MARTINEZ VILLALBA" },
  { cedula: "42694425", nombre: "YANETH VIVIANA RESTREPO CARMONA" },
  { cedula: "12345678", nombre: "EJEMPLO 7" },
  { cedula: "23456789", nombre: "EJEMPLO 8" },
  { cedula: "34567890", nombre: "EJEMPLO 9" },
  { cedula: "45678901", nombre: "EJEMPLO 10" },
  { cedula: "56789012", nombre: "EJEMPLO 11" },
  { cedula: "67890123", nombre: "EJEMPLO 12" },
  { cedula: "78901234", nombre: "EJEMPLO 13" },
  { cedula: "89012345", nombre: "EJEMPLO 14" },
  { cedula: "90123456", nombre: "EJEMPLO 15" },
];

const casosPorPagina = 10;
let paginaActual = 1;

function mostrarCasos(pagina) {
  const inicio = (pagina - 1) * casosPorPagina;
  const fin = inicio + casosPorPagina;
  const casosPagina = casos.slice(inicio, fin);

  const lista = document.getElementById("casos-list");
  lista.innerHTML = "";

  casosPagina.forEach((caso, i) => {
    const numeroCaso = inicio + i + 1;

    const casoHTML = `
  <div class="card shadow-sm border-0 rounded-4 p-4 bg-white mb-4 mx-2">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div>
        <div class="text-uppercase text-primary small fw-semibold mb-1">Caso #${numeroCaso}</div>
        <div class="fs-5 fw-bold text-dark mb-1">${caso.nombre}</div>
        <div class="text-secondary small">Cédula: <span class="fw-medium">${caso.cedula}</span></div>
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

  // Botón Anterior
  const botonAnterior = document.createElement("button");
  botonAnterior.textContent = "Anterior";
  botonAnterior.className = "btn btn-outline-primary";
  botonAnterior.disabled = paginaActual === 1;
  botonAnterior.addEventListener("click", () =>
    cambiarPagina(paginaActual - 1)
  );
  contenedor.appendChild(botonAnterior);

  // Botones de páginas
  for (let i = 1; i <= totalPaginas; i++) {
    const botonPagina = document.createElement("button");
    botonPagina.textContent = i;
    botonPagina.className =
      "btn " + (paginaActual === i ? "btn-primary" : "btn-outline-primary");
    botonPagina.addEventListener("click", () => cambiarPagina(i));
    contenedor.appendChild(botonPagina);
  }

  // Botón Siguiente
  const botonSiguiente = document.createElement("button");
  botonSiguiente.textContent = "Siguiente";
  botonSiguiente.className = "btn btn-outline-primary";
  botonSiguiente.disabled = paginaActual === totalPaginas;
  botonSiguiente.addEventListener("click", () =>
    cambiarPagina(paginaActual + 1)
  );
  contenedor.appendChild(botonSiguiente);
}

function cambiarPagina(pagina) {
  const totalPaginas = Math.ceil(casos.length / casosPorPagina);
  if (pagina < 1 || pagina > totalPaginas) return;

  paginaActual = pagina;
  mostrarCasos(paginaActual);
  crearPaginacion();
}

window.onload = () => {
  mostrarCasos(paginaActual);
  crearPaginacion();
};
