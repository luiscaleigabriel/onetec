<?php

namespace app\support;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email 
{
    private $mail; 

    public function __construct($host, $username, $password, $port = 587) { 
        $this->mail = new PHPMailer(true); 
        // Configurações do servidor 
        $this->mail->isSMTP(); 
        $this->mail->Host = $host; 
        $this->mail->SMTPAuth = true; 
        $this->mail->Username = $username; 
        $this->mail->Password = $password; 
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $this->mail->Port = $port; 

        // Configurações SSL/TLS 
        $this->mail->SMTPOptions = array( 
            'ssl' => array( 
                'verify_peer' => false, 
                'verify_peer_name' => false, 
                'allow_self_signed' => true 
            ) 
        );
    } 
    
    public function sendEmail($from, $fromName, $to, $toName, $subject, $body) { 
        try { 
            // Remetente e destinatário 
            $this->mail->setFrom($from, $fromName); 
            $this->mail->addAddress($to, $toName); 
            // Conteúdo do email 
            $this->mail->isHTML(true); 
            $this->mail->Subject = $subject; 
            $this->mail->Body = $body; 
            $this->mail->AltBody = strip_tags($body); 
            $this->mail->send(); 
            return 'Mensagem enviada com sucesso'; 
        } catch (Exception $e) { 
            return "A mensagem não pôde ser enviada. Erro: {$this->mail->ErrorInfo}"; 
        } 
    }
}