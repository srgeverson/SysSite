<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/controller/ControllerSystem.php");
include_once server_path("br/com/system/dao/DAOFuncionarioUser.php");
include_once server_path("br/com/system/dao/DAOUser.php");
include_once server_path("br/com/system/model/ModelFuncionarioUser.php");

class ControllerFuncionarioUser {

    private $info;
    private $daoFuncionarioUser;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoFuncionarioUser = new DAOFuncionarioUser();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (GenericController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (!isset($fuus_pk_id)) {
                $this->info = 'warning=authority_uninformed';
            }
            try {
                $daoUser = new DAOUser();
                if (empty($daoUser->selectCountObjectsByFKAuthority($fuus_pk_id))) {
                    if (!$this->daoFuncionarioUser->delete($fuus_pk_id)) {
                        $this->info = 'warning=authority_not_exists';
                        $this->listar();
                    }
                    $this->info = "success=authority_deleted";
                } else {
                    $this->info = "warning=authority_in_use";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function deleteFuncionarioUserByFuncionario($func_pk_id = 0) {
        if (GenericController::authotity()) {
            try {
                $this->daoFuncionarioUser->deleteByFuncionario($func_pk_id);
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (isset($fuus_pk_id)) {
                $fuus_status = false;
                try {
                    if (($this->daoFuncionarioUser->selectObjectById($fuus_pk_id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelFuncionarioUser();
                        $authority->fuus_pk_id = $fuus_pk_id;
                        $authority->fuus_status = $fuus_status;

                        $this->daoFuncionarioUser->updateStatus($authority);
                        $this->info = 'success=authority_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=authority_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $fuus_pk_id = $_GET['fuus_pk_id'];
            if (!isset($fuus_pk_id)) {
                $this->info = 'warning=authority_uninformed';
                $this->listar();
            }
            try {
                $authority = $this->daoFuncionarioUser->selectObjectById($fuus_pk_id);
                if (!isset($authority)) {
                    $this->info = 'warning=authority_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($authority == false) {
                $this->info = "warning=authority_not_found";
            }
            include_once server_path('br/com/system/view/authority/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (isset($fuus_pk_id)) {
                $fuus_status = true;
                try {
                    if (($this->daoFuncionarioUser->selectObjectById($fuus_pk_id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelFuncionarioUser();
                        $authority->fuus_pk_id = $fuus_pk_id;
                        $authority->fuus_status = $fuus_status;

                        $this->daoFuncionarioUser->updateStatus($authority);
                        $this->info = 'success=authority_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=authority_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (GenericController::authotity()) {
            if (isset($_POST['fuus_description'])) {
                $authority = new ModelFuncionarioUser();
                $authority->fuus_description = strip_tags($_POST['fuus_description']);
                try {
                    $authorities = $this->daoFuncionarioUser->selectObjectsByContainsObject($authority);
                    $permissao = $this->usuarioAutencitado->user_fk_authority_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/authority/list.php');
        }
    }

    public function novo() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/authority/new.php');
        }
    }

    public function saveFuncionarioUser(ModelFuncionarioUser $funcionarioUser) {
        if (GenericController::authotity()) {
            global $user_logged;
            $controlerSystem = new ControllerSystem();
            try {
                $this->daoFuncionarioUser->save($funcionarioUser);
                $this->info = "success=funcionario_user_created";
                if ($user_logged->user_fk_authority_pk_id == 3) {
                    $controlerSystem->welcome($this->info);
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
                if ($user_logged->user_fk_authority_pk_id == 3) {
                    $controlerSystem->welcome($this->info);
                }
            }
        }
    }

    public function searchByFkFucionario($func_pk_id = 0) {
        if (GenericController::authotity()) {
            $funcionarioUser = null;
            try {
                $funcionarioUser = $this->daoFuncionarioUser->selectObjectByFkFuncionario($func_pk_id);
                if (!isset($funcionarioUser)) {
                    $this->info = 'warning=funcionario_not_exists';
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $funcionarioUser;
        }
    }

    public function searchByFkUser($user_pk_id = 0) {
        if (GenericController::authotity()) {
            $funcionarioUser = null;
            try {
                $funcionarioUser = $this->daoFuncionarioUser->selectObjectByFkUser($user_pk_id);
                if (!isset($funcionarioUser)) {
                    $this->info = 'warning=funcionario_not_exists';
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $funcionarioUser;
        }
    }

    public function updateFuncionarioUser($funcionarioUser) {
        if (GenericController::authotity()) {
            try {
                $this->daoFuncionarioUser->update($funcionarioUser);
                $this->info = "success=funcionario_updated";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $controlerSystem = new ControllerSystem();
            global $user_logged;
            if ($user_logged->user_fk_authority_pk_id == 3) {
                $controlerSystem->welcome($this->info);
            }
        }
    }

}
