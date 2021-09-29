<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mail
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function send(array $to, string $template, string $subject, array $payload)
    {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.ethereal.email';
            $mail->SMTPAuth = true;
            $mail->Username = 'efrain.runte10@ethereal.email';
            $mail->Password = 'BXnv31J61vUWg2XMJK';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->CharSet = 'utf-8';
            $mail->setFrom('from@example.com', 'Marcus Pereira');
            $mail->addAddress($to['email'], $to['name']);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $this->container->view->render(
                $this->container->response,
                'mails/'. $template,
                $payload
            );

            $mail->send();
        } catch (PHPMailerException $e) {
            echo 'Houve um erro na tentativa de enviar um e-mail';
        }
    }
}