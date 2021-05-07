<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    trait EmailTrait  {

        public function sendEmail($to,$subject,$message)
        {
            
        $from = "ghous.lal@coeus-solutions.de";
        $headers = "From:" . $from;

        if(mail($to,$subject,$message, $headers)) {

            echo "The email message was sent.";

        } else {

            echo "The email message was not sent.";

        }

        }

    }