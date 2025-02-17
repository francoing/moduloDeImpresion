<script>

$(document).ready(function() {
   // Generar años y meses al cargar la página
    generarMeses();
    generarAnios();
    cargarOpcionesMenu();

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

    // Funciones para generar la tabla
    function generateDaysHeader(dias_mes, diasClase) {
            let headers = `<th rowspan="2" class="align-middle">Nombre</th>`;
            
            // Generar columnas para todos los días del mes
            for(let i = 1; i <= dias_mes; i++) {
                const diaFormateado = String(i).padStart(2, '0');
                // Verificar si este día está en diasClase
                const esDiaClase = diasClase.includes(i);
                // Si es día de clase, mostrar el número, si no, mostrar FdS o dejarlo vacío
                headers += `<th>${diaFormateado}</th>`;
            }

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
                            ${generateDaysHeader(response.data.dias_mes,response.data.dias_clase)}
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

    function actualizarEstadoDia(dia, estado) {

        // const formData = {
        //     dia: dia,
        //     estado: estado,
        //     mes: $('#mes').val(),
        //     anio: $('#anio_alum').val(),
        //     ciclo: $('#ciclo_padron_alum').val(),
        //     curso: $('#curso_padron_alum').val().split('-')[0],
        //     division: $('#curso_padron_alum').val().split('-')[1],
        //     api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
        // };

        // $.ajax({
        //     url: 'http://localhost/csc-back/api/asistencia/actualizar_estado_dia.php',
        //     type: 'POST',
        //     dataType: 'json',
        //     data: formData,
        //     success: function(response) {
        //         if(response.status === 'success') {
        //             // Recargar la tabla
        //             loadStudents(formData);
        //         } else {
        //             Swal.fire({
        //                 title: '¡Error!',
        //                 text: response.message,
        //                 icon: 'error'
        //             });
        //         }
        //     }
        // });
    }

    // Cargar opciones del menú al iniciar
    function cargarOpcionesMenu() {
        $.ajax({
            url: 'http://localhost/csc-back/api/asistencia/get_opciones_menu_dia.php',
            type: "POST",
            dataType: "json",
            data: { 
                api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
            },
            success: function(response) {
                if (response.status === 'success') {
                    let menuHtml = '';
                    response.opciones.forEach(opcion => {
                        menuHtml += `<div class="menu-item" data-action="${opcion.id}">[${opcion.id}] ${opcion.descripcion}</div>`;
                    });
                    $('#contextMenuDia').html(menuHtml);
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

    $(document).on('contextmenu', '.attendance-table th', function(e) {
        e.preventDefault();
        
        if($(this).text().match(/^\d{2}$/)) {
            const columnIndex = $(this).index();
            
            // Remover hover previo
            $('.column-hover').removeClass('column-hover');
            
            // Aplicar hover usando eq()
            $('.attendance-table td').each(function() {
                if($(this).index() === columnIndex) {
                    $(this).addClass('column-hover');
                }
            });
            $('.attendance-table th').eq(columnIndex).addClass('column-hover');
            
            const contextMenu = $('#contextMenu');
            contextMenu.data('selectedDay', $(this).text());
            contextMenu.data('columnIndex', columnIndex);
            
            contextMenu.css({
                top: e.pageY + 'px',
                left: e.pageX + 'px',
                display: 'block'
            });
        }
    });

    $(document).on('contextmenu', '.attendance-table tbody td:not(:first-child):not(:last-child):not(:nth-last-child(2)):not(:nth-last-child(3))', function(e) {
        e.preventDefault();
        
        const contenidoCelda = $(this).text().trim();
        if(['FdS', 'FeN', 'FeP', 'AsN', 'AsP', 'AsE', 'RaI', 'PaN', 'PaP', 'ReV', 'ReI', 'Ef', 'JdE'].includes(contenidoCelda)) {
            return;
        }

        const contextMenuDia = $('#contextMenuDia');
        contextMenuDia.data('selectedCell', $(this));
        
        // Obtener dimensiones y posiciones
        const cellRect = this.getBoundingClientRect();
        const windowHeight = $(window).height();
        const menuHeight = contextMenuDia.outerHeight();
        const scrollTop = $(window).scrollTop();
        
        // Calcular posición del menú
        let top = e.pageY;
        let left = e.pageX;
        
        // Ajustar posición vertical si el menú se sale de la ventana
        if (cellRect.top + menuHeight > windowHeight) {
            top = e.pageY - menuHeight;
        }
        
        // Ajustar posición horizontal si el menú se sale de la ventana
        if (left + contextMenuDia.outerWidth() > $(window).width()) {
                left = e.pageX - contextMenuDia.outerWidth();
        }
            
            $('#contextMenu').hide();
            contextMenuDia.css({
                position: 'absolute',  // Cambiar a posición absoluta
                top: top + 'px',
                left: left + 'px',
                display: 'block'
            });
            
            $(this).addClass('cell-highlight');
    });

    // Agregar evento de scroll
    $('.table-responsive').on('scroll', function() {
        $('#contextMenuDia').hide();
        $('.cell-highlight').removeClass('cell-highlight');
    });

    $('#contextMenuDia').on('click', '.menu-item', function(e) {
        e.stopPropagation();
        const action = $(this).data('action');
        const selectedCell = $('#contextMenuDia').data('selectedCell');
        
        if(selectedCell) {
            selectedCell.removeAttr('style').removeClass('column-hover');
            selectedCell.text(action).css('background-color', getColorForAction(action));
                
            const dia = $('.attendance-table thead th').eq(selectedCell.index()).text();
            const legajo = selectedCell.parent().find('td:first').data('legajo');
        }
        
        selectedCell.removeClass('cell-highlight');
        $('#contextMenuDia').hide();
    });

    // Función auxiliar para obtener el color según el tipo
    function getColorForAction(action) {
        const colorMap = {
            'P': '#a5d6a7',    // Verde claro
            'Pr': '#fff59d',   // Amarillo claro
            'Aj': '#90caf9',   // Azul claro
            'A': '#ef9a9a',    // Rojo claro
            'L/D': '#b39ddb',  // Púrpura claro
            'P*': '#80deea',   // Cyan claro
            'Ing': '#fff176',  // Amarillo
            'Egr': '#ffb74d',  // Naranja
            'PaN': '#f48fb1'   // Rosa
            // Agregar más colores según necesites
        };
        
        return colorMap[action] || '#b39ddb';
    }

    $(document).click(function() {
        $('#contextMenu').hide();
        $('#contextMenuDia').hide();
        $('.column-hover').removeClass('column-hover');
        $('.cell-highlight').removeClass('cell-highlight');
    });

    // Manejar click en opciones del menú
    $('.menu-item').click(function(e) {
        e.stopPropagation();
        const action = $(this).data('action');
        const selectedDay = $('#contextMenu').data('selectedDay');
        const columnIndex = $('#contextMenu').data('columnIndex');
        // Aquí puedes manejar la acción seleccionada
        console.log(`Acción ${action} para el día ${selectedDay}`);
        // Actualizar todas las celdas de la columna según el estado
        $('.attendance-table tbody tr').each(function() {
            const cells = $(this).find('td');
            const cell = cells.eq(columnIndex);
            
            switch(action) {
                case 'Cla':
                    cell.text('').css('background-color', 'white');
                    break;
                case 'Fds':
                    cell.text('FdS').css('background-color', '#f0f0f0');
                    break;
                case 'FeN':
                    cell.text('FeN').css('background-color', '#ffcdd2');
                    break;
                case 'FeP':
                    cell.text('FeP').css('background-color', '#ffecb3');
                    break;
                case 'AsN':
                    cell.text('AsN').css('background-color', '#c8e6c9');
                    break;
                case 'AsP':
                    cell.text('AsP').css('background-color', '#b3e5fc');
                    break;
                case 'AsE':
                    cell.text('AsE').css('background-color', '#e1bee7');
                    break;
                case 'RaI':
                    cell.text('RaI').css('background-color', '#d7ccc8');
                    break;
                case 'PaN':
                    cell.text('PaN').css('background-color', '#ffccbc');
                    break;
                case 'PaP':
                    cell.text('PaP').css('background-color', '#cfd8dc');
                    break;
                case 'ReV':
                    cell.text('ReV').css('background-color', '#b2dfdb');
                    break;
                case 'ReI':
                    cell.text('ReI').css('background-color', '#f0f4c3');
                    break;
                case 'Ef':
                    cell.text('Ef').css('background-color', '#bbdefb');
                    break;
                case 'JdE':
                    cell.text('JdE').css('background-color', '#d1c4e9');
                    break;
                case 'PG':
                    cell.text('P').css('background-color', '#c5e1a5');
                    break;
            }
        });
        
        // Remover hover y ocultar menú
        $('.column-hover').removeClass('column-hover');
        $('#contextMenu').hide();
    });

});
</script>