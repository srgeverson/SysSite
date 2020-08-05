<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOEstado extends GenericDAO {

    public function delete($esta_pk_id = 0) {
        try {
            $this->query = "DELETE FROM estado WHERE esta_pk_id=:esta_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":esta_pk_id", $esta_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelEstado $estado = null) {
        if (!is_object($estado)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO estado ";
        $this->query .= "(esta_nome, esta_sigla, esta_fk_pais_pk_id, esta_fk_user_pk_id, esta_status) ";
        $this->query .= "VALUES ";
        $this->query .= "(:esta_nome, :esta_sigla,  :esta_fk_pais_pk_id, :esta_fk_user_pk_id, :esta_status);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':esta_nome', $estado->esta_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':esta_sigla', $estado->esta_sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':esta_fk_pais_pk_id', $estado->esta_fk_pais_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':esta_fk_user_pk_id', $estado->esta_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':esta_status', $estado->esta_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($esta_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, p.pais_pk_id, p.pais_nome, u.user_pk_id, u.user_name ";
        $this->query .= "FROM estado AS e ";
        $this->query .= "INNER JOIN pais AS p ON (e.esta_fk_pais_pk_id=p.pais_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.esta_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE esta_pk_id=:esta_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":esta_pk_id", $esta_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelEstado $estado = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, p.pais_pk_id, p.pais_nome, u.user_pk_id, u.user_name ";
        $this->query .= "FROM estado AS e ";
        $this->query .= "INNER JOIN pais AS p ON (e.esta_fk_pais_pk_id=p.pais_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.esta_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "e.esta_nome LIKE '%$estado->esta_nome%' AND ";
        $this->query .= "p.pais_nome LIKE '%$estado->pais_nome%';";

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
        $this->query = "SELECT p.* FROM estado AS p WHERE p.esta_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelEstado $estado = null) {
        if (!is_object($estado)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE estado SET ";
        $this->query .= "esta_nome=:esta_nome, ";
        $this->query .= "esta_sigla=:esta_sigla, ";
        $this->query .= "esta_fk_pais_pk_id=:esta_fk_pais_pk_id, ";
        $this->query .= "esta_fk_user_pk_id=:esta_fk_user_pk_id ";
        $this->query .= " WHERE esta_pk_id=:esta_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':esta_nome', $estado->esta_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':esta_sigla', $estado->esta_sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':esta_fk_pais_pk_id', $estado->esta_fk_pais_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':esta_fk_user_pk_id', $estado->esta_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':esta_pk_id', $estado->esta_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEstado $estado = null) {
        if (!is_object($estado)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE estado SET ";
        $this->query .= "esta_status=:esta_status ";
        $this->query .= "WHERE esta_pk_id=:esta_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':esta_status', $estado->esta_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':esta_pk_id', $estado->esta_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
