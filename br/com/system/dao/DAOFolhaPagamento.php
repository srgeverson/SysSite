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
            $this->query = "DELETE FROM endereco WHERE fopa_pk_id=:fopa_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":fopa_pk_id", $fopa_pk_id, PDO::PARAM_INT);
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
        $this->query .= "(fopa_logradouro, fopa_numero, fopa_bairro, fopa_cep, fopa_cidade, fopa_status, fopa_fk_estado_pk_id, fopa_fk_user_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:fopa_logradouro, :fopa_numero, :fopa_bairro, :fopa_cep, :fopa_cidade, :fopa_status, :fopa_fk_estado_pk_id, :fopa_fk_user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_logradouro', $endereco->fopa_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_numero', $endereco->fopa_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_bairro', $endereco->fopa_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_cep', $endereco->fopa_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_cidade', $endereco->fopa_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_fk_estado_pk_id', $endereco->fopa_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_fk_user_pk_id', $endereco->fopa_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_status', $endereco->fopa_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function select() {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.fopa_fk_endereco_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.fopa_fk_user_pk_id=u.user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectById($fopa_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.esta_pk_id, es.esta_nome, es.esta_sigla, u.user_pk_id, u.user_name ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.fopa_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.fopa_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "fopa_pk_id=:fopa_pk_id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelEndereco $endereco = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, es.esta_pk_id, es.esta_nome, es.esta_sigla, u.user_pk_id, u.user_name ";
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.fopa_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.fopa_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "e.fopa_logradouro LIKE '%$endereco->fopa_logradouro%' AND ";
        $this->query .= "e.fopa_cidade LIKE '%$endereco->fopa_cidade%';";
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
        $this->query .= "FROM endereco AS e ";
        $this->query .= "INNER JOIN estado AS es ON (e.fopa_fk_estado_pk_id=es.esta_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (e.fopa_fk_user_pk_id=u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.fopa_status = 1;";
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
        $this->query .= "fopa_logradouro=:fopa_logradouro, ";
        $this->query .= "fopa_numero=:fopa_numero, ";
        $this->query .= "fopa_bairro=:fopa_bairro, ";
        $this->query .= "fopa_cep=:fopa_cep, ";
        $this->query .= "fopa_cidade=:fopa_cidade, ";
        $this->query .= "fopa_fk_estado_pk_id=:fopa_fk_estado_pk_id, ";
        $this->query .= "fopa_fk_user_pk_id=:fopa_fk_user_pk_id ";
        $this->query .= " WHERE fopa_pk_id=:fopa_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_logradouro', $endereco->fopa_logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_numero', $endereco->fopa_numero, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_bairro', $endereco->fopa_bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_cep', $endereco->fopa_cep, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_cidade', $endereco->fopa_cidade, PDO::PARAM_STR);
        $this->statement->bindParam(':fopa_fk_estado_pk_id', $endereco->fopa_fk_estado_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_fk_user_pk_id', $endereco->fopa_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':fopa_pk_id', $endereco->fopa_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE endereco SET ";
        $this->query .= "fopa_status=:fopa_status ";
        $this->query .= "WHERE fopa_pk_id=:fopa_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':fopa_status', $endereco->fopa_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':fopa_pk_id', $endereco->fopa_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
