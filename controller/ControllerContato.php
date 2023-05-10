<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOContato.php");
include_once server_path("model/ModelContato.php");

class ControllerContato {

    private $info;
    private $daoContato;
    private $controllerSystem;
    private $parameter;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoContato = new DAOContato();
        $this->controllerSystem = new ControllerSystem();
        $this->parameter = new ControllerParameter();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=contato_uninformed';
            }
            try {
                $this->daoContato->delete($id);
                $this->info = "success=contato_deleted";
                $this->listar();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    if (($this->daoContato->selectObjectById($id)) === null) {
                        $this->info = 'warning=contato_not_exists';
                    } else {
                        $contato = new ModelContato();
                        $contato->id = $id;
                        $contato->status = $status;

                        $this->daoContato->updateStatus($contato);
                        $this->info = 'success=contato_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=contato_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=contato_uninformed';
                $this->listar();
            }
            try {
                $contato = $this->daoContato->selectObjectById($id);
                if (!isset($contato)) {
                    $this->info = 'warning=contato_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($contato == false) {
                $this->info = "warning=contato_not_found";
            }
            include_once server_path('view/contato/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoContato->selectObjectById($id)) === null) {
                        $this->info = 'warning=contato_not_exists';
                    } else {
                        $contato = new ModelContato();
                        $contato->id = $id;
                        $contato->status = $status;

                        $this->daoContato->updateStatus($contato);
                        $this->info = 'success=contato_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=contato_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['descricao']) && isset($_POST['celular'])) {
                $contato = new ModelContato();
                $contato->descricao = strip_tags($_POST['descricao']);
                $contato->celular = strip_tags($_POST['celular']);
                try {
                    $contatos = $this->daoContato->selectObjectsByContainsObject($contato);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/contato/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/contato/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $descricao = strip_tags($_POST['descricao']);
            $telefone = strip_tags($_POST['telefone']);
            $celular = strip_tags($_POST['celular']);
            $whatsapp = strip_tags($_POST['whatsapp']);
            $email = strip_tags($_POST['email']);
            $facebook = strip_tags($_POST['facebook']);
            $instagram = strip_tags($_POST['instagram']);
            $observacao = strip_tags($_POST['observacao']);
            $status = false;

            $contato = new ModelContato();
            $contato->descricao = $descricao;
            $contato->telefone = $telefone;
            $contato->celular = $celular;
            $contato->whatsapp = $whatsapp;
            $contato->email = $email;
            $contato->facebook = $facebook;
            $contato->instagram = $instagram;
            $contato->observacao = $observacao;
            $contato->status = $status;
            try {
                $daoContato = new DAOContato();
                $daoContato->save($contato);
                $this->info = "success=contato_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function send_email(ModelContato $contato = null) {
        require_once server_path('assets/php/phpmailer/class.phpmailer.php');
        $email = $this->parameter->getProperty('email');
        $senha = $this->parameter->getProperty('senha');
        $nomeFantazia = $this->parameter->getProperty('nome_fantazia');

        define('GUSER', $email); // <-- Insira aqui o seu GMail
        define('GPWD', $senha);  // <-- Insira aqui a senha do seu GMail

        function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
            $parameter = new ControllerParameter();
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = $parameter->getProperty('servidor_debug_email');
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = $parameter->getProperty('servidor_email_seguranca');
            $mail->Host = $parameter->getProperty('servidor_email_smtp');
            $mail->Port = $parameter->getProperty('servidor_email_porta');
            $mail->CharSet = "utf-8";
            $mail->Username = GUSER;
            $mail->Password = GPWD;
            $mail->SetFrom($de, $de_nome);
            $mail->Subject = $assunto;
            $mail->Body = $corpo;
            $mail->AddAddress($para);

            if (!$mail->Send()) {
                return false;
            } else {
                return true;
            }
        }

        $conteudoEmail = "Nome: $contato->descricao\n\nE-mail: $contato->email\n\nMensagem: $contato->observacaoo\n";
        return smtpmailer($contato->email, $email, $nomeFantazia, 'Dados de Acesso', $conteudoEmail);

        if (!empty($error)) {
            throw new Exception("Erro ao enviar email. Erro " . $error);
        }
    }

    public function send_email_smtp(ModelContato $contato = null){
        try {
            require_once server_path('assets/php/phpmailer/class.phpmailer.php');

            $email = $this->parameter->getProperty('email');
            $senha = $this->parameter->getProperty('senha');
            $nomeFantazia = $this->parameter->getProperty('nome_fantazia');

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = $this->parameter->getProperty('servidor_debug_email'); //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->CharSet = "utf-8";
            $mail->Host       = $this->parameter->getProperty('servidor_email_smtp'); //Set the SMTP server to send through
            $mail->SMTPAuth   = true; //Enable SMTP authentication
            $mail->Username   =  $email; //SMTP username
            $mail->Password   =  $senha; //SMTP password
            $mail->SMTPSecure = $this->parameter->getProperty('servidor_email_seguranca'); //SSL/TLS Enable implicit TLS encryption
            $mail->Port       = $this->parameter->getProperty('servidor_email_porta'); //465/587 TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, $nomeFantazia);
            $mail->addAddress($contato->email, $contato->descricao);     //Add a recipient
            //$mail->addAddress('paulistensetecnologia@zohomail.com');               //Name is optional
            //$mail->addReplyTo($contato->email, 'Information');
            //$mail->addCC('paulistensetecnologia@zohomail.com');
            //$mail->addBCC('paulistensetecnologia@zohomail.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Dados de Acesso';
            $mail->Body    = $conteudoEmail = "Nome: $contato->descricao E-mail: $contato->email Mensagem: $contato->observacaoo";//Interpretador HTML
            $mail->AltBody = $conteudoEmail = "Nome: $contato->descricao E-mail: $contato->email Mensagem: $contato->observacaoo";//Sem interpretador HTML
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function submit() {
        $descricao = strip_tags($_POST['descricao']);
        $celular = strip_tags($_POST['celular']);
        $email = strip_tags($_POST['email']);
        $observacao = strip_tags($_POST['observacao']);

        $contato = new ModelContato();
        $contato->descricao = $descricao;
        $contato->celular = $celular;
        $contato->email = $email;
        $contato->observacao = $observacao;
        $contato->telefone = '';
        $contato->whatsapp = '';
        $contato->facebook = '';
        $contato->instagram = '';
        $contato->status = true;

        try {
            if ($this->send_email($contato)) {
                $this->daoContato->save($contato);
                include_once server_path('view/contato/success.php');
            } else {
                echo '<script>alert("Email não enviado!")</script>';
                redirect("javascript:window.history.go(-1)");
            }
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $id = strip_tags($_POST['id']);
                if (!isset($id)) {
                    $this->info = 'warning=contato_uninformed';
                }

                $descricao = strip_tags($_POST['descricao']);
                $telefone = strip_tags($_POST['telefone']);
                $celular = strip_tags($_POST['celular']);
                $whatsapp = strip_tags($_POST['whatsapp']);
                $email = strip_tags($_POST['email']);
                $facebook = strip_tags($_POST['facebook']);
                $instagram = strip_tags($_POST['instagram']);
                $observacao = strip_tags($_POST['observacao']);

                $contato = new ModelContato();
                $contato->id = $id;
                $contato->descricao = $descricao;
                $contato->telefone = $telefone;
                $contato->celular = $celular;
                $contato->whatsapp = $whatsapp;
                $contato->email = $email;
                $contato->facebook = $facebook;
                $contato->instagram = $instagram;
                $contato->observacao = $observacao;

                try {
                    $this->daoContato->update($contato);
                    if ($contato == null) {
                        $this->info = 'warning=contato_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=contato_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
