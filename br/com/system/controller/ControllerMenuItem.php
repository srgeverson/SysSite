<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// include_once server_path("br/com/system/model/ModelContent.php");
include_once server_path("br/com/system/model/ModelMenuItem.php");
// include_once server_path("br/com/system/dao/DAOContact.php");
// include_once server_path("br/com/system/dao/DAOContent.php");
// include_once server_path("br/com/system/dao/DAOEndereco.php");
include_once server_path("br/com/system/dao/DAOMenuItem.php");

class ControllerMenuItem {

    private $info;
    private $daoMenuItem;
    private $usuarioAutencitado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoMenuItem = new DAOMenuItem();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $menuItem_pk_id = strip_tags($_GET['menuItem_pk_id']);
            if (!isset($menuItem_pk_id)) {
                $this->info = 'warning=menuItem_uninformed';
            }
            try {
                $this->daoMenuItem->delete($menuItem_pk_id);
                $this->info = "success=menuItem_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $menuItem_pk_id = strip_tags($_GET['menuItem_pk_id']);
            if (isset($menuItem_pk_id)) {
                $menuItem_status = false;
                try {
                    if (($this->daoMenuItem->selectObjectById($menuItem_pk_id)) === null) {
                        $this->info = 'warning=menuItem_not_exists';
                    } else {
                        $menuItem = new ModelMenuItem();
                        $menuItem->menuItem_pk_id = $menuItem_pk_id;
                        $menuItem->menuItem_status = $menuItem_status;

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
            $menuItem_pk_id = $_GET['menuItem_pk_id'];
            if (!isset($menuItem_pk_id)) {
                $this->info = 'warning=menuItem_uninformed';
                $this->listar();
            }
            try {
                $menuItem = $this->daoMenuItem->selectObjectById($menuItem_pk_id);
                if ($menuItem == false) {
                    $this->info = "warning=menuItem_not_found";
                }
                if (!isset($menuItem)) {
                    $this->info = 'warning=menuItem_not_exists';
                    $this->listar();
                } else {
                    include_once server_path('br/com/system/view/menuItem/edit.php');
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $menuItem_pk_id = strip_tags($_GET['menuItem_pk_id']);
            if (isset($menuItem_pk_id)) {
                $menuItem_status = true;
                try {
                    if (($this->daoMenuItem->selectObjectById($menuItem_pk_id)) === null) {
                        $this->info = 'warning=menuItem_not_exists';
                    } else {
                        $menuItem = new ModelMenuItem();
                        $menuItem->menuItem_pk_id = $menuItem_pk_id;
                        $menuItem->menuItem_status = $menuItem_status;

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
            if (isset($_POST['menuItem_name']) && isset($_POST['menuItem_description'])) {
                try {
                    $menuItem = new ModelMenuItem();
                    $menuItem->menuItem_name = strip_tags($_POST['menuItem_name']);
                    $menuItem->menuItem_description = strip_tags($_POST['menuItem_description']);
                    $menuItems = $this->daoMenuItem->selectObjectsByContainsObject($menuItem);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/menuItem/list.php');
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
            include_once server_path('br/com/system/view/menuItem/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $menuItem_name = strip_tags($_POST['menuItem_name']);
            $menuItem_description = strip_tags($_POST['menuItem_description']);
            $menuItem_icon = strip_tags($_POST['menuItem_icon']);
            $menuItem_label = strip_tags($_POST['menuItem_label']);
            $menuItem_status = false;
            global $user_logged;
            $menuItem_fk_user_pk_id = $user_logged->user_pk_id;
            $menuItem = new ModelMenuItem();
            $menuItem->menuItem_name = $menuItem_name;
            $menuItem->menuItem_description = $menuItem_description;
            $menuItem->menuItem_icon = $menuItem_icon;
            $menuItem->menuItem_label = $menuItem_label;
            $menuItem->menuItem_status = $menuItem_status;
            $menuItem->menuItem_fk_user_pk_id = $menuItem_fk_user_pk_id;

            try {
                if (!isset($this->daoMenuItem->selectObjectByObject($menuItem)->menuItem_name)) {
                    $this->daoMenuItem->save($menuItem);
                    $this->info = "success=menuItem_created";
                } else {
                    $this->info = "warning=menuItem_already_registered";
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
                $menuItem_pk_id = strip_tags($_POST['menuItem_pk_id']);
                if (!isset($menuItem_pk_id)) {
                    $this->info = 'warning=menuItem_uninformed';
                }
                $menuItem_name = strip_tags($_POST['menuItem_name']);
                $menuItem_description = strip_tags($_POST['menuItem_description']);
                $menuItem_icon = strip_tags($_POST['menuItem_icon']);
                $menuItem_label = strip_tags($_POST['menuItem_label']);
                global $user_logged;
                $menuItem_fk_user_pk_id = $user_logged->user_pk_id;

                $menuItem = new ModelMenuItem();
                $menuItem->menuItem_pk_id = $menuItem_pk_id;
                $menuItem->menuItem_name = $menuItem_name;
                $menuItem->menuItem_description = $menuItem_description;
                $menuItem->menuItem_icon = $menuItem_icon;
                $menuItem->menuItem_label = $menuItem_label;
                $menuItem->menuItem_fk_user_pk_id = $menuItem_fk_user_pk_id;

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
