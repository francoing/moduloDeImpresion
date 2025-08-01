<!-- Modal para Agregar Docente -->
<div class="modal fade" id="modalAgregarDocente" tabindex="-1" role="dialog" aria-labelledby="modalAgregarDocenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalAgregarDocenteLabel">
                    <i class="fas fa-user-plus"></i>
                    Agregar Docente
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Información de la Materia -->
                <div class="alert alert-info" role="alert">
                    <h6 class="alert-heading">
                        <i class="fas fa-book"></i>
                        Información de la Materia
                    </h6>
                    <div class="row">
                        <div class="col-6">
                            <small><strong>Año:</strong> <span id="modal-anio">-</span></small><br>
                            <small><strong>Ciclo:</strong> <span id="modal-ciclo">-</span></small>
                        </div>
                        <div class="col-6">
                            <small><strong>Curso:</strong> <span id="modal-curso">-</span></small><br>
                            <small><strong>División:</strong> <span id="modal-division">-</span></small>
                        </div>
                    </div>
                    <hr class="my-2">
                    <small><strong>Materia:</strong> <span id="modal-materia">-</span></small>
                </div>

                <!-- Formulario -->
                <form id="formAgregarDocente">
                    <div class="form-group">
                        <label for="legajo_docente">
                            <i class="fas fa-id-card"></i>
                            Legajo del Docente <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="legajo_docente" 
                               placeholder="Ingrese el legajo del docente" 
                               required>
                        <small class="form-text text-muted">Ingrese el número de legajo del docente a asignar</small>
                    </div>

                    <!-- Campos ocultos para enviar datos -->
                    <input type="hidden" id="hidden-anio" name="anio">
                    <input type="hidden" id="hidden-ciclo" name="ciclo_id">
                    <input type="hidden" id="hidden-curso" name="curso_id">
                    <input type="hidden" id="hidden-division" name="division_id">
                    <input type="hidden" id="hidden-materia" name="materia_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btnGuardarDocente">
                    <i class="fas fa-save"></i>
                    Guardar Docente
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    // Event listener para el botón "Agregar Docente"
    $(document).on('click', '#agregar_docente', function() {

        console.log(CurriculaSystem.selectedAño+' '+ CurriculaSystem.selectedCiclo+' '+CurriculaSystem.selectedCurso+' '
        +CurriculaSystem.selectedNombreMateria);
        
        // Verificar que tenemos todos los datos necesarios
        if (!CurriculaSystem.selectedAño || !CurriculaSystem.selectedCiclo || 
            !CurriculaSystem.selectedCurso || !CurriculaSystem.selectedDivision || 
            !CurriculaSystem.selectedMateria) {
            
            Swal.fire({
                icon: 'warning',
                title: 'Información Incompleta',
                text: 'Debe seleccionar un año, división y materia antes de agregar un docente.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Obtener el nombre de la materia seleccionada


        let nombreMateria = 'Materia no identificada';

        nombreMateria = CurriculaSystem.selectedMateria;
        
        /*
        if (CurriculaSystem.matxdivData) {
            const materiaSeleccionada = CurriculaSystem.matxdivData.find(m => m.id === CurriculaSystem.selectedMateria);
            if (materiaSeleccionada) {
                nombreMateria = materiaSeleccionada.codigo || materiaSeleccionada.nombre || materiaSeleccionada.id;
            }
        }
            */

        // Llenar los datos en el modal
        $('#modal-anio').text(CurriculaSystem.selectedAño);
        $('#modal-ciclo').text(CurriculaSystem.selectedCiclo);
        $('#modal-curso').text(CurriculaSystem.selectedCurso);
        $('#modal-division').text(CurriculaSystem.selectedDivision);
        $('#modal-materia').text(nombreMateria);

        // Llenar campos ocultos
        $('#hidden-anio').val(CurriculaSystem.selectedAño);
        $('#hidden-ciclo').val(CurriculaSystem.selectedCiclo);
        $('#hidden-curso').val(CurriculaSystem.selectedCurso);
        $('#hidden-division').val(CurriculaSystem.selectedDivision);
        $('#hidden-materia').val(CurriculaSystem.selectedMateria);

        // Limpiar el formulario
        $('#legajo_docente').val('');
        $('#legajo_docente').removeClass('is-invalid');

        // Mostrar el modal
        $('#modalAgregarDocente').modal('show');
    });

    // Event listener para el botón "Guardar Docente"
    $(document).on('click', '#btnGuardarDocente', function() {
        const legajoDocente = $('#legajo_docente').val().trim();
        
        // Validar que se haya ingresado el legajo
        if (!legajoDocente) {
            $('#legajo_docente').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Campo Requerido',
                text: 'Debe ingresar el legajo del docente.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Remover clase de error si había
        $('#legajo_docente').removeClass('is-invalid');

        // Deshabilitar botón mientras se procesa
        const $btnGuardar = $('#btnGuardarDocente');
        const textoOriginal = $btnGuardar.html();
        $btnGuardar.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');

        // Preparar datos para enviar
        const datosFormulario = {
            anio: $('#hidden-anio').val(),
            ciclo_id: $('#hidden-ciclo').val(),
            curso_id: $('#hidden-curso').val(),
            division_id: $('#hidden-division').val(),
            materia_id: $('#hidden-materia').val(),
            legajo_docente: legajoDocente,
            api_key: CurriculaSystem.api_key
        };

        // Realizar petición AJAX
        $.ajax({
            url: 'http://localhost/csc-back/api/curricula/guardar_docente.php',
            method: 'POST',
            data: datosFormulario,
            dataType: 'json',
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                
                // Restaurar botón
                $btnGuardar.prop('disabled', false).html(textoOriginal);
                
                if (response.status === 'success') {
                    // Cerrar modal
                    $('#modalAgregarDocente').modal('hide');
                    
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Docente Agregado!',
                        text: response.message || 'El docente ha sido asignado correctamente a la materia.',
                        confirmButtonText: 'Perfecto',
                        timer: 3000,
                        timerProgressBar: true
                    });

                    // Recargar la tabla de docentes
                    if (CurriculaSystem.selectedMateria) {
                        CurriculaSystem.loadDocentes(
                            CurriculaSystem.selectedAño,
                            CurriculaSystem.selectedMateria,
                            CurriculaSystem.selectedCiclo,
                            CurriculaSystem.selectedCurso,
                            CurriculaSystem.selectedDivision
                        );
                    }
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al Agregar Docente',
                        text: response.message || 'Ha ocurrido un error al intentar agregar el docente. Por favor, inténtelo nuevamente.',
                        confirmButtonText: 'Entendido'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', error);
                
                // Restaurar botón
                $btnGuardar.prop('disabled', false).html(textoOriginal);
                
                // Mostrar mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Conexión',
                    text: 'No se pudo conectar con el servidor. Por favor, verifique su conexión e inténtelo nuevamente.',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    });

    // Limpiar formulario cuando se cierra el modal
    $('#modalAgregarDocente').on('hidden.bs.modal', function() {
        $('#formAgregarDocente')[0].reset();
        $('#legajo_docente').removeClass('is-invalid');
    });

    // Validación en tiempo real del campo legajo
    $(document).on('input', '#legajo_docente', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>

<style>
    /* Estilos adicionales para el modal */
    .modal-header.bg-success {
        border-bottom: 1px solid #28a745;
    }

    .alert-info {
        background-color: #e3f2fd;
        border-color: #2196f3;
        color: #0d47a1;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>