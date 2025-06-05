<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Public/phpmailer/src/PHPMailer.php';
require '../Public/phpmailer/src/SMTP.php';
require '../Public/phpmailer/src/Exception.php';

$mail = new PHPMailer(true);
    function enviarCorreoPedido($carrito, $total, $code_order, $user_id) {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Habilitar salida de depuración detallada
            $mail->isSMTP();                                            // Enviar usando SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Servidor SMTP de Gmail
            $mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
            $mail->Username   = 'enelisurieles17@gmail.com';              // Usuario SMTP
            $mail->Password   = 'oxjb hfjj zssk wqnx';                               // Contraseña SMTP (usa un método seguro para almacenarla)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar encriptación TLS implícita
            $mail->Port       = 465;                                    // Puerto TCP; usa 587 si configuraste `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Destinatarios
            $mail->setFrom('enelisurieles17@gmail.com', 'Tienda CDP');
            $mail->addAddress('enelisurieles15@gmail.com', 'Cliente'); // Añadir un destinatario

            $mail->isHTML(true); 
            // Contenido
            $mail->Subject = 'Nuevo pedido recibido';
            $mail->Body = "<h3>Nuevo pedido recibido</h3>
                            <p><strong>Codigo Pedido:</strong> {$code_order}</p>
                            <p><strong>Cliente:</strong> {$user_id}</p>
                            <p><strong>Total:</strong> {$total} €</p>
                            <p><strong>Productos:</strong></p><ul>";

                foreach ($carrito as $producto) {
                    $mail->Body .= "<li>{$producto['id']} - Cantidad: {$producto['cantidad']}</li>";
                }

                $mail->Body .= "</ul>";

                $mail->send();
                return true;

            } catch (Exception $e) {
                echo "Error al enviar el correo electrónico de la compra: {$mail->ErrorInfo}";
                exit;
            }
    }
?>