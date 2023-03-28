<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOPais extends GenericDAO {

    public function delete($pais_pk_id = 0) {
        try {
            $this->query = "DELETE FROM pais WHERE pais_pk_id=:pais_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":pais_pk_id", $pais_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelPais $pais = null) {
        if (!is_object($pais)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO pais ";
        $this->query .= "(pais_nome, pais_status, pais_sigla, pais_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:pais_nome, :pais_status, :pais_sigla, :pais_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':pais_nome', $pais->pais_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_status', $pais->pais_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':pais_sigla', $pais->pais_sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_fk_id', $pais->pais_fk_id, PDO::PARAM_STR);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($pais_pk_id = 0) {
        $this->query = "SELECT * FROM pais WHERE pais_pk_id=:pais_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":pais_pk_id", $pais_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelPais $pais = null) {
        $this->query = "SELECT ";
        $this->query .= "p.*, u.id, u.nome ";
        $this->query .= "FROM pais AS p ";
        $this->query .= "INNER JOIN user AS u ON (p.pais_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.pais_nome LIKE '%$pais->pais_nome%';";
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
        $this->query = "SELECT p.* FROM pais AS p WHERE p.pais_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelPais $pais = null) {
        if (!is_object($pais)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE pais SET ";
        $this->query .= "pais_nome=:pais_nome, ";
        $this->query .= "pais_sigla=:pais_sigla, ";
        $this->query .= "pais_fk_id=:pais_fk_id ";
        $this->query .= " WHERE pais_pk_id=:pais_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':pais_nome', $pais->pais_nome, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_sigla', $pais->pais_sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_fk_id', $pais->pais_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':pais_pk_id', $pais->pais_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelPais $pais = null) {
        if (!is_object($pais)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE pais SET ";
        $this->query .= "pais_status=:pais_status ";
        $this->query .= "WHERE pais_pk_id=:pais_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':pais_status', $pais->pais_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':pais_pk_id', $pais->pais_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
