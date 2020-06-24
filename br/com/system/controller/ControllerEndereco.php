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

    //ok
    public function delete() {
        if (GenericController::authotity()) {
            $ende_pk_id = strip_tags($_GET['ende_pk_id']);
            if (!isset($ende_pk_id)) {
                $this->info = 'warning=endereco_uninformed';
            }
            try {
                $this->daoEndereco->delete($ende_pk_id);
                $this->info = "success=endereco_deleted";
                $this->list();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    //ok
    public function disable() {
        if (GenericController::authotity()) {
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
            $this->list();
        }
    }

    //ok
    public function edit() {
        if (GenericController::authotity()) {
            $ende_pk_id = $_GET['ende_pk_id'];
            if (!isset($ende_pk_id)) {
                $this->info = 'warning=endereco_uninformed';
                $this->list();
            }
            try {
                $daoEstado = new DAOEstado();
                $estados = $daoEstado->selectObjectsEnabled();
                $endereco = $this->daoEndereco->selectObjectById($ende_pk_id);
                if (!isset($endereco)) {
                    $this->info = 'warning=endereco_not_exists';
                    $this->list();
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

    //ok
    public function enable() {
        if (GenericController::authotity()) {
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
            $this->list();
        }
    }

    //ok
    public function list() {
        if (GenericController::authotity()) {
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
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/endereco/list.php');
        }
    }

    //ok
    public function new() {
        if (GenericController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            include_once server_path('br/com/system/view/endereco/new.php');
        }
    }

    //ok
    public function save() {
        if (GenericController::authotity()) {
            $ende_logradouro = strip_tags($_POST['ende_logradouro']);
            $ende_numero = strip_tags($_POST['ende_numero']);
            $ende_bairro = strip_tags($_POST['ende_bairro']);
            $ende_cep = strip_tags($_POST['ende_cep']);
            $ende_cidade = strip_tags($_POST['ende_cidade']);
            $ende_fk_estado_pk_id = strip_tags($_POST['ende_fk_estado_pk_id']);
            global $user_logged;
            $ende_fk_user_pk_id = $user_logged->user_pk_id;
            $ende_status = true;

            $endereco = new ModelEndereco();
            $endereco->ende_logradouro = $ende_logradouro;
            $endereco->ende_numero = $ende_numero;
            $endereco->ende_bairro = $ende_bairro;
            $endereco->ende_cep = $ende_cep;
            $endereco->ende_cidade = $ende_cidade;
            $endereco->ende_fk_estado_pk_id = $ende_fk_estado_pk_id;
            $endereco->ende_fk_user_pk_id = $ende_fk_user_pk_id;
            $endereco->ende_status = $ende_status;
            try {
                $daoEndereco = new DAOEndereco();
                $daoEndereco->save($endereco);
                $this->info = "success=endereco_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
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
                $ende_fk_user_pk_id = $user_logged->user_pk_id;

                $endereco = new ModelEndereco();
                $endereco->ende_pk_id = $ende_pk_id;
                $endereco->ende_logradouro = $ende_logradouro;
                $endereco->ende_numero = $ende_numero;
                $endereco->ende_bairro = $ende_bairro;
                $endereco->ende_cep = $ende_cep;
                $endereco->ende_cidade = $ende_cidade;
                $endereco->ende_fk_estado_pk_id = $ende_fk_estado_pk_id;
                $endereco->ende_fk_user_pk_id = $ende_fk_user_pk_id;

                try {
                    $this->daoEndereco->update($endereco);
                    if ($endereco == null) {
                        $this->info = 'warning=endereco_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=endereco_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

}
