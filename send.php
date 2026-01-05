<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização de dados
    $name    = htmlspecialchars($_POST["name"]);
    $email   = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars($_POST["phone"]);
    $service = htmlspecialchars($_POST["service"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "valdesdeabreu@hotmail.com";
    $subject = "Novo contato do site: $name";

    $body = "Novo contato recebido pelo site:\n\n";
    $body .= "Nome: $name\n";
    $body .= "E-mail: $email\n";
    $body .= "Telefone: $phone\n";
    $body .= "Serviço: $service\n\n";
    $body .= "Mensagem:\n$message";

    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>