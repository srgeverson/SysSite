<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOPais.php");
include_once server_path("model/ModelPais.php");

class ControllerPais {

    private $info;
    private $daoPais;

    function __construct() {
        $this->info = 'default=default';
        $this->daoPais = new DAOPais();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=pais_uninformed';
            }
            try {
                $this->daoPais->delete($id);
                $this->info = "success=pais_deleted";
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
                    if (($this->daoPais->selectObjectById($id)) === null) {
                        $this->info = 'warning=pais_not_exists';
                    } else {
                        $pais = new ModelPais();
                        $pais->id = $id;
                        $pais->status = $status;

                        $this->daoPais->updateStatus($pais);
                        $this->info = 'success=pais_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=pais_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=pais_uninformed';
                $this->listar();
            }
            try {
                $pais = $this->daoPais->selectObjectById($id);
                if (!isset($pais)) {
                    $this->info = 'warning=pais_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($pais == false) {
                $this->info = "warning=pais_not_found";
            }
            include_once server_path('view/pais/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoPais->selectObjectById($id)) === null) {
                        $this->info = 'warning=pais_not_exists';
                    } else {
                        $pais = new ModelPais();
                        $pais->id = $id;
                        $pais->status = $status;

                        $this->daoPais->updateStatus($pais);
                        $this->info = 'success=pais_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=pais_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $pais = new ModelPais();
            $pais->nome = strip_tags($_POST['nome']);
            $pais->todos = strip_tags($_POST['todos']);
            if ($pais->nome != null || $pais->todos) {
                try {
                    $paises = $this->daoPais->selectObjectsByContainsObject($pais);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/pais/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/pais/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $nome = strip_tags($_POST['nome']);
            $sigla = strip_tags($_POST['sigla']);
            $status = true;
            global $user_logged;
            $usuario_id = $user_logged->id;

            $pais = new ModelPais();
            $pais->nome = $nome;
            $pais->sigla = $sigla;
            $pais->status = $status;
            $pais->usuario_id = $usuario_id;
            try {
                $daoPais = new DAOPais();
                $daoPais->save($pais);
                $this->info = "success=pais_created";
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
                    $this->info = 'warning=pais_uninformed';
                }
                $nome = strip_tags($_POST['nome']);
                $sigla = strip_tags($_POST['sigla']);
                global $user_logged;
                $usuario_id = $user_logged->id;

                $pais = new ModelPais();
                $pais->id = $id;
                $pais->nome = $nome;
                $pais->sigla = $sigla;
                $pais->usuario_id = $usuario_id;

                try {
                    $this->daoPais->update($pais);
                    if ($pais == null) {
                        $this->info = 'warning=pais_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=pais_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
