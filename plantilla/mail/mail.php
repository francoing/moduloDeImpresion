<?php
/**
 * Script para enviar correos con Gmail usando OAuth2 automáticamente
 * Este script renueva el token de acceso automáticamente cuando es necesario
 */

// Cargar dependencias de Composer
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Grant\RefreshToken;

/**
 * Función para enviar un correo electrónico con Gmail usando OAuth2
 * 
 * @param string $destinatario Email del destinatario
 * @param string $asunto Asunto del correo
 * @param string $cuerpo Cuerpo del correo (HTML)
 * @param array $adjuntos Array de rutas a archivos adjuntos
 * @param string $cc Email en copia (opcional)
 * @return array Resultado del envío ['exito' => bool, 'mensaje' => string]
 */
function enviarCorreoGmail($destinatario, $asunto, $cuerpo, $adjuntos = [], $cc = null) {
    // Configuración de credenciales OAuth2
    $clientId = '331083804735-fos1vnkf5epa27ei36fpb5t7soj9k66n.apps.googleusercontent.com';
    $clientSecret = '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';
    $email = 'franco.montti.19@gmail.com';
    
    // Ruta al archivo de token de actualización
    $refreshTokenFile = __DIR__ . '/refresh_token.txt';
    
    // Verificar si existe el archivo de refresh token
    if (!file_exists($refreshTokenFile)) {
        return [
            'exito' => false,
            'mensaje' => 'No se encontró el archivo refresh_token.txt. Por favor, genera primero un token de actualización.'
        ];
    }
    
    // Obtener refresh token del archivo
    $refreshToken = file_get_contents($refreshTokenFile);
    
    // Inicializar proveedor OAuth de Google
    $provider = new Google([
        'clientId'     => $clientId,
        'clientSecret' => $clientSecret,
        'redirectUri'  => 'http://localhost/ModuloImpresionPdf/oauth-callback.php', // No se usa pero es necesario
    ]);
    
    try {
        // Intentar obtener un nuevo token de acceso usando el refresh token
        $accessToken = $provider->getAccessToken(new RefreshToken(), [
            'refresh_token' => $refreshToken
        ]);
        
        // Crear instancia de PHPMailer
        $mail = new PHPMailer(true);
        
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Configuración de OAuth2
        $mail->AuthType = 'XOAUTH2';
        $mail->setOAuth(
            new OAuth([
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email
            ])
        );
        
        // Configurar remitente y destinatarios
        $mail->setFrom($email, 'Sistema Automático');
        $mail->addAddress($destinatario);
        
        // Añadir CC si se proporciona
        if ($cc) {
            $mail->addCC($cc);
        }
        
        // Añadir archivos adjuntos
        foreach ($adjuntos as $adjunto) {
            if (file_exists($adjunto)) {
                $mail->addAttachment($adjunto);
            }
        }
        
        // Configurar contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->AltBody = strip_tags($cuerpo);
        
        // Opcional: para problemas de codificación
        $mail->CharSet = 'UTF-8';
        
        // Enviar correo
        $mail->send();
        
        return [
            'exito' => true,
            'mensaje' => 'Correo enviado correctamente a ' . $destinatario
        ];
        
    } catch (Exception $e) {
        return [
            'exito' => false,
            'mensaje' => 'Error al enviar el correo: ' . $mail->ErrorInfo
        ];
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // Este error ocurre si hay problemas con el refresh token
        return [
            'exito' => false,
            'mensaje' => 'Error con el token de OAuth: ' . $e->getMessage()
        ];
    }
}

// Ejemplo de uso:
$destinatario = 'fmontti@colsantacatalina.edu.ar';
$asunto = 'Correo automático con OAuth2';
$cuerpo = '
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { padding: 20px; }
        .header { background-color: #f0f0f0; padding: 10px; }
        .footer { font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Notificación Automática</h2>
        </div>
        <p>Este es un correo enviado automáticamente desde nuestro sistema.</p>
        <p>Fecha y hora: ' . date('Y-m-d H:i:s') . '</p>
        <div class="footer">
            <p>No responda a este correo, es un envío automático.</p>
        </div>
    </div>
</body>
</html>';

$adjuntos = [
    __DIR__ . '/archivo.pdf',
    __DIR__ . '/reporte.xlsx'
];

// Enviar el correo
$resultado = enviarCorreoGmail($destinatario, $asunto, $cuerpo, $adjuntos);

// Mostrar resultado
if ($resultado['exito']) {
    echo "¡Éxito! " . $resultado['mensaje'];
} else {
    echo "Error: " . $resultado['mensaje'];
}

/**
 * PARA INCLUIR EN UN SISTEMA EXISTENTE:
 * 
 * 1. Copiar la función 'enviarCorreoGmail' a tu archivo de utilidades o donde sea apropiado
 * 2. Asegurarte de tener las dependencias necesarias instaladas (phpmailer/phpmailer y league/oauth2-google)
 * 3. Tener un archivo 'refresh_token.txt' con el token de actualización válido
 * 4. Llamar a la función cuando necesites enviar un correo
 */
?>