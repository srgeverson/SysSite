<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOFuncionario extends GenericDAO {

    public function delete($func_pk_id = 0) {
        try {
            $this->query = "DELETE FROM funcionario WHERE func_pk_id=:func_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":func_pk_id", $func_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelEndereco $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionario ";
        $this->query .= "(func_logradouro, func_numero, func_bairro, func_cep, func_cidade, func_status, func_fk_estado_pk_id, func_fk_user_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:func_logradouro, :func_numero, :func_bairro, :func_cep, :func_cidade, :func_status, :func_fk_estado_pk_id, :func_fk_user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_logradouro', $funcionario->func_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':func_numero', $funcionario->func_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':func_bairro', $funcionario->func_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cep', $funcionario->func_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cidade', $funcionario->func_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':func_fk_estado_pk_id', $funcionario->func_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_user_pk_id', $funcionario->func_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_status', $funcionario->func_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function select() {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.func_fk_funcionario_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.func_fk_user_pk_id=u.user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectById($func_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.esta_pk_id, es.esta_nome, es.esta_sigla, u.user_pk_id, u.user_name ";
        $this->query .= "FROM funcionario AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.func_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.func_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "func_pk_id=:func_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":func_pk_id", $func_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelEndereco $funcionario = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.esta_pk_id, es.esta_nome, es.esta_sigla, u.user_pk_id, u.user_name ";
        $this->query .= "FROM funcionario AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.func_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.func_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "e.func_logradouro LIKE '%$funcionario->func_logradouro%' AND ";
        $this->query .= "e.func_cidade LIKE '%$funcionario->func_cidade%';";
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
        $this->query .= "e.*, es.esta_pk_id, es.esta_nome, es.esta_sigla, u.user_pk_id, u.user_name ";
        $this->query .= "FROM funcionario AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.func_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.func_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.func_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByFkUser($user_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "f.*, u.user_pk_id, u.user_name ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "INNER JOIN funcionario AS f  ON (fu.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "fu.fuus_fk_user_pk_id = :fuus_fk_user_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":fuus_fk_user_pk_id", $user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function update(ModelEndereco $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionario SET ";
        $this->query .= "func_logradouro=:func_logradouro, ";
        $this->query .= "func_numero=:func_numero, ";
        $this->query .= "func_bairro=:func_bairro, ";
        $this->query .= "func_cep=:func_cep, ";
        $this->query .= "func_cidade=:func_cidade, ";
        $this->query .= "func_fk_estado_pk_id=:func_fk_estado_pk_id, ";
        $this->query .= "func_fk_user_pk_id=:func_fk_user_pk_id ";
        $this->query .= " WHERE func_pk_id=:func_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_logradouro', $funcionario->func_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':func_numero', $funcionario->func_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':func_bairro', $funcionario->func_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cep', $funcionario->func_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cidade', $funcionario->func_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':func_fk_estado_pk_id', $funcionario->func_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_user_pk_id', $funcionario->func_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_pk_id', $funcionario->func_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEndereco $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionario SET ";
        $this->query .= "func_status=:func_status ";
        $this->query .= "WHERE func_pk_id=:func_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_status', $funcionario->func_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':func_pk_id', $funcionario->func_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
