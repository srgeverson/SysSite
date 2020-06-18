<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/model/ModelPage.php");
include_once server_path("br/com/system/dao/DAOPage.php");

class ControllerContent {

    private $info;
    private $daoPage;

    function __construct() {
        $this->info = 'default=default';
        $this->daoPage = new DAOPage();
    }

    public function about($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/about.php');
    }

    public function contact($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/contact.php');
    }

    public function delete() {
        if (GenericController::authotity()) {
            $page_pk_id = strip_tags($_GET['page_pk_id']);
            if (!isset($page_pk_id)) {
                $this->info = 'warning=page_uninformed';
            }
            try {
                $this->daoPage->delete($page_pk_id);
                $this->info = "success=page_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $page_pk_id = strip_tags($_GET['page_pk_id']);
            if (isset($page_pk_id)) {
                $page_status = false;
                try {
                    if (($this->daoPage->selectObjectById($page_pk_id)) === null) {
                        $this->info = 'warning=page_not_exists';
                    } else {
                        $page = new ModelPage();
                        $page->page_pk_id = $page_pk_id;
                        $page->page_status = $page_status;

                        $this->daoPage->updateStatus($page);
                        $this->info = 'success=page_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=page_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $page_pk_id = $_GET['page_pk_id'];
            if (!isset($page_pk_id)) {
                $this->info = 'warning=page_uninformed';
                $this->list();
            }
            try {
                $page = $this->daoPage->selectObjectById($page_pk_id);
                if ($page == false) {
                    $this->info = "warning=page_not_found";
                }
                if (!isset($page)) {
                    $this->info = 'warning=page_not_exists';
                    $this->list();
                } else {
                    include_once server_path('br/com/system/view/page/edit.php');
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $page_pk_id = strip_tags($_GET['page_pk_id']);
            if (isset($page_pk_id)) {
                $page_status = true;
                try {
                    if (($this->daoPage->selectObjectById($page_pk_id)) === null) {
                        $this->info = 'warning=page_not_exists';
                    } else {
                        $page = new ModelPage();
                        $page->page_pk_id = $page_pk_id;
                        $page->page_status = $page_status;

                        $this->daoPage->updateStatus($page);
                        $this->info = 'success=page_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=page_uninformed';
            }
            $this->list();
        }
    }

    public function home($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/default.php');
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['page_name']) && isset($_POST['page_description'])) {
                try {
                    $page = new ModelPage();
                    $page->page_name = strip_tags($_POST['page_name']);
                    $page->page_description = strip_tags($_POST['page_description']);
                    $pages = $this->daoPage->selectObjectsByContainsObject($page);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/page/list.php');
        }
    }

    public function listEnableds() {
        if (GenericController::authotity()) {
            try {
                return $this->daoPage->selectObjectsEnabled();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/page/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $page_name = strip_tags($_POST['page_name']);
            $page_description = strip_tags($_POST['page_description']);
            $page_icon = strip_tags($_POST['page_icon']);
            $page_label = strip_tags($_POST['page_label']);
            $page_status = false;
            global $user_logged;
            $page_fk_user_pk_id = $user_logged->user_pk_id;
            $page = new ModelPage();
            $page->page_name = $page_name;
            $page->page_description = $page_description;
            $page->page_icon = $page_icon;
            $page->page_label = $page_label;
            $page->page_status = $page_status;
            $page->page_fk_user_pk_id = $page_fk_user_pk_id;

            try {
                if (!isset($this->daoPage->selectObjectByObject($page)->page_name)) {
                    $this->daoPage->save($page);
                    $this->info = "success=page_created";
                } else {
                    $this->info = "warning=page_already_registered";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $page_pk_id = strip_tags($_POST['page_pk_id']);
                if (!isset($page_pk_id)) {
                    $this->info = 'warning=page_uninformed';
                }
                $page_name = strip_tags($_POST['page_name']);
                $page_description = strip_tags($_POST['page_description']);
                $page_icon = strip_tags($_POST['page_icon']);
                $page_label = strip_tags($_POST['page_label']);
                global $user_logged;
                $page_fk_user_pk_id = $user_logged->user_pk_id;

                $page = new ModelPage();
                $page->page_pk_id = $page_pk_id;
                $page->page_name = $page_name;
                $page->page_description = $page_description;
                $page->page_icon = $page_icon;
                $page->page_label = $page_label;
                $page->page_fk_user_pk_id = $page_fk_user_pk_id;

                try {
                    $this->daoPage->update($page);
                    if ($page == null) {
                        $this->info = 'warning=page_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=page_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

    public function service($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/service.php');
    }

}
