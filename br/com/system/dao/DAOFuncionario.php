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

    public function save(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionario ";
        $this->query .= "(func_nome, func_cpf, func_rg, func_pis, func_data_nascimento, func_status, func_fk_contact_pk_id, func_fk_endereco_pk_id, func_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:func_nome, :func_cpf, :func_rg, :func_pis, :func_data_nascimento, :func_status, :func_fk_contact_pk_id, :func_fk_endereco_pk_id, :func_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_nome', $funcionario->func_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cpf', $funcionario->func_cpf, PDO::PARAM_STR);
        $this->statement->bindParam(':func_rg', $funcionario->func_rg, PDO::PARAM_STR);
        $this->statement->bindParam(':func_pis', $funcionario->func_pis, PDO::PARAM_STR);
        $this->statement->bindParam(':func_data_nascimento', $funcionario->func_data_nascimento, PDO::PARAM_STR);
        $this->statement->bindParam(':func_fk_contact_pk_id', $funcionario->func_fk_contact_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_endereco_pk_id', $funcionario->func_fk_endereco_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_id', $funcionario->func_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_status', $funcionario->func_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionario ";
        $this->query .= "(func_nome, func_cpf, func_rg, func_pis, func_data_nascimento, func_status, func_fk_contact_pk_id, func_fk_endereco_pk_id, func_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:func_nome, :func_cpf, :func_rg, :func_pis, :func_data_nascimento, :func_status, :func_fk_contact_pk_id, :func_fk_endereco_pk_id, :func_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_nome', $funcionario->func_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cpf', $funcionario->func_cpf, PDO::PARAM_STR);
        $this->statement->bindParam(':func_rg', $funcionario->func_rg, PDO::PARAM_STR);
        $this->statement->bindParam(':func_pis', $funcionario->func_pis, PDO::PARAM_STR);
        $this->statement->bindParam(':func_data_nascimento', $funcionario->func_data_nascimento, PDO::PARAM_STR);
        $this->statement->bindParam(':func_fk_contact_pk_id', $funcionario->func_fk_contact_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_endereco_pk_id', $funcionario->func_fk_endereco_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_fk_id', $funcionario->func_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_status', $funcionario->func_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($func_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario AS f ";
        $this->query .= "INNER JOIN endereco AS e ON (f.func_fk_endereco_pk_id=e.ende_pk_id) ";
        $this->query .= "INNER JOIN contact AS c ON (f.func_fk_contact_pk_id=c.cont_pk_id) ";
        $this->query .= "INNER JOIN funcionario_user AS fu ON (f.func_pk_id=fu.fuus_fk_funcionario_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.func_pk_id=:func_pk_id LIMIT 1;";
        
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

    public function selectObjectsByContainsObject(ModelFuncionario $funcionario = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario AS f ";
        $this->query .= "INNER JOIN endereco AS e ON (f.func_fk_endereco_pk_id=e.ende_pk_id) ";
        $this->query .= "INNER JOIN contact AS c ON (f.func_fk_contact_pk_id=c.cont_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (f.func_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.func_nome LIKE '%$funcionario->func_nome%' AND ";
        $this->query .= "f.func_cpf LIKE '%$funcionario->func_cpf%' AND ";
        $this->query .= "f.func_rg LIKE '%$funcionario->func_rg%';";
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
        $this->query .= "* ";
        $this->query .= "FROM funcionario AS f ";
        $this->query .= "INNER JOIN contact AS c ON (f.func_fk_contact_pk_id=c.cont_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (f.func_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.func_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionario SET ";
        $this->query .= "func_nome=:func_nome, ";
        $this->query .= "func_cpf=:func_cpf, ";
        $this->query .= "func_rg=:func_rg, ";
        $this->query .= "func_pis=:func_pis, ";
        $this->query .= "func_data_nascimento=:func_data_nascimento, ";
        $this->query .= "func_fk_id=:func_fk_id ";
        $this->query .= " WHERE func_pk_id=:func_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':func_nome', $funcionario->func_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':func_cpf', $funcionario->func_cpf, PDO::PARAM_STR);
        $this->statement->bindParam(':func_rg', $funcionario->func_rg, PDO::PARAM_STR);
        $this->statement->bindParam(':func_pis', $funcionario->func_pis, PDO::PARAM_STR);
        $this->statement->bindParam(':func_data_nascimento', $funcionario->func_data_nascimento, PDO::PARAM_STR);
        $this->statement->bindParam(':func_fk_id', $funcionario->func_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':func_pk_id', $funcionario->func_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelFuncionario $funcionario = null) {
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
