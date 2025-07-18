<style>
/* === SISTEMA DE CURRÍCULA - ESTILOS === */

.curricula-container {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 20px rgba(0,0,0,0.08);
}

/* Header del sistema */
.curricula-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 25px;
    border-radius: 8px 8px 0 0;
    margin: -20px -20px 25px -20px;
    position: relative;
    overflow: hidden;
}

.curricula-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.curricula-header h2 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
    font-weight: 600;
    position: relative;
    z-index: 1;
}

.curricula-header h2 i {
    font-size: 28px;
    color: #3498db;
}

/* Panel de control */
.control-panel {
    background: white;
    padding: 25px;
    border-radius: 8px;
    margin-bottom: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.control-group {
    display: flex;
    gap: 20px;
    align-items: flex-end;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.control-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 180px;
    flex: 1;
}

.control-item label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.control-item select,
.control-item input {
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
    min-height: 44px;
}

.control-item select:focus,
.control-item input:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    transform: translateY(-1px);
}

.control-item select:disabled,
.control-item input:disabled {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
}

/* Botón consultar */
.btn-consultar {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 44px;
    box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
}

.btn-consultar:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
}

.btn-consultar:active:not(:disabled) {
    transform: translateY(0);
}

.btn-consultar:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-consultar i {
    font-size: 16px;
}

/* Grid de tablas */
.tables-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 25px;
}

