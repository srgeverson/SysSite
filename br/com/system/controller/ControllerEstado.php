<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOEstado.php");
include_once server_path("br/com/system/dao/DAOPais.php");
include_once server_path("br/com/system/model/ModelEstado.php");

class ControllerEstado {

    private $info;
    private $controllerSystem;
    private $daoEstado;

    function __construct() {
        $this->info = 'default=default';
        $this->controllerSystem = new ControllerSystem();
        $this->daoEstado = new DAOEstado();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=estado_uninformed';
            }
            try {
                $this->daoEstado->delete($id);
                $this->info = "success=estado_deleted";
                $this->listar();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    if (($this->daoEstado->selectObjectById($id)) === null) {
                        $this->info = "warning=estado_not_exists";
                    } else {
                        $estado = new ModelEstado();
                        $estado->id = $id;
                        $estado->status = $status;

                        $this->daoEstado->updateStatus($estado);
                        $this->info = "success=estado_disabled";
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = "warning=estado_uninformed";
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=estado_uninformed';
                $this->listar();
            }
            try {
                $estado = $this->daoEstado->selectObjectById($id);
                $daoPais = new DAOPais();
                $paises = $daoPais->selectObjectsEnabled();
                if (!isset($estado)) {
                    $this->info = 'warning=estado_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($estado == false) {
                $this->info = "warning=estado_not_found";
            }
            include_once server_path('br/com/system/view/estado/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoEstado->selectObjectById($id)) === null) {
                        $this->info = 'warning=estado_not_exists';
                    } else {
                        $estado = new ModelEstado();
                        $estado->id = $id;
                        $estado->status = $status;

                        $this->daoEstado->updateStatus($estado);
                        $this->info = 'success=estado_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=estado_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $estado = new ModelEstado();
            $estado->nome =  strip_tags($_POST['nome']);
            $estado->todos = strip_tags($_POST['todos']);
            if (strip_tags($_POST['pais_nome']) !== 'Todos') 
                $estado->pais_nome = strip_tags($_POST['pais_nome']);

                if (($estado->nome != null || $estado->pais_nome != null) || $estado->todos) {
                    try {
                    $estados = $this->daoEstado->selectObjectsByContainsObject($estado);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            $daoPais = new DAOPais();
            $paises = $daoPais->selectObjectsEnabled();
            include_once server_path('br/com/system/view/estado/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $daoPais = new DAOPais();
            $paises = $daoPais->selectObjectsEnabled();
            include_once server_path('br/com/system/view/estado/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $nome = strip_tags($_POST['nome']);
            $sigla = strip_tags($_POST['sigla']);
            $status = true;
            $pais_id = strip_tags($_POST['pais_id']);
            global $user_logged;
            $pais_id = $user_logged->id;

            $estado = new ModelEstado();
            $estado->nome = $nome;
            $estado->sigla = $sigla;
            $estado->status = $status;
            $estado->pais_id = $pais_id;
            $estado->pais_id = $pais_id;
            try {
                $this->daoEstado->save($estado);
                $this->info = "success=estado_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $id = strip_tags($_POST['id']);
                if (!isset($id)) {
                    $this->info = 'warning=estado_uninformed';
                }
                $nome = strip_tags($_POST['nome']);
                $sigla = strip_tags($_POST['sigla']);
                $pais_id = strip_tags($_POST['pais_id']);
                global $user_logged;
                $usuario_id = $user_logged->id;

                $estado = new ModelEstado();
                $estado->id = $id;
                $estado->nome = $nome;
                $estado->sigla = $sigla;
                $estado->pais_id = $pais_id;
                $estado->usuario_id = $usuario_id;

                try {
                    $this->daoEstado->update($estado);
                    if ($estado == null) {
                        $this->info = 'warning=estado_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=estado_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
