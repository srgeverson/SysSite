<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// include_once server_path("br/com/system/model/ModelContent.php");
include_once server_path("br/com/system/model/ModelMenu.php");
// include_once server_path("br/com/system/dao/DAOContact.php");
// include_once server_path("br/com/system/dao/DAOContent.php");
// include_once server_path("br/com/system/dao/DAOEndereco.php");
include_once server_path("br/com/system/dao/DAOMenu.php");
include_once server_path("br/com/system/dao/DAOMenuItem.php");

class ControllerMenu {

    private $info;
    private $daoMenu;
    private $daoMenuItem;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoMenu = new DAOMenu();
        $this->daoMenuItem = new DAOMenuItem();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $menu_pk_id = strip_tags($_GET['menu_pk_id']);
            if (!isset($menu_pk_id)) {
                $this->info = 'warning=menu_uninformed';
            }
            try {
                $this->daoMenu->delete($menu_pk_id);
                $this->info = "success=menu_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $menu_pk_id = strip_tags($_GET['menu_pk_id']);
            if (isset($menu_pk_id)) {
                $menu_status = false;
                try {
                    if (($this->daoMenu->selectObjectById($menu_pk_id)) === null) {
                        $this->info = 'warning=menu_not_exists';
                    } else {
                        $menu = new ModelMenu();
                        $menu->menu_pk_id = $menu_pk_id;
                        $menu->menu_status = $menu_status;

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
            $menu_pk_id = $_GET['menu_pk_id'];
            if (!isset($menu_pk_id)) {
                $this->info = 'warning=menu_uninformed';
                $this->listar();
            }
            try {
                $menu = $this->daoMenu->selectObjectById($menu_pk_id);
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
            $menu_pk_id = strip_tags($_GET['menu_pk_id']);
            if (isset($menu_pk_id)) {
                $menu_status = true;
                try {
                    if (($this->daoMenu->selectObjectById($menu_pk_id)) === null) {
                        $this->info = 'warning=menu_not_exists';
                    } else {
                        $menu = new ModelMenu();
                        $menu->menu_pk_id = $menu_pk_id;
                        $menu->menu_status = $menu_status;

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
            if (isset($_POST['menu_name']) && isset($_POST['menu_description'])) {
                try {
                    $menu = new ModelMenu();
                    $menu->menu_name = strip_tags($_POST['menu_name']);
                    $menu->menu_description = strip_tags($_POST['menu_description']);
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
            include_once server_path('br/com/system/view/menu/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $menu_name = strip_tags($_POST['menu_name']);
            $menu_description = strip_tags($_POST['menu_description']);
            $menu_icon = strip_tags($_POST['menu_icon']);
            $menu_label = strip_tags($_POST['menu_label']);
            $menu_status = false;
            global $user_logged;
            $menu_fk_user_pk_id = $user_logged->user_pk_id;
            $menu = new ModelMenu();
            $menu->menu_name = $menu_name;
            $menu->menu_description = $menu_description;
            $menu->menu_icon = $menu_icon;
            $menu->menu_label = $menu_label;
            $menu->menu_status = $menu_status;
            $menu->menu_fk_user_pk_id = $menu_fk_user_pk_id;

            try {
                if (!isset($this->daoMenu->selectObjectByObject($menu)->menu_name)) {
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
                $menu_pk_id = strip_tags($_POST['menu_pk_id']);
                if (!isset($menu_pk_id)) {
                    $this->info = 'warning=menu_uninformed';
                }
                $menu_name = strip_tags($_POST['menu_name']);
                $menu_description = strip_tags($_POST['menu_description']);
                $menu_icon = strip_tags($_POST['menu_icon']);
                $menu_label = strip_tags($_POST['menu_label']);
                global $user_logged;
                $menu_fk_user_pk_id = $user_logged->user_pk_id;

                $menu = new ModelMenu();
                $menu->menu_pk_id = $menu_pk_id;
                $menu->menu_name = $menu_name;
                $menu->menu_description = $menu_description;
                $menu->menu_icon = $menu_icon;
                $menu->menu_label = $menu_label;
                $menu->menu_fk_user_pk_id = $menu_fk_user_pk_id;

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
