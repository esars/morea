<!doctype html>
<html>
<head>
<title>Sending HTML email using PHP</title>
</head>
<body>
<?php
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);
ini_set('sendmail_from','admin@example.co.uk');
ini_set('SMTP','smtp.aeg.es');
ini_set('smtp_port',25);
$to = 'enekosar@ikasle.aeg.es';
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers  .= "From: NO-REPLY<no-reply@mydomain.com>" . "\r\n";
$subject = "Confirmation For Request";
$message = '<html>
                <body>
                    <p>
                        We recieved below details from you. Please use given Request/Ticket ID for future follow up:
                    <p>
                    Thanks,<br>
                    Team.
                    </p>
                </body>
            </html>';
if(mail( $to, $subject, $message, $headers )) {
        echo "delux";
} else {
        echo "lastima";
}
