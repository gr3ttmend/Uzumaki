<?php
include("Mailer/src/PHPMailer.php");    //RENOMBRAR LA CARPETA PHPmAILER X Mailer (opcional)
include("Mailer/src/Exception.php");    //https://github.com/PHPMailer/PHPMailer
include("Mailer/src/SMTP.php");
try{

    $fromemail = $_POST["email"];
    $fromname = $_POST["nombre"];
    $subject = "Correo desde UZUMAKI";
    $mensa = $_POST["mensaje"];
    $asunto = $_POST["asunto"];
    $host = "smtp.gmail.com";
    $port = "587";
    $SMTPAuth = "login";
    $SMTPSecure = "tls";
    $username = "user@gmail.com";                 //AQUÍ VA EL CORREO RECEPTOR DEL ENVIO DE MENSAJE
    $password = "*******";                //AQUÍ VA LA PASSWORD DEL CORREO INDICADO ARRIBA

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;   //"1" EJECUTA DEBUG EN PANTALLA, "0" PARA NO EJECUTAR DEBUG
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = $SMTPAuth;    //Para hacerse autentificar por SMTP
    $mail->SMTPSecure = $SMTPSecure;   //protocolo de encriptación por el cual se va a enviar Transport Layer Security
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->setFrom($fromemail,$fromname);
    //DESTINATARIO
    $mail->addAddress($username);
    //ASUNTO
    $mail->isHTML(true);
    $mail->Subject = $subject;
    //CUERPO DEL EMAIL
    $mensaje = nl2br("Este mensaje fue enviado por " . $fromname . "\n");
    $mensaje .= nl2br("Su e-mail es: " . $fromemail . "\n");
    $mensaje .= nl2br("Asunto: " . $asunto . "\n");
    $mensaje .= nl2br("Mensaje: " . $mensa . "\n");
    $mensaje .= "Enviado el " . date('d/m/Y', time());
    $mail->Body = $mensaje;

    if(!$mail->send()){
        error_log("MAILER: No se pudo enviar el correo!"); 
        echo("MAILER: No se pudo enviar el correo!");die();
    }
    // echo("Correo enviado con éxito!"); die();   //ESTA LINEA HABRÁ QUE SACAR O COMENTAR PARA ACCEDER A CONTACTO2
    header('Location: Contacto2.html');
    }catch(Exception $e){
        echo("Alguna instrucción de PHPMailer no se puedo llevar a cabo");
    }
?>
