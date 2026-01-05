<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "valdesdeabreu@hotmail.com";
    $subject = "Novo Contato: " . $_POST['service'];
    
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $body = "Nome: $name\nE-mail: $email\nTelefone: $phone\nServiço: " . $_POST['service'] . "\n\nMensagem:\n$message";

    // Headers mais profissionais
    $headers = "From: techsolutions@render.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo "sucesso";
    } else {
        // Isso vai nos ajudar a ver o erro no log do Render
        error_log("Erro ao enviar e-mail para: $to");
        echo "erro";
    }
}
?>