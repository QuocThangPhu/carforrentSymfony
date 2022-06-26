<?php

namespace App\Service;

use App\Transfer\MailTransfer;
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

    public function sendMail(MailTransfer $mailTransfer): void
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
            $mail->addAddress($mailTransfer->getMailAddress(), $mailTransfer->getNameOfUser());
            $mail->isHTML(true);
            $mail->Subject = $mailTransfer->getMailSubject();
            $mail->Body    = $mailTransfer->getMailBody();

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $errors) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
