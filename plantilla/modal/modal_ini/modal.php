<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"> <!-- Cambiado a modal-xl para más espacio -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Boletín de Calificaciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <h6>Alumno: <span id="nombreAlumno"></span></h6>
                <h6>Curso: <span id="cursoAlumno"></span></h6>
            </div>
        </div>
        <table id="calificacionesTable" class="table table-bordered">
          <thead>
            <tr>
              <th rowspan="2"  class="materia-column" >Materia</th>
              <th colspan="2">Primer Trimestre</th>
              <th colspan="2">Segundo Trimestre</th>
            </tr>
            <tr>
              <th>Logrado</th>
              <th>No Logrado</th>
              <th>Logrado</th>
              <th>No Logrado</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <hr>
        <!-- Tabla de asistencias -->
        <table id="asistenciasTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Asistencia</th>
                    <th>1°C</th>
                    <th>2°C</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<style>
.materia-column {
    width: 70%;
    min-width: 300px;
}
</style>