<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrarse</title>
    <script src="../js/register.js" defer></script>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Registrar nuevo usuario</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="registerForm" class="bg-light p-4 rounded shadow">
                    <!-- Campo de nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de usuario:</label>
                        <input type="text" id="nombre" class="form-control" required>
                    </div>

                    <!-- Campo de correo -->
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico:</label>
                        <input type="email" id="correo" class="form-control" required>
                    </div>

                    <!-- Campo de teléfono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" id="telefono" class="form-control" required>
                    </div>

                    <!-- Campo de contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" id="password" class="form-control" required>
                    </div>

                    <!-- Campo para confirmar contraseña -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar contraseña:</label>
                        <input type="password" id="confirmPassword" class="form-control" required>
                    </div>

                    <!-- Botón de registro -->
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </form>

                <!-- Mensaje para mostrar errores o éxito -->
                <p id="message" class="mt-3 text-danger"></p>
            </div>
        </div>
    </div>

    <script>
        // Validación de contraseñas en el frontend
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita el envío del formulario si hay errores

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const message = document.getElementById('message');

            // Validar que las contraseñas coincidan
            if (password !== confirmPassword) {
                message.textContent = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
            } else {
                message.textContent = '';
                // Aquí podrías enviar el formulario si las contraseñas coinciden
                alert('Registro exitoso');
                // this.submit(); // Descomentar si necesitas enviar el formulario
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>
