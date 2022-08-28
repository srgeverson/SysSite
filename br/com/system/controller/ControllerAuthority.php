<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOAuthority.php");
include_once server_path("br/com/system/dao/DAOUser.php");
include_once server_path("br/com/system/model/ModelAuthority.php");

class ControllerAuthority {

    private $info;
    private $daoAuthority;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoAuthority = new DAOAuthority();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (GenericController::authotity()) {
            $auth_pk_id = strip_tags($_GET['auth_pk_id']);
            if (!isset($auth_pk_id)) {
                $this->info = 'warning=authority_uninformed';
            }
            try {
                $daoUser = new DAOUser();
                if (empty($daoUser->selectCountObjectsByFKAuthority($auth_pk_id))) {
                    if (!$this->daoAuthority->delete($auth_pk_id)) {
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

    public function disable() {
        if (GenericController::authotity()) {
            $auth_pk_id = strip_tags($_GET['auth_pk_id']);
            if (isset($auth_pk_id)) {
                $auth_status = false;
                try {
                    if (($this->daoAuthority->selectObjectById($auth_pk_id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelAuthority();
                        $authority->auth_pk_id = $auth_pk_id;
                        $authority->auth_status = $auth_status;

                        $this->daoAuthority->updateStatus($authority);
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
            $auth_pk_id = $_GET['auth_pk_id'];
            if (!isset($auth_pk_id)) {
                $this->info = 'warning=authority_uninformed';
                $this->listar();
            }
            try {
                $authority = $this->daoAuthority->selectObjectById($auth_pk_id);
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
            $auth_pk_id = strip_tags($_GET['auth_pk_id']);
            if (isset($auth_pk_id)) {
                $auth_status = true;
                try {
                    if (($this->daoAuthority->selectObjectById($auth_pk_id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelAuthority();
                        $authority->auth_pk_id = $auth_pk_id;
                        $authority->auth_status = $auth_status;

                        $this->daoAuthority->updateStatus($authority);
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
            if (isset($_POST['auth_description'])) {
                $authority = new ModelAuthority();
                $authority->auth_description = strip_tags($_POST['auth_description']);
                try {
                    $authorities = $this->daoAuthority->selectObjectsByContainsObject($authority);
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

    public function save() {
        if (GenericController::authotity()) {
            $auth_description = strip_tags($_POST['auth_description']);
            $auth_screen = strip_tags($_POST['auth_screen']);
            $auth_function = strip_tags($_POST['auth_function']);
            $auth_status = false;
            $authority = new ModelAuthority();
            $authority->auth_description = $auth_description;
            $authority->auth_status = $auth_status;
            $authority->auth_screen = $auth_screen;
            $authority->auth_function = $auth_function;
            try {
                $daoAuthority = new DAOAuthority();
                $daoAuthority->save($authority);
                $this->info = "success=authority_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $auth_pk_id = strip_tags($_POST['auth_pk_id']);
                if (!isset($auth_pk_id)) {
                    $this->info = 'warning=authority_uninformed';
                }
                $auth_description = strip_tags($_POST['auth_description']);
                $auth_screen = strip_tags($_POST['auth_screen']);
                $auth_function = strip_tags($_POST['auth_function']);

                $authority = new ModelAuthority();
                $authority->auth_pk_id = $auth_pk_id;
                $authority->auth_description = $auth_description;
                $authority->auth_screen = $auth_screen;
                $authority->auth_function = $auth_function;

                try {
                    $this->daoAuthority->update($authority);
                    if ($authority == null) {
                        $this->info = 'warning=authority_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=authority_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
