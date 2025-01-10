<div class="card-body">
        <h5 class="card-title">Reportes</h5>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary mb-3">
                    <div class="card-header">Busqueda</div>
                    <div class="card-body text-primary">
                        <div class="input-group mb-3">
                            <select class="form-control ml-1" name="ciclo" id="ciclo_padron" aria-label="Ciclo">
                                <option value="">Seleccione Ciclo</option>
                                <option value="INI">INI</option>
                                <option value="PRI">PRI</option>
                                <option value="SEC">SEC</option>
                            </select>
                            <select class="form-control ml-1" name="curso" id="curso_padron" aria-label="Curso">
                                <option value="">Seleccione Curso</option>
                            </select>

                            <select class="form-control ml-1" name="periodo" id="periodo_padron" aria-label="Periodo">
                                <option value="">Seleccione Periodo</option>
                            </select>

                            <select class="form-control ml-1" name="padron" id="padron" aria-label="Padron">
                                <option value="">Seleccione Padron</option>
                                <option value="parcial">Padron parcial</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include "plantilla/padron/padrones_script.php"; ?>