<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOEndereco.php");
include_once server_path("br/com/system/dao/DAOEstado.php");
include_once server_path("br/com/system/model/ModelEndereco.php");

class ControllerEndereco {

    private $info;
    private $daoEndereco;

    function __construct() {
        $this->info = 'default=default';
        $this->daoEndereco = new DAOEndereco();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $ende_pk_id = strip_tags($_GET['ende_pk_id']);
            if (!isset($ende_pk_id)) {
                $this->info = 'warning=endereco_uninformed';
            }
            try {
                $this->daoEndereco->delete($ende_pk_id);
                $this->info = "success=endereco_deleted";
                $this->listar();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $ende_pk_id = strip_tags($_GET['ende_pk_id']);
            if (isset($ende_pk_id)) {
                $ende_status = false;
                try {
                    if (($this->daoEndereco->selectObjectById($ende_pk_id)) === null) {
                        $this->info = 'warning=endereco_not_exists';
                    } else {
                        $endereco = new ModelEndereco();
                        $endereco->ende_pk_id = $ende_pk_id;
                        $endereco->ende_status = $ende_status;

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
            $ende_pk_id = $_GET['ende_pk_id'];
            if (!isset($ende_pk_id)) {
                $this->info = 'warning=endereco_uninformed';
                $this->listar();
            }
            try {
                $daoEstado = new DAOEstado();
                $estados = $daoEstado->selectObjectsEnabled();
                $endereco = $this->daoEndereco->selectObjectById($ende_pk_id);
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
            include_once server_path('br/com/system/view/endereco/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $ende_pk_id = strip_tags($_GET['ende_pk_id']);
            if (isset($ende_pk_id)) {
                $ende_status = true;
                try {
                    if (($this->daoEndereco->selectObjectById($ende_pk_id)) === null) {
                        $this->info = 'warning=endereco_not_exists';
                    } else {
                        $endereco = new ModelEndereco();
                        $endereco->ende_pk_id = $ende_pk_id;
                        $endereco->ende_status = $ende_status;

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
            if (isset($_POST['ende_logradouro']) && isset($_POST['ende_cidade'])) {
                $endereco = new ModelEndereco();
                $endereco->ende_logradouro = strip_tags($_POST['ende_logradouro']);
                $endereco->ende_cidade = strip_tags($_POST['ende_cidade']);
                try {
                    $enderecos = $this->daoEndereco->selectObjectsByContainsObject($endereco);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/endereco/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            include_once server_path('br/com/system/view/endereco/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $ende_logradouro = strip_tags($_POST['ende_logradouro']);
            $ende_numero = strip_tags($_POST['ende_numero']);
            $ende_bairro = strip_tags($_POST['ende_bairro']);
            $ende_cep = strip_tags($_POST['ende_cep']);
            $ende_cidade = strip_tags($_POST['ende_cidade']);
            $ende_fk_estado_pk_id = strip_tags($_POST['ende_fk_estado_pk_id']);
            global $user_logged;
            $ende_fk_id = $user_logged->id;
            $ende_status = true;

            $endereco = new ModelEndereco();
            $endereco->ende_logradouro = $ende_logradouro;
            $endereco->ende_numero = $ende_numero;
            $endereco->ende_bairro = $ende_bairro;
            $endereco->ende_cep = $ende_cep;
            $endereco->ende_cidade = $ende_cidade;
            $endereco->ende_fk_estado_pk_id = $ende_fk_estado_pk_id;
            $endereco->ende_fk_id = $ende_fk_id;
            $endereco->ende_status = $ende_status;
            try {
                $daoEndereco = new DAOEndereco();
                $daoEndereco->save($endereco);
                $this->info = "success=endereco_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $ende_pk_id = strip_tags($_POST['ende_pk_id']);
                if (!isset($ende_pk_id)) {
                    $this->info = 'warning=endereco_uninformed';
                }
                $ende_logradouro = strip_tags($_POST['ende_logradouro']);
                $ende_numero = strip_tags($_POST['ende_numero']);
                $ende_bairro = strip_tags($_POST['ende_bairro']);
                $ende_cep = strip_tags($_POST['ende_cep']);
                $ende_cidade = strip_tags($_POST['ende_cidade']);
                $ende_fk_estado_pk_id = strip_tags($_POST['ende_fk_estado_pk_id']);
                global $user_logged;
                $ende_fk_id = $user_logged->id;

                $endereco = new ModelEndereco();
                $endereco->ende_pk_id = $ende_pk_id;
                $endereco->ende_logradouro = $ende_logradouro;
                $endereco->ende_numero = $ende_numero;
                $endereco->ende_bairro = $ende_bairro;
                $endereco->ende_cep = $ende_cep;
                $endereco->ende_cidade = $ende_cidade;
                $endereco->ende_fk_estado_pk_id = $ende_fk_estado_pk_id;
                $endereco->ende_fk_id = $ende_fk_id;

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
