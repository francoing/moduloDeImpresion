<script>

$(document).ready(function() {
   // Generar años y meses al cargar la página
   generarMeses();
   generarAnios();

   function generarAnios() {
       const anioActual = new Date().getFullYear();
       const select = document.getElementById('anio_alum');
       
       // Genera opciones desde el año actual hasta 4 años atrás
       for(let i = 0; i <= 4; i++) {
           const anio = anioActual - i;
           const option = new Option(anio, anio);
           select.add(option);
       }
   }

   function generarMeses() {
       const meses = [
           { value: "01", nombre: "Enero" },
           { value: "02", nombre: "Febrero" },
           { value: "03", nombre: "Marzo" },
           { value: "04", nombre: "Abril" },
           { value: "05", nombre: "Mayo" },
           { value: "06", nombre: "Junio" },
           { value: "07", nombre: "Julio" },
           { value: "08", nombre: "Agosto" },
           { value: "09", nombre: "Septiembre" },
           { value: "10", nombre: "Octubre" },
           { value: "11", nombre: "Noviembre" },
           { value: "12", nombre: "Diciembre" }
       ];

       const select = document.getElementById('mes');
       meses.forEach(mes => {
           const option = new Option(mes.nombre, mes.value);
           select.add(option);
       });
   }

   // Manejador de cambio para el ciclo
   $('#ciclo_padron_alum').change(function() {
       let ciclo = $(this).val();
       let formData = {
           ciclo: ciclo,
           api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
       };

       let html = '<option value="">Seleccione Curso</option>';
       $.ajax({
           url: 'http://localhost/csc-back/api/padrones/get_cursos.php',
           type: "POST",
           dataType: "json",
           data: formData,
           success: function(response) {
               if (response.status === 'success') {
                   response.curso.forEach((curso, index) => {
                       html += `<option value="${curso}-${response.division[index]}">${curso}-${response.division[index]}</option>`;
                   });
                   $('#curso_padron_alum').html(html);
               }
           }
       });
   });

   // Funciones para generar la tabla
   function generateDaysHeader(diasClase) {
       let headers = `<th rowspan="2" class="align-middle">Nombre</th>`;
       diasClase.forEach(dia => {
           headers += `<th>${String(dia).padStart(2, '0')}</th>`;
       });
       headers += `
           <th rowspan="2">Jus</th>
           <th rowspan="2">Inj</th>
           <th rowspan="2">Tot</th>
       `;
       return headers;
   }

   function generateTableHTML(response) {
       return `
       <div class="content-wrapper">
           <h2 class="text-center mb-4">Planilla de Asistencia</h2>
           <div class="header-container d-flex justify-content-between align-items-center mb-3">
               <div class="d-flex align-items-center">
                   <span class="mr-3">Curso: ${response.data.curso}° ${response.data.division} (${response.data.ciclo})</span>
                   <span class="mr-3">Mes: ${response.data.mes}</span>
                   <span>Año: ${response.data.anio}</span>
               </div>
           </div>
           
           <div class="table-responsive">
               <table class="table table-bordered table-sm attendance-table">
                   <thead>
                       <tr>
                           ${generateDaysHeader(response.data.dias_clase)}
                       </tr>
                   </thead>
                   <tbody>
                       ${generateTableBody(response.data.alumnos)}
                   </tbody>
               </table>
           </div>

           <div class="text-right mt-3">
               <p>Generado el: ${new Date().toLocaleString()}</p>
           </div>
       </div>`;
   }

   function generateTableBody(alumnos) {
       return alumnos.map(alumno => {
           const asistencias = Object.entries(alumno.asistencias)
               .map(([dia, valor]) => {
                   let contenido = '';
                   if (valor === 'FdS') {
                       contenido = 'FdS';
                   } else if (valor === null) {
                       contenido = '';
                   } else {
                       contenido = valor;
                   }
                   return `<td class="text-center">${contenido}</td>`;
               }).join('');

           return `
               <tr>
                   <td class="nombre-column">${alumno.apellidos}, ${alumno.nombres}</td>
                   ${asistencias}
                   <td class="text-center">${alumno.totales.justificadas}</td>
                   <td class="text-center">${alumno.totales.injustificadas}</td>
                   <td class="text-center">${alumno.totales.total}</td>
               </tr>
           `;
       }).join('');
   }

   function loadStudents(formData) {
       $.ajax({
           url: 'http://localhost/csc-back/api/asistencia/planilla.php',
           type: "POST",
           dataType: "json",
           data: formData,
           success: function(response) {
               if (response.status === 'success') {
                   const tableHTML = generateTableHTML(response);
                   $('#contenido_tabla_asistencia').html(tableHTML);
               } else {
                   Swal.fire({
                       title: '¡Atención!',
                       text: response.message,
                       showCancelButton: false,
                       confirmButtonText: 'Aceptar',
                   });
               }
           }
       });
   }

   // Manejador de eventos para los cambios en los selects
   $('#turno').change(function() {
       const ciclo = $('#ciclo_padron_alum').val();
       const curso_padron = $('#curso_padron_alum').val();
       const mes = $('#mes').val();
       const anio = $('#anio_alum').val();

       if (!ciclo || !curso_padron || !mes || !anio) {
           return;
       }

       let [curso, division] = curso_padron.split('-');

       let formData = {
           ciclo: ciclo,
           curso: curso,
           division: division,
           mes: mes,
           anio: anio,
           api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
       };
       
       loadStudents(formData);
   });
});
</script>