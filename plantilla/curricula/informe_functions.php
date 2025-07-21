<script>
// Sistema de Gestión de Currícula - Funciones JavaScript Actualizado (Sin Selects)
$(document).ready(function() {
    
    // Configuración global del sistema
    window.CurriculaSystem = {
        selectedMateria: null,
        currentData: null,
        selectedAño: null,
        apiEndpoint: 'http://localhost/csc-back/api/curricula/get_curricula_data.php',
        api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0=',
        añosData: null,
        curriculaData: null,
        
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
                            Sistema de Gestión
                        </h2>
                    </div>

                    <!-- Panel de Resumen (donde estaban los selects) -->
                    <div id="resumen-panel" class="info-panel" style="display: none;">
                        <h3 style="margin-top: 0; color: #495057;">
                            <i class="fas fa-chart-pie"></i>
                            Resumen de la Currícula
                        </h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Año Seleccionado</div>
                                <div class="info-value" id="año-seleccionado">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total de Materias</div>
                                <div class="info-value" id="total-materias">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total de Cursos</div>
                                <div class="info-value" id="total-cursos">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total de Divisiones</div>
                                <div class="info-value" id="total-divisiones">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Docentes Asignados</div>
                                <div class="info-value" id="total-docentes">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Preceptores</div>
                                <div class="info-value" id="total-preceptores">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de Tablas -->
                    <div class="tables-grid">

                        <!-- Tabla de años -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-calendar"></i>
                                Años Disponibles
                            </div>
                            <div class="table-container">
                                <div id="años-content" class="empty-state">
                                    <i class="fas fa-calendar-alt fa-3x"></i>
                                    <p>Cargando años académicos...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Cursos -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-graduation-cap"></i>
                                Cursos Disponibles
                            </div>
                            <div class="table-container">
                                <div id="cursos-content" class="empty-state">
                                    <i class="fas fa-graduation-cap fa-3x"></i>
                                    <p>Selecciona un año para ver los cursos</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Divisiones -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-users"></i>
                                Divisiones Disponibles
                            </div>
                            <div class="table-container">
                                <div id="divisiones-content" class="empty-state">
                                    <i class="fas fa-users fa-3x"></i>
                                    <p>Selecciona un curso para ver las divisiones</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Materias -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-book"></i>
                                Materias por División
                            </div>
                            <div class="table-container">
                                <div id="materias-content" class="empty-state">
                                    <i class="fas fa-book-open fa-3x"></i>
                                    <p>Selecciona una división para ver las materias</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Docentes -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Docentes
                            </div>
                            <div class="table-container">
                                <div id="docentes-content" class="empty-state">
                                    <i class="fas fa-user-tie fa-3x"></i>
                                    <p>Información de docentes disponible</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Preceptores -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-user-graduate"></i>
                                Preceptores
                            </div>
                            <div class="table-container">
                                <div id="preceptores-content" class="empty-state">
                                    <i class="fas fa-user-graduate fa-3x"></i>
                                    <p>Información de preceptores disponible</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Insertar en el contenedor
            $('#contenido_formulario_datos').html(interfaceHtml);
            
            // Ocultar el loader
            $('.loader').hide();
            
        },
        
        // Vincular eventos
        bindEvents: function() {
            // Solo necesitamos eventos para clicks en las tablas
            $(document).off('click', '.btn-select-año').on('click', '.btn-select-año', this.onAñoSelect.bind(this));
            $(document).off('click', '.btn-select-curso').on('click', '.btn-select-curso', this.onCursoSelect.bind(this));
            $(document).off('click', '.btn-select-division').on('click', '.btn-select-division', this.onDivisionSelect.bind(this));
        },
        
        // Cargar datos iniciales
        loadInitialData: function() {
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
                    console.log('Respuesta de años:', data);
                    
                    if (data.status === 'success') {
                        this.añosData = data.data;
                        this.loadAñosTable(data.data);
                    } else {
                        console.error('Error en respuesta:', data.message);
                        this.showErrorInAños('Error al cargar años: ' + (data.message || 'Error desconocido'));
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar años:', error);
                    this.showErrorInAños('Error de conexión al cargar años');
                }
            });
        },
        
        // Cargar datos de currícula por año
        loadCurriculaPorAnio: function(anio) {
            // Mostrar estado de carga
            this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_curricula_por_anio',
                    anio: anio,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de currícula:', data);
                    
                    if (data.status === 'success') {
                        this.curriculaData = data.data;
                        this.selectedAño = anio;
                        this.processCurriculaData(data.data);
                        this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
                    } else {
                        console.error('Error en respuesta:', data.message);
                        this.showError('Error al cargar currícula: ' + (data.message || 'Error desconocido'));
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error al cargar currícula:', error);
                    this.showError('Error de conexión al cargar currícula');
                }
            });
        },
        
        // Procesar datos de currícula
        processCurriculaData: function(data) {
            // Cargar tablas con los datos recibidos
            this.loadCursosTable(data.cursos || []);
            this.loadDivisionesTable(data.divisiones || []);
            this.loadMateriasTable(data.matxdiv || []);
            this.loadDocentesTable(data.docentes || []);
            this.loadPreceptoresTable(data.preceptores || []);
            
            // Mostrar resumen
            this.updateResumen(data);
            $('#resumen-panel').show();
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
                const añoId = año.anio;
                const añoNombre = año.anio;
                const añoEstado = año.aniolec_stat;
                
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
                                ${añoEstado === 'a' ? 'Ver Año Actual' : 'Ver Currícula'}
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#años-content').html(html);
            
            // Auto-seleccionar el año activo si existe
            const añoActivo = años.find(a => a.aniolec_stat === 'a');
            if (añoActivo) {
                setTimeout(() => {
                    this.selectAñoFromTable(añoActivo.anio);
                }, 100);
            }
        },
        
        // Cargar tabla de cursos
        loadCursosTable: function(cursos) {
            if (!cursos || cursos.length === 0) {
                $('#cursos-content').html('<div class="empty-state"><i class="fas fa-graduation-cap fa-3x"></i><p>No hay cursos disponibles</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Ciclo</th>
                            <th>Divisiones</th>
                            <th>Materias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            cursos.forEach(curso => {
                html += `
                    <tr data-curso-id="${curso.id}" data-ciclo="${curso.ciclo_id}" class="curso-row">
                        <td><strong>${curso.nombre}</strong></td>
                        <td><span class="badge badge-info">${curso.ciclo_id}</span></td>
                        <td><span class="badge badge-secondary">${curso.total_divisiones}</span></td>
                        <td><span class="badge badge-primary">${curso.total_materias}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary btn-select-curso" 
                                    data-curso="${curso.id}" 
                                    data-ciclo="${curso.ciclo_id}">
                                 Ver Divisiones
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#cursos-content').html(html);
        },
        
        // Cargar tabla de divisiones
        loadDivisionesTable: function(divisiones) {
            if (!divisiones || divisiones.length === 0) {
                $('#divisiones-content').html('<div class="empty-state"><i class="fas fa-users fa-3x"></i><p>No hay divisiones disponibles</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>División</th>
                            <th>Ciclo</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            divisiones.forEach(division => {
                const estadoTexto = division.division_estado === 'A' ? 'Activa' : 'Inactiva';
                const estadoClass = division.division_estado === 'A' ? 'activo' : 'inactivo';
                
                html += `
                    <tr data-division-id="${division.division_id}" data-ciclo="${division.ciclo_id}" data-curso="${division.curso_id}" class="division-row">
                        <td><strong>${division.division_completa}</strong></td>
                        <td><span class="badge badge-info">${division.ciclo_id}</span></td>
                        <td><span class="badge badge-warning">${division.curso_id}</span></td>
                        <td>
                            <span class="status-badge status-${estadoClass}">
                                ${estadoTexto}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary btn-select-division" 
                                    data-division="${division.division_id}" 
                                    data-ciclo="${division.ciclo_id}" 
                                    data-curso="${division.curso_id}">
                                 Ver Materias
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#divisiones-content').html(html);
        },
        
        // Cargar tabla de materias
        loadMateriasTable: function(materias) {
            if (!materias || materias.length === 0) {
                $('#materias-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>No hay materias registradas</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Materia</th>
                            <th>División</th>
                            <th>Estado Docente</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            materias.forEach(materia => {
                const estadoClass = materia.estado_docente === 'Con Docente' ? 'activo' : 'inactivo';
                
                html += `
                    <tr data-materia-id="${materia.materia_id}" class="materia-row">
                        <td><strong>${materia.materia_id}</strong></td>
                        <td>${materia.materia_nombre}</td>
                        <td><span class="badge badge-info">${materia.division_completa}</span></td>
                        <td>
                            <span class="status-badge status-${estadoClass}">
                                ${materia.estado_docente}
                            </span>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#materias-content').html(html);
        },
        
        // Cargar tabla de docentes
        loadDocentesTable: function(docentes) {
            if (!docentes || docentes.length === 0) {
                $('#docentes-content').html('<div class="empty-state"><i class="fas fa-user-tie fa-3x"></i><p>No hay docentes registrados</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Legajo</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            docentes.forEach(docente => {
                html += `
                    <tr>
                        <td><strong>${docente.legajo}</strong></td>
                        <td>${docente.nombres}</td>
                        <td>${docente.apellidos}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-info">
                                 Ver
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#docentes-content').html(html);
        },
        
        // Cargar tabla de preceptores
        loadPreceptoresTable: function(preceptores) {
            if (!preceptores || preceptores.length === 0) {
                $('#preceptores-content').html('<div class="empty-state"><i class="fas fa-user-graduate fa-3x"></i><p>No hay preceptores registrados</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Legajo</th>
                            <th>Nombre</th>
                            <th>División</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            preceptores.forEach(preceptor => {
                html += `
                    <tr>
                        <td><strong>${preceptor.legajo}</strong></td>
                        <td>${preceptor.nombre}</td>
                        <td><span class="badge badge-info">${preceptor.division_completa}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#preceptores-content').html(html);
        },
        
        // Eventos de selección desde las tablas
        onAñoSelect: function(e) {
            const añoId = $(e.currentTarget).data('año').toString();
            this.selectAñoFromTable(añoId);
            console.log('select año'+ añoId);
            
        },
        
        onCursoSelect: function(e) {
            const button = $(e.currentTarget);
            const cursoId = button.data('curso');
            const cicloId = button.data('ciclo');
            this.selectCursoFromTable(cursoId, cicloId);
        },
        
        onDivisionSelect: function(e) {
            const button = $(e.currentTarget);
            this.selectDivisionFromTable(
                button.data('ciclo'),
                button.data('curso'),
                button.data('division')
            );
        },
        
        // Seleccionar año desde la tabla
        selectAñoFromTable: function(añoId) {
            // Marcar año como seleccionado
            $('.año-row').removeClass('selected');
            $(`.año-row[data-año-id="${añoId}"]`).addClass('selected');
            
            // Cargar datos del año
            this.loadCurriculaPorAnio(añoId);
            this.showNotification(`Año ${añoId} seleccionado`, 'success');
        },
        
        // Seleccionar curso desde la tabla
        selectCursoFromTable: function(cursoId, cicloId) {
            $('.curso-row').removeClass('selected');
            $(`.curso-row[data-curso-id="${cursoId}"]`).addClass('selected');
            
            // Filtrar divisiones para este curso
            if (this.curriculaData && this.curriculaData.divisiones) {
                const divisionesFiltradas = this.curriculaData.divisiones.filter(div => 
                    div.id === cursoId && div.ciclo_id === cicloId
                );
                this.loadDivisionesTable(divisionesFiltradas);
                
                // Limpiar materias hasta que se seleccione una división
                $('#materias-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>Selecciona una división para ver las materias</p></div>');
                
                this.showNotification(`Curso ${cursoId} seleccionado`, 'info');
            }
        },
        
        // Seleccionar división desde la tabla
        selectDivisionFromTable: function(ciclo, curso, division) {
            $('.division-row').removeClass('selected');
            $(`.division-row[data-ciclo="${ciclo}"][data-curso="${curso}"][data-division-id="${division}"]`).addClass('selected');
            
            // Filtrar materias para esta división
            if (this.curriculaData && this.curriculaData.matxdiv) {
                const materiasFiltradas = this.curriculaData.matxdiv.filter(mat => 
                    mat.ciclo_id === ciclo && 
                    mat.curso_id === curso && 
                    mat.division_id === division
                );
                this.loadMateriasTable(materiasFiltradas);
                
                // Actualizar resumen con datos específicos de la división
                this.updateResumenEspecifico({
                    año: this.selectedAño,
                    ciclo: ciclo,
                    curso: curso,
                    division: division,
                    materias: materiasFiltradas
                });
                
                this.showNotification(`División ${division} seleccionada`, 'info');
            }
        },
        
        // Actualizar resumen general
        updateResumen: function(data) {
            $('#año-seleccionado').text(this.selectedAño || '-');
            $('#total-materias').text(data.matxdiv ? data.matxdiv.length : 0);
            $('#total-cursos').text(data.cursos ? data.cursos.length : 0);
            $('#total-divisiones').text(data.divisiones ? data.divisiones.length : 0);
            $('#total-docentes').text(data.docentes ? data.docentes.length : 0);
            $('#total-preceptores').text(data.preceptores ? data.preceptores.length : 0);
        },
        
        // Actualizar resumen específico para una división
        updateResumenEspecifico: function(data) {
            const infoHtml = `
                <h3 style="margin-top: 0; color: #495057;">
                    <i class="fas fa-chart-pie"></i>
                    Resumen - ${data.ciclo} ${data.curso} División ${data.division} (${data.año})
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Año Académico</div>
                        <div class="info-value">${data.año}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Ciclo</div>
                        <div class="info-value">${data.ciclo}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Curso</div>
                        <div class="info-value">${data.curso}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">División</div>
                        <div class="info-value">${data.division}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Total Materias</div>
                        <div class="info-value">${data.materias.length}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Con Docente</div>
                        <div class="info-value">${data.materias.filter(m => m.estado_docente === 'Con Docente').length}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Sin Docente</div>
                        <div class="info-value">${data.materias.filter(m => m.estado_docente === 'Sin Docente').length}</div>
                    </div>
                </div>
            `;
            
            $('#resumen-panel').html(infoHtml);
        },

        // Limpiar tablas
        clearTables: function() {
            $('#cursos-content').html('<div class="empty-state"><i class="fas fa-graduation-cap fa-3x"></i><p>Selecciona un año para ver los cursos</p></div>');
            $('#divisiones-content').html('<div class="empty-state"><i class="fas fa-users fa-3x"></i><p>Selecciona un curso para ver las divisiones</p></div>');
            $('#materias-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>Selecciona una división para ver las materias</p></div>');
            $('#docentes-content').html('<div class="empty-state"><i class="fas fa-user-tie fa-3x"></i><p>Información de docentes disponible</p></div>');
            $('#preceptores-content').html('<div class="empty-state"><i class="fas fa-user-graduate fa-3x"></i><p>Información de preceptores disponible</p></div>');
            $('#resumen-panel').hide();
        },
        
        // Mostrar estado de carga
        showLoading: function() {
            const loadingHtml = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Cargando datos...</div>';
            
            $('#cursos-content').html(loadingHtml);
            $('#divisiones-content').html(loadingHtml);
            $('#materias-content').html(loadingHtml);
            $('#docentes-content').html(loadingHtml);
            $('#preceptores-content').html(loadingHtml);
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
        
        // Mostrar error general
        showError: function(message) {
            const errorHtml = `<div class="empty-state error-state"><i class="fas fa-exclamation-triangle fa-3x"></i><p>${message}</p></div>`;
            
            $('#cursos-content').html(errorHtml);
            $('#divisiones-content').html(errorHtml);
            $('#materias-content').html(errorHtml);
            $('#docentes-content').html(errorHtml);
            $('#preceptores-content').html(errorHtml);
        },
        
        // Función para mostrar notificaciones
        showNotification: function(message, type = 'info') {
            const notification = $(`
                <div class="alert alert-${type} alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'warning' ? 'exclamation' : 'info'}-circle"></i>
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
        }
    };
    
    // Inicializar el sistema
    CurriculaSystem.init();
});
</script>