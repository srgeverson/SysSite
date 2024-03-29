<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path('assets/php/PdfToText/PdfToText.phpclass');
include_once server_path("dao/DAOFolhaPagamento.php");
include_once server_path("dao/DAOFuncionario.php");
include_once server_path("model/ModelFolhaPagamento.php");

class ControllerFolhaPagamento {

    private $info;
    private $daoFolhaPagamento;
    private $usuarioAutenticado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoFolhaPagamento = new DAOFolhaPagamento();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
            } else {
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
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    //Em desenvolvimento
    public function downloadFile() {
        if (HelperController::authotity()) {
            try {
                $fopa_pk_id = strip_tags($_GET['fopa_pk_id']);
                if (!isset($fopa_pk_id)) {
                    $this->info = 'warning=folha_pagamento_uninformed';
                    $this->listar();
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
                        $bin .= chr(hexdec($str[$i] . $str[($i + 1)]));
                        $i += 2;
                    } while ($i < strlen($str));
                    return $bin;
                }

            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
                $this->listar();
            }
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $fopa_pk_id = $_GET['fopa_pk_id'];
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
                $this->listar();
            } else {
                try {
                    $daoFuncionario = new DAOFuncionario();
                    $funcionarios = $daoFuncionario->selectObjectsEnabled();
                    $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                    if (!isset($folhaPagamento)) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                        $this->listar();
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                    $this->listar();
                }
                if ($folhaPagamento == false) {
                    $this->info = "warning=folha_pagamento_not_found";
                    $this->listar();
                }
                include_once server_path('view/folha_pagamento/edit.php');
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
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
            $this->listar();
        }
    }

    public function filterByFuncionario() {
        if (HelperController::authotity()) {
            if (isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['fopa_competencia'])) {
                $folhaPagamento = new ModelFolhaPagamento();
                $folhaPagamento->nome = strip_tags($_POST['nome']);
                $folhaPagamento->cpf = strip_tags($_POST['cpf']);
                $folhaPagamento->fopa_competencia = strip_tags($_POST['fopa_competencia']);
                try {
                    $folhaPagamentos = $this->daoFolhaPagamento->selectObjectsByContainsObject($folhaPagamento);
                    $permissao = $this->usuarioAutenticado->user_fk_permissao_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/folha_pagamento/listByFuncionario.php');
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['fopa_competencia'])) {
                $folhaPagamento = new ModelFolhaPagamento();
                $folhaPagamento->nome = strip_tags($_POST['nome']);
                $folhaPagamento->cpf = strip_tags($_POST['cpf']);
                $folhaPagamento->fopa_competencia = strip_tags($_POST['fopa_competencia']);
                try {
                    $folhaPagamentos = $this->daoFolhaPagamento->selectObjectsByContainsObject($folhaPagamento);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/folha_pagamento/list.php');
        }
    }

    public function listEnableds() {
        if (HelperController::authotity()) {
            $folhaPagamentos = null;
            try {
                $folhaPagamentos = $this->daoFolhaPagamento->selectObjectsEnabled();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $folhaPagamentos;
        }
    }

    public function listEnabledsByFuncionario($fopa_fk_funcionario_pk_id) {
        if (HelperController::authotity()) {
            $folhaPagamentos = null;
            try {
                $folhaPagamentos = $this->daoFolhaPagamento->selectObjectsEnabledByFuncionario($fopa_fk_funcionario_pk_id);
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            return $folhaPagamentos;
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/folha_pagamento/new.php');
        }
    }

    public function novoLote() {
        if (HelperController::authotity()) {
            include_once server_path('view/folha_pagamento/batch.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $fopa_competencia = strip_tags($_POST['fopa_competencia']);
            if (isset($_FILES["fopa_arquivo"])) {
                $arquivo_temporario = $_FILES['fopa_arquivo']['tmp_name'];
                $fopa_nome_arquivo = $_FILES['fopa_arquivo']['name'];
                $extensao = pathinfo($fopa_nome_arquivo, PATHINFO_EXTENSION);
                $extensao = strtolower($extensao);
                $uploaddir = server_path('uploads/folha_pagamento/');
                $novo_nome = uniqid(time()) . '.' . $extensao;
                $uploadfile = $uploaddir . $novo_nome;

                $daoFuncionario = new DAOFuncionario();
                $funcionarios = $daoFuncionario->selectObjectsEnabled();
                if (!empty($funcionarios)) {
                    foreach ($funcionarios as $each_funcionario) {
                        if ($this->searchCPFInFile($arquivo_temporario, $each_funcionario->cpf)) {
                            $fopa_fk_funcionario_pk_id = $each_funcionario->id;
                            $fopa_status = true;
                            if (strstr('.pdf', $extensao)) {
                                if (move_uploaded_file($arquivo_temporario, $uploadfile)) {
                                    $folhaPagamento = new ModelFolhaPagamento();
                                    $folhaPagamento->fopa_competencia = $fopa_competencia;
                                    $folhaPagamento->fopa_arquivo = null;
                                    $folhaPagamento->fopa_nome_arquivo = $novo_nome;
                                    $folhaPagamento->fopa_caminho_arquivo = 'uploads/folha_pagamento/' . $novo_nome;
                                    $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                                    $folhaPagamento->fopa_fk_id = $this->usuarioAutenticado->id;
                                    $folhaPagamento->fopa_status = $fopa_status;
                                    try {
                                        $this->daoFolhaPagamento->save($folhaPagamento);
                                        $this->info = "success=folha_pagamento_created";
                                    } catch (Exception $erro) {
                                        $this->info = "error=" . $erro->getMessage();
                                    }
                                }
                            }
                            break;
                        } else {
                            $this->info = "warning=Contra cheque não pertence a nenhum funcionário";
                        }
                    }
                } else {
                    $this->info = "warning=Não existe funcionários cadastrados/habilitados";
                }
            }
            $this->listar();
        }
    }

    public function saveBatch() {
        if (HelperController::authotity()) {
            $countFileNotUpload = 0;
            $countFileUpload = 0;
            $fopa_competencia = strip_tags($_POST['fopa_competencia']);
            $arquivos = $_FILES["fopa_arquivo"];
            if (isset($arquivos)) {
                $daoFuncionario = new DAOFuncionario();
                $funcionarios = $daoFuncionario->selectObjectsEnabled();
                if (!empty($funcionarios)) {
                    for ($index = 0; $index < count($arquivos['name']); $index++) {
                        foreach ($funcionarios as $each_funcionario) {
                            if ($this->searchCPFInFile($arquivos['tmp_name'][$index], $each_funcionario->cpf)) {
                                $extensao = pathinfo($arquivos['name'][$index], PATHINFO_EXTENSION);
                                $extensao = strtolower($extensao);
                                $uploaddir = server_path('uploads/folha_pagamento/');
                                $novo_nome = uniqid(time()) . '.' . $extensao;
                                $uploadfile = $uploaddir . $novo_nome;

                                $fopa_fk_funcionario_pk_id = $each_funcionario->id;
                                $fopa_status = true;
                                if (strstr('.pdf', $extensao)) {
                                    if (move_uploaded_file($arquivos['tmp_name'][$index], $uploadfile)) {
                                        $folhaPagamento = new ModelFolhaPagamento();
                                        $folhaPagamento->fopa_competencia = $fopa_competencia;
                                        $folhaPagamento->fopa_arquivo = null;
                                        $folhaPagamento->fopa_nome_arquivo = $novo_nome;
                                        $folhaPagamento->fopa_caminho_arquivo = 'uploads/folha_pagamento/' . $novo_nome;
                                        $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                                        $folhaPagamento->fopa_fk_id = $this->usuarioAutenticado->id;
                                        $folhaPagamento->fopa_status = $fopa_status;
                                        try {
                                            $this->daoFolhaPagamento->save($folhaPagamento);
                                            $countFileUpload++;
                                        } catch (Exception $erro) {
                                            $this->info = "error=" . $erro->getMessage();
                                        }
                                    } else {
                                        $countFileNotUpload++;
                                    }
                                }
                                break;
                            }
                        }
                    }
                    $this->info = 'success=' . $countFileUpload . ' Arquivos salvos, e ' . $countFileNotUpload . ' Arquivos descartados.';
                } else {
                    $this->info = "warning=Não existe funcionários cadastrados/habilitados";
                }
            }
            $this->listar();
        }
    }

    public function searchCPFInFile($arquivo, $cpf) {
        if (HelperController::authotity()) {
            $pdf = new PDFToText($arquivo);
            $resposta = false;
            $texto = $pdf->Text;
            if (strpos($texto, $cpf) || strpos($texto, str_replace('-', '', str_replace('.', '', $cpf)))) {
                $resposta = true;
            }
            return $resposta;
        }
    }

    public function tests() {
        global $user_logged;
        if (HelperController::authotity()) {
            if ($user_logged->user_fk_permissao_pk_id == 1) {
                //echo 'Conteúdo: ' . $this->readFile('http://192.168.0.101/system/uploads/folha_pagamento/15963265325f260284eebde.pdf', '606.717.623-89');
                //echo 'Conteúdo: ' . $this->searchCPFInFile('http://192.168.0.101/system/uploads/folha_pagamento/15963272065f2605269da0a.pdf', '606.717.623-89');   
                //echo 'Conteúdo: ' . $this->searchCPFInFile('http://localhost/system/uploads/folha_pagamento/tests.pdf', str_replace('-', '', str_replace('.', '', trim('606.717.623-89'))));
                echo 'Conteúdo: ' . $this->searchCPFInFile('http://localhost/system/uploads/folha_pagamento/tests.pdf', '60671762389') ? 'CPF encontrado' : 'CPF não encontrado';
//                $folhaPagamento = $this->daoFolhaPagamento->selectObjectById(130);
//                echo 'Conteúdo: ' . $this->searchCPFInFile($folhaPagamento->fopa_arquivo, '1606.717.623-89') ? 'CPF encontrado' : 'CPF não encontrado';
            } else {
                $this->info = "warning=Usuário sem acesso a esta tela.";
                $this->listar();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            $fopa_pk_id = strip_tags($_POST['fopa_pk_id']);
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
            } else {
                try {
                    $folhaPagamentoAntigo = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $fopa_competencia = strip_tags($_POST['fopa_competencia']);
                $fopa_nome_arquivo = $_FILES['fopa_arquivo']['name'];
                $novo_nome = null;

                if ($fopa_nome_arquivo !== "") {
                    //Início->Tratando arquivo para upload 
                    $arquivo_temporario = $_FILES['fopa_arquivo']['tmp_name'];
                    $extensao = pathinfo($fopa_nome_arquivo, PATHINFO_EXTENSION);
                    $extensao = strtolower($extensao);
                    $uploaddir = server_path('uploads/folha_pagamento/');
                    $novo_nome = uniqid(time()) . '.' . $extensao;
                    $uploadfile = $uploaddir . $novo_nome;
                    //Fim->Tratando arquivo para upload 
                    if (strstr('.pdf', $extensao)) {
                        if (move_uploaded_file($arquivo_temporario, $uploadfile)) {
                            if ($folhaPagamentoAntigo->fopa_caminho_arquivo) {
                                unlink(server_path($folhaPagamentoAntigo->fopa_caminho_arquivo));
                            }
                        }
                    } else {
                        echo '<script>alert("Arquivo não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                } else {
                    $novo_nome = $folhaPagamentoAntigo->fopa_nome_arquivo;
                }
                $fopa_fk_funcionario_pk_id = strip_tags($_POST['fopa_fk_funcionario_pk_id']);

                $folhaPagamento = new ModelFolhaPagamento();
                $folhaPagamento->fopa_pk_id = $fopa_pk_id;
                $folhaPagamento->fopa_competencia = $fopa_competencia;
                $folhaPagamento->fopa_arquivo = null;
                $folhaPagamento->fopa_nome_arquivo = $novo_nome;
                $folhaPagamento->fopa_caminho_arquivo = 'uploads/folha_pagamento/' . $novo_nome;
                $folhaPagamento->fopa_fk_funcionario_pk_id = $fopa_fk_funcionario_pk_id;
                $folhaPagamento->fopa_fk_id = $this->usuarioAutenticado->id;

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
            $this->listar();
        }
    }

    public function view() {
        if (HelperController::authotity()) {
            $fopa_pk_id = $_GET['fopa_pk_id'];
            if (!isset($fopa_pk_id)) {
                $this->info = 'warning=folha_pagamento_uninformed';
                $this->listar();
            } else {
                try {
                    $daoFuncionario = new DAOFuncionario();
                    $funcionarios = $daoFuncionario->selectObjectsEnabled();
                    $folhaPagamento = $this->daoFolhaPagamento->selectObjectById($fopa_pk_id);
                    if (!isset($folhaPagamento)) {
                        $this->info = 'warning=folha_pagamento_not_exists';
                        $this->listar();
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                    $this->listar();
                }
                if ($folhaPagamento == false) {
                    $this->info = "warning=folha_pagamento_not_found";
                    $this->listar();
                }
                include_once server_path('view/folha_pagamento/view.php');
            }
        }
    }

}
