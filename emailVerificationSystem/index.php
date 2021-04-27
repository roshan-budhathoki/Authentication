<?php

$con = mysqli_connect('localhost','root','','ee');

$code = md5(rand(1,100));

$body = '

welcome to ryzen click the link below to activate your account

<a href="http://localhost/emailVerificationSystem/activate.php?code='.$code.'" target="_blank">Confirm Email</>

';

$query = mysqli_query($con,"INSERT INTO cart (product_id,user_id,quantity) VALUES ('$code','1','1')");

if($query){

    $mailDo = mail($to, $subject, $message, $headers);

}

if($mailDo){

    echo "registration success";
}


?>


<?php
$to = 'razoo.choudhary@gmail.com';
$subject = 'Marriage Proposal';
$from = 'peterparker@email.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hi Jane!</h1>';
$message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p><button>GOTO FACEBOOK</button>';
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?>