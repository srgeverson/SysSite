<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("model/ModelContent.php");
include_once server_path("model/ModelPage.php");
include_once server_path("dao/DAOContato.php");
include_once server_path("dao/DAOContent.php");
include_once server_path("dao/DAOEndereco.php");
include_once server_path("dao/DAOPage.php");
include_once server_path("dao/DAOParameter.php");

class ControllerPage {

    private $info;
    private $daoPage;
    private $usuarioAutencitado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoPage = new DAOPage();
        $this->daoParameter = new DAOParameter();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged;
    }

    public function about($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);

        $daoContent = new DAOContent();
        $content = new ModelContent();

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 4;
        $content->conte_component = "modern_business";
        $modern_business = $daoContent->selectObjectsByObject($content);

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 4;
        $content->conte_component = "our_team";
        $our_team = $daoContent->selectObjectsByObject($content);

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 4;
        $content->conte_component = "our_customers";
        $our_customers = $daoContent->selectObjectsByObject($content);

        include_once server_path('view/page/pages/about.php');
    }

    public function contato($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        $daoContent = new DAOContent();
        $content = new ModelContent();

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 2;
        $content->conte_component = "our_contato";
        $our_contatos = $daoContent->selectObjectsByObject($content);

        $parameter = new ControllerParameter();
        $daoEndereco = new DAOEndereco();
        $endereco = $daoEndereco->selectObjectById($parameter->getProperty('endereco'));

        $daoContato = new DAOContato();
        $contato = $daoContato->selectObjectById($parameter->getProperty('contato'));
        include_once server_path('view/page/pages/contato.php');
    }

    public function delete() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $page_pk_id = $_GET['page_pk_id'];
            if (!isset($page_pk_id)) {
                $this->info = 'warning=page_uninformed';
                $this->listar();
            }
            try {
                $page = $this->daoPage->selectObjectById($page_pk_id);
                if ($page == false) {
                    $this->info = "warning=page_not_found";
                }
                if (!isset($page)) {
                    $this->info = 'warning=page_not_exists';
                    $this->listar();
                } else {
                    include_once server_path('view/page/edit.php');
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function home($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }

        $daoContent = new DAOContent();
        $content = new ModelContent();

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 1;
        $content->conte_component = "slide_apresentacao";
        $slide_apresentacao = $daoContent->selectObjectsByObject($content);

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 1;
        $content->conte_component = "nossos_destaques";
        $nossos_destaques = $daoContent->selectObjectsByObject($content);

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 1;
        $content->conte_component = "outros_destaques";
        $outros_destaques = $daoContent->selectObjectsByObject($content);

        HelperController::valid_messages($msg);
        if (isset($this->usuarioAutencitado)) {
            include_once server_path('view/system/welcome.php');
        } else {
            if ($this->daoPage->selectObjectByKey('home')) {
                include_once server_path('view/page/pages/default.php');
            } else {
                $page = new ModelPage();
                if($this->daoParameter->verificaConfiguracaoDeEmail())
                    $page->enviar_senha_por_email = true;
                else
                    $page->enviar_senha_por_email = false;
                    
                include_once server_path('view/user/authenticate.php');
            }
        }
    }

    public function landingPage($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        try {
            $parameter = new ControllerParameter();
            $daoEndereco = new DAOEndereco();
            $endereco = $daoEndereco->selectObjectById($parameter->getProperty('endereco'));
            
            $daoContato = new DAOContato();
            $contato = $daoContato->selectObjectById($parameter->getProperty('contato'));
            //code...
        } catch (Exception $ex) {
           throw $ex;
        }
        include_once server_path('view/page/pages/landing_page.php');
    }

    public function listar() {
        if (HelperController::authotity()) {
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
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/page/list.php');
        }
    }

    public function listEnableds() {
        try {
            return $this->daoPage->selectObjectsEnabled();
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
        if (isset($this->info)) {
            HelperController::valid_messages($this->info);
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/page/new.php');
        }
    }

    //pk
    public function save() {
        if (HelperController::authotity()) {
            $page_name = strip_tags($_POST['page_name']);
            $page_description = strip_tags($_POST['page_description']);
            $page_icon = strip_tags($_POST['page_icon']);
            $page_label = strip_tags($_POST['page_label']);
            $page_status = false;
            global $user_logged;
            $page_fk_id = $user_logged->id;
            $page = new ModelPage();
            $page->page_name = $page_name;
            $page->page_description = $page_description;
            $page->page_icon = $page_icon;
            $page->page_label = $page_label;
            $page->page_status = $page_status;
            $page->page_fk_id = $page_fk_id;

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
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $page_pk_id = strip_tags($_POST['page_pk_id']);
                if (!isset($page_pk_id)) {
                    $this->info = 'warning=page_uninformed';
                }
                $page_name = strip_tags($_POST['page_name']);
                $page_description = strip_tags($_POST['page_description']);
                $page_icon = strip_tags($_POST['page_icon']);
                $page_label = strip_tags($_POST['page_label']);
                global $user_logged;
                $page_fk_id = $user_logged->id;

                $page = new ModelPage();
                $page->page_pk_id = $page_pk_id;
                $page->page_name = $page_name;
                $page->page_description = $page_description;
                $page->page_icon = $page_icon;
                $page->page_label = $page_label;
                $page->page_fk_id = $page_fk_id;

                try {
                    $this->daoPage->update($page);
                    if ($page == null) {
                        $this->info = 'warning=page_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=page_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

    public function service($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        $daoContent = new DAOContent();
        $content = new ModelContent();

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 3;
        $content->conte_component = "destaques_servicos";
        $destaques_servicos = $daoContent->selectObjectsByObject($content);

        $content = null;
        $content = new ModelContent();
        $content->conte_fk_page_pk_id = 3;
        $content->conte_component = "nossos_servicos";
        $nossos_servicos = $daoContent->selectObjectsByObject($content);
        include_once server_path('view/page/pages/service.php');
    }

}
