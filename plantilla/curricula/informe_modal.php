<!-- MODALES DEL SISTEMA DE CURRÍCULA -->

<!-- Modal de Detalle de Materia -->
<div class="modal fade" id="modalDetalleMateria" tabindex="-1" role="dialog" aria-labelledby="modalDetalleMateriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleMateriaLabel">
                    <i class="fas fa-book"></i>
                    Detalle de la Materia
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Código:</strong></label>
                            <p id="detalle-codigo" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Nombre:</strong></label>
                            <p id="detalle-nombre" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Horas Semanales:</strong></label>
                            <p id="detalle-horas" class="form-control-static">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Estado:</strong></label>
                            <p id="detalle-estado" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Tipo:</strong></label>
                            <p id="detalle-tipo" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Área:</strong></label>
                            <p id="detalle-area" class="form-control-static">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <h6><i class="fas fa-align-left"></i> Descripción:</h6>
                        <p id="detalle-descripcion" class="text-muted">-</p>
                    </div>
                </div>
                
                <!-- Pestañas de información adicional -->
                <ul class="nav nav-tabs mt-3" id="detalleTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="docentes-tab" data-toggle="tab" href="#docentes-tab-content" role="tab">
                            <i class="fas fa-users"></i> Docentes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="horarios-tab" data-toggle="tab" href="#horarios-tab-content" role="tab">
                            <i class="fas fa-clock"></i> Horarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos-tab-content" role="tab">
                            <i class="fas fa-tools"></i> Recursos
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content mt-3" id="detalleTabsContent">
                    <div class="tab-pane fade show active" id="docentes-tab-content" role="tabpanel">
                        <div id="modal-docentes-list">
                            <div class="text-center text-muted">
                                <i class="fas fa-user-tie fa-2x"></i>
                                <p>Cargando información de docentes...</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="horarios-tab-content" role="tabpanel">
                        <div id="modal-horarios-list">
                            <div class="text-center text-muted">
                                <i class="fas fa-calendar fa-2x"></i>
                                <p>Cargando horarios...</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="recursos-tab-content" role="tabpanel">
                        <div id="modal-recursos-list">
                            <div class="text-center text-muted">
                                <i class="fas fa-box fa-2x"></i>
                                <p>Cargando recursos...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btn-editar-materia">
                    <i class="fas fa-edit"></i> Editar Materia
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Información del Docente -->
<div class="modal fade" id="modalInfoDocente" tabindex="-1" role="dialog" aria-labelledby="modalInfoDocenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoDocenteLabel">
                    <i class="fas fa-user-tie"></i>
                    Información del Docente
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <div class="docente-avatar">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label><strong>Nombre Completo:</strong></label>
                            <p id="docente-nombre" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Cargo:</strong></label>
                            <p id="docente-cargo" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Email:</strong></label>
                            <p id="docente-email" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Teléfono:</strong></label>
                            <p id="docente-telefono" class="form-control-static">-</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Especialidad:</strong></label>
                            <p id="docente-especialidad" class="form-control-static">-</p>
                        </div>
                    </div>
                </div>
                
                <h6 class="mt-3"><i class="fas fa-graduation-cap"></i> Materias que Dicta:</h6>
                <div id="docente-materias" class="mt-2">
                    <div class="text-center text-muted">
                        <p>Cargando materias...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btn-contactar-docente">
                    <i class="fas fa-envelope"></i> Contactar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Configuración de Currícula -->
