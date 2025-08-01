<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailServices
{
    public function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = env('MAIL_PORT', 587);

            //Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            \Log::error("PHPMailer error: " . $mail->ErrorInfo);
            return false;
        }
    }
}
