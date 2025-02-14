<div class="card-body">
    <div class="attendance-container">
        <!-- Header Controls -->
        <div class="controls-header mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <select class="form-control" id="ciclo_padron_alum"  name="ciclo">
                        <option value="">Seleccione Ciclo</option>
                        <option value="INI">INI</option>
                        <option value="PRI">PRI</option>
                        <option value="SEC">SEC</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" name="curso" id="curso_padron_alum" aria-label="Curso">
                        <option value="">Seleccione Curso</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" id="mes">
                        <option value="">Selecciona un mes</option>
                        <!-- Más opciones -->
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" id="anio_alum">
                        <option value="">Seleccione un año</option>
                        <!-- Más opciones -->
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" id="turno">
                        <option value="">Seleccione un Turno</option>
                        <option value="contra_turno">Contra Turno</option>
                        <option value="turno">Turno</option>
                        <!-- Más opciones -->
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-primary">Imprimir Planilla</button>
                </div>
            </div>
        </div>

        <!-- Attendance Grid -->
        <div id="contenido_tabla_asistencia">
            <!-- Aquí se generará dinámicamente la tabla -->
        </div>
    </div>
</div>
<?php include "plantilla/asistencia/asistencia_script.php"; ?>