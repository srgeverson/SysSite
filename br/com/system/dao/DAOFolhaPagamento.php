<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOFolhaPagamento extends GenericDAO {

    public function delete($fopa_pk_id = 0) {
        try {
            $this->query = "DELETE FROM folha_pagamento WHERE fopa_pk_id=:fopa_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":fopa_pk_id", $fopa_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelFolhaPagamento $folhaPagamento = null) {
        if (!is_object($folhaPagamento)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO folha_pagamento ";
        $this->query .= "(fopa_competencia, fopa_arquivo, fopa_nome_arquivo, fopa_caminho_arquivo, fopa_status, fopa_fk_funcionario_pk_id, fopa_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:fopa_competencia, :fopa_arquivo, :fopa_nome_arquivo, :fopa_caminho_arquivo, :fopa_status, :fopa_fk_funcionario_pk_id, :fopa_fk_id)";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_competencia', $folhaPagamento->fopa_competencia, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_arquivo', $folhaPagamento->fopa_arquivo, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_nome_arquivo', $folhaPagamento->fopa_nome_arquivo, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_caminho_arquivo', $folhaPagamento->fopa_caminho_arquivo, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_fk_funcionario_pk_id', $folhaPagamento->fopa_fk_funcionario_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_fk_id', $folhaPagamento->fopa_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_status', $folhaPagamento->fopa_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($fopa_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "fp.*, f.func_pk_id, func_nome, u.id, nome ";
        $this->query .= "FROM folha_pagamento AS fp ";
        $this->query .= "INNER JOIN funcionario AS f ON (fp.fopa_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fp.fopa_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "fp.fopa_pk_id=:fopa_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":fopa_pk_id", $fopa_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelFolhaPagamento $folhaPagamento = null) {
        $this->query = "SELECT ";
        $this->query .= "fp.*, f.*, u.id, nome ";
        $this->query .= "FROM folha_pagamento AS fp ";
        $this->query .= "INNER JOIN funcionario AS f ON (fp.fopa_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fp.fopa_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.func_nome LIKE '%$folhaPagamento->func_nome%' AND ";
        $this->query .= "f.func_cpf LIKE '%$folhaPagamento->func_cpf%' AND ";
        $this->query .= "fp.fopa_competencia LIKE '%$folhaPagamento->fopa_competencia%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT ";
        $this->query .= "fp.*, f.func_pk_id, f.func_nome, f.func_cpf, u.id, u.nome ";
        $this->query .= "FROM folha_pagamento AS fp ";
        $this->query .= "INNER JOIN funcionario AS f ON (fp.fopa_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fp.fopa_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "fp.fopa_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabledByFuncionario($fopa_fk_funcionario_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "fp.*, f.func_pk_id, f.func_nome, f.func_cpf, u.id, u.nome ";
        $this->query .= "FROM folha_pagamento AS fp ";
        $this->query .= "INNER JOIN funcionario AS f ON (fp.fopa_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fp.fopa_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "fp.fopa_status = 1 AND fp.fopa_fk_funcionario_pk_id = :fopa_fk_funcionario_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_fk_funcionario_pk_id', $fopa_fk_funcionario_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelFolhaPagamento $folhaPagamento = null) {
        if (!is_object($folhaPagamento)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE folha_pagamento SET ";
        $this->query .= "fopa_competencia=:fopa_competencia, ";
        $this->query .= "fopa_arquivo=:fopa_arquivo, ";
        $this->query .= "fopa_caminho_arquivo=:fopa_caminho_arquivo, ";
        $this->query .= "fopa_fk_funcionario_pk_id=:fopa_fk_funcionario_pk_id, ";
        $this->query .= "fopa_fk_id=:fopa_fk_id ";
        $this->query .= " WHERE fopa_pk_id=:fopa_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_competencia', $folhaPagamento->fopa_competencia, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_arquivo', $folhaPagamento->fopa_arquivo, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_caminho_arquivo', $folhaPagamento->fopa_caminho_arquivo, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_fk_funcionario_pk_id', $folhaPagamento->fopa_fk_funcionario_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_fk_id', $folhaPagamento->fopa_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_pk_id', $folhaPagamento->fopa_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelFolhaPagamento $folhaPagamento = null) {
        if (!is_object($folhaPagamento)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE folha_pagamento SET ";
        $this->query .= "fopa_status=:fopa_status ";
        $this->query .= "WHERE fopa_pk_id=:fopa_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_status', $folhaPagamento->fopa_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':fopa_pk_id', $folhaPagamento->fopa_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
