<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOFolhaPagamento.php");
include_once server_path("br/com/system/dao/DAOFuncionario.php");
include_once server_path("br/com/system/model/ModelFolhaPagamento.php");

class ControllerFolhaPagamento {

    private $info;
    private $daoFolhaPagamento;
    private $usuarioAutencitado;

    //ok
    function __construct() {
        $this->info = 'default=default';
        $this->daoFolhaPagamento = new DAOFolhaPagamento();
        global $user_logged;
        $this->usuarioAutencitado = $user_logged->user_pk_id;
    }

    //ok
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

    //ok
    public function disable() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (isset($fopa_pk_id)) {
                $fopa_status = false;
                try {
                    if (($this->daoFolhaPagamento->selectObjectById($fopa_pk_id)) === null) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                    } else {
                        $folhaPagamento = new ModelFolhaPagamento();
                        $folhaPagamento->fopa_pk_id = $fopa_pk_id;
                        $folhaPagamento->fopa_status = $fopa_status;

                        $this->daoFolhaPagamento->updateStatus($folhaPagamento);
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

    //ok
    public function edit() {
        if (GenericController::authotity()) {
            $fopa_pk_id = $_GET['fopa_pk_id'];
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
                $this->list();
            } else {
                try {
                    $daoFuncionario = new DAOFuncionario();
                    $funcionarios = $daoFuncionario->selectObjectsEnabled();
                    $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                    if (!isset($folhaPagamento)) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                        $this->list();
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                    $this->list();
                }
                if ($folhaPagamento == false) {
                    $this->info = "warning=folha_pagamento_not_found";
                    $this->list();
                }
                include_once server_path('br/com/system/view/folha_pagamento/edit.php');
            }
        }
    }

    //ok
    public function enable() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (isset($fopa_pk_id)) {
                $fopa_status = true;
                try {
                    if (($this->daoFolhaPagamento->selectObjectById($fopa_pk_id)) === null) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                    } else {
                        $folhaPagamento = new ModelFolhaPagamento();
                        $folhaPagamento->fopa_pk_id = $fopa_pk_id;
                        $folhaPagamento->fopa_status = $fopa_status;

                        $this->daoFolhaPagamento->updateStatus($folhaPagamento);
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

    //ok
    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['func_nome']) && isset($_POST['func_cpf']) && isset($_POST['fopa_competencia'])) {
                $folhaPagamento = new ModelFolhaPagamento();
                $folhaPagamento->func_nome = strip_tags($_POST['func_nome']);
                $folhaPagamento->func_cpf = strip_tags($_POST['func_cpf']);
                $folhaPagamento->fopa_competencia = strip_tags($_POST['fopa_competencia']);
                try {
                    $folhaPagamentos = $this->daoFolhaPagamento->selectObjectsByContainsObject($folhaPagamento);
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

    //ok
    public function new() {
        if (GenericController::authotity()) {
            $daoFuncionario = new DAOFuncionario();
            $funcionarios = $daoFuncionario->selectObjectsEnabled();
            include_once server_path('br/com/system/view/folha_pagamento/new.php');
        }
    }

    //ok
    public function save() {
        if (GenericController::authotity()) {
            $fopa_competencia = strip_tags($_POST['fopa_competencia']);
            //Início->Tratando arquivo para upload 
            $fopa_arquivo = strip_tags($_POST['fopa_arquivo']);
            $user_image = $_FILES['user_image']['name'];
            $uploaddir = server_path('br/com/system/uploads/folha_pagamento/');
            $uploadfile = $uploaddir . $user_image;
            $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);
            //Fim->Tratando arquivo para upload 
            $fopa_caminho_arquivo = strip_tags($_POST['fopa_caminho_arquivo']);
            $fopa_fk_funcionario_pk_id = strip_tags($_POST['fopa_fk_funcionario_pk_id']);
            $fopa_status = true;

            $folhaPagamento = new ModelFolhaPagamento();
            $folhaPagamento->fopa_competencia = $fopa_competencia;
            $folhaPagamento->fopa_arquivo = $fopa_arquivo;
            $folhaPagamento->fopa_caminho_arquivo = $fopa_caminho_arquivo;
            $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
            $folhaPagamento->fopa_fk_user_pk_id = $this->usuarioAutencitado;
            $folhaPagamento->fopa_status = $fopa_status;
            try {
                $this->daoFolhaPagamento->save($folhaPagamento);
                $this->info = "success=folha_pagamento_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    //ok
    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $fopa_pk_id = strip_tags($_POST['fopa_pk_id']);
                if (!isset($fopa_pk_id)) {
                    $this->info = 'warning=folha_pagamento_uninformed';
                }
                $fopa_competencia = strip_tags($_POST['fopa_competencia']);
                $fopa_arquivo = strip_tags($_POST['fopa_arquivo']);
                $fopa_caminho_arquivo = strip_tags($_POST['fopa_caminho_arquivo']);
                $fopa_fk_funcionario_pk_id = strip_tags($_POST['fopa_fk_funcionario_pk_id']);

                $folhaPagamento = new ModelFolhaPagamento();
                $folhaPagamento->fopa_pk_id = $fopa_pk_id;
                $folhaPagamento->fopa_competencia = $fopa_competencia;
                $folhaPagamento->fopa_arquivo = $fopa_arquivo;
                $folhaPagamento->fopa_caminho_arquivo = $fopa_caminho_arquivo;
                $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                $folhaPagamento->fopa_fk_user_pk_id = $this->usuarioAutencitado;

                try {
                    $this->daoFolhaPagamento->update($folhaPagamento);
                    if ($folhaPagamento == null) {
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

    public function view() {
        if (GenericController::authotity()) {
            $fopa_pk_id = $_GET['fopa_pk_id'];
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
                $this->list();
            } else {
                try {
                    $daoFuncionario = new DAOFuncionario();
                    $funcionarios = $daoFuncionario->selectObjectsEnabled();
                    $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                    if (!isset($folhaPagamento)) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                        $this->list();
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                    $this->list();
                }
                if ($folhaPagamento == false) {
                    $this->info = "warning=folha_pagamento_not_found";
                    $this->list();
                }
                include_once server_path('br/com/system/view/folha_pagamento/view.php');
            }
        }
    }

}
