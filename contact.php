<?php
 $valid = true;
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

function sendMail($email, $message)
{
    //require(".\PHPMailer\src\PHPMailer.php");
    //require(".\PHPMailer\src\SMTP.php");
    //require(".\PHPMailer\src\Exception.php");
    
    require __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer/src/SMTP.php';
    require __DIR__ . '/PHPMailer/src/Exception.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable debug output                     //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'waowx.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contact@waowx.com';                     //SMTP username
        $mail->Password   = 'Success4u#';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('contact@waowx.com', 'Public Relations with WAOWX INNOVATIONS');
        $mail->addAddress($email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Public Relations with WAOWX INNOVATIONS';
        $mail->Body    = $message;
    
        $mail->send();
        //echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
 if (isset($_POST['action']) && $_POST['action'] == 'contact') {
     switch (true) {
         case (!isset($_POST['name']) || empty($_POST['name'])):
             echo "<div class = 'alert alert-danger alert-dismissible w-100 mx-auto' role= 'alert'>
                         Enter name or company name
                     </div> ";
             $valid = FALSE;
             exit;
             break;
         default:
            $name = htmlentities(htmlspecialchars($_POST['name']));
             //$stu_firstname = db_Input_Secure($db_conn,'stu_firstname');
             //$stu_firstname = nameChecker($stu_firstname);
             break;
     }
     switch (true) {
        case (!isset($_POST['email']) || empty($_POST['email'])):
            echo "<div class = 'alert alert-danger alert-dismissible w-100 mx-auto' role= 'alert'>
                        Enter  email
                    </div> ";
            $valid = FALSE;
            exit;
            break;
        case (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
            echo "<div class = 'alert alert-danger alert-dismissible w-100 mx-auto' role= 'alert'>
                        Enter a valid email
                    </div> ";
            $valid = FALSE;
            exit;
            break;
        default:
           $email = htmlentities(htmlspecialchars($_POST['email']));
            
            break;
    }
    switch (true) {
        case (!isset($_POST['phone']) || empty($_POST['phone'])):
            echo "<div class = 'alert alert-danger alert-dismissible w-100 mx-auto' role= 'alert'>
                        Enter Phone Number
                    </div> ";
            $valid = FALSE;
            exit;
            break;

        default:
           $phone = htmlentities(htmlspecialchars($_POST['phone']));
            
            break;
    }
    if (TRUE == $valid) {
        $waowx_msg = "Hello Waowx <br> I am $name and I am interested with PR with waowX <br> my details are below<br> email: $email<br> phone: $phone";
        if(@sendMail("tobi@waowx.com", $waowx_msg)){
            echo "<div class = 'alert alert-success alert-dismissible w-100 mx-auto' role= 'alert'>
                        Thanks for contacting waowx. 
                    </div> ";
        }else{
            echo "<div class = 'alert alert-danger alert-dismissible w-100 mx-auto' role= 'alert'>
                       Oops! something went wrong try again
                    </div> ";
        }
    }
}