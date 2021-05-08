<?php
echo "Hi, I am authnetication";
    $toemail = "budhathoki.roshan321@gmail.com";

    $subject = "Verification code.";

    $body  = "This is your verification code: 8989.";

    $headers = "From: senders\'s email";

    if(mail($toemail, $subject, $body, $headers)){
        echo "Email is sent successfully.";
    } else {
        echo "Email is not sent";
    }
?>