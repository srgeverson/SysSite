<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOEndereco extends GenericDAO {

    public function delete($ende_pk_id = 0) {
        try {
            $this->query = "DELETE FROM endereco WHERE ende_pk_id=:ende_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":ende_pk_id", $ende_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO endereco ";
        $this->query .= "(ende_logradouro, ende_numero, ende_bairro, ende_cep, ende_cidade, ende_status, ende_fk_estado_pk_id, ende_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:ende_logradouro, :ende_numero, :ende_bairro, :ende_cep, :ende_cidade, :ende_status, :ende_fk_estado_pk_id, :ende_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':ende_logradouro', $endereco->ende_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_numero', $endereco->ende_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_bairro', $endereco->ende_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cep', $endereco->ende_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cidade', $endereco->ende_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_fk_estado_pk_id', $endereco->ende_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_fk_id', $endereco->ende_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_status', $endereco->ende_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO endereco ";
        $this->query .= "(ende_logradouro, ende_numero, ende_bairro, ende_cep, ende_cidade, ende_status, ende_fk_estado_pk_id, ende_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:ende_logradouro, :ende_numero, :ende_bairro, :ende_cep, :ende_cidade, :ende_status, :ende_fk_estado_pk_id, :ende_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':ende_logradouro', $endereco->ende_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_numero', $endereco->ende_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_bairro', $endereco->ende_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cep', $endereco->ende_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cidade', $endereco->ende_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_fk_estado_pk_id', $endereco->ende_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_fk_id', $endereco->ende_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_status', $endereco->ende_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($ende_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.id, es.nome, es.sigla, u.id, u.nome ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.ende_fk_estado_pk_id=es.id) ";
        $this->query .= "INNER JOIN user AS u ON (e.ende_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "ende_pk_id=:ende_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":ende_pk_id", $ende_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelEndereco $endereco = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.id, es.nome, es.sigla, u.id, u.nome ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.ende_fk_estado_pk_id=es.id) ";
        $this->query .= "INNER JOIN user AS u ON (e.ende_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "e.ende_logradouro LIKE '%$endereco->ende_logradouro%' AND ";
        $this->query .= "e.ende_cidade LIKE '%$endereco->ende_cidade%';";
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
        $this->query .= "e.*, es.id, es.nome, es.sigla, u.id, u.nome ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.ende_fk_estado_pk_id=es.id) ";
        $this->query .= "INNER JOIN user AS u ON (e.ende_fk_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.ende_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE endereco SET ";
        $this->query .= "ende_logradouro=:ende_logradouro, ";
        $this->query .= "ende_numero=:ende_numero, ";
        $this->query .= "ende_bairro=:ende_bairro, ";
        $this->query .= "ende_cep=:ende_cep, ";
        $this->query .= "ende_cidade=:ende_cidade, ";
        $this->query .= "ende_fk_estado_pk_id=:ende_fk_estado_pk_id, ";
        $this->query .= "ende_fk_id=:ende_fk_id ";
        $this->query .= " WHERE ende_pk_id=:ende_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':ende_logradouro', $endereco->ende_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_numero', $endereco->ende_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_bairro', $endereco->ende_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cep', $endereco->ende_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_cidade', $endereco->ende_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':ende_fk_estado_pk_id', $endereco->ende_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_fk_id', $endereco->ende_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':ende_pk_id', $endereco->ende_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE endereco SET ";
        $this->query .= "ende_status=:ende_status ";
        $this->query .= "WHERE ende_pk_id=:ende_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':ende_status', $endereco->ende_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':ende_pk_id', $endereco->ende_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
