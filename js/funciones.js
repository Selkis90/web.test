document.addEventListener("DOMContentLoaded", function () {
    const campo = document.getElementById("dx_cie10");
    const error = document.getElementById("cie10_error");

    if (campo) {
        campo.addEventListener("input", function () {
            validarCIE10(campo, error);
        });
    }
});

function validarCIE10(campo, error) {
    const valor = campo.value;

    const regex = /^[A-Za-z0-9]{0,5}$/;

    if (!regex.test(valor)) {
        error.style.display = "block";
        campo.classList.add("is-invalid");
    } else {
        error.style.display = "none";
        campo.classList.remove("is-invalid");
    }
}
