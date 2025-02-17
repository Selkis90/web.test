// Evitar que el usuario vuelva a la página de login después de iniciar sesión
if (window.history.replaceState) {
  window.history.replaceState(null, "", window.location.href);
}
