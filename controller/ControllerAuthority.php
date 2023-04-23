<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOAuthority.php");
include_once server_path("dao/DAOGrupoPermissao.php");
include_once server_path("dao/DAOMenuItem.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("model/ModelAuthority.php");

class ControllerAuthority {

    private $info;
    private $daoAuthority;
    private $daoGrupoPermissao;
    private $daoMenuItem;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoAuthority = new DAOAuthority();
        $this->daoGrupoPermissao = new DAOGrupoPermissao();
        $this->daoMenuItem = new DAOMenuItem();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=authority_uninformed';
            }
            try {
                $existente = $this->daoGrupoPermissao->selectObjectsByContainsFkPermissao($id);
                if (empty($existente)) {
                    if (!$this->daoAuthority->delete($id)) {
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
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    if (($this->daoAuthority->selectObjectById($id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelAuthority();
                        $authority->id = $id;
                        $authority->status = $status;

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
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=authority_uninformed';
                $this->listar();
            }
            try {
                $menuItens = $this->daoMenuItem->selectObjectsEnabled();
                $authority = $this->daoAuthority->selectObjectById($id);
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
            include_once server_path('view/authority/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoAuthority->selectObjectById($id)) === null) {
                        $this->info = 'warning=authority_not_exists';
                    } else {
                        $authority = new ModelAuthority();
                        $authority->id = $id;
                        $authority->status = $status;
                        $authority->usuario_id = $this->usuarioAutencitado->id;
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
        if (HelperController::authotity()) {
            $authority = new ModelAuthority();
            $authority->descricao = strip_tags($_POST['descricao']);
            $authority->todos = strip_tags($_POST['todos']);
            if ($authority->descricao != null || $authority->todos) {
                try {
                    $authorities = $this->daoAuthority->selectObjectsByContainsObject($authority);
                    //$permissao = $this->usuarioAutencitado->user_fk_authority_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/authority/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $menuItens = $this->daoMenuItem->selectObjectsEnabled();
            include_once server_path('view/authority/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $authority = new ModelAuthority();
            $authority->descricao = strip_tags($_POST['descricao']);
            $authority->nome = strip_tags($_POST['nome']);
            $authority->status = true;
            $authority->menu_item_id = strip_tags($_POST['menu_item_id']);
            $authority->usuario_id = $this->usuarioAutencitado->id;
            $existente = $this->daoAuthority->selectObjectsByNameUnique($authority->nome);
            if (empty($existente)) {
                try {
                    $daoAuthority = new DAOAuthority();
                    $daoAuthority->save($authority);
                    $this->info = "success=authority_created";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            } else {
                $this->info = "warning=authority_already_registered";
                HelperController::valid_messages($this->info);
                $this->novo();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $authority = new ModelAuthority();
                $authority->id = strip_tags($_POST['id']);;
                $authority->nome =strip_tags($_POST['nome']);
                $authority->descricao =strip_tags($_POST['descricao']);
                $authority->menu_item_id = strip_tags($_POST['menu_item_id']);
                $authority->usuario_id = $this->usuarioAutencitado->id;
                if (!$authority->id) {
                    $this->info = 'warning=authority_uninformed';
                }

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
