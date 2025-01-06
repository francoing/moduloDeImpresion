<script>
  // plantilla_script.php
let responseData; 
// secundario
function renderSecData(data) {
   $('#nombreAlumnoSec').text(`${data.alumno.nombre} ${data.alumno.apellido}`);
   $('#cursoAlumnoSec').text(`${data.alumno.curso}° ${data.alumno.division}`);

   var table = $('#calificacionesTableSec').DataTable({
      paging: true,
      searching: false,
      ordering: false,
      info: false,
      destroy: true,
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Exportar PDF',
                title: `Boletín de ${data.alumno.nombre} ${data.alumno.apellido}`,
                customize: function(doc) {
                    doc.content.splice(1, 0, {
                        text: `Curso: ${data.alumno.curso}° ${data.alumno.division}`,
                        style: 'subheader'
                    });
                    doc.styles.tableHeader.fillColor = '#4CAF50';
                }
            }
        ]
   });

   table.clear();
   data.materias.nombre_materia_primaria.forEach((materia, index) => {
       const materiaId = data.materias.materia_id[index];
       const tr1 = parseFloat(data.calificaciones.TR1?.[materiaId]) || 0;
       const tr2 = parseFloat(data.calificaciones.TR2?.[materiaId]) || 0;
       const tr3 = parseFloat(data.calificaciones.TR3?.[materiaId]) || 0;
       
       // Calcular promedio si hay notas
       let promedio = '-';
       if (tr1 || tr2 || tr3) {
           const suma = tr1 + tr2 + tr3;
           const cantidad = (tr1 ? 1 : 0) + (tr2 ? 1 : 0) + (tr3 ? 1 : 0);
           promedio = (suma / cantidad).toFixed(2);
       }

       // Determinar C.D
       const dic = parseFloat(data.calificaciones.DIC?.[materiaId]) || 0;
       const feb = parseFloat(data.calificaciones.FEB?.[materiaId]) || 0;
       let cd = '-';
       
       if (promedio !== '-' && parseFloat(promedio) >= 6) {
           cd = promedio;
       } else if (dic >= 6) {
           cd = dic;
       } else if (feb >= 6) {
           cd = feb;
       }

       let row = [
           materia,
           data.calificaciones.TR1?.[materiaId] || '-',
           data.calificaciones.IC1?.[materiaId] || '-',
           data.calificaciones.N41?.[materiaId] || '-',
           data.calificaciones.TR2?.[materiaId] || '-',
           data.calificaciones.IC2?.[materiaId] || '-',
           data.calificaciones.N42?.[materiaId] || '-',
           data.calificaciones.TR3?.[materiaId] || '-',
           data.calificaciones.IC3?.[materiaId] || '-',
           data.calificaciones.N43?.[materiaId] || '-',
           promedio,
           data.calificaciones.DIC?.[materiaId] || '-',
           data.calificaciones.FEB?.[materiaId] || '-',
           cd
       ];
       table.row.add(row);
   });

   // Código de asistencias sin cambios
   var tableAsistencias = $('#asistenciasTableSec').DataTable({
       paging: false,
       searching: false,
       ordering: false,
       info: false,
       destroy: true,
       dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Exportar PDF',
                title: `Boletín de ${data.alumno.nombre} ${data.alumno.apellido}`,
                customize: function(doc) {
                    doc.content.splice(1, 0, {
                        text: `Curso: ${data.alumno.curso}° ${data.alumno.division}`,
                        style: 'subheader'
                    });
                    doc.styles.tableHeader.fillColor = '#4CAF50';
                }
            }
        ]
   });
   
   tableAsistencias.clear();
   const asistenciasData = [
       ['Asistencia', data.asistencias.preTR1, data.asistencias.preTR2, data.asistencias.pretot],
       ['Inasist. Just.', data.asistencias.jusTR1, data.asistencias.jusTR2, data.asistencias.justot || 0],
       ['Inasist. Injust.', data.asistencias.injusTR1, data.asistencias.injusTR2, data.asistencias.injustot],
       ['Llegadas tarde', 
           data.asistencias.LTITR1 + data.asistencias.LTJTR1,
           data.asistencias.LTITR2 + data.asistencias.LTJTR2,
           data.asistencias.LTI + data.asistencias.LTJ
       ]
   ];
  
   asistenciasData.forEach(row => tableAsistencias.row.add(row));

   tableAsistencias.draw();
   table.draw();
   $('#exampleModalSec').modal('show');
}
//inicial
function renderIniData(data) {
   var tableCalificaciones = $('#calificacionesTable').DataTable({
       paging: true,
       searching: false,
       ordering: false,
       info: false,
       language: {
           url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
       },
       destroy: true
   });

   var tableAsistencias = $('#asistenciasTable').DataTable({
       paging: false,
       searching: false,
       ordering: false,
       info: false,
       destroy: true
   });
   
   $('#nombreAlumno').text(`${data.alumno.nombre} ${data.alumno.apellido}`);
   $('#cursoAlumno').text(`${data.alumno.curso}° ${data.alumno.division}`);
   
   tableCalificaciones.clear();
   tableAsistencias.clear();

   data.materias.nombre_materia_primaria.forEach((materia, index) => {
       const materiaId = data.materias.materia_id[index];
       const notaTrim1 = data.calificaciones.CU1[materiaId];
       const notaTrim2 = data.calificaciones.CU2[materiaId];

       tableCalificaciones.row.add([
           materia,
           notaTrim1 === '6' ? 'X' : '',
           notaTrim1 !== '6' ? 'X' : '',
           notaTrim2 === '6' ? 'X' : '',
           notaTrim2 !== '6' ? 'X' : ''
       ]);
   });

   const asistenciasData = [
       ['Asistencia', data.asistencias.preTR1, data.asistencias.preTR2, data.asistencias.pretot],
       ['Inasist. Just.', data.asistencias.jusTR1, data.asistencias.jusTR2, data.asistencias.justot || 0],
       ['Inasist. Injust.', data.asistencias.injusTR1, data.asistencias.injusTR2, data.asistencias.injustot],
       ['Llegadas tarde', 
           data.asistencias.LTITR1 + data.asistencias.LTJTR1,
           data.asistencias.LTITR2 + data.asistencias.LTJTR2,
           data.asistencias.LTI + data.asistencias.LTJ
       ]
   ];
   
   asistenciasData.forEach(row => tableAsistencias.row.add(row));

   tableCalificaciones.draw();
   tableAsistencias.draw();
   
   $('#exampleModal').modal('show');
}

