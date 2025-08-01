<body>
    <div >
        <div class="card text-center" style="width: 100%;">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link " data-content="first-tab" href="#">Primero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-content="second-tab" href="#">Segundo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-content="tercer-tab" href="#">Tercero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-content="curricula-tab" href="#">Curricula</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="first-tab" class="tab-pane ">
                            <!-- Contenido actual -->
                            <div class="card-body">
                                <h5 class="card-title">Reportes</h5>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card border-primary mb-3">
                                            <div class="card-header">Busqueda</div>
                                            <div class="card-body text-primary">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="dni" placeholder="Ingrese DNI..." aria-label="DNI">
                                                    
                                                    <select class="form-control ml-1" name="anio" id="anio" aria-label="Año">
                                                        <option value="">Seleccione Año</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                    </select>
                                                    <select class="form-control ml-1" name="ciclo" id="ciclo" aria-label="Ciclo">
                                                        <option value="">Seleccione Ciclo</option>
                                                        <option value="INI">Inicial</option>
                                                        <option value="PRI">Primario</option>
                                                        <option value="SEC">Secundario</option>
                                                    </select>

                                                    <button class="btn btn-outline-primary ml-1" id="busqueda" type="button">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <button type="button" class="btn btn-primary" id="btn-modal" data-toggle="modal"  disabled>
                                                        Ver reporte via html
                                                    </button>
                                                    <a href="/ModuloImpresionPdf/plantilla/pdf/pdf_sec.php" class="btn btn-primary" id="btn-pdf" target="_blank">
                                                        Generar Reporte Via pdf
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                        <div id="second-tab" class="tab-pane">
                            <!-- Contenido de padrones.php -->
                            <?php include "plantilla/padron/padrones.php"; ?>
                        </div>
                        <div id="tercer-tab" class="tab-pane">
                            <!-- Contenido de padrones.php -->
                            <?php include "plantilla/asistencia/asistencia.php"; ?>
                        </div>
                         <div id="curricula-tab" class="tab-pane active">
                            <!-- Contenido de padrones.php -->
                            <?php include "plantilla/curricula/curricula.php"; ?>
                        </div>
            </div>
            
            
        </div>
    </div>
</body>
<?php include "plantilla/plantilla_script.php"; ?>
<?php include "plantilla/modal/modal_ini/modal.php"; ?>
<?php include "plantilla/modal/modal_sec/modal_sec.php"; ?>

<script>
    $('.nav-link').click(function(e) {
    e.preventDefault();
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
    $('.tab-pane').removeClass('active');
    $('#' + $(this).data('content')).addClass('active');
    
});
</script>