/* Secciones de tabla */
.table-section {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.table-section:hover {
    box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    transform: translateY(-1px);
}

.table-header {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 18px 20px;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-header i {
    font-size: 18px;
    color: #3498db;
}

.table-container {
    max-height: 450px;
    overflow-y: auto;
    position: relative;
}

/* Scrollbar personalizada */
.table-container::-webkit-scrollbar {
    width: 6px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.table-container::-webkit-scrollbar-thumb {
    background: #bdc3c7;
    border-radius: 3px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #95a5a6;
}

/* Tablas */
.curricula-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.curricula-table th {
    background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #bdc3c7;
    position: sticky;
    top: 0;
    z-index: 10;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.curricula-table td {
    padding: 12px;
    border-bottom: 1px solid #ecf0f1;
    transition: all 0.2s ease;
    vertical-align: middle;
}

.curricula-table tbody tr {
    cursor: pointer;
    transition: all 0.2s ease;
}

.curricula-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.curricula-table tbody tr.selected {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border-left: 4px solid #2196f3;
    box-shadow: inset 0 0 10px rgba(33, 150, 243, 0.1);
}

.curricula-table tbody tr.materia-row:hover {
    background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
}

/* Estados y badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.status-activo {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-inactivo {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.status-pendiente {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    color: #856404;
    border: 1px solid #ffeaa7;
}

/* Estados vacíos y de carga */
.loading {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px;
    color: #6c757d;
    font-size: 16px;
    font-weight: 500;
}

.loading i {
    margin-right: 10px;
    font-size: 20px;
    color: #3498db;
}

.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 15px;
    opacity: 0.6;
    color: #bdc3c7;
}

.empty-state p {
    font-size: 16px;
    margin: 0;
    font-weight: 500;
}

.error-state {
    color: #dc3545 !important;
}

.error-state i {
    color: #dc3545 !important;
}

/* Panel de información */
.info-panel {
    background: white;
    padding: 25px;
    border-radius: 8px;
    margin-top: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.info-panel h3 {
    color: #2c3e50;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-panel h3 i {
    color: #3498db;
    font-size: 22px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.info-item {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    border-left: 4px solid #3498db;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.info-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.info-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
}

/* Animaciones */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.curricula-container * {
    animation: fadeIn 0.5s ease-out;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(52, 152, 219, 0);
    }
}

.btn-consultar:not(:disabled):hover {
    animation: pulse 2s infinite;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .tables-grid {
        grid-template-columns: 1fr;
    }
    
    .control-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .control-item {
        min-width: auto;
    }
}

@media (max-width: 768px) {
    .curricula-container {
        padding: 15px;
        margin: 10px 0;
    }
    
    .curricula-header {
        padding: 20px;
        margin: -15px -15px 20px -15px;
    }
    
    .curricula-header h2 {
        font-size: 20px;
    }
    
    .control-panel {
        padding: 20px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .table-container {
        max-height: 350px;
    }
    
    .curricula-table th,
    .curricula-table td {
        padding: 10px 8px;
        font-size: 13px;
    }
    
    .btn-consultar {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .curricula-header h2 {
        font-size: 18px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }
    
    .curricula-table {
        font-size: 12px;
    }
    
    .curricula-table th,
    .curricula-table td {
        padding: 8px 6px;
    }
    
    .status-badge {
        font-size: 10px;
        padding: 4px 8px;
    }
    
    .info-value {
        font-size: 16px;
    }
}

/* Mejoras de accesibilidad */
.curricula-table tbody tr:focus {
    outline: 2px solid #3498db;
    outline-offset: -2px;
}

.control-item select:focus,
.control-item input:focus {
    outline: none;
}

.btn-consultar:focus {
    outline: 2px solid #2980b9;
    outline-offset: 2px;
}

/* === ESTILOS MINIMALISTAS BOOTSTRAP-LIKE === */

/* Tablas con estilo Bootstrap minimalista */
.curricula-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    background: white;
    margin: 0;
}

.curricula-table th {
    background: #f8f9fa;
    padding: 8px 12px;
    text-align: left;
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
    position: sticky;
    top: 0;
    z-index: 10;
    font-size: 13px;
    text-transform: none;
    letter-spacing: normal;
}

.curricula-table td {
    padding: 8px 12px;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
    line-height: 1.2;
}

.curricula-table tbody tr {
    cursor: pointer;
    transition: background-color 0.15s ease;
}

.curricula-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: none;
}

/* Filas más compactas y minimalistas */
.año-row {
    height: 45px;
}

.año-row td {
    padding: 6px 12px;
}

/* Estados minimalistas para badges */
.status-badge {
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

/* Estados específicos minimalistas */
.status-activo {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-vigente {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.status-inactivo {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Botón minimalista estilo Bootstrap */
.btn-select-año {
    background: #007bff;
    border: 1px solid #007bff;
    color: white;
    font-weight: 400;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 4px;
    transition: all 0.15s ease;
    min-width: 80px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}

.btn-select-año:hover:not(:disabled) {
    background: #0056b3;
    border-color: #0056b3;
    color: white;
    transform: none;
    box-shadow: none;
}

.btn-select-año:active:not(:disabled) {
    background: #004085;
    border-color: #004085;
    transform: none;
}

.btn-select-año:disabled {
    background: #6c757d;
    border-color: #6c757d;
    cursor: not-allowed;
    opacity: 0.65;
}

.btn-select-año i {
    font-size: 10px;
}

/* Selección minimalista */
.año-row.selected {
    background: #e7f3ff !important;
    border-left: 3px solid #007bff;
    box-shadow: none;
}

/* Hover minimalista */
.table-hover-highlight {
    background-color: #f8f9fa !important;
    transform: none;
    transition: background-color 0.15s ease;
}

/* Año activo minimalista */
.año-activo {
    background: #f0f9ff;
    border-left: 3px solid #0ea5e9;
}

.año-activo:hover {
    background: #e0f2fe;
}

/* Eliminar animaciones excesivas */
.año-activo .status-badge {
    animation: none;
}

/* Texto muted más sutil */
.text-muted {
    color: #6c757d !important;
    font-style: normal;
    font-size: 12px;
}

/* Headers de tabla minimalistas */
.table-header {
    background: #495057;
    color: white;
    padding: 12px 16px;
    font-weight: 500;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    text-transform: none;
    letter-spacing: normal;
}

.table-header i {
    font-size: 14px;
    color: white;
}

/* Container de tabla minimalista */
.table-container {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-top: none;
}

/* Sección de tabla minimalista */
.table-section {
    background: white;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #dee2e6;
    transition: none;
}

.table-section:hover {
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    transform: none;
}

/* Estados vacíos minimalistas */
.empty-state {
    text-align: center;
    padding: 30px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 32px;
    margin-bottom: 10px;
    opacity: 0.5;
    color: #adb5bd;
}

.empty-state p {
    font-size: 14px;
    margin: 0;
    font-weight: 400;
}

/* Loading minimalista */
.loading {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px;
    color: #6c757d;
    font-size: 14px;
}

.loading i {
    font-size: 20px;
    margin-bottom: 8px;
    color: #007bff;
}

/* Scrollbar minimalista */
.table-container::-webkit-scrollbar {
    width: 6px;
}

.table-container::-webkit-scrollbar-track {
    background: #f8f9fa;
}

.table-container::-webkit-scrollbar-thumb {
    background: #dee2e6;
    border-radius: 3px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #adb5bd;
}

/* Responsive minimalista */
@media (max-width: 768px) {
    .curricula-table th,
    .curricula-table td {
        padding: 6px 8px;
        font-size: 12px;
    }
    
    .btn-select-año {
        font-size: 11px;
        padding: 3px 8px;
        min-width: 70px;
        height: 24px;
    }
    
    .status-badge {
        font-size: 10px;
        padding: 2px 6px;
    }
    
    .año-row {
        height: 40px;
    }
    
    .table-header {
        padding: 10px 12px;
        font-size: 13px;
    }
    
    /* Ocultar descripción en móviles */
    .curricula-table th:nth-child(3),
    .curricula-table td:nth-child(3) {
        display: none;
    }
}

@media (max-width: 576px) {
    .curricula-table th,
    .curricula-table td {
        padding: 4px 6px;
        font-size: 11px;
    }
    
    .btn-select-año {
        font-size: 10px;
        padding: 2px 6px;
        min-width: 60px;
        height: 22px;
    }
    
    .año-row {
        height: 36px;
    }
    
    /* Ocultar estado en pantallas muy pequeñas */
    .curricula-table th:nth-child(2),
    .curricula-table td:nth-child(2) {
        display: none;
    }
}

/* Eliminar efectos innecesarios */
.table-section::before {
    display: none;
}

.curricula-container::before {
    display: none;
}

/* Botón consultar minimalista */
.btn-consultar {
    background: #007bff;
    color: white;
    border: 1px solid #007bff;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    font-size: 14px;
    text-transform: none;
    letter-spacing: normal;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: none;
}

.btn-consultar:hover:not(:disabled) {
    background: #0056b3;
    border-color: #0056b3;
    transform: none;
    box-shadow: none;
}

.btn-consultar:disabled {
    opacity: 0.65;
    cursor: not-allowed;
    background: #6c757d;
    border-color: #6c757d;
}

/* Panel de control minimalista */
.control-panel {
    background: white;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #dee2e6;
}

/* Controles minimalistas */
.control-item select,
.control-item input {
    padding: 6px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease;
    background: white;
    min-height: 38px;
}

.control-item select:focus,
.control-item input:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

.control-item label {
    font-weight: 500;
    color: #495057;
    font-size: 14px;
    margin-bottom: 4px;
    text-transform: none;
    letter-spacing: normal;
}

/* Grid minimalista */
.tables-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

@media (max-width: 1200px) {
    .tables-grid {
        grid-template-columns: 1fr;
    }
}

/* Contenedor principal minimalista */
.curricula-container {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 4px;
    margin: 20px 0;
    box-shadow: none;
    border: 1px solid #dee2e6;
}

/* Header minimalista */
.curricula-header {
    background: #495057;
    color: white;
    padding: 20px;
    border-radius: 4px 4px 0 0;
    margin: -20px -20px 20px -20px;
    border-bottom: 1px solid #dee2e6;
}

.curricula-header h2 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    font-weight: 500;
}

.curricula-header h2 i {
    font-size: 20px;
    color: white;
}

/* Notificaciones minimalistas */
.alert {
    border-radius: 4px;
    border: 1px solid transparent;
    box-shadow: none;
    padding: 12px 15px;
    margin-bottom: 15px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border-color: #bee5eb;
}

.alert i {
    margin-right: 6px;
}

/* Notificaciones flotantes */
.alert {
    border-radius: 6px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    color: #0c5460;
}

.alert i {
    margin-right: 8px;
}

/* Mejorar botones de acción en tablas */
.btn-select-año {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-select-año:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    color: white;
}

/* Estados de error mejorados */
.error-state {
    color: #dc3545 !important;
}

.error-state i {
    color: #dc3545 !important;
}

.error-state .btn {
    margin-top: 15px;
}

/* Animaciones para las tablas */
.curricula-table tbody tr {
    transition: all 0.2s ease;
}

.curricula-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

/* Mejorar la tabla de años específicamente */
.table-section:first-child .table-header {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

/* Grid responsivo mejorado */
@media (max-width: 1400px) {
    .tables-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .tables-grid {
        grid-template-columns: 1fr;
    }
    
    .control-group {
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
}

@media (max-width: 576px) {
    .control-group {
        grid-template-columns: 1fr;
    }
    
    .btn-sm {
        font-size: 11px;
        padding: 3px 6px;
    }
}

/* Mejoras para la accesibilidad */
.btn:focus,
.form-control:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Loader específico para tablas */
.loading {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 40px;
    color: #6c757d;
    font-size: 14px;
}

.loading i {
    font-size: 24px;
    margin-bottom: 10px;
    color: #007bff;
}

/* Estados de las tablas mejorados */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 42px;
    margin-bottom: 12px;
    opacity: 0.6;
    color: #bdc3c7;
}

.empty-state p {
    font-size: 15px;
    margin: 0;
    font-weight: 500;
    line-height: 1.4;
}

/* Efectos de transición para cambios de contenido */
.table-container > * {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mejoras en los badges de estado */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

/* Scroll personalizado para las tablas */
.table-container {
    scrollbar-width: thin;
    scrollbar-color: #bdc3c7 #f1f1f1;
}

.table-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb {
    background: #bdc3c7;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #95a5a6;
}

/* Efectos hover mejorados para botones */
.btn-consultar,
.btn-select-año {
    position: relative;
    overflow: hidden;
}

.btn-consultar::before,
.btn-select-año::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-consultar:hover::before,
.btn-select-año:hover::before {
    left: 100%;
}

/* Mejoras en la tipografía */
.table-header {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 700;
    letter-spacing: 0.8px;
}

.curricula-table th {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 600;
}

/* Sombras dinámicas */
.table-section {
    transition: all 0.3s ease;
}

.table-section:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

/* Estados de carga específicos por sección */
.años-loading {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
}

.materias-loading {
    background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
}

.docentes-loading {
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
}

.horarios-loading {
    background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
}
</style>