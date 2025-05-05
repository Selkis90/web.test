// Cargar departamentos al cargar la página
document.addEventListener("DOMContentLoaded", cargarDepartamentos);

function cargarDepartamentos() {
  const selectDepartamentos = document.getElementById("departamentos");

  for (const departamento in municipiosPorDepartamento) {
    const option = document.createElement("option");
    option.value = departamento;
    option.textContent = departamento;
    selectDepartamentos.appendChild(option);
  }
}

function actualizarMunicipios() {
  const selectDepartamentos = document.getElementById("departamentos");
  const selectMunicipios = document.getElementById("municipios");
  const departamentoSeleccionado = selectDepartamentos.value;

  // Limpiar municipios anteriores
  selectMunicipios.innerHTML = "";

  if (
    departamentoSeleccionado &&
    municipiosPorDepartamento[departamentoSeleccionado]
  ) {
    const municipios = municipiosPorDepartamento[departamentoSeleccionado];
    municipios.forEach((municipio) => {
      const option = document.createElement("option");
      option.value = municipio;
      option.textContent = municipio;
      selectMunicipios.appendChild(option);
    });
  } else {
    const option = document.createElement("option");
    option.value = "";
    option.textContent = "Selecciona primero un departamento";
    selectMunicipios.appendChild(option);
  }
}
