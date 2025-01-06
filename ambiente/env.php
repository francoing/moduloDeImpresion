<?php
// Primero verificamos que las variables existen
$url_api = getenv('APPLICATION_ENV') ?: '';
$url_new_api = getenv('APPLICATION_ENV_NEW') ?: '';
$url_api_dos = getenv('APPLICATION_ENV_DOS') ?: '';
?>

<script type="text/javascript">
// Definimos las constantes de manera segura escapando los valores
const URL_API = <?php echo json_encode($url_api); ?>;
const URL_NEW_API = <?php echo json_encode($url_new_api); ?>;
const URL_API_DOS = <?php echo json_encode($url_api_dos); ?>;
</script>