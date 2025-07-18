<script>
// Sistema de Gestión de Currícula - Funciones JavaScript
$(document).ready(function() {
    
    // Configuración global del sistema
    window.CurriculaSystem = {
        selectedMateria: null,
        currentData: null,
        apiEndpoint: 'http://localhost/csc-back/api/curricula/get_curricula_data.php', // Ajusta según tu estructura
        api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0=', // Coma agregada aquí
        añosData: null, // Para almacenar los datos de años
        
        // Inicialización del sistema
        init: function() {
            this.bindEvents();
            this.loadInitialData();
            this.renderInterface();
        },
        
        // Renderizar la interfaz
        renderInterface: function() {
            const interfaceHtml = `
                <div class="curricula-container">
                    <div class="curricula-header">
                        <h2>
                            <i class="fas fa-chart-bar"></i>
                            Sistema de Gestión de Currícula
                        </h2>
                    </div>

                    <!-- Panel de Control -->
                    <div class="control-panel">
                        <div class="control-group">
                            <div class="control-item">
                                <label for="select-año">Año Académico</label>
                                <select id="select-año" class="form-control">
                                    <option value="">Seleccionar año...</option>
                                </select>
                            </div>
                            
                            <div class="control-item">
                                <label for="select-nivel">Nivel</label>
                                <select id="select-nivel" class="form-control" disabled>
                                    <option value="">Seleccionar nivel...</option>
                                </select>
                            </div>
                            
                            <div class="control-item">
                                <label for="select-curso">Curso</label>
                                <select id="select-curso" class="form-control" disabled>
                                    <option value="">Seleccionar curso...</option>
                                </select>
                            </div>
                            
                            <div class="control-item">
                                <label for="select-division">División</label>
                                <select id="select-division" class="form-control" disabled>
                                    <option value="">Seleccionar división...</option>
                                </select>
                            </div>
                        </div>
                        
                        <button id="btn-consultar" class="btn-consultar" disabled>
                            <i class="fas fa-search"></i>
                            Consultar Currícula
                        </button>
                    </div>

                    <!-- Grid de Tablas -->
                    <div class="tables-grid">

                        <!-- Tabla de años -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-calendar"></i>
                                Años Académicos Disponibles
                            </div>
                            <div class="table-container">
                                <div id="años-content" class="empty-state">
                                    <i class="fas fa-calendar-alt fa-3x"></i>
                                    <p>Cargando años académicos...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Materias -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-book"></i>
                                Materias del Curso
                            </div>
                            <div class="table-container">
                                <div id="materias-content" class="empty-state">
                                    <i class="fas fa-book-open fa-3x"></i>
                                    <p>Selecciona un curso para ver las materias</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Docentes -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Docentes Asignados
                            </div>
                            <div class="table-container">
                                <div id="docentes-content" class="empty-state">
                                    <i class="fas fa-user-tie fa-3x"></i>
                                    <p>Selecciona una materia para ver los docentes</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Horarios -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-clock"></i>
                                Horarios de Clases
                            </div>
                            <div class="table-container">
                                <div id="horarios-content" class="empty-state">
                                    <i class="fas fa-calendar-alt fa-3x"></i>
                                    <p>Selecciona una materia para ver los horarios</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Información Adicional -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-info-circle"></i>
                                Información del Curso
                            </div>
                            <div class="table-container">
                                <div id="info-content" class="empty-state">
                                    <i class="fas fa-clipboard-list fa-3x"></i>
                                    <p>Información del curso seleccionado</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Información Resumida -->
                    <div id="resumen-panel" class="info-panel" style="display: none;">
                        <h3 style="margin-top: 0; color: #495057;">
                            <i class="fas fa-chart-pie"></i>
                            Resumen de la Currícula
                        </h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Total de Materias</div>
                                <div class="info-value" id="total-materias">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Docentes Asignados</div>
                                <div class="info-value" id="total-docentes">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Horas Semanales</div>
                                <div class="info-value" id="total-horas">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Estado</div>
                                <div class="info-value" id="estado-curricula">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Insertar en el contenedor
            $('#contenido_formulario_datos').html(interfaceHtml);
            
            // Ocultar el loader
            $('.loader').hide();
            
            // Rebind events después de renderizar
            this.bindEvents();
        },
        
        // Vincular eventos
        bindEvents: function() {
            $(document).off('change', '#select-año').on('change', '#select-año', this.onAñoChange.bind(this));
            $(document).off('change', '#select-nivel').on('change', '#select-nivel', this.onNivelChange.bind(this));
            $(document).off('change', '#select-curso').on('change', '#select-curso', this.onCursoChange.bind(this));
            $(document).off('change', '#select-division').on('change', '#select-division', this.onDivisionChange.bind(this));
            $(document).off('click', '#btn-consultar').on('click', '#btn-consultar', this.consultarCurricula.bind(this));
        },
        
        // Cargar datos iniciales
        loadInitialData: function() {
            // Cargar años disponibles desde tu API
            this.loadAños();
        },
        
        // Cargar años disponibles
        loadAños: function() {
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_anios',
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de años:', data); // Para debug
                    
                    if (data.status === 'success') {
                        // Guardar los datos para usar en la tabla
                        this.añosData = data.data;
                        
                        // Poblar el select
                        this.populateSelect('#select-año', data.data, 'Seleccionar año...');
                        
                        // Mostrar tabla de años
                        this.loadAñosTable(data.data);
                    } else {
                        console.error('Error en respuesta:', data.message);
                        this.showErrorInAños('Error al cargar años: ' + (data.message || 'Error desconocido'));
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar años:', error);
                    console.error('Respuesta completa:', xhr.responseText);
                    this.showErrorInAños('Error de conexión al cargar años');
                }
            });
        },
        
        // Cargar tabla de años
        loadAñosTable: function(años) {
            if (!años || años.length === 0) {
                $('#años-content').html('<div class="empty-state"><i class="fas fa-calendar-times fa-3x"></i><p>No hay años académicos disponibles</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Año Académico</th>
                            <th>Estado</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            años.forEach(año => {
                // Adaptar según tu estructura de respuesta
                const añoId = año.anio;
                const añoNombre = año.anio;
                const añoEstado = año.aniolec_stat;
                
                // Convertir estado a texto legible
                let estadoTexto = '';
                let estadoClass = '';
                
                switch(añoEstado) {
                    case 'a':
                        estadoTexto = 'Activo';
                        estadoClass = 'activo';
                        break;
                    case 'v':
                        estadoTexto = 'Vigente';
                        estadoClass = 'vigente';
                        break;
                    case 'i':
                        estadoTexto = 'Inactivo';
                        estadoClass = 'inactivo';
                        break;
                    default:
                        estadoTexto = 'Desconocido';
                        estadoClass = 'inactivo';
                }
                
                // Descripción basada en el estado
                let descripcion = '';
                switch(añoEstado) {
                    case 'a':
                        descripcion = 'Año lectivo en curso';
                        break;
                    case 'v':
                        descripcion = 'Año lectivo disponible';
                        break;
                    case 'i':
                        descripcion = 'Año lectivo cerrado';
                        break;
                    default:
                        descripcion = 'Estado no definido';
                }
                
                html += `
                    <tr data-año-id="${añoId}" class="año-row ${añoEstado === 'a' ? 'año-activo' : ''}">
                        <td><strong>${añoNombre}</strong></td>
                        <td>
                            <span class="status-badge status-${estadoClass}">
                                ${estadoTexto}
                            </span>
                        </td>
                        <td class="text-muted">${descripcion}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-select-año" data-año="${añoId}" ${añoEstado === 'i' ? 'disabled' : ''}>
                                <i class="fas fa-check"></i> 
                                ${añoEstado === 'a' ? 'Año Actual' : 'Seleccionar'}
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#años-content').html(html);
            
            // Eventos para selección de año desde la tabla
            $('.btn-select-año').off('click').on('click', (e) => {
                const añoId = $(e.currentTarget).data('año');
                this.selectAñoFromTable(añoId);
            });
            
            // Evento para highlight al hacer hover
            $('.año-row').off('mouseenter mouseleave').on('mouseenter', function() {
                $(this).addClass('table-hover-highlight');
            }).on('mouseleave', function() {
                $(this).removeClass('table-hover-highlight');
            });
            
            // Auto-seleccionar el año activo si existe
            const añoActivo = años.find(a => a.aniolec_stat === 'a');
            if (añoActivo) {
                // Pequeño delay para que se renderice la tabla primero
                setTimeout(() => {
                    this.selectAñoFromTable(añoActivo.anio);
                }, 100);
            }
        },
        
        // Seleccionar año desde la tabla
        selectAñoFromTable: function(añoId) {
            // Actualizar el select
            $('#select-año').val(añoId).trigger('change');
            
            // Highlight en la tabla
            $('.año-row').removeClass('selected');
            $(`.año-row[data-año-id="${añoId}"]`).addClass('selected');
            
            // Mensaje de confirmación
            this.showNotification(`Año ${añoId} seleccionado`, 'success');
        },
        
        // Mostrar error específico en la tabla de años
        showErrorInAños: function(message) {
            const errorHtml = `
                <div class="empty-state error-state">
                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                    <p>${message}</p>
                    <button class="btn btn-outline-primary btn-sm" onclick="CurriculaSystem.loadAños()">
                        <i class="fas fa-redo"></i> Reintentar
                    </button>
                </div>
            `;
            $('#años-content').html(errorHtml);
        },
        
        // Función para mostrar notificaciones
        showNotification: function(message, type = 'info') {
            // Crear notificación temporal
            const notification = $(`
                <div class="alert alert-${type} alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="fas fa-${type === 'success' ? 'check' : 'info'}-circle"></i>
                    ${message}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            `);
            
            $('body').append(notification);
            
            // Auto-hide después de 3 segundos
            setTimeout(() => {
                notification.alert('close');
            }, 3000);
        },
        
        // Evento: cambio de año
        onAñoChange: function() {
            const año = $('#select-año').val();
            
            // Actualizar highlight en tabla de años
            $('.año-row').removeClass('selected');
            if (año) {
                $(`.año-row[data-año-id="${año}"]`).addClass('selected');
                
                this.loadNiveles(año);
                $('#select-nivel').prop('disabled', false);
            } else {
                this.resetSelects(['nivel', 'curso', 'division']);
            }
            
            this.checkConsultarButton();
        },
        
        // Evento: cambio de nivel
        onNivelChange: function() {
            const nivel = $('#select-nivel').val();
            
            if (nivel) {
                this.loadCursos(nivel);
                $('#select-curso').prop('disabled', false);
            } else {
                this.resetSelects(['curso', 'division']);
            }
            
            this.checkConsultarButton();
        },
        
        // Evento: cambio de curso
        onCursoChange: function() {
            const curso = $('#select-curso').val();
            
            if (curso) {
                this.loadDivisiones(curso);
                $('#select-division').prop('disabled', false);
            } else {
                this.resetSelects(['division']);
            }
            
            this.checkConsultarButton();
        },
        
        // Evento: cambio de división
        onDivisionChange: function() {
            this.checkConsultarButton();
        },
        
        // Cargar niveles basado en el año
        loadNiveles: function(año) {
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    action: 'get_niveles', 
                    año: año,
                    apiKey: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    if (data.success) {
                        this.populateSelect('#select-nivel', data.niveles, 'Seleccionar nivel...');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar niveles:', error);
                    // Fallback con datos estáticos
                    const niveles = [
                        { id: 'inicial', nombre: 'Nivel Inicial' },
                        { id: 'primario', nombre: 'Nivel Primario' },
                        { id: 'secundario', nombre: 'Nivel Secundario' }
                    ];
                    this.populateSelect('#select-nivel', niveles, 'Seleccionar nivel...');
                }
            });
        },
        
        // Cargar cursos basado en el nivel
        loadCursos: function(nivel) {
            const año = $('#select-año').val();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    action: 'get_cursos', 
                    año: año, 
                    nivel: nivel,
                    apiKey: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    if (data.success) {
                        this.populateSelect('#select-curso', data.cursos, 'Seleccionar curso...');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar cursos:', error);
                    // Fallback con datos estáticos
                    this.loadCursosFallback(nivel);
                }
            });
        },
        
        // Fallback para cursos
        loadCursosFallback: function(nivel) {
            const cursos = {
                'inicial': [
                    { id: '3años', nombre: '3 años' },
                    { id: '4años', nombre: '4 años' },
                    { id: '5años', nombre: '5 años' }
                ],
                'primario': [
                    { id: '1ro', nombre: '1° Grado' },
                    { id: '2do', nombre: '2° Grado' },
                    { id: '3ro', nombre: '3° Grado' },
                    { id: '4to', nombre: '4° Grado' },
                    { id: '5to', nombre: '5° Grado' },
                    { id: '6to', nombre: '6° Grado' }
                ],
                'secundario': [
                    { id: '1año', nombre: '1° Año' },
                    { id: '2año', nombre: '2° Año' },
                    { id: '3año', nombre: '3° Año' },
                    { id: '4año', nombre: '4° Año' },
                    { id: '5año', nombre: '5° Año' }
                ]
            };
            
            this.populateSelect('#select-curso', cursos[nivel] || [], 'Seleccionar curso...');
        },
        
        // Cargar divisiones basado en el curso
        loadDivisiones: function(curso) {
            const año = $('#select-año').val();
            const nivel = $('#select-nivel').val();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    action: 'get_divisiones', 
                    año: año, 
                    nivel: nivel, 
                    curso: curso,
                    apiKey: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    if (data.success) {
                        this.populateSelect('#select-division', data.divisiones, 'Seleccionar división...');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar divisiones:', error);
                    // Fallback con datos estáticos
                    const divisiones = [
                        { id: 'A', nombre: 'División A' },
                        { id: 'B', nombre: 'División B' },
                        { id: 'C', nombre: 'División C' }
                    ];
                    this.populateSelect('#select-division', divisiones, 'Seleccionar división...');
                }
            });
        },
        
        // Poblar select con opciones
        populateSelect: function(selector, options, placeholder) {
            const $select = $(selector);
            $select.empty().append(`<option value="">${placeholder}</option>`);
            
            options.forEach(option => {
                // Adaptar según la estructura de tu respuesta
                let optionId, optionNombre;
                
                if (selector === '#select-año') {
                    // Para años, usar tu estructura específica
                    optionId = option.anio;
                    optionNombre = option.anio;
                    
                    // Solo agregar años que no estén inactivos
                    if (option.aniolec_stat !== 'i') {
                        // Agregar indicador si es el año activo
                        const indicador = option.aniolec_stat === 'a' ? ' (Actual)' : '';
                        $select.append(`<option value="${optionId}">${optionNombre}${indicador}</option>`);
                    }
                } else {
                    // Para otros selects, usar estructura estándar
                    optionId = option.id || option.anio_academico || option.año;
                    optionNombre = option.nombre || option.descripcion || option.anio_academico || option.año;
                    $select.append(`<option value="${optionId}">${optionNombre}</option>`);
                }
            });
        },
        
        // Resetear selects
        resetSelects: function(selects) {
            selects.forEach(select => {
                $(`#select-${select}`).empty()
                    .append('<option value="">Seleccionar...</option>')
                    .prop('disabled', true);
            });
            
            this.clearTables();
        },
        
        // Verificar si se puede habilitar el botón consultar
        checkConsultarButton: function() {
            const año = $('#select-año').val();
            const nivel = $('#select-nivel').val();
            const curso = $('#select-curso').val();
            const division = $('#select-division').val();
            
            const enabled = año && nivel && curso && division;
            $('#btn-consultar').prop('disabled', !enabled);
        },
        
        // Consultar currícula - FUNCIÓN PRINCIPAL
        consultarCurricula: function() {
            const formData = {
                action: 'get_curricula',
                año: $('#select-año').val(),
                nivel: $('#select-nivel').val(),
                curso: $('#select-curso').val(),
                division: $('#select-division').val(),
                apiKey: this.api_key
            };
            
            this.showLoading();
            
            // Petición AJAX a tu endpoint
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: (data) => {
                    if (data.success) {
                        this.loadCurriculaData(data.data);
                    } else {
                        this.showError(data.message || 'Error al cargar los datos');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al consultar currícula:', error);
                    this.showError('Error de conexión. Por favor, intenta nuevamente.');
                }
            });
        },
        
        // Mostrar estado de carga
        showLoading: function() {
            const loadingHtml = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Cargando datos...</div>';
            
            $('#materias-content').html(loadingHtml);
            $('#docentes-content').html(loadingHtml);
            $('#horarios-content').html(loadingHtml);
            $('#info-content').html(loadingHtml);
        },
        
        // Cargar datos de currícula
        loadCurriculaData: function(data) {
            this.currentData = data;
            
            this.loadMateriasTable(data.materias || []);
            this.loadDocentesTable([]);
            this.loadHorariosTable([]);
            this.loadInfoPanel(data.info || {});
            this.updateResumen(data);
            
            $('#resumen-panel').show();
        },
        
        // Cargar tabla de materias
        loadMateriasTable: function(materias) {
            if (!materias || materias.length === 0) {
                $('#materias-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>No hay materias registradas para este curso</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Materia</th>
                            <th>Horas</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            materias.forEach(materia => {
                html += `
                    <tr data-materia-id="${materia.id}" class="materia-row">
                        <td>${materia.codigo}</td>
                        <td>${materia.nombre}</td>
                        <td>${materia.horas}</td>
                        <td><span class="status-badge status-${materia.estado.toLowerCase()}">${materia.estado}</span></td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#materias-content').html(html);
            
            // Eventos para selección de materia
            $('.materia-row').off('click').on('click', (e) => {
                const materiaId = $(e.currentTarget).data('materia-id');
                this.selectMateria(materiaId);
            });
        },
        
        // Seleccionar materia
        selectMateria: function(materiaId) {
            $('.materia-row').removeClass('selected');
            $(`.materia-row[data-materia-id="${materiaId}"]`).addClass('selected');
            
            this.selectedMateria = materiaId;
            const materia = this.currentData.materias.find(m => m.id == materiaId);
            
            if (materia) {
                this.loadDocentesTable(materia.docentes || []);
                this.loadHorariosTable(materia.horarios || []);
            }
        },
        
        // Cargar tabla de docentes
        loadDocentesTable: function(docentes) {
            if (!docentes || docentes.length === 0) {
                $('#docentes-content').html('<div class="empty-state"><i class="fas fa-user-tie fa-3x"></i><p>Selecciona una materia para ver los docentes</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            docentes.forEach(docente => {
                html += `
                    <tr>
                        <td>${docente.nombre}</td>
                        <td>${docente.cargo}</td>
                        <td>${docente.email || '-'}</td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#docentes-content').html(html);
        },
        
        // Cargar tabla de horarios
        loadHorariosTable: function(horarios) {
            if (!horarios || horarios.length === 0) {
                $('#horarios-content').html('<div class="empty-state"><i class="fas fa-calendar-alt fa-3x"></i><p>Selecciona una materia para ver los horarios</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
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
            $('#horarios-content').html(html);
        },
        
        // Cargar panel de información
        loadInfoPanel: function(info) {
            let html = `
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Curso</div>
                        <div class="info-value">${info.curso || '-'}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">División</div>
                        <div class="info-value">${info.division || '-'}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Año Académico</div>
                        <div class="info-value">${info.año || '-'}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Cantidad Alumnos</div>
                        <div class="info-value">${info.cantidad_alumnos || '-'}</div>
                    </div>
                </div>
            `;
            
            $('#info-content').html(html);
        },
        
        // Actualizar resumen
        updateResumen: function(data) {
            const resumen = data.resumen || {};
            $('#total-materias').text(data.materias ? data.materias.length : 0);
            $('#total-docentes').text(resumen.total_docentes || 0);
            $('#total-horas').text(resumen.total_horas || 0);
            $('#estado-curricula').text(resumen.estado || 'Pendiente');
        },
        
        // Limpiar tablas
        clearTables: function() {
            $('#materias-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>Selecciona un curso para ver las materias</p></div>');
            $('#docentes-content').html('<div class="empty-state"><i class="fas fa-user-tie fa-3x"></i><p>Selecciona una materia para ver los docentes</p></div>');
            $('#horarios-content').html('<div class="empty-state"><i class="fas fa-calendar-alt fa-3x"></i><p>Selecciona una materia para ver los horarios</p></div>');
            $('#info-content').html('<div class="empty-state"><i class="fas fa-clipboard-list fa-3x"></i><p>Información del curso seleccionado</p></div>');
            $('#resumen-panel').hide();
            
            // No limpiar la tabla de años, solo las demás
        },
        
        // Mostrar error
        showError: function(message) {
            const errorHtml = `<div class="empty-state error-state"><i class="fas fa-exclamation-triangle fa-3x"></i><p>${message}</p></div>`;
            
            $('#materias-content').html(errorHtml);
            $('#docentes-content').html(errorHtml);
            $('#horarios-content').html(errorHtml);
            $('#info-content').html(errorHtml);
        }
    };
    
    // Inicializar el sistema
    CurriculaSystem.init();
});
</script>