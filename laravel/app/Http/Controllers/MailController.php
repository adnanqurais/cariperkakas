<?php namespace App\Http\Controllers;

use Input; 
use DB;
use Session;
use PHPMailer;
class MailController extends Controller {

    public function getmailtest(){    
        $config=DB::table('configuration')->first();    
        
        //PHPMailer Object
        $mail = new PHPMailer;                
        // whereas if using SMTP you would have
        $mail->IsMAIL();
        // Set mailer to use SMTP
        $mail->Host = 'mail.chronosh.com';  // Specify main and backup SMTP servers
        //From email address and name
        $mail->From = "cariperkakas@chronosh.com";
        $mail->FromName = $config->sitename;
        //To address and name
        $mail->addAddress("rhomario.elven@gmail.com", "");

        //Address to which recipient will reply
        // $mail->addReplyTo("reply@yourdomain.com", "Reply");

        //CC and BCC
        // $mail->addCC("cc@example.com");
        // $mail->addBCC("bcc@example.com");

        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = "Subject Text";
        $mail->Body = "<i>Mail body in HTML</i>";
        $mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send()) 
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {
            echo "Message has been sent successfully";
        }

    }



}