<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização de dados
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST["phone"]);
    $service = htmlspecialchars($_POST["service"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // Configurações do Servidor SMTP
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST') ?: 'localhost';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER');
        $mail->Password = getenv('SMTP_PASS');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = getenv('SMTP_PORT') ?: 587;
        $mail->CharSet = 'UTF-8';

        // Destinatários
        // O remetente oficial é o e-mail configurado no SMTP, mas o e-mail do cliente é colocado no Reply-To
        $mail->setFrom(getenv('SMTP_USER'), 'TechSolutions Site');
        $mail->addAddress('valdesdeabreu@hotmail.com');
        $mail->addReplyTo($email, $name);

        // Conteúdo do E-mail
        $mail->isHTML(false);
        $mail->Subject = "Novo contato do site: $name";

        $body = "Novo contato recebido pelo site:\n\n";
        $body .= "Nome: $name\n";
        $body .= "E-mail: $email\n";
        $body .= "Telefone: $phone\n";
        $body .= "Serviço: $service\n\n";
        $body .= "Mensagem:\n$message";

        $mail->Body = $body;

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        // Log do erro para depuração interna (não exibe para o usuário)
        error_log("Mailer Error: {$mail->ErrorInfo}");
        echo "error";
    }
}
?>