<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Configurações do Servidor (Exemplo usando Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Ou o host do seu provedor
        $mail->SMTPAuth   = true;
        $mail->Username   = 'SEU_EMAIL@gmail.com'; // Seu e-mail
        $mail->Password   = 'SUA_SENHA_DE_APP';    // Sua senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinatários
        $mail->setFrom('SEU_EMAIL@gmail.com', 'Site TechSolutions');
        $mail->addAddress('valdesdeabreu@hotmail.com'); 

        // Conteúdo
        $mail->isHTML(false);
        $mail->Subject = "Novo Contato: " . $_POST['service'];
        $mail->Body    = "Nome: {$_POST['name']}\nE-mail: {$_POST['email']}\nTelefone: {$_POST['phone']}\n\nMensagem:\n{$_POST['message']}";

        $mail->send();
        echo "sucesso";
    } catch (Exception $e) {
        echo "erro";
    }
}
?>