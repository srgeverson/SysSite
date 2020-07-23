<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOEstado.php");
include_once server_path("br/com/system/dao/DAOFuncionario.php");
include_once server_path("br/com/system/model/ModelContact.php");
include_once server_path("br/com/system/model/ModelEndereco.php");
include_once server_path("br/com/system/model/ModelFuncionario.php");

class ControllerFuncionario {

    private $info;
    private $daoFuncionario;

    //ok
    function __construct() {
        $this->info = 'default=default';
        $this->daoFuncionario = new DAOFuncionario();
    }

    //ok
    public function delete() {
        if (GenericController::authotity()) {
            $func_pk_id = strip_tags($_GET['func_pk_id']);
            if (!isset($func_pk_id)) {
                $this->info = 'warning=funcionario_uninformed';
            }

            try {
                $funcionario = $this->daoFuncionario->selectObjectById($func_pk_id);
                $this->daoFuncionario->delete($func_pk_id);
                $this->info = "success=funcionario_deleted";
                $this->list();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            //DAOs
            $daoContact = new DAOContact();
            $daoEndereco = new DAOEndereco();

            try {
                $daoContact->delete($funcionario->func_fk_contact_pk_id);
                try {
                    $daoEndereco->delete($funcionario->func_fk_endereco_pk_id);
                } catch (Exception $erro) {
                    $this->info = "error=Endereço: " . $erro->getMessage();
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=Contato: " . $erro->getMessage();
                $this->list();
            }
        }
    }

    //ok
    public function disable() {
        if (GenericController::authotity()) {
            $func_pk_id = strip_tags($_GET['func_pk_id']);
            if (isset($func_pk_id)) {
                $func_status = false;
                try {
                    if (($this->daoFuncionario->selectObjectById($func_pk_id)) === null) {
                        $this->info = 'warning=funcionario_not_exists';
                    } else {
                        $funcionario = new ModelFuncionario();
                        $funcionario->func_pk_id = $func_pk_id;
                        $funcionario->func_status = $func_status;

                        $this->daoFuncionario->updateStatus($funcionario);
                        $this->info = 'success=funcionario_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=funcionario_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $func_pk_id = $_GET['func_pk_id'];
            if (!isset($func_pk_id)) {
                $this->info = 'warning=funcionario_uninformed';
                $this->list();
            }
            try {
                $daoEstado = new DAOEstado();
                $estados = $daoEstado->selectObjectsEnabled();
                $funcionario = $this->daoFuncionario->selectObjectById($func_pk_id);
                if (!isset($funcionario)) {
                    $this->info = 'warning=funcionario_not_exists';
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($funcionario == false) {
                $this->info = "warning=funcionario_not_found";
            }
            include_once server_path('br/com/system/view/funcionario/edit.php');
        }
    }

    //ok
    public function enable() {
        if (GenericController::authotity()) {
            $func_pk_id = strip_tags($_GET['func_pk_id']);
            if (isset($func_pk_id)) {
                $func_status = true;
                try {
                    if (($this->daoFuncionario->selectObjectById($func_pk_id)) === null) {
                        $this->info = 'warning=funcionario_not_exists';
                    } else {
                        $funcionario = new ModelFuncionario();
                        $funcionario->func_pk_id = $func_pk_id;
                        $funcionario->func_status = $func_status;

                        $this->daoFuncionario->updateStatus($funcionario);
                        $this->info = 'success=funcionario_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=funcionario_uninformed';
            }
            $this->list();
        }
    }

    //ok
    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['func_nome']) && isset($_POST['func_cpf']) && isset($_POST['func_rg'])) {
                $funcionario = new ModelFuncionario();
                $funcionario->func_nome = strip_tags($_POST['func_nome']);
                $funcionario->func_cpf = strip_tags($_POST['func_cpf']);
                $funcionario->func_rg = strip_tags($_POST['func_rg']);
                try {
                    $funcionarios = $this->daoFuncionario->selectObjectsByContainsObject($funcionario);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/funcionario/list.php');
        }
    }

    //ok
    public function new() {
        if (GenericController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            include_once server_path('br/com/system/view/funcionario/new.php');
        }
    }

    //ok
    public function save() {
        if (GenericController::authotity()) {
            //Usuário Logado
            global $user_logged;

            //Contato
            $cont_description = strip_tags($_POST['cont_description']);
            $cont_phone = strip_tags($_POST['cont_phone']);
            $cont_cell_phone = strip_tags($_POST['cont_cell_phone']);
            $cont_whatsapp = strip_tags($_POST['cont_whatsapp']);
            $cont_email = strip_tags($_POST['cont_email']);
            $cont_facebook = strip_tags($_POST['cont_facebook']);
            $cont_instagram = strip_tags($_POST['cont_instagram']);
            $cont_text = strip_tags($_POST['cont_text']);
            $cont_status = true;

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
            $contact->cont_fk_user_pk_id = $user_logged->user_pk_id;


            //Endereço
            $ende_logradouro = strip_tags($_POST['ende_logradouro']);
            $ende_numero = strip_tags($_POST['ende_numero']);
            $ende_bairro = strip_tags($_POST['ende_bairro']);
            $ende_cep = strip_tags($_POST['ende_cep']);
            $ende_cidade = strip_tags($_POST['ende_cidade']);
            $ende_fk_estado_pk_id = strip_tags($_POST['ende_fk_estado_pk_id']);
            $ende_fk_user_pk_id = $user_logged->user_pk_id;
            $ende_status = true;

            $endereco = new ModelEndereco();
            $endereco->ende_logradouro = $ende_logradouro;
            $endereco->ende_numero = $ende_numero;
            $endereco->ende_bairro = $ende_bairro;
            $endereco->ende_cep = $ende_cep;
            $endereco->ende_cidade = $ende_cidade;
            $endereco->ende_fk_estado_pk_id = $ende_fk_estado_pk_id;
            $endereco->ende_fk_user_pk_id = $ende_fk_user_pk_id;
            $endereco->ende_status = $ende_status;

            //DAOs
            $daoContact = new DAOContact();
            $daoEndereco = new DAOEndereco();

            //Funcionário
            $func_nome = strip_tags($_POST['func_nome']);
            $func_cpf = strip_tags($_POST['func_cpf']);
            $func_rg = strip_tags($_POST['func_rg']);
            $func_pis = strip_tags($_POST['func_pis']);
            $func_data_nascimento = strip_tags($_POST['func_data_nascimento']);
            try {
                $func_fk_contact_pk_id = $daoContact->saveAndReturnPkId($contact);
            } catch (Exception $erro) {
                $this->info = "error=Contato: " . $erro->getMessage();
            }
            try {
                $func_fk_endereco_pk_id = $daoEndereco->saveAndReturnPkId($endereco);
            } catch (Exception $erro) {
                $this->info = "error=Endereço: " . $erro->getMessage();
            }
            $func_fk_user_pk_id = $user_logged->user_pk_id;
            $func_status = true;

            $funcionario = new ModelFuncionario();
            $funcionario->func_nome = $func_nome;
            $funcionario->func_cpf = $func_cpf;
            $funcionario->func_rg = $func_rg;
            $funcionario->func_pis = $func_pis;
            $funcionario->func_data_nascimento = $func_data_nascimento;
            $funcionario->func_fk_contact_pk_id = $func_fk_contact_pk_id;
            $funcionario->func_fk_endereco_pk_id = $func_fk_endereco_pk_id;
            $funcionario->func_fk_user_pk_id = $func_fk_user_pk_id;
            $funcionario->func_status = $func_status;

            try {
                $this->daoFuncionario->save($funcionario);
                $this->info = "success=funcionario_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    //ok
    public function searchByFkUser($user_pk_id = 0) {
        if (GenericController::authotity()) {
            $funcionario = null;
            try {
                $funcionario = $this->daoFuncionario->selectObjectByFkUser($user_pk_id);
                if (!isset($funcionario)) {
                    $this->info = 'warning=funcionario_not_exists';
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $funcionario;
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $func_pk_id = strip_tags($_POST['func_pk_id']);
                if (!isset($func_pk_id)) {
                    $this->info = 'warning=funcionario_uninformed';
                }
                $func_logradouro = strip_tags($_POST['func_logradouro']);
                $func_numero = strip_tags($_POST['func_numero']);
                $func_bairro = strip_tags($_POST['func_bairro']);
                $func_cep = strip_tags($_POST['func_cep']);
                $func_cidade = strip_tags($_POST['func_cidade']);
                $func_fk_estado_pk_id = strip_tags($_POST['func_fk_estado_pk_id']);
                global $user_logged;
                $func_fk_user_pk_id = $user_logged->user_pk_id;

                $funcionario = new ModelFuncionario();
                $funcionario->func_pk_id = $func_pk_id;
                $funcionario->func_logradouro = $func_logradouro;
                $funcionario->func_numero = $func_numero;
                $funcionario->func_bairro = $func_bairro;
                $funcionario->func_cep = $func_cep;
                $funcionario->func_cidade = $func_cidade;
                $funcionario->func_fk_estado_pk_id = $func_fk_estado_pk_id;
                $funcionario->func_fk_user_pk_id = $func_fk_user_pk_id;

                try {
                    $this->daoFuncionario->update($funcionario);
                    if ($funcionario == null) {
                        $this->info = 'warning=funcionario_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=funcionario_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

}
