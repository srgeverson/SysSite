<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("model/ModelContent.php");
include_once server_path("dao/DAOContent.php");
include_once server_path("dao/DAOPage.php");

class ControllerContent {

    private $info;
    private $daoContent;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoContent = new DAOContent();
    }

    public function delete() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
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
                        include_once server_path('view/content/edit.php');
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=content_not_found';
                $this->listar();
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function filterByPage() {
        if (HelperController::authotity()) {
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
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/content/content.php');
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
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
                HelperController::valid_messages($this->info);
            }
            $daoPage = new DAOPage();
            $pages = $daoPage->selectObjectsEnabled();
            include_once server_path('view/content/list.php');
        }
    }

    public function listEnableds() {
        if (HelperController::authotity()) {
            try {
                return $this->daoContent->selectObjectsEnabled();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $daoPage = new DAOPage();
            $pages = $daoPage->selectObjectsEnabled();
            include_once server_path('view/content/new.php');
        }
    }

    public function personalize() {
        if (HelperController::authotity()) {
            if (isset($_GET['conte_pk_id'])) {
                $conte_pk_id = $_GET['conte_pk_id'];
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                    $this->listar();
                } else {
                    try {
                        $content = $this->daoContent->selectObjectById($conte_pk_id);
                        if ($content == false) {
                            $this->info = "warning=content_not_found";
                        }
                        if (!isset($content)) {
                            $this->info = 'warning=content_not_exists';
                            $this->listar();
                        } else {
                            include_once server_path('view/content/personalize.php');
                        }
                    } catch (Exception $erro) {
                        $this->info = "error=" . $erro->getMessage();
                    }
                }
            }
        }
    }

    public function personalizeRedirect(ModelContent $content = null) {
        if (HelperController::authotity()) {
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
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/content/content.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $conte_component = strip_tags($_POST['conte_component']);
                $conte_title = strip_tags($_POST['conte_title']);
                $conte_subtitle = strip_tags($_POST['conte_subtitle']);

                $conte_image = $_FILES['conte_image']['name'];
                $uploaddir = server_path('uploads/content/');
                $uploadfile = $uploaddir . $conte_image;
                $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

                $conte_link = strip_tags($_POST['conte_link']);
                $conte_text = strip_tags($_POST['conte_text']);
                $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                }
                global $user_logged;
                $usuario_id = $user_logged->id;

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
                            $content->usuario_id = $usuario_id;
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
                $this->listar();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $conte_pk_id = strip_tags($_POST['conte_pk_id']);
                $conte_component = strip_tags($_POST['conte_component']);
                $conte_title = strip_tags($_POST['conte_title']);
                $conte_subtitle = strip_tags($_POST['conte_subtitle']);

                $conte_image = $_FILES['conte_image']['name'];
                $uploaddir = server_path('uploads/content/');
                $uploadfile = $uploaddir . $conte_image;
                $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

                $conte_link = strip_tags($_POST['conte_link']);
                $conte_text = strip_tags($_POST['conte_text']);
                $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
                if (!isset($conte_pk_id)) {
                    $this->info = 'warning=content_uninformed';
                }
                global $user_logged;
                $content_fk_id = $user_logged->id;

                try {
                    if ($conte_pk_id == null) {
                        $this->info = 'warning=content_not_exists';
                        $this->listar();
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
                                $content->usuario_id = $usuario_id;
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
                $this->listar();
            }
        }
    }

    public function submit() {
        if (HelperController::authotity()) {
            $conte_pk_id = strip_tags($_POST['conte_pk_id']);
            $conte_component = strip_tags($_POST['conte_component']);
            $conte_title = strip_tags($_POST['conte_title']);
            $conte_subtitle = strip_tags($_POST['conte_subtitle']);

            $conte_image = $_FILES['conte_image']['name'];
            $uploaddir = server_path('uploads/content/');
            $uploadfile = $uploaddir . $conte_image;
            $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

            $conte_link = strip_tags($_POST['conte_link']);
            $conte_text = strip_tags($_POST['conte_text']);
            $conte_fk_page_pk_id = strip_tags($_POST['conte_fk_page_pk_id']);
            if (!isset($conte_pk_id)) {
                $this->info = 'warning=content_uninformed';
            } else {
                global $user_logged;
                $usuario_id = $user_logged->id;
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
                                $content->usuario_id = $usuario_id;
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
