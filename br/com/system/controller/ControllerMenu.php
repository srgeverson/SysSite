<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/model/ModelMenu.php");
include_once server_path("br/com/system/dao/DAOMenu.php");
include_once server_path("br/com/system/dao/DAOMenuItem.php");
include_once server_path("br/com/system/dao/DAOSistema.php");

class ControllerMenu {

    private $info;
    private $daoMenu;
    private $daoMenuItem;
    private $daoSistema;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoMenu = new DAOMenu();
        $this->daoMenuItem = new DAOMenuItem();
        $this->daoSistema = new DAOSistema();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=menu_uninformed';
            }
            try {
                $this->daoMenu->delete($id);
                $this->info = "success=menu_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $menu = new ModelMenu();
            $menu->id = strip_tags($_GET['id']);
            $menu->status = false;
            $menu->usuario_id = $this->usuarioAutencitado->id;
            if ($menu->id) {
                try {
                    $existente = $this->daoMenu->selectObjectById($menu->id);
                    if ($existente === null) {
                        $this->info = 'warning=menu_not_exists';
                    } else {
                        $this->daoMenu->updateStatus($menu);
                        $this->info = 'success=menu_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=menu_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=menu_uninformed';
                $this->listar();
            }
            try {
                $sistemas = $this->daoSistema->selectObjectsEnabled();
                $menu = $this->daoMenu->selectObjectById($id);
                if ($menu == false) {
                    $this->info = "warning=menu_not_found";
                }
                if (!isset($menu)) {
                    $this->info = 'warning=menu_not_exists';
                    $this->listar();
                } else {
                    include_once server_path('br/com/system/view/menu/edit.php');
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $menu = new ModelMenu();
            $menu->id = strip_tags($_GET['id']);
            $menu->status = true;
            $menu->usuario_id = $this->usuarioAutencitado->id;
            if ($menu->id) {
                $status = true;
                try {
                    $existente =$this->daoMenu->selectObjectById($menu->id);
                    if ($existente === null) {
                        $this->info = 'warning=menu_not_exists';
                    } else {
                        $this->daoMenu->updateStatus($menu);
                        $this->info = 'success=menu_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=menu_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $menu = new ModelMenu();
            $menu->nome = strip_tags($_POST['nome']);
            $menu->descricao = strip_tags($_POST['descricao']);
            $menu->todos = strip_tags($_POST['todos']);
            if ($menu->nome || $menu->descricao || $menu->todos) {
                try {
                    $menus = $this->daoMenu->selectObjectsByContainsObject($menu);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/menu/list.php');
        }
    }

    public function listEnableds() {
        try {
            $menus = $this->daoMenu->selectObjectsEnabled();
            $menusComItem = array();
            foreach ($menus as $each_menu) {
               $itens = $this->daoMenuItem->selectObjectsEnabledAndFkMenu($each_menu->id);
               if(!empty($itens)){
                    $each_menu->itens = $itens;
                    array_push($menusComItem, $each_menu);
                }
            }
            return $menusComItem;
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
        if (isset($this->info)) {
            HelperController::valid_messages($this->info);
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $sistemas = $this->daoSistema->selectObjectsEnabled();
            include_once server_path('br/com/system/view/menu/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $menu = new ModelMenu();
            // $menu->id = strip_tags($_POST['id']);
            $menu->nome = strip_tags($_POST['nome']);
            $menu->descricao = strip_tags($_POST['descricao']);
            $menu->class = strip_tags($_POST['class']);
            $menu->url = strip_tags($_POST['url']);
            $menu->image = strip_tags($_POST['image']);
            $menu->icone = strip_tags($_POST['icone']);
            $menu->sistema_id = strip_tags($_POST['sistema_id']);
            $menu->status = true;
            $menu->usuario_id = $this->usuarioAutencitado->id;

            try {
                $existente = $this->daoMenu->selectObjectByObject($menu);
                if (!isset($existente->nome)) {
                    $this->daoMenu->save($menu);
                    $this->info = "success=menu_created";
                } else {
                    $this->info = "warning=menu_already_registered";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $menu = new ModelMenu();
                $menu->id = strip_tags($_POST['id']);
                $menu->nome = strip_tags($_POST['nome']);
                $menu->descricao = strip_tags($_POST['descricao']);
                $menu->class = strip_tags($_POST['class']);
                $menu->url = strip_tags($_POST['url']);
                $menu->image = strip_tags($_POST['image']);
                $menu->icone = strip_tags($_POST['icone']);
                $menu->sistema_id = strip_tags($_POST['sistema_id']);
                $menu->usuario_id = $this->usuarioAutencitado->id;
                if (!$menu->id) {
                    $this->info = 'warning=menu_uninformed';
                }

                try {
                    $this->daoMenu->update($menu);
                    if ($menu == null) {
                        $this->info = 'warning=menu_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=menu_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
