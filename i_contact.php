<?php



if(!$_POST) exit;



function tommus_email_validate($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); }


$name = $_POST['name']; $email = $_POST['email']; $message = $_POST['message'];

if(trim($name) == '') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($name) == 'Name *') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($email) == '') {

	exit('<div class="error_message">Attention! Please enter a valid email address.</div>');

} else if(!tommus_email_validate($email)) {

	exit('<div class="error_message">Attention! You have entered an invalid e-mail address.</div>');

} else if(trim($message) == 'Comment *') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} else if(trim($message) == '') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} if(get_magic_quotes_gpc()) { $message = stripslashes($message); }



$address = 'gaston.rey.79@gmail.com';



$e_subject = 'You\'ve been contacted by ' . $name . '.';

$e_body = "You have been contacted by $name from your contact form, their additional message is as follows." . "\r\n" . "\r\n";

$e_content = "\"$message\"" . "\r\n" . "\r\n";

$e_reply = "You can contact $name via email, $email";



$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );



$headers = "From: $email" . "\r\n";

$headers .= "Reply-To: $email" . "\r\n";