<div class="modal fade" id="modalConfiguracion" tabindex="-1" role="dialog" aria-labelledby="modalConfiguracionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfiguracionLabel">
                    <i class="fas fa-cogs"></i>
                    Configuración de Currícula
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-configuracion">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="config-año"><strong>Año Académico:</strong></label>
                                <select class="form-control" id="config-año" name="año">
                                    <option value="">Seleccionar...</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="config-nivel"><strong>Nivel:</strong></label>
                                <select class="form-control" id="config-nivel" name="nivel">
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="config-curso"><strong>Curso:</strong></label>
                                <select class="form-control" id="config-curso" name="curso">
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="config-division"><strong>División:</strong></label>
                                <select class="form-control" id="config-division" name="division">
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h6><i class="fas fa-table"></i> Opciones de Visualización:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mostrar-codigos" checked>
                                <label class="form-check-label" for="mostrar-codigos">
                                    Mostrar códigos de materias
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mostrar-horas" checked>
                                <label class="form-check-label" for="mostrar-horas">
                                    Mostrar horas semanales
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mostrar-estados" checked>
                                <label class="form-check-label" for="mostrar-estados">
                                    Mostrar estados
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="auto-refresh">
                                <label class="form-check-label" for="auto-refresh">
                                    Actualización automática
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h6><i class="fas fa-download"></i> Exportar Datos:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-success btn-block" id="btn-export-excel">
                                <i class="fas fa-file-excel"></i> Exportar a Excel
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-danger btn-block" id="btn-export-pdf">
                                <i class="fas fa-file-pdf"></i> Exportar a PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-guardar-config">
                    <i class="fas fa-save"></i> Guardar Configuración
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exportación -->
<div class="modal fade" id="modalExportacion" tabindex="-1" role="dialog" aria-labelledby="modalExportacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExportacionLabel">
                    <i class="fas fa-download"></i>
                    Exportar Currícula
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Selecciona el formato de exportación y las secciones que deseas incluir:</p>
                
                <div class="form-group">
                    <label><strong>Formato:</strong></label>
                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                        <label class="btn btn-outline-success active flex-fill">
                            <input type="radio" name="formato" id="formato-excel" value="excel" checked>
                            <i class="fas fa-file-excel"></i> Excel
                        </label>
                        <label class="btn btn-outline-danger flex-fill">
                            <input type="radio" name="formato" id="formato-pdf" value="pdf">
                            <i class="fas fa-file-pdf"></i> PDF
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><strong>Incluir secciones:</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="incluir-materias" checked>
                        <label class="form-check-label" for="incluir-materias">
                            Materias del curso
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="incluir-docentes" checked>
                        <label class="form-check-label" for="incluir-docentes">
                            Docentes asignados
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="incluir-horarios" checked>
                        <label class="form-check-label" for="incluir-horarios">
                            Horarios de clases
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="incluir-resumen" checked>
                        <label class="form-check-label" for="incluir-resumen">
                            Resumen estadístico
                        </label>
                    </div>
                </div>
                
                <div id="export-progress" class="mt-3" style="display: none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted">Generando archivo...</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-iniciar-exportacion">
                    <i class="fas fa-download"></i> Descargar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Error -->
<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="modalErrorLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalErrorLabel">
                    <i class="fas fa-exclamation-triangle"></i>
                    Error
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="error-message">Ha ocurrido un error inesperado.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="modalConfirmacionLabel">
                    <i class="fas fa-question-circle"></i>
                    Confirmación
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmacion-message">¿Estás seguro de realizar esta acción?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-confirmar-accion">
                    <i class="fas fa-check"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar los modales -->
