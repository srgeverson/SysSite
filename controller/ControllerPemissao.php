<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOPermissao.php");
include_once server_path("dao/DAOGrupoPermissao.php");
include_once server_path("dao/DAOMenuItem.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("model/ModelPermissao.php");

class ControllerPemissao {

    private $info;
    private $daoPermissao;
    private $daoGrupoPermissao;
    private $daoMenuItem;
    private $usuarioAutencitado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoPermissao = new DAOPermissao();
        $this->daoGrupoPermissao = new DAOGrupoPermissao();
        $this->daoMenuItem = new DAOMenuItem();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=permissao_uninformed';
            }
            try {
                $existente = $this->daoGrupoPermissao->selectObjectsByContainsFkPermissao($id);
                if (empty($existente)) {
                    if (!$this->daoPermissao->delete($id)) {
                        $this->info = 'warning=permissao_not_exists';
                        $this->listar();
                    }
                    $this->info = "success=permissao_deleted";
                } else {
                    $this->info = "warning=permissao_in_use";
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
                    if (($this->daoPermissao->selectObjectById($id)) === null) {
                        $this->info = 'warning=permissao_not_exists';
                    } else {
                        $permissao = new ModelPermissao();
                        $permissao->id = $id;
                        $permissao->status = $status;

                        $this->daoPermissao->updateStatus($permissao);
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
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=permissao_uninformed';
                $this->listar();
            }
            try {
                $menuItens = $this->daoMenuItem->selectObjectsEnabled();
                $permissao = $this->daoPermissao->selectObjectById($id);
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
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoPermissao->selectObjectById($id)) === null) {
                        $this->info = 'warning=permissao_not_exists';
                    } else {
                        $permissao = new ModelPermissao();
                        $permissao->id = $id;
                        $permissao->status = $status;
                        $permissao->usuario_id = $this->usuarioAutencitado->id;
                        $this->daoPermissao->updateStatus($permissao);
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
            $permissao = new ModelPermissao();
            $permissao->descricao = strip_tags($_POST['descricao']);
            $permissao->todos = strip_tags($_POST['todos']);
            if ($permissao->descricao != null || $permissao->todos) {
                try {
                    $authorities = $this->daoPermissao->selectObjectsByContainsObject($permissao);
                    //$permissao = $this->usuarioAutencitado->user_fk_permissao_pk_id;
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

    public function novo() {
        if (HelperController::authotity()) {
            $menuItens = $this->daoMenuItem->selectObjectsEnabled();
            include_once server_path('view/permissao/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $permissao = new ModelPermissao();
            $permissao->descricao = strip_tags($_POST['descricao']);
            $permissao->nome = strip_tags($_POST['nome']);
            $permissao->status = true;
            $permissao->menu_item_id = strip_tags($_POST['menu_item_id']);
            $permissao->usuario_id = $this->usuarioAutencitado->id;
            $existente = $this->daoPermissao->selectObjectsByNameUnique($permissao->nome);
            if (empty($existente)) {
                try {
                    $daoPermissao = new DAOPermissao();
                    $daoPermissao->save($permissao);
                    $this->info = "success=permissao_created";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            } else {
                $this->info = "warning=permissao_already_registered";
                HelperController::valid_messages($this->info);
                $this->novo();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $permissao = new ModelPermissao();
                $permissao->id = strip_tags($_POST['id']);;
                $permissao->nome =strip_tags($_POST['nome']);
                $permissao->descricao =strip_tags($_POST['descricao']);
                $permissao->menu_item_id = strip_tags($_POST['menu_item_id']);
                $permissao->usuario_id = $this->usuarioAutencitado->id;
                if (!$permissao->id) {
                    $this->info = 'warning=permissao_uninformed';
                }

                try {
                    $this->daoPermissao->update($permissao);
                    if ($permissao == null) {
                        $this->info = 'warning=permissao_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=permissao_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
