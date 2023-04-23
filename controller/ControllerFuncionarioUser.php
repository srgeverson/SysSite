<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("controller/ControllerSystem.php");
include_once server_path("dao/DAOFuncionarioUser.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("model/ModelFuncionarioUser.php");

class ControllerFuncionarioUser {

    private $info;
    private $daoFuncionarioUser;
    private $daoUser;
    private $usuarioAutencitado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoFuncionarioUser = new DAOFuncionarioUser();
        $this->daoUser = new DAOUser();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (!isset($fuus_pk_id)) {
                $this->info = 'warning=permissao_uninformed';
            }
            try {
                // $daoUser = new DAOUser();
                // if (empty($daoUser->selectCountObjectsByFKAuthority($fuus_pk_id))) {
                //     if (!$this->daoFuncionarioUser->delete($fuus_pk_id)) {
                //         $this->info = 'warning=permissao_not_exists';
                //         $this->listar();
                //     }
                //     $this->info = "success=permissao_deleted";
                // } else {
                //     $this->info = "warning=permissao_in_use";
                // }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            //$this->listar();
        }
    }

    public function deleteFuncionarioUserByFuncionario($id = 0) {
        if (HelperController::authotity()) {
            try {
                $this->daoFuncionarioUser->deleteByFuncionario($id);
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (isset($fuus_pk_id)) {
                $fuus_status = false;
                try {
                    if (($this->daoFuncionarioUser->selectObjectById($fuus_pk_id)) === null) {
                        $this->info = 'warning=permissao_not_exists';
                    } else {
                        $permissao = new ModelFuncionarioUser();
                        $permissao->fuus_pk_id = $fuus_pk_id;
                        $permissao->fuus_status = $fuus_status;

                        $this->daoFuncionarioUser->updateStatus($permissao);
                        $this->info = 'success=permissao_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=permissao_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $fuus_pk_id = $_GET['fuus_pk_id'];
            if (!isset($fuus_pk_id)) {
                $this->info = 'warning=permissao_uninformed';
                $this->listar();
            }
            try {
                $permissao = $this->daoFuncionarioUser->selectObjectById($fuus_pk_id);
                if (!isset($permissao)) {
                    $this->info = 'warning=permissao_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($permissao == false) {
                $this->info = "warning=permissao_not_found";
            }
            include_once server_path('view/permissao/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $fuus_pk_id = strip_tags($_GET['fuus_pk_id']);
            if (isset($fuus_pk_id)) {
                $fuus_status = true;
                try {
                    if (($this->daoFuncionarioUser->selectObjectById($fuus_pk_id)) === null) {
                        $this->info = 'warning=permissao_not_exists';
                    } else {
                        $permissao = new ModelFuncionarioUser();
                        $permissao->fuus_pk_id = $fuus_pk_id;
                        $permissao->fuus_status = $fuus_status;

                        $this->daoFuncionarioUser->updateStatus($permissao);
                        $this->info = 'success=permissao_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=permissao_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['fuus_description'])) {
                $permissao = new ModelFuncionarioUser();
                $permissao->fuus_description = strip_tags($_POST['fuus_description']);
                try {
                    $authorities = $this->daoFuncionarioUser->selectObjectsByContainsObject($permissao);
                    $permissao = $this->usuarioAutencitado->user_fk_permissao_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/permissao/list.php');
        }
    }

    public function saveFuncionarioUser(ModelFuncionarioUser $funcionarioUser) {
        if (HelperController::authotity()) {
            global $user_logged;
            $controlerSystem = new ControllerSystem();
            try {
                $this->daoFuncionarioUser->save($funcionarioUser);
                $this->info = "success=funcionario_user_created";
                if ($user_logged->user_fk_permissao_pk_id == 3) {
                    $controlerSystem->welcome($this->info);
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
                if ($user_logged->user_fk_permissao_pk_id == 3) {
                    $controlerSystem->welcome($this->info);
                }
            }
        }
    }

    public function searchByFkFucionario($id = 0) {
        if (HelperController::authotity()) {
            $funcionarioUser = null;
            try {
                $funcionarioUser = $this->daoFuncionarioUser->selectObjectByFkFuncionario($id);
                if (!isset($funcionarioUser)) {
                    $this->info = 'warning=funcionario_not_exists';
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $funcionarioUser;
        }
    }

    public function searchByFkUser($id = 0) {
        if (HelperController::authotity()) {
            $funcionarioUser = null;
            try {
                $funcionarioUser = $this->daoFuncionarioUser->selectObjectByFkUser($id);
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
        if (HelperController::authotity()) {
            try {
                $this->daoFuncionarioUser->update($funcionarioUser);
                $this->info = "success=funcionario_updated";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $controlerSystem = new ControllerSystem();
            global $user_logged;
            if ($user_logged->user_fk_permissao_pk_id == 3) {
                $controlerSystem->welcome($this->info);
            }
        }
    }

}
