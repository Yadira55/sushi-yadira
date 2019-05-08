<?php

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

// Datos del Formulario a recibir, solo agregar mas variables segun se requieran

$nombre = $_POST["nombre"];

$apellido = $_POST["apellido"];

//$empresa = $_POST["empresa"];

$telefono = $_POST["telefono"];

$email = $_POST["email"];

//$intereses = $_POST["intereses"];

$mensaje = $_POST["mensaje"];

$aviso = $_POST["aviso"];

$destino = "hhyadira@gmail";

// Si requerimos enviar el formulario a mas destinatarios los agregamos
// $destino2 = "dan@studio-8.co";
// $destino3 = "ejemplo@gmail.com";

// Set mailer to use SMTP aqui es donde se encripta la informacion
$mail->isSMTP();

// Si la cuenta es de gmail usar el host
// $mail->Host = 'ssl://smtp.gmail.com';
// Si la cuenta es de Hotmail u outlook
// $mail->Host = 'smtp.live.com';

$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers, a ste se le cambia, dependiendo de tu dominio
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'hhyadira@gmail.com';                 // SMTP username, deben ser reales
$mail->Password = 'yadmari5';                           // SMTP password, deben ser reales
$mail->SMTPSecure = 'ssl';                           // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to es el puerto esto se checa en la documentacion del servidor

// Mail que envia y valida el envio del formulario
$mail->setFrom('hhyadira@gmail.com', 'Contacto'); //de donde estas enviando, se pone el mail que se usa para validar, en las siguiuentes comillas puedes poner un nombre, lo que quieres que aparezca en la cabecera

$mail->addAddress($destino, 'Ventas'); //a quien se lo estas enviando
//Agrego mas destinos en caso de requerirlo
// $mail->addAddress($destino2, 'Daniel');
// $mail->addAddress($destino3, 'Usuario Destino');

$mail->Subject = 'Nuevo mensaje de Contacto'; //asunto del mail
$mensajeHtml = nl2br($mensaje);

//Se estructura el cuerpo del mensaje, en html para darle formato

$mail->Body    =

"
<html>

<body>

<h2>Recibiste un nuevo mensaje desde el formulario de Contacto</h2> 

<p>Informacion enviada por {$nombre}:</p>

<p>Email: {$email}</p>

<p>Telefono de contacto: {$telefono}</p>

<p>Mensaje: {$mensaje}</p>

<p>Aviso: {$aviso}</p>

</body>

</html>

<br />";

// Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

//$mail->SMTPOptions = array(
//    'ssl' => array(
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    )
//);


if(!$mail->send()) {
    echo 'Error, mensaje no enviado';
    echo 'Error del mensaje: ' . $mail->ErrorInfo;
} else {
    // Mensaje de envio de formulario correcto o redirección a pagina de agradcimientos para contar los Leeds recibidos de ese formualrio
//   echo 'El mensaje se ha enviado correctamente';
     header("Location:../index.html"); //con este le dices a que html quieres que se vaya, si no quieres hacer una pagina de gracias, lo vuelve a enviar al index y asi el usuario sabe que fue enviado
}
