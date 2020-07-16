<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOFuncionario.php");
include_once server_path("br/com/system/model/ModelFuncionario.php");

class ControllerFuncionario {

    private $info;
    private $daoFuncionario;

    function __construct() {
        $this->info = 'default=default';
        $this->daoFuncionario = new DAOFuncionario();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $func_pk_id = strip_tags($_GET['func_pk_id']);
            if (!isset($func_pk_id)) {
                $this->info = 'warning=funcionario_uninformed';
            }
            try {
                $this->daoFuncionario->delete($func_pk_id);
                $this->info = "success=funcionario_deleted";
                $this->list();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

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

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['func_logradouro']) && isset($_POST['func_cidade'])) {
                $funcionario = new ModelFuncionario();
                $funcionario->func_logradouro = strip_tags($_POST['func_logradouro']);
                $funcionario->func_cidade = strip_tags($_POST['func_cidade']);
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

    public function new() {
        if (GenericController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            include_once server_path('br/com/system/view/funcionario/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $func_logradouro = strip_tags($_POST['func_logradouro']);
            $func_numero = strip_tags($_POST['func_numero']);
            $func_bairro = strip_tags($_POST['func_bairro']);
            $func_cep = strip_tags($_POST['func_cep']);
            $func_cidade = strip_tags($_POST['func_cidade']);
            $func_fk_estado_pk_id = strip_tags($_POST['func_fk_estado_pk_id']);
            global $user_logged;
            $func_fk_user_pk_id = $user_logged->user_pk_id;
            $func_status = true;

            $funcionario = new ModelFuncionario();
            $funcionario->func_logradouro = $func_logradouro;
            $funcionario->func_numero = $func_numero;
            $funcionario->func_bairro = $func_bairro;
            $funcionario->func_cep = $func_cep;
            $funcionario->func_cidade = $func_cidade;
            $funcionario->func_fk_estado_pk_id = $func_fk_estado_pk_id;
            $funcionario->func_fk_user_pk_id = $func_fk_user_pk_id;
            $funcionario->func_status = $func_status;
            try {
                $daoFuncionario = new DAOFuncionario();
                $daoFuncionario->save($funcionario);
                $this->info = "success=funcionario_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

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
