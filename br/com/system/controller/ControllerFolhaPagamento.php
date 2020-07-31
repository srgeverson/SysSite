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

    function __construct() {
        $this->info = 'default=default';
        $this->daoFolhaPagamento = new DAOFolhaPagamento();
        global $user_logged;
        if (isset($user_logged)) {
            $this->usuarioAutencitado = $user_logged->user_pk_id;
        }
    }

    public function delete() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
            }
            try {
                $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                if (unlink(server_path($folhaPagamento->fopa_caminho_arquivo))) {
                    $this->daoFolhaPagamento->delete($folhaPagamento->fopa_pk_id);
                    $this->info = "success=folha_pagamento_deleted";
                } else {
                    $this->info = 'error=folha_pagamento_not_deleted';
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
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

    //Em desenvolvimento
    public function downloadFile() {
        if (GenericController::authotity()) {
            try {
                $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
                if (!isset($fopa_pk_id)) {
                    $this->info = 'warning=folha_pagamento_uninformed';
                    $this->list();
                }

                $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);

                $file = fopen($folhaPagamento->fopa_arquivo, "a+");
                fwrite($file, hex2bin($folhaPagamento->fopa_arquivo));
                fclose($file);

                //Forçando o download...
                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=" . $folhaPagamento->fopa_caminho_arquivo);
                //header("Content-Length: " . $doc->get('tamanho_documento'));
                header("Content-Transfer-Encoding: binary");
                readfile($folhaPagamento->fopa_arquivo);

                //Apagando o arquivo
                unlink($folhaPagamento->fopa_arquivo);

                function hex2bin($str) {
                    $bin = "";
                    $i = 0;
                    do {
                        $bin .= chr(hexdec($str{$i} . $str{($i + 1)}));
                        $i += 2;
                    } while ($i < strlen($str));
                    return $bin;
                }

            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
                $this->list();
            }
        }
    }

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

    public function new() {
        if (GenericController::authotity()) {
            $daoFuncionario = new DAOFuncionario();
            $funcionarios = $daoFuncionario->selectObjectsEnabled();
            include_once server_path('br/com/system/view/folha_pagamento/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $fopa_competencia = strip_tags($_POST['fopa_competencia']);
            //Início->Tratando arquivo para upload 
            if (isset($_FILES["fopa_arquivo"])) {
                $arquivo_temporario = $_FILES['fopa_arquivo']['tmp_name'];
                $fopa_nome_arquivo = $_FILES['fopa_arquivo']['name'];
                $extensao = pathinfo($fopa_nome_arquivo, PATHINFO_EXTENSION);
                $extensao = strtolower($extensao);
                $uploaddir = server_path('br/com/system/uploads/folha_pagamento/');
                $novo_nome = uniqid(time()) . '.' . $extensao;
                $uploadfile = $uploaddir . $novo_nome;

                $abreArquivo = fopen($arquivo_temporario, 'rb');
                $lerArquivo = fread($abreArquivo, filesize($arquivo_temporario));
                fclose($abreArquivo);
                $fopa_arquivo = bin2hex($lerArquivo);
            }
            //Fim->Tratando arquivo para upload 
            $fopa_fk_funcionario_pk_id = strip_tags($_POST['fopa_fk_funcionario_pk_id']);
            $fopa_status = true;

            if (strstr('.pdf', $extensao)) {
                if (move_uploaded_file($arquivo_temporario, $uploadfile)) {
                    $folhaPagamento = new ModelFolhaPagamento();
                    $folhaPagamento->fopa_competencia = $fopa_competencia;
                    $folhaPagamento->fopa_arquivo = $fopa_arquivo;
                    $folhaPagamento->fopa_nome_arquivo = $novo_nome;
                    $folhaPagamento->fopa_caminho_arquivo = 'br/com/system/uploads/folha_pagamento/' . $novo_nome;
                    $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                    $folhaPagamento->fopa_fk_user_pk_id = $this->usuarioAutencitado;
                    $folhaPagamento->fopa_status = $fopa_status;
                    try {
                        $this->daoFolhaPagamento->save($folhaPagamento);
                        $this->info = "success=folha_pagamento_created";
                    } catch (Exception $erro) {
                        $this->info = "error=" . $erro->getMessage();
                    }
                }
            } else {
                echo '<script>alert("Arquivo não aceito!")</script>';
                redirect("javascript:window.history.go(-1)");
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            $fopa_pk_id = strip_tags($_POST['fopa_pk_id']);
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
            } else {
                $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                $fopa_competencia = strip_tags($_POST['fopa_competencia']);
                //Início->Tratando arquivo para upload 
                if (isset($_FILES["fopa_arquivo"])) {
                    $arquivo_temporario = $_FILES['fopa_arquivo']['tmp_name'];
                    $fopa_nome_arquivo = $_FILES['fopa_arquivo']['name'];
                    $extensao = pathinfo($fopa_nome_arquivo, PATHINFO_EXTENSION);
                    $extensao = strtolower($extensao);
                    $uploaddir = server_path('br/com/system/uploads/folha_pagamento/');
                    $novo_nome = uniqid(time()) . '.' . $extensao;
                    $uploadfile = $uploaddir . $novo_nome;

                    $abreArquivo = fopen($arquivo_temporario, 'rb');
                    $lerArquivo = fread($abreArquivo, filesize($arquivo_temporario));
                    fclose($abreArquivo);
                    $fopa_arquivo = bin2hex($lerArquivo);

                    //Fim->Tratando arquivo para upload 
                    $fopa_fk_funcionario_pk_id = strip_tags($_POST['fopa_fk_funcionario_pk_id']);

                    if (strstr('.pdf', $extensao)) {
                        unlink(server_path($folhaPagamento->fopa_caminho_arquivo));
                        if (move_uploaded_file($arquivo_temporario, $uploadfile)) {
                            $folhaPagamento = new ModelFolhaPagamento();
                            $folhaPagamento->fopa_pk_id = $fopa_pk_id;
                            $folhaPagamento->fopa_competencia = $fopa_competencia;
                            $folhaPagamento->fopa_arquivo = $fopa_arquivo;
                            $folhaPagamento->fopa_nome_arquivo = $novo_nome;
                            $folhaPagamento->fopa_caminho_arquivo = 'br/com/system/uploads/folha_pagamento/' . $novo_nome;
                            $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                            $folhaPagamento->fopa_fk_user_pk_id = $this->usuarioAutencitado;

                            try {
                                $this->daoFolhaPagamento->update($folhaPagamento);
                                if ($folhaPagamento == null) {
                                    $this->info = 'warning=folha_pagamento_not_exists';
                                } else {
                                    $this->info = 'success=folha_pagamento_updated';
                                }
                            } catch (Exception $erro) {
                                $this->info = "error=" . $erro->getMessage();
                            }
                        }
                    } else {
                        echo '<script>alert("Arquivo não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                }
            }
            $this->list();
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
