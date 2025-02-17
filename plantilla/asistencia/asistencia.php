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

<!-- Agregar esto al final del body -->
<div id="contextMenu" class="context-menu" style="display: none;">
    <div class="menu-item" data-action="Cla">[Cla] Día de Clase</div>
    <div class="menu-item" data-action="Fds">[Fds] Fin de Semana</div>
    <div class="menu-item" data-action="FeN">[FeN] Feriado Nacional</div>
    <div class="menu-item" data-action="FeP">[FeP] Feriado Provincial</div>
    <div class="menu-item" data-action="AsN">[AsN] Asueto Nacional</div>
    <div class="menu-item" data-action="AsP">[AsP] Asueto Provincial</div>
    <div class="menu-item" data-action="AsE">[AsE] Asueto Escolar</div>
    <div class="menu-item" data-action="RaI">[RaI] Razones Institucionales</div>
    <div class="menu-item" data-action="PaN">[PaN] Paro Nacional</div>
    <div class="menu-item" data-action="PaP">[PaP] Paro Provincial</div>
    <div class="menu-item" data-action="ReV">[ReV] Receso de Verano</div>
    <div class="menu-item" data-action="ReI">[ReI] Receso de Invierno</div>
    <div class="menu-item" data-action="Ef">[Ef] Exámenes Finales</div>
    <div class="menu-item" data-action="JdE">[JdE] Jornada de Estudio</div>
    <div class="menu-item" data-action="PG">[P] Presente Global</div>
</div>

<div id="contextMenuDia" class="context-menu" style="display: none;">
    
</div>

<style>
.column-hover {
    background-color: rgba(0, 123, 255, 0.1) !important;
}

.attendance-table th {
    cursor: context-menu;
    position: relative;
}
.context-menu {
    position: fixed;
    z-index: 1000;
    background: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
    padding: 5px 0;
    max-height: 80vh; /* límite de altura */
    overflow-y: auto; /* scroll si es necesario */
}

.cell-highlight {
    position: relative;
    z-index: 999;
    outline: 2px solid #007bff;
}

.menu-item {
    padding: 8px 15px;
    cursor: pointer;
    font-size: 14px;
}

.menu-item:hover {
    background-color: #f0f0f0;
}

.attendance-table th {
    cursor: context-menu;
}
</style>

<?php include "plantilla/asistencia/asistencia_script.php"; ?>