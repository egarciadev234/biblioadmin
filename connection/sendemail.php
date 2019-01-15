<?php 
    function sendemail($mail_username,$mail_userpassword,$mail_addAddress, $template)
    {
        require("class.phpmailer.php");
        
        $mail = new PHPMailer;
        $mail->isSMTP();                            
        $mail->Host = 'smtp.gmail.com';             
        $mail->SMTPAuth = true;                     
        $mail->Username = $mail_username;          
        $mail->Password = $mail_userpassword; 		
        $mail->SMTPSecure = 'tls'; 
        $mail->Body = 'Este es un Mensaje de ALERTA';
        $mail->Subject = "Se ha vencido uno de tus Prestamoss";                 
        $mail->Port = 587;                          
        $mail->setFrom('', 'biblioAdmin');//el primer parametro deve de ser el correo emisor
        $mail->addAddress($mail_addAddress);
        $message = file_get_contents($template);
        
        $mail->isHTML(true);
        if(!$mail->send()) 
        {
           return false;
        } 
        else 
        {
            return true;
        }
    }
?>