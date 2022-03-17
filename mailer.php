<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



function sendStockReport(){

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'finahealthcare123@gmail.com';                     //SMTP username
    $mail->Password   = 'T1e2s3t4';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('announcements@tornadoteam.website', 'Pharmacy');

        $mail->addAddress('finahealthcare123@gmail.com', 'Weekly Report');     //Add a recipient

    
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    $uploaddri='weeklyReports/';
    $Fname='weeklyReport.pdf';
    $mail->addAttachment($uploaddri.$Fname,"weeklyReport".rand(1000,9999).".pdf");         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Stock';
    $mail->Body    = 'This is the weekly report regarding stocks status';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
} catch (Exception $e) {
}

}
function businessSend($Fname){

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'finahealthcare123@gmail.com';                     //SMTP username
        $mail->Password   = 'T1e2s3t4';                               //SMTP password
       // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('announcements@tornadoteam.website', 'Business Report');
    
            $mail->addAddress('finahealthcare123@gmail.com', 'Business Report');     //Add a recipient
    
        
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addBCC('bcc@example.com');
        $uploaddri='BusinessDocsOut/';
        //Attachments
        $mail->addAttachment($uploaddri.$Fname,);         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Supply Report';
        $mail->Body    = 'Medical Supplies Report';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        
    } catch (Exception $e) {
    }
    
    }

    function sendUnavailableStockReport(){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'finahealthcare123@gmail.com';                     //SMTP username
            $mail->Password   = 'T1e2s3t4';                               //SMTP password
           // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('announcements@tornadoteam.website', 'Pharmacy');
        
                $mail->addAddress('finahealthcare123@gmail.com', 'Stock Purchase');     //Add a recipient
        
            
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            $uploaddri='weeklyReports/';
            $Fname='unavailableItems.pdf';
            $time = date('H:i:s');
            $mail->addAttachment($uploaddri.$Fname,"unavailableItems".rand(1000,9999).".pdf");         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'unavailable Stock Request';
            $mail->Body    = 'This is a request report for all the unavailable items in the pharmacy for purchase';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            
        } catch (Exception $e) {
        }
        
        }
?>