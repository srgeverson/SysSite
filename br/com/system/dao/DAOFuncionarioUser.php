<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOFuncionarioUser extends GenericDAO {

    public function delete($fuus_pk_id = 0) {
        try {
            $this->query = "DELETE FROM funcionario_user WHERE fuus_pk_id=:fuus_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":fuus_pk_id", $fuus_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function deleteByFuncionario($func_pk_id = 0) {
        try {
            $this->query = "DELETE FROM funcionario_user WHERE fuus_fk_funcionario_pk_id=:fuus_fk_funcionario_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":fuus_fk_funcionario_pk_id", $func_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelFuncionarioUser $funcionarioUser = null) {
        if (!is_object($funcionarioUser)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionario_user ";
        $this->query .= "(fuus_fk_id, fuus_fk_funcionario_pk_id, fuus_status) ";
        $this->query .= "VALUES ";
        $this->query .= "(:fuus_fk_id, :fuus_fk_funcionario_pk_id, :fuus_status)";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fuus_fk_id', $funcionarioUser->fuus_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fuus_fk_funcionario_pk_id', $funcionarioUser->fuus_fk_funcionario_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fuus_status', $funcionarioUser->fuus_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($fuus_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN funcionario AS f ON (fp.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "fp.fuus_pk_id=:fuus_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":fuus_pk_id", $fuus_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelFuncionarioUser $funcionarioUser = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN funcionario AS f ON (fu.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.func_nome LIKE '%$funcionarioUser->func_nome%' AND ";
        $this->query .= "f.func_cpf LIKE '%$funcionarioUser->func_cpf%' AND ";
        $this->query .= "fp.fuus_fk_id LIKE '%$funcionarioUser->fuus_fk_id%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByFkFuncionario($func_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "INNER JOIN funcionario AS f ON (fu.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "fu.fuus_fk_funcionario_pk_id = :fuus_fk_funcionario_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":fuus_fk_funcionario_pk_id", $func_pk_id, PDO::PARAM_INT);
        $this->statement->execute();

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByFkUser($id = 0) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "INNER JOIN funcionario AS f ON (fu.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "fu.fuus_fk_id = :fuus_fk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":fuus_fk_id", $id, PDO::PARAM_INT);
        $this->statement->execute();

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionario_user AS fu ";
        $this->query .= "INNER JOIN funcionario AS f ON (fu.fuus_fk_funcionario_pk_id=f.func_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (fu.fuus_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "fu.fuus_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelFuncionarioUser $funcionarioUser = null) {
        if (!is_object($funcionarioUser)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionario_user SET ";
        $this->query .= "fuus_fk_id=:fuus_fk_id, ";
        $this->query .= "fuus_fk_funcionario_pk_id=:fuus_fk_funcionario_pk_id ";
        $this->query .= " WHERE fuus_pk_id=:fuus_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fuus_fk_id', $funcionarioUser->fuus_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fuus_fk_funcionario_pk_id', $funcionarioUser->fuus_fk_funcionario_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fuus_pk_id', $funcionarioUser->fuus_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelFuncionarioUser $funcionarioUser = null) {
        if (!is_object($funcionarioUser)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionario_user SET ";
        $this->query .= "fuus_status=:fuus_status ";
        $this->query .= "WHERE fuus_pk_id=:fuus_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fuus_status', $funcionarioUser->fuus_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':fuus_pk_id', $funcionarioUser->fuus_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