$(document).ready(function() {
   $('#busqueda').click(function() {
       $('#btn-modal').html('<span class="spinner-border spinner-border-sm"></span> Ver reporte via html');
       $('#btn-pdf').html('<span class="spinner-border spinner-border-sm"></span> Generar Reporte Via pdf');

       let formData = {
           dni_alumno: $('#dni').val(),
           anio: $('#anio').val(),
           ciclo_alumno: $('#ciclo').val(),
           api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
       };
       
       $.ajax({
           url: 'http://localhost/csc-back/api/padres/get_informe_anual_optimizado.php',
           type: "POST",
           dataType: "json",
           data: formData,
           success: function(response) {
               responseData = response; // Almacenar en variable global
               if (response.status === 'success') {
                   resetButtons();
                   configurarBotonModal(response.alumno.ciclo);
               }
           },
           error: handleError
       });
   });

   function resetButtons() {
       $('#btn-modal').html('Ver reporte via html').prop('disabled', false);
       $('#btn-pdf').html('Generar Reporte Via pdf').prop('disabled', false);
   }

   function configurarBotonModal(ciclo) {
        const btn = $('#btn-modal');
        btn.off('click'); // Remover eventos previos
        
        if(ciclo === 'SEC') {
            btn.attr('data-target', '#exampleModalSec')
               .addClass('modal-sec')
               .on('click', function() {
                    renderSecData(responseData);
               });
        } else if(ciclo === 'INI') {
            btn.attr('data-target', '#exampleModal')
               .addClass('modal-ini')
               .on('click', function() {
                   renderIniData(responseData);
               });
        }
    }

   function handleError(xhr, status, error) {
       console.error('Error:', error);
       resetButtons();
   }
});

</script>