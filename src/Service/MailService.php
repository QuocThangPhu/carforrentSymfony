<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailService
{
    private ParameterBagInterface $param;
    public function __construct(ParameterBagInterface $param)
    {
        $this->param = $param;
    }

    public function sendMail(): void
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = $this->param->get('email_host');
            $mail->CharSet = 'UTF-8';
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->param->get('email_username');
            $mail->Password   = $this->param->get('email_password');
            $mail->SMTPSecure = $this->param->get('email_smtp');
            $mail->Port       = $this->param->get('email_port');

            $mail->setFrom('support@diggory.me', 'Mailer');
            $mail->addAddress('thang.phu@nfq.asia', 'Nghia');

            $mail->isHTML(true);
            $mail->Subject = 'Nghĩa ngu ngok';
            $mail->Body    = 'Nghĩa nguuuuuuuuuu';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $errors) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
