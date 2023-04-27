<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOCidade.php");
include_once server_path("dao/DAOEndereco.php");
include_once server_path("dao/DAOEstado.php");
include_once server_path("model/ModelCidade.php");
include_once server_path("model/ModelEndereco.php");

class ControllerEndereco {

    private $info;
    private $daoEndereco;
    private $daoCidade;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoEndereco = new DAOEndereco();
        $this->daoCidade = new DAOCidade();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=endereco_uninformed';
            }
            try {
                $this->daoEndereco->delete($id);
                $this->info = "success=endereco_deleted";
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
                    if (($this->daoEndereco->selectObjectById($id)) === null) {
                        $this->info = 'warning=endereco_not_exists';
                    } else {
                        $endereco = new ModelEndereco();
                        $endereco->id = $id;
                        $endereco->status = $status;

                        $this->daoEndereco->updateStatus($endereco);
                        $this->info = 'success=endereco_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=endereco_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=endereco_uninformed';
                $this->listar();
            }
            try {
                $cidades = $this->daoCidade->selectObjectsEnabledWithEstados();
                $endereco = $this->daoEndereco->selectObjectById($id);
                if (!isset($endereco)) {
                    $this->info = 'warning=endereco_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($endereco == false) {
                $this->info = "warning=endereco_not_found";
            }
            include_once server_path('view/endereco/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoEndereco->selectObjectById($id)) === null) {
                        $this->info = 'warning=endereco_not_exists';
                    } else {
                        $endereco = new ModelEndereco();
                        $endereco->id = $id;
                        $endereco->status = $status;

                        $this->daoEndereco->updateStatus($endereco);
                        $this->info = 'success=endereco_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=endereco_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $endereco = new ModelEndereco();
            $endereco->logradouro = strip_tags($_POST['logradouro']);
            $endereco->cidade_id =strip_tags($_POST['cidade_id']);
            $endereco->todos =strip_tags($_POST['todos']);
            $cidades = $this->daoCidade->selectObjectsEnabledWithEstados();
            if ($endereco->logradouro != null && $endereco->cidade_id != null || $endereco->todos) {
                try {
                    $enderecos = $this->daoEndereco->selectObjectsByContainsObject($endereco);
                } catch (Exception $erro) {
                    print_r($erro);
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/endereco/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            try {
                $cidades = $this->daoCidade->selectObjectsEnabledWithEstados();
                include_once server_path('view/endereco/new.php');
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            try {
                $endereco = new ModelEndereco();
                $endereco->logradouro = strip_tags($_POST['logradouro']);
                $endereco->numero = strip_tags($_POST['numero']);
                $endereco->bairro = strip_tags($_POST['bairro']);
                $endereco->cep = strip_tags($_POST['cep']);
                $endereco->cidade_id =strip_tags($_POST['cidade_id']);
                global $user_logged;
                $endereco->usuario_id = $user_logged->id;
                $endereco->status = true;
                $daoEndereco = new DAOEndereco();
                $daoEndereco->save($endereco);
                $this->info = "success=endereco_created";
            } catch (Exception $erro) {
                // print_r($erro);
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
                    $this->info = 'warning=endereco_uninformed';
                }
                $logradouro = strip_tags($_POST['logradouro']);
                $numero = strip_tags($_POST['numero']);
                $bairro = strip_tags($_POST['bairro']);
                $cep = strip_tags($_POST['cep']);
                $cidade_id = strip_tags($_POST['cidade_id']);
                $estado_id = strip_tags($_POST['estado_id']);
                global $user_logged;
                $usuario_id = $user_logged->id;

                $endereco = new ModelEndereco();
                $endereco->id = $id;
                $endereco->logradouro = $logradouro;
                $endereco->numero = $numero;
                $endereco->bairro = $bairro;
                $endereco->cep = $cep;
                $endereco->cidade_id = $cidade_id;
                $endereco->estado_id = $estado_id;
                $endereco->usuario_id = $usuario_id;

                try {
                    $this->daoEndereco->update($endereco);
                    if ($endereco == null) {
                        $this->info = 'warning=endereco_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=endereco_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
