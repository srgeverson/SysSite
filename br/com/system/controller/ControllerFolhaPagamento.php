<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOFolhaPagamento.php");
include_once server_path("br/com/system/model/ModelFolhaPagamento.php");

class ControllerFolhaPagamento {

    private $info;
    private $daoFolhaPagamento;

    function __construct() {
        $this->info = 'default=default';
        $this->daoFolhaPagamento = new DAOFolhaPagamento();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
            }
            try {
                $this->daoFolhaPagamento->delete($fopa_pk_id);
                $this->info = "success=folha_pagamento_deleted";
                $this->list();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (isset($fopa_pk_id)) {
                $fopa_status = false;
                try {
                    if (($this->daoFolhaPagamento->selectObjectById($fopa_pk_id)) === null) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                    } else {
                        $endereco = new ModelFolhaPagamento();
                        $endereco->fopa_pk_id = $fopa_pk_id;
                        $endereco->fopa_status = $fopa_status;

                        $this->daoFolhaPagamento->updateStatus($endereco);
                        $this->info = 'success=folha_pagamento_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=folha_pagamento_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $fopa_pk_id = $_GET['fopa_pk_id'];
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
                $this->list();
            }
            try {
                $daoEstado = new DAOEstado();
                $estados = $daoEstado->selectObjectsEnabled();
                $endereco = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                if (!isset($endereco)) {
                    $this->info = 'warning=folha_pagamento_not_exists';
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($endereco == false) {
                $this->info = "warning=folha_pagamento_not_found";
            }
            include_once server_path('br/com/system/view/folha_pagamento/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (isset($fopa_pk_id)) {
                $fopa_status = true;
                try {
                    if (($this->daoFolhaPagamento->selectObjectById($fopa_pk_id)) === null) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                    } else {
                        $endereco = new ModelFolhaPagamento();
                        $endereco->fopa_pk_id = $fopa_pk_id;
                        $endereco->fopa_status = $fopa_status;

                        $this->daoFolhaPagamento->updateStatus($endereco);
                        $this->info = 'success=folha_pagamento_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=folha_pagamento_uninformed';
            }
            $this->list();
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['fopa_logradouro']) && isset($_POST['fopa_cidade'])) {
                $endereco = new ModelFolhaPagamento();
                $endereco->fopa_logradouro = strip_tags($_POST['fopa_logradouro']);
                $endereco->fopa_cidade = strip_tags($_POST['fopa_cidade']);
                try {
                    $enderecos = $this->daoFolhaPagamento->selectObjectsByContainsObject($endereco);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/folha_pagamento/list.php');
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            $daoEstado = new DAOEstado();
            $estados = $daoEstado->selectObjectsEnabled();
            include_once server_path('br/com/system/view/folha_pagamento/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $fopa_logradouro = strip_tags($_POST['fopa_logradouro']);
            $fopa_numero = strip_tags($_POST['fopa_numero']);
            $fopa_bairro = strip_tags($_POST['fopa_bairro']);
            $fopa_cep = strip_tags($_POST['fopa_cep']);
            $fopa_cidade = strip_tags($_POST['fopa_cidade']);
            $fopa_fk_estado_pk_id = strip_tags($_POST['fopa_fk_estado_pk_id']);
            global $user_logged;
            $fopa_fk_user_pk_id = $user_logged->user_pk_id;
            $fopa_status = true;

            $endereco = new ModelFolhaPagamento();
            $endereco->fopa_logradouro = $fopa_logradouro;
            $endereco->fopa_numero = $fopa_numero;
            $endereco->fopa_bairro = $fopa_bairro;
            $endereco->fopa_cep = $fopa_cep;
            $endereco->fopa_cidade = $fopa_cidade;
            $endereco->fopa_fk_estado_pk_id = $fopa_fk_estado_pk_id;
            $endereco->fopa_fk_user_pk_id = $fopa_fk_user_pk_id;
            $endereco->fopa_status = $fopa_status;
            try {
                $daoFolhaPagamento = new DAOFolhaPagamento();
                $daoFolhaPagamento->save($endereco);
                $this->info = "success=folha_pagamento_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $fopa_pk_id = strip_tags($_POST['fopa_pk_id']);
                if (!isset($fopa_pk_id)) {
                    $this->info = 'warning=folha_pagamento_uninformed';
                }
                $fopa_logradouro = strip_tags($_POST['fopa_logradouro']);
                $fopa_numero = strip_tags($_POST['fopa_numero']);
                $fopa_bairro = strip_tags($_POST['fopa_bairro']);
                $fopa_cep = strip_tags($_POST['fopa_cep']);
                $fopa_cidade = strip_tags($_POST['fopa_cidade']);
                $fopa_fk_estado_pk_id = strip_tags($_POST['fopa_fk_estado_pk_id']);
                global $user_logged;
                $fopa_fk_user_pk_id = $user_logged->user_pk_id;

                $endereco = new ModelFolhaPagamento();
                $endereco->fopa_pk_id = $fopa_pk_id;
                $endereco->fopa_logradouro = $fopa_logradouro;
                $endereco->fopa_numero = $fopa_numero;
                $endereco->fopa_bairro = $fopa_bairro;
                $endereco->fopa_cep = $fopa_cep;
                $endereco->fopa_cidade = $fopa_cidade;
                $endereco->fopa_fk_estado_pk_id = $fopa_fk_estado_pk_id;
                $endereco->fopa_fk_user_pk_id = $fopa_fk_user_pk_id;

                try {
                    $this->daoFolhaPagamento->update($endereco);
                    if ($endereco == null) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=folha_pagamento_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

}
