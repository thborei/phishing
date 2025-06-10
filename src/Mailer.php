<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer
{
    public static function send($to, $subject, $body, $from = 'no-reply@monapp.com')
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mailhog';   // ⚠️ important : le nom du service dans docker-compose
            $mail->Port = 1025;
            $mail->SMTPAuth = false;

            $mail->setFrom($from, 'Mon App');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur PHPMailer : " . $mail->ErrorInfo);
            return false;
        }
    }
}