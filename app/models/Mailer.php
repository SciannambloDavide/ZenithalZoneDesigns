<?php
namespace app\models;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailsender/src/Exception.php';
require 'phpmailsender/src/PHPMailer.php';
require 'phpmailsender/src/SMTP.php';

class Mailer extends \app\core\Model{
    

    public static function sendEmail($email, $subject, $message){ 
            try {
                $mail = new PHPMailer(true);  
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'zenithalzonedesigns@gmail.com';
                $mail->Password = 'dgictnycvifnejot';
                $mail->SMTPSecure = 'ssl'; // or 'tls'
                $mail->Port = 465; // or 587 for TLS
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->send();
                return 0;
            } catch (Exception $e) {
                return 1;
            }
    }
    //sending email to multiple recipients
    public static function sendEmailToMultipleRecipients($emails, $subject, $message){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zenithalzonedesigns@gmail.com';
            $mail->Password = 'dgictnycvifnejot';
            $mail->SMTPSecure = 'ssl'; // or 'tls'
            $mail->Port = 465; // or 587 for TLS
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            foreach ($emails as $email) {
                $mail->clearAddresses();
                $mail->addAddress($email);
                $mail->send();
            }
            return 0;
        } catch (Exception $e) {
            return 1;
        }
    }


    //sending the same email to multiple recipients with names
    public static function sendEmailToMultipleRecipientsWithNames($names, $emails, $subject, $message){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zenithalzonedesigns@gmail.com';
            $mail->Password = 'dgictnycvifnejot';
            $mail->SMTPSecure = 'ssl'; // or 'tls'
            $mail->Port = 465; // or 587 for TLS
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            foreach ($emails as $key => $email) {
                $mail->clearAddresses();
                $mail->addAddress($email, $names[$key]);
                $mail->send();
            }
            
            return 0;
        } catch (Exception $e) {
            return 1;
        }
    }

}

?>