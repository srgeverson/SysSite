<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOContact.php");
include_once server_path("br/com/system/model/ModelContact.php");

class ControllerContact {

    private $info;
    private $daoContact;
    private $controllerSystem;
    private $parameter;

    function __construct() {
        $this->info = 'default=default';
        $this->daoContact = new DAOContact();
        $this->controllerSystem = new ControllerSystem();
        $this->parameter = new ControllerParameter();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $cont_pk_id = strip_tags($_GET['cont_pk_id']);
            if (!isset($cont_pk_id)) {
                $this->info = 'warning=contact_uninformed';
            }
            try {
                $this->daoContact->delete($cont_pk_id);
                $this->info = "success=contact_deleted";
                $this->listar();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $cont_pk_id = strip_tags($_GET['cont_pk_id']);
            if (isset($cont_pk_id)) {
                $cont_status = false;
                try {
                    if (($this->daoContact->selectObjectById($cont_pk_id)) === null) {
                        $this->info = 'warning=contact_not_exists';
                    } else {
                        $contact = new ModelContact();
                        $contact->cont_pk_id = $cont_pk_id;
                        $contact->cont_status = $cont_status;

                        $this->daoContact->updateStatus($contact);
                        $this->info = 'success=contact_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=contact_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $cont_pk_id = $_GET['cont_pk_id'];
            if (!isset($cont_pk_id)) {
                $this->info = 'warning=contact_uninformed';
                $this->listar();
            }
            try {
                $contact = $this->daoContact->selectObjectById($cont_pk_id);
                if (!isset($contact)) {
                    $this->info = 'warning=contact_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($contact == false) {
                $this->info = "warning=contact_not_found";
            }
            include_once server_path('br/com/system/view/contact/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $cont_pk_id = strip_tags($_GET['cont_pk_id']);
            if (isset($cont_pk_id)) {
                $cont_status = true;
                try {
                    if (($this->daoContact->selectObjectById($cont_pk_id)) === null) {
                        $this->info = 'warning=contact_not_exists';
                    } else {
                        $contact = new ModelContact();
                        $contact->cont_pk_id = $cont_pk_id;
                        $contact->cont_status = $cont_status;

                        $this->daoContact->updateStatus($contact);
                        $this->info = 'success=contact_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=contact_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['cont_description']) && isset($_POST['cont_cell_phone'])) {
                $contact = new ModelContact();
                $contact->cont_description = strip_tags($_POST['cont_description']);
                $contact->cont_cell_phone = strip_tags($_POST['cont_cell_phone']);
                try {
                    $contacts = $this->daoContact->selectObjectsByContainsObject($contact);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/contact/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('br/com/system/view/contact/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $cont_description = strip_tags($_POST['cont_description']);
            $cont_phone = strip_tags($_POST['cont_phone']);
            $cont_cell_phone = strip_tags($_POST['cont_cell_phone']);
            $cont_whatsapp = strip_tags($_POST['cont_whatsapp']);
            $cont_email = strip_tags($_POST['cont_email']);
            $cont_facebook = strip_tags($_POST['cont_facebook']);
            $cont_instagram = strip_tags($_POST['cont_instagram']);
            $cont_text = strip_tags($_POST['cont_text']);
            $cont_status = false;

            $contact = new ModelContact();
            $contact->cont_description = $cont_description;
            $contact->cont_phone = $cont_phone;
            $contact->cont_cell_phone = $cont_cell_phone;
            $contact->cont_whatsapp = $cont_whatsapp;
            $contact->cont_email = $cont_email;
            $contact->cont_facebook = $cont_facebook;
            $contact->cont_instagram = $cont_instagram;
            $contact->cont_text = $cont_text;
            $contact->cont_status = $cont_status;
            try {
                $daoContact = new DAOContact();
                $daoContact->save($contact);
                $this->info = "success=contact_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function send_email(ModelContact $contact = null) {
        require_once server_path('br/com/system/assets/php/phpmailer/class.phpmailer.php');
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

        $conteudoEmail = "Nome: $contact->cont_descricao\n\nE-mail: $contact->cont_email\n\nMensagem: $contact->cont_texto\n";
        return smtpmailer($contact->cont_email, $email, $nomeFantazia, 'Dados de Acesso', $conteudoEmail);

        if (!empty($error)) {
            throw new Exception("Erro ao enviar email. Erro " . $error);
        }
    }

    public function submit() {
        $cont_description = strip_tags($_POST['cont_description']);
        $cont_cell_phone = strip_tags($_POST['cont_cell_phone']);
        $cont_email = strip_tags($_POST['cont_email']);
        $cont_text = strip_tags($_POST['cont_text']);

        $contact = new ModelContact();
        $contact->cont_description = $cont_description;
        $contact->cont_cell_phone = $cont_cell_phone;
        $contact->cont_email = $cont_email;
        $contact->cont_text = $cont_text;
        $contact->cont_phone = '';
        $contact->cont_whatsapp = '';
        $contact->cont_facebook = '';
        $contact->cont_instagram = '';
        $contact->cont_status = true;

        try {
            if ($this->send_email($contact)) {
                $this->daoContact->save($contact);
                include_once server_path('br/com/system/view/contact/success.php');
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
                $cont_pk_id = strip_tags($_POST['cont_pk_id']);
                if (!isset($cont_pk_id)) {
                    $this->info = 'warning=contact_uninformed';
                }

                $cont_description = strip_tags($_POST['cont_description']);
                $cont_phone = strip_tags($_POST['cont_phone']);
                $cont_cell_phone = strip_tags($_POST['cont_cell_phone']);
                $cont_whatsapp = strip_tags($_POST['cont_whatsapp']);
                $cont_email = strip_tags($_POST['cont_email']);
                $cont_facebook = strip_tags($_POST['cont_facebook']);
                $cont_instagram = strip_tags($_POST['cont_instagram']);
                $cont_text = strip_tags($_POST['cont_text']);

                $contact = new ModelContact();
                $contact->cont_pk_id = $cont_pk_id;
                $contact->cont_description = $cont_description;
                $contact->cont_phone = $cont_phone;
                $contact->cont_cell_phone = $cont_cell_phone;
                $contact->cont_whatsapp = $cont_whatsapp;
                $contact->cont_email = $cont_email;
                $contact->cont_facebook = $cont_facebook;
                $contact->cont_instagram = $cont_instagram;
                $contact->cont_text = $cont_text;

                try {
                    $this->daoContact->update($contact);
                    if ($contact == null) {
                        $this->info = 'warning=contact_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=contact_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
