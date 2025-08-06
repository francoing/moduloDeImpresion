<script>
// Sistema de Gestión de Currícula - Funciones JavaScript Actualizado (Sin Selects)
$(document).ready(function() {
    
    // Configuración global del sistema
    window.CurriculaSystem = {
        selectedMateria: null,
        currentData: null,
        selectedAño: null,
        //apiEndpoint: URL_API_DOS +'curricula/get_curricula_data.php',
        apiEndpoint: 'http://localhost/csc-back/api/curricula/get_curricula_data.php',
        api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0=',
        añosData: null,
        curriculaData: null,
        matxdivData:null,
        materiasData:null,
        docentesData:null,
        selectedCiclo: null,    // Nueva propiedad
        selectedCurso: null,    // Nueva propiedad
        selectedDivision: null, // Nueva propiedad
        selectedMateria: null, // Nueva propiedad
        selectedNombreMateria:null,
        
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
                            Curricula
                        </h2>
                    </div>

                    <!-- Grid de Tablas -->
                    <div class="tables-grid">

                        <!-- Tabla de años -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-calendar"></i>
                                Años
                            </div>
                            <div class="table-container">
                                <div id="años-content" class="empty-state">
                                    <i class="fas fa-calendar-alt fa-3x"></i>
                                    <p>Cargando años académicos...</p>
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

                        <!-- Tabla de Materias x division -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-book"></i>
                                Materias por Curso
                            </div>
                            <div class="table-container">
                                <div id="materiaspordiv-content" class="empty-state">
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
                                <button type="button" id="agregar_docente" class="btn btn-sm btn-success ml-auto">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="table-container">
                                <div id="docentes-content" class="empty-state">
                                    <i class="fas fa-user-tie fa-3x"></i>
                                    <p>Información de docentes disponible</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Materias -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-book"></i>
                                Materias 
                            </div>
                            <div class="table-container">
                                <div id="materias-content" class="empty-state">
                                    <i class="fas fa-book-open fa-3x"></i>
                                    <p>Selecciona una división para ver las materias</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Preceptores -->
                        <div class="table-section">
                            <div class="table-header">
                                <i class="fas fa-user-graduate"></i>
                                Preceptores / Tutores
                                <button id="agregar_preceptor" class="btn btn-success btn-sm ml-auto">
                                    <i class="fas fa-plus"></i>
                                </button>
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
            $(document).off('click', '.btn-select-materia').on('click', '.btn-select-materia', this.onMateriaSelect.bind(this));
            $(document).off('click', '.btn-select-docente').on('click', '.btn-select-docente', this.onDocenteSelect.bind(this));

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

        // Carga de materias
        loadMatxDiv: function(anio,ciclo, curso, division) {
            // Mostrar estado de carga
            //this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_matxdiv',
                    anio: anio,
                    ciclo_id: ciclo,
                    curso_id: curso,
                    division_id: division,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de currícula:', data);
                    
                    if (data.status === 'success') {
                        this.materiasData = data.data;
                        this.loadMateriasxDivTable(data.data);
                        //this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
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

        // Carga de materias por divisiones 
        loadMateriasPorDivision: function(materia_id) {
            // Mostrar estado de carga
            //this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_materias',
                    materia_id:materia_id,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de currícula:', data);
                    
                    if (data.status === 'success') {
                        this.materiasData = data.data;
                        this.loadMateriasTable(data.data);
                        //this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
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

        // Carga de materias
        loadDocentes: function(anio, materia_id, ciclo = null, curso = null, division = null) {
            // Mostrar estado de carga
            //this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_docentes',
                    anio: anio,
                    materia_id:materia_id,
                    ciclo_id: ciclo,
                    curso_id: curso,
                    division_id: division,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de currícula:', data);
                    
                    if (data.status === 'success') {
                        this.docentesData = data.data;
                        this.loadDocentesTable(data.data);
                        //this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
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

        loadPreceptores: function( ciclo = null, curso = null, division = null) {
            // Mostrar estado de carga
            //this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: 'obtener_preceptores',
                    ciclo_id: ciclo,
                    curso_id: curso,
                    division_id: division,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de preceptores:', data);
                    
                    if (data.status === 'success') {
                        //this.docentesData = data.data;
                        this.loadPreceptoresTable(data.data);
                        //this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
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

        // Carga de materias
        loadPrexDiv: function(anio,ciclo, curso, division) {
            // Mostrar estado de carga
            //this.showLoading();
            
            $.ajax({
                url: this.apiEndpoint,
                method: 'POST',
                data: { 
                    accion: '',
                    anio: anio,
                    materia_id:materia_id,
                    api_key: this.api_key 
                },
                dataType: 'json',
                success: (data) => {
                    console.log('Respuesta de currícula:', data);
                    
                    if (data.status === 'success') {
                        this.docentesData = data.data;
                        this.loadDocentesTable(data.data);
                        //this.showNotification(`Datos del año ${anio} cargados correctamente`, 'success');
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
            this.loadMateriasTable(data.materias || []);
            this.loadMateriasxDivTable(data.matxdiv || []);
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
                        estadoTexto = 'Vencido';
                        estadoClass = 'vigente';
                        break;
                    case 'i':
                        estadoTexto = 'Inscripcion';
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
                                 Ver MatxDiv
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
                            <th>Abreviatura</th>
                            <th>Analitico</th>
                           
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            materias.forEach(materia => {
                
                html += `
                    <tr data-materia-id="${materia.id}" class="materia-row">
                        <td><strong>${materia.codigo}</strong></td>
                        <td>${materia.nombre}</td>
                        <td>${materia.abreviatura}</td>
                        <td>${materia.analitico}</td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#materias-content').html(html);
        },
        
        // Cargar tabla de materias
        loadMateriasxDivTable: function(materias) {
            if (!materias || materias.length === 0) {
                $('#materiaspordiv-content').html('<div class="empty-state"><i class="fas fa-book-open fa-3x"></i><p>No hay materias registradas</p></div>');
                return;
            }
            
            let html = `
                <table class="curricula-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Numero</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            materias.forEach(materia => {
                //const estadoClass = materia.estado_docente === 'Con Docente' ? 'activo' : 'inactivo';
                const estadoTexto = materia.estado === 'A' ? 'Activa' : 'Inactiva';
                const estadoClass = materia.estado === 'A' ? 'activo' : 'inactivo';
                
                html += `
                    <tr data-materia-id="${materia.id}" class="materia-row">
                        <td><strong>${materia.codigo}</strong></td>
                        <td>${materia.numero}</td>
                        <td>
                            <span class="status-badge status-${estadoClass}">
                                ${estadoTexto}
                            </span>
                        </td>
                        <td>${materia.tipo}</td>
                        <td>${materia.observacion}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary btn-select-materia"
                             data-materia-id="${materia.id}" data-anio="${this.selectedAño}"
                            >
                                        Ver 
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            $('#materiaspordiv-content').html(html);
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
                    <tr class="docente-row">
                        <td><strong>${docente.legajo}</strong></td>
                        <td>${docente.nombres}</td>
                        <td>${docente.apellidos}</td>
                        <td>
                            <button id="eliminar_docente" 
                                class="btn btn-sm btn-outline-danger btn-eliminar-docente"
                                data-legajo="${docente.legajo}"
                                data-nombres="${docente.nombres}"
                                data-apellidos="${docente.apellidos}">
                                Eliminar
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
                    <tr class="preceptor-row">
                        <td><strong>${preceptor.legajo}</strong></td>
                        <td>${preceptor.nombre}</td>
                        <td><span class="badge badge-info">${preceptor.division_completa || 'No especificada'}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-danger btn-eliminar-preceptor"
                                        data-legajo="${preceptor.legajo}"
                                        data-nombre="${preceptor.nombre}"
                                        data-toggle="tooltip" 
                                        title="Eliminar preceptor de esta división">
                                     Eliminar
                                </button>
                            </div>
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

        onMateriaSelect: function(e) {
            const button = $(e.currentTarget);
            this.selectMateriaFromTable(
                button.data('materia-id'),
                button.data('anio')
            );
        },

        onDocenteSelect: function(e) {
            const button = $(e.currentTarget);
            this.selectDocenteFromTable(
                button.data('anio'),
                button.data('materia-id')
            );
        },

        selectDocenteFromTable: function(año,materia) {

            const añoId = Number(año);
            // Marcar año como seleccionado
            $('.materia-row').removeClass('selected');
            $(`.materia-row[data-anio="${añoId}"][data-materia-id="${materia}"]`).addClass('selected');
            
            // Cargar datos del año
            this.loadDocentes(año,materia);
            this.showNotification(`Año ${año} seleccionado`, 'success');
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
            this.selectedCiclo = ciclo;
            this.selectedCurso = curso;
            this.selectedDivision = division;

            $('.division-row').removeClass('selected');
            $(`.division-row[data-ciclo="${ciclo}"][data-curso="${curso}"][data-division-id="${division}"]`).addClass('selected');
                this.loadMatxDiv(this.selectedAño,ciclo, curso, division);
                this.loadPreceptores(ciclo, curso, division);
                this.showNotification(`División ${division} seleccionada`, 'info');
        },

        selectMateriaFromTable: function(materia,anio) {
            $('.materia-row').removeClass('selected');
            $(`.materia-row[data-materia-id="${materia}"][data-anio="${anio}"]`).addClass('selected');
                this.selectedMateria = materia;
                this.selectedNombreMateria = this.materiasData[0].nombre;
                this.loadDocentes(anio, materia, this.selectedCiclo, this.selectedCurso, this.selectedDivision);
                this.loadMateriasPorDivision(materia);
                this.showNotification(`Materia ${materia} seleccionada`, 'info');
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
        showNotification: function(message, type = 'ino') {
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
        },

        
    };
    
    // Inicializar el sistema
    CurriculaSystem.init();
});
</script>