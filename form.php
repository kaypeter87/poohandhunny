<?php

$url = "http://poohandhunny.us";

		if(isset($_POST['submit'])){
            $to = "poohandhunny08252013@gmail.com"; // this is your Email address
            $name = $_POST["name"];
            $from = $_POST["form-email"]; // this is the sender's Email address
            
            function debug_to_console( $data ) {
                $output = $data;
                if ( is_array( $output ) )
                    $output = implode( ',', $output);
            
                echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
            }
           // Function to validate against any email injection attempts
           function IsInjected($str)
           {
           $injections = array('(\n+)',
                       '(\r+)',
                       '(\t+)',
                       '(%0A+)',
                       '(%0D+)',
                       '(%08+)',
                       '(%09+)'
                       );
           $inject = join('|', $injections);
           $inject = "/$inject/i";
           if(preg_match($inject,$str))
               {
               return true;
           }
           else
               {
               return false;
           }
           }
            
            //Validate first
            if(empty($name)||empty($from)) 
            {
                echo "Name and email are mandatory! Go back <a href='".$url."'>Home</a>";
                debug_to_console($name);
                debug_to_console($from);
                exit;
            }

            if(IsInjected($from))
            {
                echo "Bad email value!";
                exit;
            }
            $attendingyes = $_POST['yesican'];
            $attendingno = $_POST['noicant'];

            if(empty($attendingno))
            {
                $attending = "be attending";
            }
            if (empty($attendingyes))
            {
                $attending = "not be attending";
            }

            $guest = $_POST['guest'];
            $message = $name . " with guest, " . $guest .  ", will ".$attending. " your wedding!";
            $subject = "$name RSVP'd! to your Wedding!";
        
            $headers = "From:" . $from;

            mail($to,$subject,$message,$headers);
            echo "Thank you, you have been RSVP'd! Go back <a href='".$url."'>Home</a>";
            exit;
        } 
?>