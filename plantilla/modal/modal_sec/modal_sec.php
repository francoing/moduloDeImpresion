<!-- modal_sec.php -->
<div class="modal fade" id="exampleModalSec" tabindex="-1" aria-labelledby="exampleModalSecLabel" aria-hidden="true">
 <div class="modal-dialog modal-xl">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalSecLabel">Boletín de Calificaciones</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       <div class="row mb-3">
         <div class="col">
           <h6>Alumno: <span id="nombreAlumnoSec"></span></h6>
           <h6>Curso: <span id="cursoAlumnoSec"></span></h6>
         </div>
       </div>

       <table id="calificacionesTableSec" class="table table-bordered">
         <thead>
           <tr>
             <th rowspan="2" class="align-middle">ESPACIOS CURRICULARES</th>
             <th colspan="3">1°T</th>
             <th colspan="3">2°T</th>
             <th colspan="3">3°T</th>
             <th colspan="4">Calificación Final</th>
           </tr>
           <tr>
             <th>Calif.</th>
             <th>Rec.</th>
             <th>Inas.</th>
             <th>Calif.</th>
             <th>Rec.</th>
             <th>Inas.</th>
             <th>Calif.</th>
             <th>Rec.</th>
             <th>Inas.</th>
             <th>Cal.final</th>
             <th>Dic.</th>
             <th>Feb.</th>
             <th>C.D</th>
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