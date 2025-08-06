<!-- Modal para Agregar Preceptor -->
<div class="modal fade" id="modalAgregarPreceptor" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPreceptorLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalAgregarPreceptorLabel">
                    <i class="fas fa-user-graduate"></i>
                    Agregar Preceptor
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Información de la División -->
                <div class="alert alert-info" role="alert">
                    <h6 class="alert-heading">
                        <i class="fas fa-users"></i>
                        Información de la División
                    </h6>
                    <div class="row">
                        <div class="col-6">
                            <small><strong>Año:</strong> <span id="modal-preceptor-anio">-</span></small><br>
                            <small><strong>Ciclo:</strong> <span id="modal-preceptor-ciclo">-</span></small>
                        </div>
                        <div class="col-6">
                            <small><strong>Curso:</strong> <span id="modal-preceptor-curso">-</span></small><br>
                            <small><strong>División:</strong> <span id="modal-preceptor-division">-</span></small>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form id="formAgregarPreceptor">
                    <div class="form-group">
                        <label for="legajo_preceptor">
                            <i class="fas fa-id-card"></i>
                            Legajo del Preceptor <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="legajo_preceptor" 
                               placeholder="Ingrese el legajo del preceptor" 
                               required>
                        <small class="form-text text-muted">Ingrese el número de legajo del preceptor a asignar</small>
                    </div>

                    <!-- Campos ocultos para enviar datos -->
                    <input type="hidden" id="hidden-preceptor-anio" name="anio">
                    <input type="hidden" id="hidden-preceptor-ciclo" name="ciclo_id">
                    <input type="hidden" id="hidden-preceptor-curso" name="curso_id">
                    <input type="hidden" id="hidden-preceptor-division" name="division_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarPreceptor">
                    <i class="fas fa-save"></i>
                    Guardar Preceptor
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    // Event listener para el botón "Agregar Preceptor"
    $(document).on('click', '#agregar_preceptor', function() {

        console.log('Datos para preceptor:', {
            año: CurriculaSystem.selectedAño,
            ciclo: CurriculaSystem.selectedCiclo,
            curso: CurriculaSystem.selectedCurso,
            division: CurriculaSystem.selectedDivision
        });
        
        // Verificar que tenemos todos los datos necesarios (no necesitamos materia para preceptores)
        if (!CurriculaSystem.selectedAño || !CurriculaSystem.selectedCiclo || 
            !CurriculaSystem.selectedCurso || !CurriculaSystem.selectedDivision) {
            
            Swal.fire({
                icon: 'warning',
                title: 'Información Incompleta',
                text: 'Debe seleccionar un año y una división antes de agregar un preceptor.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Llenar los datos en el modal
        $('#modal-preceptor-anio').text(CurriculaSystem.selectedAño);
        $('#modal-preceptor-ciclo').text(CurriculaSystem.selectedCiclo);
        $('#modal-preceptor-curso').text(CurriculaSystem.selectedCurso);
        $('#modal-preceptor-division').text(CurriculaSystem.selectedDivision);

        // Llenar campos ocultos
        $('#hidden-preceptor-anio').val(CurriculaSystem.selectedAño);
        $('#hidden-preceptor-ciclo').val(CurriculaSystem.selectedCiclo);
        $('#hidden-preceptor-curso').val(CurriculaSystem.selectedCurso);
        $('#hidden-preceptor-division').val(CurriculaSystem.selectedDivision);

        // Limpiar el formulario
        $('#legajo_preceptor').val('');
        $('#legajo_preceptor').removeClass('is-invalid');

        // Mostrar el modal
        $('#modalAgregarPreceptor').modal('show');
    });

    // Event listener para el botón "Guardar Preceptor"
    $(document).on('click', '#btnGuardarPreceptor', function() {
        const legajoPreceptor = $('#legajo_preceptor').val().trim();
        
        // Validar que se haya ingresado el legajo
        if (!legajoPreceptor) {
            $('#legajo_preceptor').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Campo Requerido',
                text: 'Debe ingresar el legajo del preceptor.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Validar que el legajo sea numérico
        if (!/^\d+$/.test(legajoPreceptor)) {
            $('#legajo_preceptor').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Formato Inválido',
                text: 'El legajo debe contener solo números.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Remover clase de error si había
        $('#legajo_preceptor').removeClass('is-invalid');

        // Deshabilitar botón mientras se procesa
        const $btnGuardar = $('#btnGuardarPreceptor');
        const textoOriginal = $btnGuardar.html();
        $btnGuardar.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');

        // Preparar datos para enviar
        const datosFormulario = {
            anio: $('#hidden-preceptor-anio').val(),
            ciclo_id: $('#hidden-preceptor-ciclo').val(),
            curso_id: $('#hidden-preceptor-curso').val(),
            division_id: $('#hidden-preceptor-division').val(),
            legajo_preceptor: legajoPreceptor,
            api_key: CurriculaSystem.api_key
        };

        console.log('Datos a enviar para agregar preceptor:', datosFormulario);

        // Realizar petición AJAX
        $.ajax({
            url: 'http://localhost/csc-back/api/curricula/guardar_preceptor.php',
            method: 'POST',
            data: datosFormulario,
            dataType: 'json',
            success: function(response) {
                console.log('Respuesta del servidor (agregar preceptor):', response);
                
                // Restaurar botón
                $btnGuardar.prop('disabled', false).html(textoOriginal);
                
                if (response.status === 'success') {
                    // Cerrar modal
                    $('#modalAgregarPreceptor').modal('hide');
                    
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Preceptor Agregado!',
                        html: `<div class="alert alert-success" role="alert">
                                ${response.message || 'El preceptor ha sido asignado correctamente a la división.'}
                            </div>`,
                        confirmButtonText: 'Perfecto',
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });

                    // Recargar la tabla de preceptores
                    if (CurriculaSystem.selectedCiclo && CurriculaSystem.selectedCurso && CurriculaSystem.selectedDivision) {
                        CurriculaSystem.loadPreceptores(
                            CurriculaSystem.selectedCiclo,
                            CurriculaSystem.selectedCurso,
                            CurriculaSystem.selectedDivision
                        );
                    }
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al Agregar Preceptor',
                        html: `<div class="alert alert-danger" role="alert">
                                ${response.message || 'Ha ocurrido un error al intentar agregar el preceptor. Por favor, inténtelo nuevamente.'}
                            </div>`,
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición (agregar preceptor):', error);
                
                // Restaurar botón
                $btnGuardar.prop('disabled', false).html(textoOriginal);
                
                // Mostrar mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Conexión',
                    html: `<div class="alert alert-danger" role="alert">
                            No se pudo conectar con el servidor. Por favor, verifique su conexión e inténtelo nuevamente.
                        </div>`,
                    confirmButtonText: 'Entendido',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    }
                });
            }
        });
    });

    // Limpiar formulario cuando se cierra el modal
    $('#modalAgregarPreceptor').on('hidden.bs.modal', function() {
        $('#formAgregarPreceptor')[0].reset();
        $('#legajo_preceptor').removeClass('is-invalid');
    });

    // Validación en tiempo real del campo legajo
    $(document).on('input', '#legajo_preceptor', function() {
        const valor = $(this).val().trim();
        if (valor && /^\d+$/.test(valor)) {
            $(this).removeClass('is-invalid');
        }
    });

    // Event listener para eliminar preceptor
    $(document).on('click', '.btn-eliminar-preceptor', function() {
        // Obtener datos del preceptor desde los data-attributes del botón
        const $button = $(this);
        const legajoPreceptor = $button.data('legajo');
        const nombrePreceptor = $button.data('nombre');

        console.log('Datos del preceptor a eliminar:', {
            legajo: legajoPreceptor,
            nombre: nombrePreceptor
        });

        // Verificar que tenemos los datos necesarios
        if (!legajoPreceptor || !CurriculaSystem.selectedAño || !CurriculaSystem.selectedCiclo || 
            !CurriculaSystem.selectedCurso || !CurriculaSystem.selectedDivision) {
            
            Swal.fire({
                icon: 'warning',
                title: 'Información Incompleta',
                text: 'No se pudo obtener la información necesaria para eliminar el preceptor.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Mostrar confirmación de eliminación
        Swal.fire({
            icon: 'question',
            title: '¿Eliminar Preceptor?',
            html: `
                <div class="alert alert-danger" role="alert">
                    <strong>¿Está seguro que desea eliminar al preceptor:</strong><br>
                    <span style="font-size: 1.1em;">${nombrePreceptor || 'Preceptor'}</span><br>
                    <small>Legajo: ${legajoPreceptor}</small>
                </div>
                <p class="text-muted">Esta acción eliminará al preceptor de la división seleccionada.</p>
            `,
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Sí, Eliminar',
            cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceder con la eliminación
                eliminarPreceptor(legajoPreceptor, nombrePreceptor);
            }
        });
    });

    // Función para eliminar el preceptor
    function eliminarPreceptor(legajoPreceptor, nombrePreceptor) {
        // Preparar datos para enviar
        const datosFormulario = {
            anio: CurriculaSystem.selectedAño,
            ciclo_id: CurriculaSystem.selectedCiclo,
            curso_id: CurriculaSystem.selectedCurso,
            division_id: CurriculaSystem.selectedDivision,
            legajo_preceptor: legajoPreceptor,
            api_key: CurriculaSystem.api_key
        };

        console.log('Datos a enviar para eliminar preceptor:', datosFormulario);

        // Mostrar loading
        Swal.fire({
            title: 'Eliminando Preceptor...',
            html: `<div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-danger me-3" role="status"></div>
                    <span>Eliminando a ${nombrePreceptor || 'preceptor'}</span>
                </div>`,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false
        });

        // Realizar petición AJAX
        $.ajax({
            url: 'http://localhost/csc-back/api/curricula/eliminar_preceptor.php',
            method: 'POST',
            data: datosFormulario,
            dataType: 'json',
            success: function(response) {
                console.log('Respuesta del servidor (eliminar preceptor):', response);
                
                if (response.status === 'success') {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Preceptor Eliminado!',
                        html: `<div class="alert alert-success" role="alert">
                                ${response.message || `El preceptor <strong>${nombrePreceptor || 'seleccionado'}</strong> ha sido eliminado correctamente.`}
                            </div>`,
                        confirmButtonText: 'Perfecto',
                        timer: 4000,
                        timerProgressBar: true,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });

                    // Recargar la tabla de preceptores
                    if (CurriculaSystem.selectedCiclo && CurriculaSystem.selectedCurso && CurriculaSystem.selectedDivision) {
                        CurriculaSystem.loadPreceptores(
                            CurriculaSystem.selectedCiclo,
                            CurriculaSystem.selectedCurso,
                            CurriculaSystem.selectedDivision
                        );
                    }
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al Eliminar Preceptor',
                        html: `<div class="alert alert-danger" role="alert">
                                ${response.message || 'Ha ocurrido un error al intentar eliminar el preceptor. Por favor, inténtelo nuevamente.'}
                            </div>`,
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición (eliminar preceptor):', error);
                
                // Mostrar mensaje de error de conexión
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Conexión',
                    html: `<div class="alert alert-danger" role="alert">
                            No se pudo conectar con el servidor. Por favor, verifique su conexión e inténtelo nuevamente.
                        </div>`,
                    confirmButtonText: 'Entendido',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    }
                });
            }
        });
    }

});
</script>

<style>
    /* Estilos adicionales para el modal de preceptores */
    .modal-header.bg-primary {
        border-bottom: 1px solid #007bff;
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

    /* Diferenciación visual entre modal de docente y preceptor */
    #modalAgregarPreceptor .modal-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }

    #modalAgregarPreceptor .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    #modalAgregarPreceptor .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>