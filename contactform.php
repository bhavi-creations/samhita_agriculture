<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path to autoload.php based on your project

// Check if the form is submitted
//-----Contact form------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assign POST data to variables
    $contactname = $_POST['contactname'] ?? '';

    $contactnumber = $_POST['contactnumber'] ?? '';
    $contactemail = $_POST['contactemail'] ?? '';
 

    $contactmessage = $_POST['contactmessage'] ?? '';

    

  
    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'manimalladi05@gmail.com'; // Your Gmail email address
        $mail->Password = 'hnjxoxgrttxomlxm'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('manimalladi05@gmail.com', 'Samhitha Agriculture'); // Your Gmail email and name
        $mail->addAddress('manimalladi05@gmail.com', 'Samhitha Agriculture'); // Recipient's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = "
           
            <h1>Contact Details</h1>
            <p><strong>Name:</strong> $contactname</p>
   
            <p><strong>Phone:</strong> $contactnumber</p>
            <p><strong>Email</strong>  $contactemail</p>
          
         
            <p><strong>Message:</strong>$contactmessage</p>
        ";

        $mail->send();
        echo '<script> window.alert("Message has been sent.\n\nPlease click OK."); window.location.href="index.html";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If accessed directly without POST data
    echo 'Access Denied';
}
?>