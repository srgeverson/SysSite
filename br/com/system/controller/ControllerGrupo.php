<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOGrupo.php");
include_once server_path("br/com/system/dao/DAOGrupoPermissao.php");
// include_once server_path("br/com/system/dao/DAOMenuItem.php");
// include_once server_path("br/com/system/dao/DAOUser.php");
include_once server_path("br/com/system/model/ModelGrupo.php");

class ControllerGrupo {

    private $info;
    private $daoGrupo;
    private $daoGrupoPermissao;
    private $usuarioAutenticado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoGrupo = new DAOGrupo();
        $this->daoGrupoPermissao = new DAOGrupoPermissao();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
            }
            try {
                if (empty($this->daoGrupoPermissao->selectObjectsByContainsFkPermissao($id))) {
                    if (!$this->daoGrupo->delete($id)) {
                        $this->info = 'warning=grupo_not_exists';
                        $this->listar();
                    }
                    $this->info = "success=grupo_deleted";
                } else {
                    $this->info = "warning=grupo_in_use";
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
                    if (($this->daoGrupo->selectObjectById($id)) === null) {
                        $this->info = 'warning=grupo_not_exists';
                    } else {
                        $grupo = new ModelGrupo();
                        $grupo->id = $id;
                        $grupo->status = $status;
                        $grupo->usuario_id = $this->usuarioAutenticado->id;
                        $this->daoGrupo->updateStatus($grupo);
                        $this->info = 'success=grupo_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=grupo_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
                $this->listar();
            }
            try {
                $grupo = $this->daoGrupo->selectObjectById($id);
                if (!isset($grupo)) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($grupo == false) {
                $this->info = "warning=grupo_not_found";
            }
            include_once server_path('br/com/system/view/grupo/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoGrupo->selectObjectById($id)) === null) {
                        $this->info = 'warning=grupo_not_exists';
                    } else {
                        $grupo = new ModelGrupo();
                        $grupo->id = $id;
                        $grupo->status = $status;
                        $grupo->usuario_id = $this->usuarioAutenticado->id;
                        $this->daoGrupo->updateStatus($grupo);
                        $this->info = 'success=grupo_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=grupo_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->nome = strip_tags($_POST['nome']);
            $grupo->todos = strip_tags($_POST['todos']);
            if ($grupo->nome || $grupo->todos) {
                try {
                    $grupos = $this->daoGrupo->selectObjectsByContainsObject($grupo);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/grupo/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('br/com/system/view/grupo/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->nome = strip_tags($_POST['nome']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;
            $existente = $this->daoGrupo->selectObjectsByNameUnique($grupo->nome);
            if (empty($existente)) {
                try {
                    $daoGrupo = new DAOGrupo();
                    $daoGrupo->save($grupo);
                    $this->info = "success=grupo_created";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            } else {
                $this->info = "warning=grupo_already_registered";
                HelperController::valid_messages($this->info);
                $this->novo();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['id']);;
            $grupo->nome =strip_tags($_POST['nome']);
            $grupo->usuario_id = $this->usuarioAutenticado->id;
            if (!$grupo->id) {
                $this->info = 'warning=grupo_uninformed';
            }

            try {
                $this->daoGrupo->update($grupo);
                if ($grupo == null) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
                $this->info = 'success=grupo_updated';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

}
