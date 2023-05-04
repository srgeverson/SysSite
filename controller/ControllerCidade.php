<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOCidade.php");
include_once server_path("dao/DAOEstado.php");
include_once server_path("model/ModelCidade.php");

class ControllerCidade {

    private $info;
    private $daoCidade;
    private $daoEstado;
    private $usuarioAutencitado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoCidade = new DAOCidade();
        $this->daoEstado = new DAOEstado();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            try {
                $id = strip_tags($_GET['id']);
                if (!isset($id)) {
                    $this->info = 'warning=cidade_uninformed';
                }
                $this->daoCidade->delete($id);
                $this->info = "success=cidade_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                $this->listar();
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            try {
                $cidade = new ModelCidade();
                $cidade->id = strip_tags($_GET['id']);
                $cidade->status = false;
                $cidade->usuario_id = $this->usuarioAutenticado->id;
                $existente = $this->daoCidade->selectObjectById($cidade->id);
                if ($existente) {
                    $this->daoCidade->updateStatus($cidade);
                    $this->info = 'success=cidade_disabled';
                } else if (!$cidade->id) 
                    $this->info = 'warning=cidade_uninformed';
                else
                    $this->info = 'warning=cidade_not_exists';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                $this->listar();
            }
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
           try {
                $id = strip_tags($_GET['id']);

                if (isset($id)){
                    $cidade = $this->daoCidade->selectObjectById($id);
                    if($cidade){
                        $cidade->estados = $this->daoEstado->selectObjectsEnabled();
                    } else
                        $this->info = "warning=cidade_not_found";
                } else 
                    $this->info = 'warning=cidade_uninformed';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                if (isset($this->info))
                    HelperController::valid_messages($this->info);
                include_once server_path('view/cidade/edit.php');
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            try {
                $cidade = new ModelCidade();
                $cidade->id = strip_tags($_GET['id']);
                $cidade->status = true;
                $cidade->usuario_id = $this->usuarioAutenticado->id;
                $existente = $this->daoCidade->selectObjectById($cidade->id);
                if ($existente) {
                    $this->daoCidade->updateStatus($cidade);
                    $this->info = 'success=cidade_enabled';
                } else if (!$cidade->id) 
                    $this->info = 'warning=cidade_uninformed';
                else
                    $this->info = 'warning=cidade_not_exists';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                $this->listar();
            }
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $cidade = new ModelCidade();
            $cidade->nome = strip_tags($_POST['nome']);
            $cidade->todos = strip_tags($_POST['todos']);
            if ($cidade->nome != null || $cidade->todos) {
                try {
                    $cidadees = $this->daoCidade->selectObjectsByContainsObject($cidade);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/cidade/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $cidade = new ModelCidade();
            $cidade->estados = $this->daoEstado->selectObjectsEnabled();
            include_once server_path('view/cidade/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            try {
                $cidade = new ModelCidade();
                $cidade->nome = strip_tags($_POST['nome']);
                $cidade->codigo = strip_tags($_POST['codigo']);
                $cidade->estado_id = strip_tags($_POST['estado_id']);
                $cidade->status = true;
                $cidade->usuario_id = $this->usuarioAutenticado->id;
                $this->daoCidade->save($cidade);
                $this->info = "success=cidade_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                $this->listar();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            try {
                $cidade = new ModelCidade();
                $cidade->id = strip_tags($_POST['id']);
                $cidade->nome = strip_tags($_POST['nome']);
                $cidade->codigo = strip_tags($_POST['codigo']);
                $cidade->estado_id = strip_tags($_POST['estado_id']);
                $cidade->usuario_id = $this->usuarioAutenticado->id;
                
                if ($cidade) {
                    $this->daoCidade->update($cidade);
                    $this->info = 'success=cidade_updated';
                } else if (!$cidade->id) 
                    $this->info = 'warning=cidade_uninformed';
                else
                    $this->info = 'warning=cidade_not_exists';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                $this->listar();
            }
        }
    }

}
