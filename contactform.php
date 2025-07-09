<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path to autoload.php based on your project

// Check if the form is submitted
//-----Contact form------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assign POST data to variables
    $contactname = $_POST['name'] ?? '';

    $contactnumber = $_POST['number'] ?? '';
    $contactemail = $_POST['email'] ?? '';
 

    $contactmeassage = $_POST['meassage'] ?? '';

    

  
    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'samhitasoilsolutions@gmail.com'; // Your Gmail email address
        $mail->Password = 'milhpmiingemmcrl '; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('samhitasoilsolutions@gmail.com', 'Samhitha Soil Solutions'); // Your Gmail email and name
        $mail->addAddress('samhitasoilsolutions@gmail.com', 'Samhitha Soil Solutions'); // Recipient's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = "
           
            <h1>Contact Details</h1>
            <p><strong>Name:</strong> $contactname</p>
   
            <p><strong>Phone:</strong> $contactnumber</p>
            <p><strong>Email</strong>  $contactemail</p>
          
         
            <p><strong>Message:</strong>$contactmeassage</p>
        ";

        $mail->send();
        echo '<script> window.alert("Message has been sent.\n\nPlease click OK."); window.location.href="index.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If accessed directly without POST data
    echo 'Access Denied';
}
?>