<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/model/ModelContact.php");

class ControllerSystem {

    private $info;

    function __construct() {
        $this->info = 'default=default';
    }

    public function about($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/system/about.php');
    }

    public function contact($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/system/contact.php');
    }

    public function home($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/system/default.php');
    }

    public function send_email(ModelContact $contact = null) {
        $Vai = "Nome: $contact->cont_descricao\n\nE-mail: $contact->cont_email\n\nMensagem: $contact->cont_texto\n";

        require_once server_path('br/com/system/assets/php/phpmailer/class.phpmailer.php');

        define('GUSER', 'paulistensetecnologia@gmail.com'); // <-- Insira aqui o seu GMail
        define('GPWD', '@Gsouza19');  // <-- Insira aqui a senha do seu GMail

        function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
            global $error;
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->CharSet  ="utf-8";
            $mail->Username = GUSER;
            $mail->Password = GPWD;
            $mail->SetFrom($de, $de_nome);
            $mail->Subject = $assunto;
            $mail->Body = $corpo;
            $mail->AddAddress($para);
            
            if (!$mail->Send()) {
                $error = 'Mail error: ' . $mail->ErrorInfo;
                return false;
            } else {
                $error = 'Mensagem enviada!';
                return true;
            }
        }

        return smtpmailer($contact->cont_email, 'paulistensetecnologia@gmail.com', 'Geverson Souza', 'Senha de Acesso', $Vai);

        if (!empty($error)) {
            throw new Exception("Erro ao enviar email" . $error);
        }
    }

    public function service($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/system/service.php');
    }

    public function welcome($msg = null) {
        if (GenericController::authotity()) {
            if (!isset($msg)) {
                $msg = $this->info;
            }
            GenericController::valid_messages($msg);
            include_once server_path('br/com/system/view/system/welcome.php');
        }
    }

    public function user_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/user/authenticate.php');
    }

}
