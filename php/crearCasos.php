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

                    <br>

                    <div class="col-md-6">
                        <label for="servicio_prestado_inicial" class="form-label">Servicio Prestado Inicial</label>
                        <br>
                        <select class="form-select" id="servicio_prestado_inicial" name="servicio_prestado_inicial" required>
                            <option value="">Seleccione...</option>
                            <option value="MEDICO A EMPRESA" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'MEDICO A EMPRESA') ? 'selected' : '' ?>>MEDICO A EMPRESA</option>
                            <option value="URGENCIAS" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'URGENCIAS') ? 'selected' : '' ?>>URGENCIAS</option>
                            <option value="TELECONSULTA" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'TELECONSULTA') ? 'selected' : '' ?>>TELECONSULTA</option>
                            <option value="SEGUIMIENTO 24 HORAS" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'SEGUIMIENTO 24 HORAS') ? 'selected' : '' ?>>SEGUIMIENTO 24 HORAS</option>
                            <option value="HOSPITALIZACION" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'HOSPITALIZACION') ? 'selected' : '' ?>>HOSPITALIZACION</option>
                            <option value="CONSULTA ML" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'CONSULTA ML') ? 'selected' : '' ?>>CONSULTA ML</option>
                            <option value="SIMULACRO/URGENCIAS" <?= (isset($detalle['servicio_prestado_inicial']) && $detalle['servicio_prestado_inicial'] == 'SIMULACRO/URGENCIAS') ? 'selected' : '' ?>>SIMULACRO/URGENCIAS</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label for="rlp" class="form-label">RLP</label>
                        <br>
                        <select class="form-select" id="rlp" name="rlp" required>
                            <option value="">Seleccione...</option>
                            <option value="ESPECIAL">RLP ESPECIAL</option>
                            <option value="SI">RLP SI</option>
                            <option value="NO">NO AMEEC</option>
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
                        <br>
                        <select class="form-select" id="pae" name="pae" required>
                            <option value="">Seleccione...</option>
                            <option value="BRAYAN MERCADO">BRAYAN MERCADO</option>
                            <option value="ELIATRIZ GOMEZ">ELIATRIZ GOMEZ</option>
                            <option value="ANGIE CASTRO">ANGIE CASTRO</option>
                            <option value="CESAR JOAQUIN CARVAJAL ZUÑIGA">CESAR JOAQUIN CARVAJAL ZUÑIGA</option>
                            <option value="EDUARDO GONZALEZ">EDUARDO GONZALEZ</option>
                            <option value="LEIDY RICO">LEIDY RICO</option>
                            <option value="FRANCISCO ZUÑIGA">FRANCISCO ZUÑIGA</option>
                            <option value="GLENIS MUNIRA CARRILLO">GLENIS MUNIRA CARRILLO</option>
                            <option value="HERNAN DARIO HERNANDEZ SANTACOLOMA">HERNAN DARIO HERNANDEZ SANTACOLOMA</option>
                            <option value="IVAN LOZANO">IVAN LOZANO</option>
                            <option value="JENNIFER GUZMAN">JENNIFER GUZMAN</option>
                            <option value="JESSICA CHIRAN">JESSICA CHIRAN</option>
                            <option value="JORGE ARMANDO ARDILA PEINADO">JORGE ARMANDO ARDILA PEINADO</option>
                            <option value="TATIANA MORENO">TATIANA MORENO</option>
                            <option value="MONICA SALAZAR">MONICA SALAZAR</option>
                            <option value="YECFRI RUIZ">YECFRI RUIZ</option>
                            <option value="SERGIO VARGAS">SERGIO VARGAS</option>
                            <option value="LINA TRUJILLO">LINA TRUJILLO</option>
                            <option value="LINA LINERO">LINA LINERO</option>
                            <option value="YUDEX VERGARA">YUDEX VERGARA</option>
                            <option value="OLGA CUELLO">OLGA CUELLO</option>
                            <option value="JULIANA VIVAS">JULIANA VIVAS</option>
                            <option value="JACKELINE LONDOÑO">JACKELINE LONDOÑO</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_pae" class="form-label">Tipo de PAE</label>
                        <br>
                        <select class="form-select" id="tipo_pae" name="tipo_pae" required>
                            <option value="">Seleccione...</option>
                            <option value="AUXILIAR ADMINISTRATIVO">AUXILIAR ADMINISTRATIVO </option>
                            <option value="PAE 1">PAE 1</option>
                            <option value="PAE 2">PAE 2</option>
                            <option value="PAE 3">PAE 3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ubicacion_pae" class="form-label">Ubicación del PAE</label>
                        <input type="text" class="form-control" id="ubicacion_pae" name="ubicacion_pae" required>
                    </div>

                    <div class="col-md-6">
                        <label for="jornada_activacion" class="form-label">Jornada de Activación</label>
                        <br>
                        <select class="form-select" id="jornada_activacion" name="jornada_activacion" required>
                            <option value="">Seleccione...</option>
                            <option value="TARDE 12:01 - 20:59" <?= (isset($detalle['jornada_activacion']) && $detalle['jornada_activacion'] == 'TARDE 12:01 - 20:59') ? 'selected' : '' ?>>TARDE 12:01 - 20:59</option>
                            <option value="MAÑANA 06 AM-12 M" <?= (isset($detalle['jornada_activacion']) && $detalle['jornada_activacion'] == 'MAÑANA 06 AM-12 M') ? 'selected' : '' ?>>MAÑANA 06 AM-12 M</option>
                            <option value="NOCTURNA 21:00 - 5:59 AM" <?= (isset($detalle['jornada_activacion']) && $detalle['jornada_activacion'] == 'NOCTURNA 21:00 - 5:59 AM') ? 'selected' : '' ?>>NOCTURNA 21:00 - 5:59 AM</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label for="tipo_pae" class="form-label">Activación Presencial</label>
                        <br>
                        <select class="form-select" id="activacion_presencial" name="activacion_presencial" required>
                            <option value="">Seleccione...</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label for="hora_activacion_pae" class="form-label">Hora de Activación del PAE</label>
                        <input type="time" class="form-control" id="hora_activacion_pae" name="hora_activacion_pae"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="tiempo_respuesta_sacs" class="form-label">Tiempo de Respuesta SACS</label>
                        <input type="time" class="form-control" id="tiempo_respuesta_sacs"
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