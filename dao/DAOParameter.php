<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOParameter extends GenericDAO {

    public function delete($para_pk_id = 0) {
        try {
            $this->query = "DELETE FROM parameter WHERE para_pk_id=:para_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":para_pk_id", $para_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelParameter $parameter = null) {
        if (!is_object($parameter)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO parameter ";
        $this->query .= "(para_key, para_value, para_description, para_status, para_fk_user_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:para_key, :para_value, :para_description, :para_status, :para_fk_user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':para_key', $parameter->para_key, PDO::PARAM_STR);
        $this->statement->bindParam(':para_value', $parameter->para_value, PDO::PARAM_STR);
        $this->statement->bindParam(':para_description', $parameter->para_description, PDO::PARAM_STR);
        $this->statement->bindParam(':para_status', $parameter->para_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':para_fk_user_pk_id', $parameter->para_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($para_pk_id = 0) {
        $this->query = "SELECT * FROM parameter WHERE para_pk_id=:para_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":para_pk_id", $para_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelParameter $parameter = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM parameter ";
        $this->query .= "WHERE ";
        $this->query .= "para_key LIKE '%$parameter->para_key%' AND ";
        $this->query .= "para_value LIKE '%$parameter->para_value%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($para_key = null) {
        $this->query = "SELECT * FROM parameter WHERE para_key = :para_key AND para_status = 1 LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":para_key", $para_key, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelParameter $parameter = null) {
        $this->query = "SELECT * FROM parameter WHERE para_key=:para_key LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":para_key", $parameter->para_key, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT p.* FROM parameter AS p WHERE p.para_value = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelParameter $parameter = null) {
        if (!is_object($parameter)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE parameter SET ";
        $this->query .= "para_value=:para_value, ";
        $this->query .= "para_description=:para_description ";
        $this->query .= " WHERE para_pk_id=:para_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':para_value', $parameter->para_value, PDO::PARAM_STR);
        $this->statement->bindParam(':para_description', $parameter->para_description, PDO::PARAM_STR);
        $this->statement->bindParam(':para_pk_id', $parameter->para_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelParameter $parameter = null) {
        if (!is_object($parameter)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE parameter SET ";
        $this->query .= "para_status=:para_status ";
        $this->query .= "WHERE para_pk_id=:para_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':para_status', $parameter->para_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':para_pk_id', $parameter->para_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function verificaConfiguracaoDeEmail(){
        $this->query = "SELECT * FROM parameter AS p where p.para_key in ('email','senha') and p.para_key is not null and p.para_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
}
