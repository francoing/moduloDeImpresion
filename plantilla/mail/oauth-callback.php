<?php
/**
 * Este script procesa el código de autorización devuelto por Google
 * después de la autenticación OAuth y obtiene/guarda el refresh token.
 * 
 * Guarda este archivo como oauth-callback.php en la URL que configuraste como URI de redirección.
 */

session_start();
require '../../vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

// Configuración
$clientId = '331083804735-fos1vnkf5epa27ei36fpb5t7soj9k66n.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/ModuloImpresionPdf/vendor/phpmailer/phpmailer/get_oauth_token.php';

$provider = new Google([
    'clientId'     => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
    'accessType'   => 'offline',
    'prompt'       => 'consent'
]);

// Función para mostrar errores de forma legible
function showError($title, $message) {
    echo "<html><head><title>Error OAuth</title>";
    echo "<style>body{font-family:Arial,sans-serif;line-height:1.6;padding:20px;max-width:800px;margin:0 auto;}
    .error{background:#ffebee;border-left:4px solid #f44336;padding:15px;margin-bottom:20px;}
    code{background:#f5f5f5;padding:2px 5px;border-radius:3px;font-family:monospace;}</style>";
    echo "</head><body>";
    echo "<h1>$title</h1>";
    echo "<div class='error'>$message</div>";
    echo "</body></html>";
    exit;
}

// Verificar estado para prevenir ataques CSRF
if (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    showError("Error de seguridad", "Estado inválido. Esto podría indicar un intento de falsificación de solicitud entre sitios (CSRF).");
}

// Si tenemos un código de autorización
if (isset($_GET['code'])) {
    try {
        // Intentar obtener un token de acceso usando el código de autorización
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        
        // Obtener datos del usuario
        $user = $provider->getResourceOwner($token);
        $email = $user->getEmail();
        
        // Guardar el token de actualización (refresh token)
        $refreshToken = $token->getRefreshToken();
        
        if (!$refreshToken) {
            showError("Falta Refresh Token", 
                "No se recibió un refresh token. Esto puede ocurrir si:<br>
                1. La aplicación ya fue autorizada previamente.<br>
                2. El parámetro 'prompt=consent' no fue incluido en la solicitud.<br>
                3. El parámetro 'access_type=offline' no fue incluido en la solicitud.<br><br>
                Para resolver esto, revoca el acceso de la aplicación en 
                <a href='https://myaccount.google.com/permissions' target='_blank'>Google Account Permissions</a> 
                y vuelve a intentarlo.");
        }
        
        // Guardar el refresh token en un archivo
        file_put_contents('refresh_token.txt', $refreshToken);
        
        // Guardar también el token de acceso para pruebas inmediatas
        file_put_contents('access_token.txt', $token->getToken());
        
        // Mostrar éxito
        echo "<html><head><title>Autorización Exitosa</title>";
        echo "<style>body{font-family:Arial,sans-serif;line-height:1.6;padding:20px;max-width:800px;margin:0 auto;}
        .success{background:#e8f5e9;border-left:4px solid #4caf50;padding:15px;margin-bottom:20px;}
        .token{word-break:break-all;background:#f5f5f5;padding:10px;border-radius:3px;font-family:monospace;}</style>";
        echo "</head><body>";
        echo "<h1>Autorización Exitosa</h1>";
        echo "<div class='success'>La autorización se completó correctamente para: <strong>$email</strong></div>";
        
        echo "<h2>Refresh Token (guardado en refresh_token.txt)</h2>";
        echo "<div class='token'>$refreshToken</div>";
        
        echo "<h2>Access Token (guardado en access_token.txt)</h2>";
        echo "<div class='token'>" . $token->getToken() . "</div>";
        
        echo "<h3>Información adicional</h3>";
        echo "<ul>";
        echo "<li>El access token expira en: " . date('Y-m-d H:i:s', $token->getExpires()) . "</li>";
        echo "<li>El refresh token no expira a menos que el usuario revoque el acceso</li>";
        echo "</ul>";
        
        echo "<p>Ahora puedes usar estos tokens para enviar correos a través de Gmail usando PHPMailer con OAuth.</p>";
        echo "</body></html>";
        
    } catch (IdentityProviderException $e) {
        // Error al obtener el token
        showError("Error en la autorización", 
            "Ocurrió un error al obtener el token: <code>" . $e->getMessage() . "</code><br><br>
            Detalles técnicos:<br><pre>" . json_encode($e->getResponseBody(), JSON_PRETTY_PRINT) . "</pre>");
    } catch (Exception $e) {
        // Otro tipo de error
        showError("Error inesperado", 
            "Ocurrió un error inesperado: <code>" . $e->getMessage() . "</code>");
    }
} else {
    // Si llegamos aquí sin un código, mostrar error
    showError("Parámetro faltante", 
        "Falta el código de autorización en la URL. Esto podría indicar que:<br>
        1. El usuario denegó el acceso.<br>
        2. Hubo un error en el proceso de redirección.<br>
        3. Se accedió a esta página directamente sin pasar por el flujo de autorización.");
}
?>