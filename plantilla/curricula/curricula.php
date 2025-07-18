
<!DOCTYPE html>
<html class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths" lang="es-AR">
	<head>
		<!-- Meta tags adicionales para el sistema de currícula -->
		<meta name="description" content="Sistema de gestión de currícula académica">
		<meta name="keywords" content="currícula, materias, docentes, horarios, gestión académica">
		
		<!-- Estilos adicionales si es necesario -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	</head>

	<body class="page-template page-template-fluid-layout page-template-fluid-layout-php page page-id-880 custom-background wp-embed-responsive site_boxed preloader3 menu_button_mode dark_header horizontal_menu light_sup_menu ">
		<span id="stickymenu" style="display:none;">1</span>
		<div id="main_wrapper">
			
			<div class="full_content clearfix row_spacer2">
			<!-- All Content -->
				<div class="content_block">
					<div class="hm_blog_full_list hm_blog_list clearfix">
					<!-- Post Container -->
						<div id="880" class="clearfix post-880 page type-page status-publish hentry">
							
							<!-- Título de la página -->
							<div class="page-title-section">
								<div class="container">
									<h1 class="page-title">
										<i class="fas fa-graduation-cap"></i>
										Sistema de Gestión de Currícula
									</h1>
									<p class="page-description">
										Administra y consulta la información académica de cursos, materias, docentes y horarios
									</p>
								</div>
							</div>
							
							<hr>
							
							<!-- Contenedor principal del sistema -->
							<div class="container">
								<div class="entry-content" id="contenido_formulario_datos" style="overflow: auto;">
									
									<!-- Loader inicial -->
									<div class='loader loader--audioWave'>
										<p>CARGANDO SISTEMA DE CURRÍCULA</p>
									</div>
									
									<!-- Aquí se carga dinámicamente el contenido del sistema de currícula -->
									
								</div>
							</div>
							
							<!-- Botones de acción adicionales -->
							<div class="container mt-4">
								<div class="row">
									<div class="col-md-12">
										<div class="action-buttons text-right">
											<button type="button" class="btn btn-info" id="btn-configuracion" data-toggle="modal" data-target="#modalConfiguracion">
												<i class="fas fa-cogs"></i> Configuración
											</button>
											<button type="button" class="btn btn-success" id="btn-exportar" onclick="$('#modalExportacion').modal('show')">
												<i class="fas fa-download"></i> Exportar
											</button>
											<button type="button" class="btn btn-primary" id="btn-actualizar" onclick="location.reload()">
												<i class="fas fa-sync-alt"></i> Actualizar
											</button>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
			<a href="#0" class="hm_go_top"></a>
		</div>

		
		<!-- Modales del sistema de currícula -->
		<?php include 'plantilla/curricula/informe_modal.php'; ?>
		
		<!-- Estilos específicos del sistema -->
		<?php include 'plantilla/curricula/informe_styles.php'; ?>
		
		<!-- JavaScript/funciones del sistema -->
		<?php include 'plantilla/curricula/informe_functions.php'; ?>
		
		<!-- Estilos adicionales para la página principal -->
		<style>
			.page-title-section {
				background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
				color: white;
				padding: 30px 0;
				margin-bottom: 0;
				border-radius: 8px 8px 0 0;
			}
			
			.page-title {
				margin: 0;
				font-size: 28px;
				font-weight: 600;
				display: flex;
				align-items: center;
				gap: 15px;
			}
			
			.page-title i {
				color: #3498db;
				font-size: 32px;
			}
			
			.page-description {
				margin: 10px 0 0 0;
				font-size: 16px;
				opacity: 0.9;
				font-weight: 300;
			}
			
			.action-buttons {
				margin: 20px 0;
				padding: 20px;
				background: white;
				border-radius: 8px;
				box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			}
			
			.action-buttons .btn {
				margin-left: 10px;
				padding: 10px 20px;
				font-weight: 600;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				border-radius: 6px;
				transition: all 0.3s ease;
			}
			
			.action-buttons .btn:hover {
				transform: translateY(-2px);
				box-shadow: 0 4px 15px rgba(0,0,0,0.2);
			}
			
			.action-buttons .btn i {
				margin-right: 8px;
			}
			
			/* Responsive para botones */
			@media (max-width: 768px) {
				.action-buttons {
					text-align: center !important;
				}
				
				.action-buttons .btn {
					display: block;
					width: 100%;
					margin: 5px 0;
				}
				
				.page-title {
					font-size: 24px;
					text-align: center;
					flex-direction: column;
					gap: 10px;
				}
				
				.page-description {
					text-align: center;
				}
			}
			
			/* Animación para el loader personalizado */
			.loader--audioWave {
				display: flex;
				justify-content: center;
				align-items: center;
				padding: 60px;
				background: white;
				border-radius: 8px;
				box-shadow: 0 2px 15px rgba(0,0,0,0.1);
				margin: 20px 0;
			}
			
			.loader--audioWave p {
				font-size: 18px;
				font-weight: 600;
				color: #2c3e50;
				margin: 0;
				display: flex;
				align-items: center;
				gap: 15px;
			}
			
			.loader--audioWave p::after {
				content: '';
				width: 30px;
				height: 30px;
				border: 3px solid #f3f3f3;
				border-top: 3px solid #3498db;
				border-radius: 50%;
				animation: spin 1s linear infinite;
			}
			
			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
			
			/* Mejoras para la integración con el tema */
			#contenido_formulario_datos {
				min-height: 600px;
				background: #f8f9fa;
				border-radius: 8px;
				padding: 0;
			}
			
			.container {
				max-width: 1200px;
			}
			
			/* Breadcrumb personalizado */
			.curricula-breadcrumb {
				background: white;
				padding: 15px 20px;
				margin-bottom: 20px;
				border-radius: 6px;
				box-shadow: 0 1px 5px rgba(0,0,0,0.1);
			}
			
			.curricula-breadcrumb ol {
				margin: 0;
				padding: 0;
				list-style: none;
				display: flex;
				align-items: center;
				gap: 10px;
			}
			
			.curricula-breadcrumb li {
				display: flex;
				align-items: center;
				gap: 10px;
				color: #6c757d;
				font-size: 14px;
			}
			
			.curricula-breadcrumb li.active {
				color: #2c3e50;
				font-weight: 600;
			}
			
			.curricula-breadcrumb li::after {
				content: '/';
				color: #bdc3c7;
			}
			
			.curricula-breadcrumb li:last-child::after {
				display: none;
			}
		</style>
		
		<!-- Script de inicialización específico para la página -->
		<script>
			$(document).ready(function() {
				
				// Agregar breadcrumb dinámico
				function addBreadcrumb() {
					const breadcrumbHtml = `
						<div class="curricula-breadcrumb">
							<ol>
								<li><i class="fas fa-home"></i> Inicio</li>
								<li><i class="fas fa-graduation-cap"></i> Gestión Académica</li>
								<li class="active"><i class="fas fa-table"></i> Sistema de Currícula</li>
							</ol>
						</div>
					`;
					
					$('#contenido_formulario_datos').prepend(breadcrumbHtml);
				}
				
				// Función para manejar errores de carga
				function handleLoadError() {
					const errorHtml = `
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Error de Carga</h4>
							<p>No se pudo cargar el sistema de currícula. Por favor, verifica:</p>
							<hr>
							<ul class="mb-0">
								<li>Tu conexión a internet</li>
								<li>Los permisos de acceso</li>
								<li>Que todos los archivos estén en su lugar</li>
							</ul>
							<hr>
							<button class="btn btn-outline-danger" onclick="location.reload()">
								<i class="fas fa-redo"></i> Reintentar
							</button>
						</div>
					`;
					
					$('#contenido_formulario_datos').html(errorHtml);
				}
				
				// Verificar si el sistema se cargó correctamente
				setTimeout(function() {
					if (typeof CurriculaSystem === 'undefined') {
						console.error('Sistema de currícula no se cargó correctamente');
						handleLoadError();
					} else {
						// Agregar breadcrumb después de que se cargue el sistema
						setTimeout(addBreadcrumb, 1000);
					}
				}, 3000);
				
				// Event listeners para botones de acción
				$('#btn-configuracion').on('click', function() {
					console.log('Abriendo configuración...');
				});
				
				$('#btn-exportar').on('click', function() {
					if (typeof CurriculaSystem !== 'undefined' && CurriculaSystem.currentData) {
						console.log('Iniciando exportación...');
					} else {
						alert('Primero debes consultar una currícula para exportar');
					}
				});
				
				$('#btn-actualizar').on('click', function() {
					if (confirm('¿Estás seguro de que quieres actualizar la página? Se perderán los datos no guardados.')) {
						location.reload();
					}
				});
				
				// Agregar tooltips a los botones
				$('[data-toggle="tooltip"]').tooltip();
				
				// Función para mostrar notificaciones
				window.showNotification = function(message, type = 'info') {
					const alertClass = `alert-${type}`;
					const iconClass = type === 'success' ? 'fa-check-circle' : 
									 type === 'warning' ? 'fa-exclamation-triangle' : 
									 type === 'danger' ? 'fa-times-circle' : 'fa-info-circle';
					
					const notification = $(`
						<div class="alert ${alertClass} alert-dismissible fade show notification-custom" role="alert">
							<i class="fas ${iconClass}"></i>
							${message}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					`);
					
					$('body').append(notification);
					
					// Auto-hide after 5 seconds
					setTimeout(() => {
						notification.alert('close');
					}, 5000);
				};
				
				// Monitorear cambios en el sistema de currícula
				$(document).on('curricula:loaded', function(e, data) {
					console.log('Currícula cargada:', data);
					showNotification('Currícula cargada exitosamente', 'success');
				});
				
				$(document).on('curricula:error', function(e, error) {
					console.error('Error en currícula:', error);
					showNotification('Error al cargar la currícula: ' + error, 'danger');
				});
				
				// Función para debug (solo en desarrollo)
				window.debugCurricula = function() {
					if (typeof CurriculaSystem !== 'undefined') {
						console.log('Sistema de Currícula:', CurriculaSystem);
						console.log('Datos actuales:', CurriculaSystem.currentData);
						console.log('Materia seleccionada:', CurriculaSystem.selectedMateria);
					} else {
						console.log('Sistema de Currícula no disponible');
					}
				};
			});
		</script>

	</body>
</html>