<script>
$(document).ready(function() {
    
    // Funciones para manejo de modales
    window.ModalHandler = {
        
        // Mostrar detalle de materia
        mostrarDetalleMateria: function(materiaId) {
            if (!CurriculaSystem.currentData) return;
            
            const materia = CurriculaSystem.currentData.materias.find(m => m.id == materiaId);
            if (!materia) return;
            
            // Llenar los datos básicos
            $('#detalle-codigo').text(materia.codigo || '-');
            $('#detalle-nombre').text(materia.nombre || '-');
            $('#detalle-horas').text(materia.horas || '-');
            $('#detalle-estado').html(`<span class="status-badge status-${(materia.estado || '').toLowerCase()}">${materia.estado || '-'}</span>`);
            $('#detalle-tipo').text(materia.tipo || '-');
            $('#detalle-area').text(materia.area || '-');
            $('#detalle-descripcion').text(materia.descripcion || 'Sin descripción disponible.');
            
            // Cargar docentes
            this.cargarDocentesModal(materia.docentes || []);
            
            // Cargar horarios
            this.cargarHorariosModal(materia.horarios || []);
            
            // Cargar recursos
            this.cargarRecursosModal(materia.recursos || []);
            
            $('#modalDetalleMateria').modal('show');
        },
        
        // Cargar docentes en el modal
        cargarDocentesModal: function(docentes) {
            let html = '';
            
            if (docentes.length === 0) {
                html = '<div class="text-center text-muted"><i class="fas fa-user-slash fa-2x"></i><p>No hay docentes asignados</p></div>';
            } else {
                html = '<div class="list-group">';
                docentes.forEach(docente => {
                    html += `
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">${docente.nombre}</h6>
                                <small class="text-muted">${docente.cargo}</small>
                            </div>
                            <p class="mb-1">${docente.email || 'Sin email'}</p>
                            <small>Especialidad: ${docente.especialidad || 'No especificada'}</small>
                        </div>
                    `;
                });
                html += '</div>';
            }
            
            $('#modal-docentes-list').html(html);
        },
        
        // Cargar horarios en el modal
        cargarHorariosModal: function(horarios) {
            let html = '';
            
            if (horarios.length === 0) {
                html = '<div class="text-center text-muted"><i class="fas fa-calendar-times fa-2x"></i><p>No hay horarios definidos</p></div>';
            } else {
                html = `
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Día</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Aula</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                horarios.forEach(horario => {
                    html += `
                        <tr>
                            <td>${horario.dia}</td>
                            <td>${horario.hora_inicio}</td>
                            <td>${horario.hora_fin}</td>
                            <td>${horario.aula || '-'}</td>
                        </tr>
                    `;
                });
                
                html += '</tbody></table>';
            }
            
            $('#modal-horarios-list').html(html);
        },
        
        // Cargar recursos en el modal
        cargarRecursosModal: function(recursos) {
            let html = '';
            
            if (!recursos || recursos.length === 0) {
                html = '<div class="text-center text-muted"><i class="fas fa-box-open fa-2x"></i><p>No hay recursos registrados</p></div>';
            } else {
                html = '<div class="list-group">';
                recursos.forEach(recurso => {
                    html += `
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">${recurso.nombre}</h6>
                                <span class="badge badge-${recurso.disponible ? 'success' : 'warning'}">${recurso.disponible ? 'Disponible' : 'No disponible'}</span>
                            </div>
                            <p class="mb-1">${recurso.descripcion || 'Sin descripción'}</p>
                            <small>Cantidad: ${recurso.cantidad || 0}</small>
                        </div>
                    `;
                });
                html += '</div>';
            }
            
            $('#modal-recursos-list').html(html);
        },
        
        // Mostrar información del docente
        mostrarInfoDocente: function(docenteData) {
            $('#docente-nombre').text(docenteData.nombre || '-');
            $('#docente-cargo').text(docenteData.cargo || '-');
            $('#docente-email').text(docenteData.email || '-');
            $('#docente-telefono').text(docenteData.telefono || '-');
            $('#docente-especialidad').text(docenteData.especialidad || '-');
            
            // Cargar materias del docente
            let materiasHtml = '';
            if (docenteData.materias && docenteData.materias.length > 0) {
                docenteData.materias.forEach(materia => {
                    materiasHtml += `<span class="badge badge-primary mr-1 mb-1">${materia}</span>`;
                });
            } else {
                materiasHtml = '<span class="text-muted">No hay materias asignadas</span>';
            }
            
            $('#docente-materias').html(materiasHtml);
            $('#modalInfoDocente').modal('show');
        },
        
        // Mostrar modal de error
        mostrarError: function(mensaje) {
            $('#error-message').text(mensaje);
            $('#modalError').modal('show');
        },
        
        // Mostrar modal de confirmación
        mostrarConfirmacion: function(mensaje, callback) {
            $('#confirmacion-message').text(mensaje);
            $('#modalConfirmacion').modal('show');
            
            // Manejar la confirmación
            $('#btn-confirmar-accion').off('click').on('click', function() {
                $('#modalConfirmacion').modal('hide');
                if (typeof callback === 'function') {
                    callback();
                }
            });
        }
    };
    
    // Event listeners para los modales
    
    // Doble click en materia para ver detalle
    $(document).on('dblclick', '.materia-row', function() {
        const materiaId = $(this).data('materia-id');
        ModalHandler.mostrarDetalleMateria(materiaId);
    });
    
    // Click en docente para ver información
    $(document).on('click', '.docente-info', function() {
        const docenteData = $(this).data('docente');
        ModalHandler.mostrarInfoDocente(docenteData);
    });
    
    // Botón de editar materia
    $('#btn-editar-materia').on('click', function() {
        // Aquí puedes implementar la lógica de edición
        alert('Función de edición en desarrollo');
    });
    
    // Botón de contactar docente
    $('#btn-contactar-docente').on('click', function() {
        const email = $('#docente-email').text();
        if (email && email !== '-') {
            window.location.href = `mailto:${email}`;
        } else {
            ModalHandler.mostrarError('No hay email disponible para este docente');
        }
    });
    
    // Botones de exportación
    $('#btn-export-excel').on('click', function() {
        $('#modalExportacion').modal('show');
        $('input[name="formato"][value="excel"]').prop('checked', true);
    });
    
    $('#btn-export-pdf').on('click', function() {
        $('#modalExportacion').modal('show');
        $('input[name="formato"][value="pdf"]').prop('checked', true);
    });
    
    // Iniciar exportación
    $('#btn-iniciar-exportacion').on('click', function() {
        const formato = $('input[name="formato"]:checked').val();
        const secciones = [];
        
        if ($('#incluir-materias').is(':checked')) secciones.push('materias');
        if ($('#incluir-docentes').is(':checked')) secciones.push('docentes');
        if ($('#incluir-horarios').is(':checked')) secciones.push('horarios');
        if ($('#incluir-resumen').is(':checked')) secciones.push('resumen');
        
        // Mostrar progress bar
        $('#export-progress').show();
        $('.progress-bar').css('width', '0%');
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            $('.progress-bar').css('width', progress + '%');
            
            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    $('#modalExportacion').modal('hide');
                    $('#export-progress').hide();
                    $('.progress-bar').css('width', '0%');
                    
                    // Aquí implementarías la descarga real
                    ModalHandler.mostrarError('Función de exportación en desarrollo');
                }, 500);
            }
        }, 200);
    });
    
    // Guardar configuración
    $('#btn-guardar-config').on('click', function() {
        // Aquí implementarías el guardado de configuración
        $('#modalConfiguracion').modal('hide');
        alert('Configuración guardada exitosamente');
    });
});
</script>

<!-- Estilos adicionales para los modales -->
<style>
.modal-content {
    border-radius: 8px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.modal-header {
    border-bottom: 2px solid #e9ecef;
    border-radius: 8px 8px 0 0;
}

.modal-header .modal-title {
    font-weight: 600;
}

.modal-header .modal-title i {
    margin-right: 8px;
}

.form-control-static {
    padding: 8px 0;
    margin: 0;
    font-weight: 500;
    color: #495057;
}

.nav-tabs .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    border-bottom-color: #007bff;
    color: #007bff;
    background: none;
}

.docente-avatar {
    margin-bottom: 15px;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}

.progress {
    height: 8px;
    border-radius: 4px;
}

.btn-group-toggle .btn {
    transition: all 0.3s ease;
}

.form-check-label {
    font-weight: 500;
    color: #495057;
}

.badge {
    font-size: 0.75em;
}
</style>