<?php
namespace App\Providers;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public static $mail_port = 587;
    public static $smtp_secure = PHPMailer::ENCRYPTION_STARTTLS;
    public static $host = 'smtp.gmail.com';
    public static function sendOrderedEmail($email, $name, $valuesToMailBody)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";

        $mail->SMTPAuth = true;

        $mail->Username = 'duongdeptrai102x@gmail.com';
        $mail->Password = 'fgpzcuoltcpzbecy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'utf-8';

        $mail->setFrom('cskh@light-studio.io', 'Light Studio CSKH');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = '[LIGHT-STUDIO] Đơn hàng của bạn đã được đặt thành công!';
        $mail->Body = view('cart.mailtemplate', compact('valuesToMailBody', 'name'))->render();

        $mail->send();
    }

    public static function sendVerifyEmail($email, $name, $token)
    {
        $valuesToMailBody = '0';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";

        $mail->SMTPAuth = true;

        $mail->Username = 'duongdeptrai102x@gmail.com';
        $mail->Password = 'fgpzcuoltcpzbecy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'utf-8';

        $mail->setFrom('cskh@light-studio.io', 'Light Studio CSKH');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = '[LIGHT-STUDIO] Vui lòng xác nhận Email của bạn';
        $mail->Body = view('auth.verified_email_template', compact('name', 'token'))->render();

        $mail->send();
    }

    public static function sendResetPasswordEmail($email, $name, $token) {
        
    }
}
?>