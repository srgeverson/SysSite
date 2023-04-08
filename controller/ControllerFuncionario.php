<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("controller/ControllerFuncionarioUser.php");
include_once server_path("controller/ControllerUser.php");
include_once server_path("controller/ControllerSystem.php");
include_once server_path("dao/DAOEstado.php");
include_once server_path("dao/DAOFuncionario.php");
include_once server_path("model/ModelContact.php");
include_once server_path("model/ModelEndereco.php");
include_once server_path("model/ModelFuncionario.php");
include_once server_path("model/ModelFuncionarioUser.php");

class ControllerFuncionario {

    private $info;
    private $daoFuncionario;
    private $usuarioAutenticado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoFuncionario = new DAOFuncionario();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $func_pk_id = strip_tags($_GET['func_pk_id']);
            $funcionario = null;
            if (!isset($func_pk_id)) {
                $this->info = 'warning=funcionario_uninformed';
                $this->listar();
            } else {
                //DAOs
                $daoContact = new DAOContact();
                $daoEndereco = new DAOEndereco();

                $funcionario = $this->daoFuncionario->selectObjectById($func_pk_id);

                try {
                $controlleFuncionarioUser = new ControllerFuncionarioUser();
                    $controlleFuncionarioUser->deleteFuncionarioUserByFuncionario($funcionario->func_pk_id);
                    try {
                        $this->daoFuncionario->delete($funcionario->func_pk_id);
                        $this->info = "success=funcionario_deleted";
                        try {
                            $daoContact->delete($funcionario->func_fk_contact_pk_id);
                            try {
                                $daoEndereco->delete($funcionario->func_fk_endereco_pk_id);
                                $this->listar();
                            } catch (Exception $exc) {
                                $this->info = "error=Endereço: " . $erro->getMessage();
                                $this->listar();
                            }
                        } catch (Exception $erro) {
                            $this->info = "error=Contato: " . $erro->getMessage();
                            $this->listar();
                        }
                    } catch (Exception $erro) {
                        $this->info = "error=Funcionário: " . $erro->getMessage();
                        $this->listar();
                    }
                } catch (Exception $erro) {
                    $this->info = "error=Funcionário Usuário: " . $erro->getMessage();
                    $this->listar();
                }
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $func_pk_id = $_GET['func_pk_id'];
            if (!isset($func_pk_id)) {
                $this->info = 'warning=funcionario_uninformed';
                $this->listar();
            }
            try {
                $daoEstado = new DAOEstado();
                $estados = $daoEstado->selectObjectsEnabled();
                $funcionario = $this->daoFuncionario->selectObjectById($func_pk_id);
                $estadoUFAtual = $daoEstado->selectObjectById($funcionario->estado_id);
                $controllerUser = new ControllerUser();
                $users = $controllerUser->selectObjectsNotInFuncionarioUser();
                if (!isset($funcionario)) {
                    $this->info = 'warning=funcionario_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($funcionario == false) {
                $this->info = "warning=funcionario_not_found";
            }
            include_once server_path('view/funcionario/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['func_nome']) && isset($_POST['func_cpf']) && isset($_POST['func_rg'])) {
                $funcionario = new ModelFuncionario();
                $funcionario->func_nome = strip_tags($_POST['func_nome']);
                $funcionario->func_cpf = strip_tags($_POST['func_cpf']);
                $funcionario->func_rg = strip_tags($_POST['func_rg']);
                try {
                    $funcionarios = $this->daoFuncionario->selectObjectsByContainsObject($funcionario);
                    $permissao = $this->usuarioAutenticado->user_fk_authority_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/funcionario/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            $controllerUser = new ControllerUser();
            $users = $controllerUser->selectObjectsNotInFuncionarioUser();
            include_once server_path('view/funcionario/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $user_fk_authority_pk_id = strip_tags($_GET['user_fk_authority_pk_id']);

            global $user_logged;

            $id = null;
            if (isset($_POST['id'])) {
                $id = strip_tags($_POST['id']);
            } else {
                $id = $user_logged->id;
            }

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
            $contact->cont_fk_id = $user_logged->id;


            //Endereço
            $logradouro = strip_tags($_POST['logradouro']);
            $numero = strip_tags($_POST['numero']);
            $bairro = strip_tags($_POST['bairro']);
            $cep = strip_tags($_POST['cep']);
            $cidade_id = strip_tags($_POST['cidade_id']);
            $estado_id = strip_tags($_POST['estado_id']);
            $usuario_id = $user_logged->id;
            $status = true;

            $endereco = new ModelEndereco();
            $endereco->logradouro = $logradouro;
            $endereco->numero = $numero;
            $endereco->bairro = $bairro;
            $endereco->cep = $cep;
            $endereco->cidade_id = $cidade_id;
            $endereco->estado_id = $estado_id;
            $endereco->usuario_id = $usuario_id;
            $endereco->status = $status;

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
            $func_fk_id = $user_logged->id;
            $func_status = true;

            $funcionario = new ModelFuncionario();
            $funcionario->func_nome = $func_nome;
            $funcionario->func_cpf = $func_cpf;
            $funcionario->func_rg = $func_rg;
            $funcionario->func_pis = $func_pis;
            $funcionario->func_data_nascimento = $func_data_nascimento;
            $funcionario->func_fk_contact_pk_id = $func_fk_contact_pk_id;
            $funcionario->func_fk_endereco_pk_id = $func_fk_endereco_pk_id;
            $funcionario->func_fk_id = $func_fk_id;
            $funcionario->func_status = $func_status;

            try {
                $func_pk_id = $this->daoFuncionario->saveAndReturnPkId($funcionario);

                $funcionarioUser = new ModelFuncionarioUser();
                $funcionarioUser->fuus_fk_funcionario_pk_id = $func_pk_id;
                $funcionarioUser->fuus_fk_id = $id;
                $funcionarioUser->fuus_status = true;

                $controllerFunconarioUser = new ControllerFuncionarioUser();
                $controllerFunconarioUser->saveFuncionarioUser($funcionarioUser);

                if ($user_fk_authority_pk_id == 0) {
                    $this->info = "success=funcionario_created";
                    $this->listar();
                }
            } catch (Exception $erro) {
                if ($user_fk_authority_pk_id == 0) {
                    $this->info = "error=" . $erro->getMessage();
                    $this->listar();
                }
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $func_pk_id = strip_tags($_POST['func_pk_id']);
                if (!isset($func_pk_id)) {
                    $this->info = 'warning=funcionario_uninformed';
                } else {
                    $user_fk_authority_pk_id = strip_tags($_GET['user_fk_authority_pk_id']);

                    global $user_logged;

                    //Contato
                    $cont_pk_id = strip_tags($_POST['func_fk_contact_pk_id']);
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
                    $contact->cont_pk_id = $cont_pk_id;
                    $contact->cont_description = $cont_description;
                    $contact->cont_phone = $cont_phone;
                    $contact->cont_cell_phone = $cont_cell_phone;
                    $contact->cont_whatsapp = $cont_whatsapp;
                    $contact->cont_email = $cont_email;
                    $contact->cont_facebook = $cont_facebook;
                    $contact->cont_instagram = $cont_instagram;
                    $contact->cont_text = $cont_text;
                    $contact->cont_status = $cont_status;
                    $contact->cont_fk_id = $user_logged->id;


                    //Endereço
                    $id = strip_tags($_POST['func_fk_endereco_pk_id']);
                    $logradouro = strip_tags($_POST['logradouro']);
                    $numero = strip_tags($_POST['numero']);
                    $bairro = strip_tags($_POST['bairro']);
                    $cep = strip_tags($_POST['cep']);
                    $cidade_id = strip_tags($_POST['cidade_id']);
                    $estado_id = strip_tags($_POST['estado_id']);
                    $usuario_id = $user_logged->id;
                    $status = true;

                    $endereco = new ModelEndereco();
                    $endereco->id = $id;
                    $endereco->logradouro = $logradouro;
                    $endereco->numero = $numero;
                    $endereco->bairro = $bairro;
                    $endereco->cep = $cep;
                    $endereco->cidade_id = $cidade_id;
                    $endereco->estado_id = $estado_id;
                    $endereco->usuario_id = $usuario_id;
                    $endereco->status = $status;

                    //DAOs
                    $daoContact = new DAOContact();
                    $daoEndereco = new DAOEndereco();

                    //Funcionário
                    $func_pk_id = strip_tags($_POST['func_pk_id']);
                    $func_nome = strip_tags($_POST['func_nome']);
                    $func_cpf = strip_tags($_POST['func_cpf']);
                    $func_rg = strip_tags($_POST['func_rg']);
                    $func_pis = strip_tags($_POST['func_pis']);
                    $func_data_nascimento = strip_tags($_POST['func_data_nascimento']);
                    $func_fk_id = $user_logged->id;
                    $func_status = true;

                    $funcionario = new ModelFuncionario();
                    $funcionario->func_pk_id = $func_pk_id;
                    $funcionario->func_nome = $func_nome;
                    $funcionario->func_cpf = $func_cpf;
                    $funcionario->func_rg = $func_rg;
                    $funcionario->func_pis = $func_pis;
                    $funcionario->func_data_nascimento = $func_data_nascimento;
                    $funcionario->func_fk_id = $func_fk_id;
                    $funcionario->func_status = $func_status;

                    //Funcionário Usuário
                    $id = null;
                    if (isset($_POST['id'])) {
                        $id = strip_tags($_POST['id']);
                    } else {
                        $id = $user_logged->id;
                    }

                    $controllerFunconarioUser = new ControllerFuncionarioUser();
                    $objetoFuncionarioUser = $controllerFunconarioUser->searchByFkFucionario($func_pk_id);
                    $funcionarioUser = new ModelFuncionarioUser();
                    $funcionarioUser->fuus_pk_id = $objetoFuncionarioUser->fuus_pk_id;
                    $funcionarioUser->fuus_fk_id = $id;
                    $funcionarioUser->fuus_fk_funcionario_pk_id = $func_pk_id;

                    //Tratando exceção do contato
                    try {
                        $daoContact->update($contact);
                        //Tratando exceção do endereço
                        try {
                            $daoEndereco->update($endereco);
                            //Tratando exceção do funcionário
                            try {
                                $this->daoFuncionario->update($funcionario);
                                $controllerFunconarioUser->updateFuncionarioUser($funcionarioUser);
                                if ($user_fk_authority_pk_id == 0) {
                                    $this->info = "success=funcionario_updated";
                                    $this->listar();
                                }
                            } catch (Exception $erro) {
                                if ($user_fk_authority_pk_id == 0) {
                                    $this->info = "error=" . $erro->getMessage();
                                    $this->listar();
                                } else {
                                    $this->info = "error=" . $erro->getMessage();
                                    $controlerSystem = new ControllerSystem();
                                    $controlerSystem->welcome($this->info);
                                }
                            }
                        } catch (Exception $erro) {
                            if ($user_fk_authority_pk_id == 0) {
                                $this->info = "error=Endereço: " . $erro->getMessage();
                                $this->listar();
                            } else {
                                $this->info = "error=" . $erro->getMessage();
                                $controlerSystem = new ControllerSystem();
                                $controlerSystem->welcome($this->info);
                            }
                        }
                    } catch (Exception $erro) {
                        if ($user_fk_authority_pk_id == 0) {
                            $this->info = "error=Contato: " . $erro->getMessage();
                            $this->listar();
                        } else {
                            $this->info = "error=" . $erro->getMessage();
                            $controlerSystem = new ControllerSystem();
                            $controlerSystem->welcome($this->info);
                        }
                    }
                }
            }
        }
    }

}
