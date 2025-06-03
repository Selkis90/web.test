<?php
require_once '../config/sesion.php';
require_once '../header.php';

?>

<!-- news section start -->
<div class="container py-5">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h2 class="text-center mb-4">Formulario de Activación</h2>
            <form action="/app.php?controller=activaciones&action=store" method="POST">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="fecha_activacion" class="form-label">Fecha de Activación</label>
                        <input type="date" class="form-control" id="fecha_activacion" name="fecha_activacion"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="hora_activacion_caso" class="form-label">Hora de Activación de Caso</label>
                        <input type="time" class="form-control" id="hora_activacion_caso"
                            name="hora_activacion_caso" required>
                    </div>

                    <div class="col-md-6">
                        <label for="trabajador" class="form-label">Trabajador</label>
                        <input type="text" class="form-control" id="trabajador" name="trabajador" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                        <br>
                        <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                            <option value="">Seleccione...</option>
                            <option value="ti">Tarjeta de Identidad</option>
                            <option value="cc">Cédula de Ciudadanía</option>
                            <option value="ppt">Permiso por Protección Temporal (PPT)</option>
                            <option value="pep">Permiso Especial de Permanencia (PEP)</option>
                            <option value="ce">Cédula de Extranjería</option>
                            <option value="visa">Visa</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="identificacion" class="form-label">Identificación</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                    </div>

                    <div class="col-md-6">
                        <label for="departamentos" class="form-label">Ciudad</label>
                        <select id="departamentos" name="ciudad" class="form-control"
                            onchange="actualizarMunicipios()" required>
                            <option value="">Seleccione una Ciudad...</option>
                            <!-- Los departamentos se generan desde el archivo JavaScript -->
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="municipios" class="form-label">Departamento</label>
                        <select id="municipios" name="departamento" class="form-control" required>
                            <option value="">Selecciona primero una Ciudad</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="ips" class="form-label">IPS</label>
                        <input type="text" class="form-control" id="ips" name="ips" required>
                    </div>

                    <div class="col-md-6">
                        <label for="servicio_prestado_inicial" class="form-label">Servicio Prestado Inicial</label>
                        <input type="text" class="form-control" id="servicio_prestado_inicial"
                            name="servicio_prestado_inicial" required>
                    </div>

                    <div class="col-md-6">
                        <label for="rlp" class="form-label">RLP</label>
                        <br>
                        <select class="form-select" id="rlp" name="rlp" required>
                            <option value="">Seleccione...</option>
                            <option value="0">RLP ESPECIAL </option>
                            <option value="1">RLP SI </option>
                            <option value="2">NO AMEEC</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="medicamentos" class="form-label">Medicamentos</label>
                        <input type="text" class="form-control" id="medicamentos" name="medicamentos" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_medicamento" class="form-label">Tipo de Medicamento</label>
                        <input type="text" class="form-control" id="tipo_medicamento" name="tipo_medicamento"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" required>
                    </div>

                    <div class="col-md-6">
                        <label for="numero_afiliacion" class="form-label">Número de Afiliación</label>
                        <input type="text" class="form-control" id="numero_afiliacion" name="numero_afiliacion"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="pae" class="form-label">PAE</label>
                        <input type="text" class="form-control" id="pae" name="pae" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_pae" class="form-label">Tipo de PAE</label>
                        <br>
                        <select class="form-select" id="tipo_pae" name="tipo_pae" required>
                            <option value="">Seleccione...</option>
                            <option value="0">AUXILIAR ADMINISTRATIVO </option>
                            <option value="1">PAE 1</option>
                            <option value="2">PAE 2</option>
                            <option value="3">PAE 3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ubicacion_pae" class="form-label">Ubicación del PAE</label>
                        <input type="text" class="form-control" id="ubicacion_pae" name="ubicacion_pae" required>
                    </div>

                    <div class="col-md-6">
                        <label for="jornada_activacion" class="form-label">Jornada de Activación</label>
                        <input type="text" class="form-control" id="jornada_activacion" name="jornada_activacion"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_pae" class="form-label">Activación Presencial</label>
                        <br>
                        <select class="form-select" id="activacion_presencial" name="activacion_presencial" required>
                            <option value="">Seleccione...</option>
                            <option value="0">SI</option>
                            <option value="1">NO</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="hora_activacion_pae" class="form-label">Hora de Activación del PAE</label>
                        <input type="time" class="form-control" id="hora_activacion_pae" name="hora_activacion_pae"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="tiempo_respuesta_sacs" class="form-label">Tiempo de Respuesta SACS</label>
                        <input type="text" class="form-control" id="tiempo_respuesta_sacs"
                            name="tiempo_respuesta_sacs" required>
                    </div>

                    <div class="col-md-6">
                        <label for="hora_llegada_pae_ips" class="form-label">Hora de Llegada del PAE al Lugar
                            (IPS)</label>
                        <input type="time" class="form-control" id="hora_llegada_pae_ips"
                            name="hora_llegada_pae_ips" required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Guardar Activación</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
<!-- news section end -->



<?php
require_once '../footer.php';
?>