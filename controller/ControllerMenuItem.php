<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// include_once server_path("model/ModelContent.php");
include_once server_path("dao/DAOMenu.php");
include_once server_path("dao/DAOMenuItem.php");
include_once server_path("model/ModelMenuItem.php");
// include_once server_path("dao/DAOContact.php");
// include_once server_path("dao/DAOContent.php");
// include_once server_path("dao/DAOEndereco.php");

class ControllerMenuItem {

    private $info;
    private $daoMenu;
    private $daoMenuItem;
    private $usuarioAutenticado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoMenu = new DAOMenu();
        $this->daoMenuItem = new DAOMenuItem();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=menuItem_uninformed';
            }
            try {
                $this->daoMenuItem->delete($id);
                $this->info = "success=menuItem_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $menuItem = new ModelMenuItem();
            $menuItem->id = strip_tags($_GET['id']);
            $menuItem->status = false;
            $menuItem->usuario_id = $this->usuarioAutenticado->id;
            if ($menuItem->id) {
                try {
                    $existente = $this->daoMenuItem->selectObjectById($menuItem->id);
                    if ($existente === null) {
                        $this->info = 'warning=menuItem_not_exists';
                    } else {
                        $this->daoMenuItem->updateStatus($menuItem);
                        $this->info = 'success=menuItem_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=menuItem_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=menuItem_uninformed';
                $this->listar();
            }
            try {
                $menus = $this->daoMenu->selectObjectsEnabled();
                $submenus = $this->daoMenuItem->selectObjectsEnabled();
                $menuItem = $this->daoMenuItem->selectObjectById($id);
                if ($menuItem == false) {
                    $this->info = "warning=menuItem_not_found";
                }
                if (!isset($menuItem)) {
                    $this->info = 'warning=menuItem_not_exists';
                    $this->listar();
                } else {
                    include_once server_path('view/menu_item/edit.php');
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $menuItem = new ModelMenuItem();
            $menuItem->id = strip_tags($_GET['id']);
            $menuItem->status = true;
            $menuItem->usuario_id = $this->usuarioAutenticado->id;
            if ($menuItem->id) {
                try {
                    $existente = $this->daoMenuItem->selectObjectById($menuItem->id);
                    if ($existente === null) {
                        $this->info = 'warning=menuItem_not_exists';
                    } else {
                        $this->daoMenuItem->updateStatus($menuItem);
                        $this->info = 'success=menuItem_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=menuItem_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $menuItem = new ModelMenuItem();
            $menuItem->nome = strip_tags($_POST['nome']);
            $menuItem->descricao = strip_tags($_POST['descricao']);
            $menuItem->menu_id = strip_tags($_POST['menu_id']);
            $menuItem->todos = strip_tags($_POST['todos']);
            $menus = $this->daoMenu->selectObjectsEnabled();
            if ($menuItem->nome || $menuItem->descricao || $menuItem->menu_id || $menuItem->todos) {
                try {
                    $menuItens = $this->daoMenuItem->selectObjectsByContainsObject($menuItem);
                } catch (Exception $erro) {
                    print_r($erro);
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/menu_item/list.php');
        }
    }

    public function listEnableds() {
        try {
            return $this->daoMenuItem->selectObjectsEnabled();
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
        if (isset($this->info)) {
            HelperController::valid_messages($this->info);
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $menus = $this->daoMenu->selectObjectsEnabled();
            $submenus = $this->daoMenuItem->selectObjectsEnabled();
            include_once server_path('view/menu_item/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $menuItem = new ModelMenuItem();
            $menuItem->nome = strip_tags($_POST['nome']);
            $menuItem->descricao = strip_tags($_POST['descricao']);
            $menuItem->titulo = strip_tags($_POST['titulo']);
            $menuItem->icone = strip_tags($_POST['icone']);
            $menuItem->image = strip_tags($_POST['image']);
            $menuItem->url = strip_tags($_POST['url']);
            $menuItem->class = strip_tags($_POST['class']);
            $menuItem->menu_item_id = strip_tags($_POST['menu_item_id']);
            $menuItem->menu_id = strip_tags($_POST['menu_id']);
            $menuItem->status = false;
            $menuItem->usuario_id = $this->usuarioAutenticado->id;

            try {
                if (!isset($this->daoMenuItem->selectObjectByObject($menuItem)->nome)) {
                    $this->daoMenuItem->save($menuItem);
                    $this->info = "success=menuItem_created";
                } else {
                    $this->info = "warning=menuItem_already_registered";
                }
            } catch (Exception $erro) {
                print_r($erro);
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $menuItem = new ModelMenuItem();
                $menuItem->id = strip_tags($_POST['id']);
                $menuItem->nome = strip_tags($_POST['nome']);
                $menuItem->descricao = strip_tags($_POST['descricao']);
                $menuItem->titulo = strip_tags($_POST['titulo']);
                $menuItem->icone = strip_tags($_POST['icone']);
                $menuItem->image = strip_tags($_POST['image']);
                $menuItem->url = strip_tags($_POST['url']);
                $menuItem->class = strip_tags($_POST['class']);
                $menuItem->menu_item_id = strip_tags($_POST['menu_item_id']);
                $menuItem->menu_id = strip_tags($_POST['menu_id']);
                $menuItem->status = false;
                $menuItem->usuario_id = $this->usuarioAutenticado->id;
                if (!isset($menuItem->id)) {
                    $this->info = 'warning=menuItem_uninformed';
                }
          
                try {
                    $this->daoMenuItem->update($menuItem);
                    if ($menuItem == null) {
                        $this->info = 'warning=menuItem_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=menuItem_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
