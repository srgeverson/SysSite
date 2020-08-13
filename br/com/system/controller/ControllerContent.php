<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/model/ModelContent.php");
include_once server_path("br/com/system/dao/DAOContent.php");
include_once server_path("br/com/system/dao/DAOPage.php");

class ControllerContent {

    private $info;
    private $daoContent;

    function __construct() {
        $this->info = 'default=default';
        $this->daoContent = new DAOContent();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $conte_pk_id = strip_tags($_GET['conte_pk_id']);
            if (!isset($conte_pk_id)) {
                $this->info = 'warning=content_uninformed';
            }
            try {
                $this->daoContent->delete($conte_pk_id);
                $this->info = "success=content_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $conte_pk_id = strip_tags($_GET['conte_pk_id']);
            if (isset($conte_pk_id)) {
                $conte_status = false;
                try {
                    if (($this->daoContent->selectObjectById($conte_pk_id)) === null) {
                        $this->info = 'warning=content_not_exists';
                    } else {
                        $content = new ModelContent();
                        $content->conte_pk_id = $conte_pk_id;
                        $content->conte_status = $conte_status;

                        $this->daoContent->updateStatus($content);
                        $this->info = 'success=content_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=content_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            if (isset($_GET['conte_pk_id'])) {
                $content_pk_id = strip_tags($_GET['conte_pk_id']);
                try {
                    $daoPage = new DAOPage();
                    $pages = $daoPage->selectObjectsEnabled();
                    $content = $this->daoContent->selectObjectById($content_pk_id);
                    if ($content == false) {
                        $this->info = "warning=content_not_found";
                    }
                    if (!isset($content)) {
                        $this->info = 'warning=content_not_exists';
                    } else {
                        include_once server_path('br/com/system/view/content/edit.php');
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=content_not_found';
                $this->list();
            }
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $conte_pk_id = strip_tags($_GET['conte_pk_id']);
            if (isset($conte_pk_id)) {
                $conte_status = true;
                try {
                    if (($this->daoContent->selectObjectById($conte_pk_id)) === null) {
                        $this->info = 'warning=content_not_exists';
                    } else {
                        $content = new ModelContent();
                        $content->conte_pk_id = $conte_pk_id;
                        $content->conte_status = $conte_status;

                        $this->daoContent->updateStatus($content);
                        $this->info = 'success=content_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=content_uninformed';
            }
            $this->list();
        }
    }

    public function filterByPage() {
        if (GenericController::authotity()) {
            if (isset($_GET['conte_fk_page_pk_id'])) {
                try {
                    $conte_fk_page_pk_id = strip_tags($_GET['conte_fk_page_pk_id']);
                    $daoPage = new DAOPage();
                    $page = $daoPage->selectObjectById($conte_fk_page_pk_id);
                    $content = new ModelContent();
                    $content->conte_fk_page_pk_id = $conte_fk_page_pk_id;
                    $contents = $this->daoContent->selectContentByContainsObject($content);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/content/content.php');
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['conte_component']) && isset($_POST['page_name'])) {
                try {
                    $content = new ModelContent();
                    $content->conte_component = strip_tags($_POST['conte_component']);
                    if (strip_tags($_POST['page_name']) !== 'Todas') {
                        $content->page_name = strip_tags($_POST['page_name']);
                    } else {
                        $content->page_name = '';
                    }
                    $contents = $this->daoContent->selectObjectsByContainsObject($content);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            $daoPage = new DAOPage();
            $pages = $daoPage->selectObjectsEnabled();
            include_once server_path('br/com/system/view/content/list.php');
        }
    }

    public function listEnableds() {
        if (GenericController::authotity()) {
            try {
                return $this->daoContent->selectObjectsEnabled();
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
            $daoPage = new DAOPage();
            $pages = $daoPage->selectObjectsEnabled();
            include_once server_path('br/com/system/view/content/new.php');
        }
    }

    public function personalize() {
        if (GenericController::authotity()) {
            if (isset($_GET['conte_pk_id'])) {
                $conte_pk_id = $_GET['conte_pk_id'];
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                    $this->list();
                } else {
                    try {
                        $content = $this->daoContent->selectObjectById($conte_pk_id);
                        if ($content == false) {
                            $this->info = "warning=content_not_found";
                        }
                        if (!isset($content)) {
                            $this->info = 'warning=content_not_exists';
                            $this->list();
                        } else {
                            include_once server_path('br/com/system/view/content/personalize.php');
                        }
                    } catch (Exception $erro) {
                        $this->info = "error=" . $erro->getMessage();
                    }
                }
            }
        }
    }

    public function personalizeRedirect(ModelContent $content = null) {
        if (GenericController::authotity()) {
            if (isset($content)) {
                try {
                    $daoPage = new DAOPage();
                    $page = $daoPage->selectObjectById($content->conte_fk_page_pk_id);
                    $contents = $this->daoContent->selectContentByContainsObject($content);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/content/content.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $conte_component = strip_tags($_POST['conte_component']);
                $conte_title = strip_tags($_POST['conte_title']);
                $conte_subtitle = strip_tags($_POST['conte_subtitle']);

                $conte_image = $_FILES['conte_image']['name'];
                $uploaddir = server_path('br/com/system/uploads/content/');
                $uploadfile = $uploaddir . $conte_image;
                $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

                $conte_link = strip_tags($_POST['conte_link']);
                $conte_text = strip_tags($_POST['conte_text']);
                $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                }
                global $user_logged;
                $content_fk_user_pk_id = $user_logged->user_pk_id;

                try {
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        if (move_uploaded_file($_FILES['conte_image']['tmp_name'], $uploadfile)) {
                            $content = new ModelContent();
                            $content->conte_component = $conte_component;
                            $content->conte_title = $conte_title;
                            $content->conte_subtitle = $conte_subtitle;
                            $content->conte_image = $conte_image;
                            $content->conte_link = $conte_link;
                            $content->conte_text = $conte_text;
                            $content->conte_fk_user_pk_id = $content_fk_user_pk_id;
                            $content->conte_fk_page_pk_id = $conte_fk_page_pk_id;
                            $this->daoContent->save($content);
                            $this->info = "success=content_created";
                        }
                    } else {
                        echo '<script>alert("Formato de imagem não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $conte_pk_id = strip_tags($_POST['conte_pk_id']);
                $conte_component = strip_tags($_POST['conte_component']);
                $conte_title = strip_tags($_POST['conte_title']);
                $conte_subtitle = strip_tags($_POST['conte_subtitle']);

                $conte_image = $_FILES['conte_image']['name'];
                $uploaddir = server_path('br/com/system/uploads/content/');
                $uploadfile = $uploaddir . $conte_image;
                $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

                $conte_link = strip_tags($_POST['conte_link']);
                $conte_text = strip_tags($_POST['conte_text']);
                $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                }
                global $user_logged;
                $content_fk_user_pk_id = $user_logged->user_pk_id;

                try {
                    if ($conte_pk_id == null) {
                        $this->info = 'warning=content_not_exists';
                        $this->list();
                    } else {
                        if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                            if (move_uploaded_file($_FILES['conte_image']['tmp_name'], $uploadfile)) {
                                $content = new ModelContent();
                                $content->conte_pk_id = $conte_pk_id;
                                $content->conte_component = $conte_component;
                                $content->conte_title = $conte_title;
                                $content->conte_subtitle = $conte_subtitle;
                                $content->conte_image = $conte_image;
                                $content->conte_link = $conte_link;
                                $content->conte_text = $conte_text;
                                $content->conte_fk_user_pk_id = $content_fk_user_pk_id;
                                $content->conte_fk_page_pk_id = $conte_fk_page_pk_id;
                                $this->daoContent->update($content);
                                $this->info = 'success=content_updated';
                            }
                        } else {
                            echo '<script>alert("Formato de imagem não aceito!")</script>';
                            redirect("javascript:window.history.go(-1)");
                        }
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

    public function submit() {
        if (GenericController::authotity()) {
            $conte_pk_id = strip_tags($_POST['conte_pk_id']);
            $conte_component = strip_tags($_POST['conte_component']);
            $conte_title = strip_tags($_POST['conte_title']);
            $conte_subtitle = strip_tags($_POST['conte_subtitle']);

            $conte_image = $_FILES['conte_image']['name'];
            $uploaddir = server_path('br/com/system/uploads/content/');
            $uploadfile = $uploaddir . $conte_image;
            $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

            $conte_link = strip_tags($_POST['conte_link']);
            $conte_text = strip_tags($_POST['conte_text']);
            $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
            if (!isset($conte_pk_id)) {
                $this->info = 'warning=content_uninformed';
            } else {
                global $user_logged;
                $content_fk_user_pk_id = $user_logged->user_pk_id;
                try {
                    if ($conte_pk_id == null) {
                        $this->info = 'warning=content_not_exists';
                    } else {
                        if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                            if (move_uploaded_file($_FILES['conte_image']['tmp_name'], $uploadfile)) {
                                $content = new ModelContent();
                                $content->conte_pk_id = $conte_pk_id;
                                $content->conte_component = $conte_component;
                                $content->conte_title = $conte_title;
                                $content->conte_subtitle = $conte_subtitle;
                                $content->conte_image = $conte_image;
                                $content->conte_link = $conte_link;
                                $content->conte_text = $conte_text;
                                $content->conte_fk_user_pk_id = $content_fk_user_pk_id;
                                $content->conte_fk_page_pk_id = $conte_fk_page_pk_id;
                                $this->daoContent->update($content);
                                $this->info = 'success=content_updated';
                            }
                        } else {
                            echo '<script>alert("Formato de imagem não aceito!")</script>';
                            redirect("javascript:window.history.go(-1)");
                        }
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            $this->personalizeRedirect($content);
        }
    }

}
