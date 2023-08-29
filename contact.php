<?php



if(!$_POST) exit;



function tommus_email_validate($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); }


$name = $_POST['name']; $email = $_POST['email']; $message = $_POST['message'];

if(trim($name) == '') {

	exit('<div class="error_message">Atención! Por favor coloca tu Mensaje.</div>');

} else if(trim($name) == 'Name *') {

	exit('<div class="error_message">Atención! Por favor coloca tu nombre.</div>');

} else if(trim($email) == '') {

	exit('<div class="error_message">Atención! Por favor coloca un mail valido.</div>');

} else if(!tommus_email_validate($email)) {

	exit('<div class="error_message">Atención! Por favor coloca un mail valido</div>');

} else if(trim($message) == 'Comment *') {

	exit('<div class="error_message">Atención! Por favor coloca un mensaje.</div>');

} else if(trim($message) == '') {

	exit('<div class="error_message">Atención! Por favor coloca un mensaje.</div>');

} if(get_magic_quotes_gpc()) { $message = stripslashes($message); }



$address = 'gaston.rey.79@gmail.com';



$e_subject = 'Has sido contactado por ' . $name . '.';

$e_body = "Ha sido contactado por $name desde su formulario de contacto, su mensaje es el siguiente." . "\r\n" . "\r\n";

$e_content = "\"$message\"" . "\r\n" . "\r\n";

$e_reply = "Puede contactar a $name via email, $email";



$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );



$headers = "De: $email" . "\r\n";

$headers .= "Responder a: $email" . "\r\n";

$headers .= "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type: text/plain; charset=utf-8" . "\r\n";

$headers .= "Content-Transfer-Encoding: quoted-printable" . "\r\n";



if(mail($address, $e_subject, $msg, $headers)) { echo "<fieldset><div class='success-h3' id='success_page'><h3>Email enviado con éxito.</h3><p>Muchas gracias $name, su mensaje ha sido enviado.</p></div></fieldset>"; }