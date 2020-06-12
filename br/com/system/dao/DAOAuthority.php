<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOAuthority extends GenericDAO {

    public function delete($auth_pk_id = "") {
        try {
            $this->query = "DELETE FROM authority WHERE auth_pk_id=:auth_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":auth_pk_id", $auth_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelAuthority $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO authority ";
        $this->query .= "(auth_description, auth_status, auth_screen, auth_function) ";
        $this->query .= "VALUES ";
        $this->query .= "(:auth_description, :auth_status, :auth_screen, :auth_function);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':auth_description', $authority->auth_description, PDO::PARAM_STR);
        $this->statement->bindParam(':auth_status', $authority->auth_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':auth_screen', $authority->auth_screen, PDO::PARAM_STR);
        $this->statement->bindParam(':auth_function', $authority->auth_function, PDO::PARAM_STR);
        $this->statement->execute();
        return true;
    }

    public function select() {
        $this->query = "SELECT * FROM authority";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectById($auth_pk_id = "") {
        $this->query = "SELECT * FROM authority WHERE auth_pk_id=:auth_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":auth_pk_id", $auth_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByFkUser($user_pk_id = "") {
        $this->query = "SELECT * FROM authority WHERE auth_fk_user_pk_id=:auth_fk_user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":auth_fk_user_pk_id", $user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT p.* FROM authority AS p WHERE p.auth_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelAuthority $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE authority SET ";
        $this->query .= "auth_description=:auth_description, ";
        $this->query .= "auth_screen=:auth_screen, ";
        $this->query .= "auth_function=:auth_function ";
        $this->query .= " WHERE auth_pk_id=:auth_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':auth_description', $authority->auth_description, PDO::PARAM_STR);
        $this->statement->bindParam(':auth_screen', $authority->auth_screen, PDO::PARAM_STR);
        $this->statement->bindParam(':auth_function', $authority->auth_function, PDO::PARAM_STR);
        $this->statement->bindParam(':auth_pk_id', $authority->auth_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelAuthority $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE authority SET ";
        $this->query .= "auth_status=:auth_status ";
        $this->query .= "WHERE auth_pk_id=:auth_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':auth_status', $authority->auth_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':auth_pk_id', $authority->auth_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
