<?php

/*
 * To change this license header, choose License Headers in Project Propertic.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOEndereco extends GenericDAO {

    public function delete($id = null) {
        try {
            $this->query = "DELETE FROM enderecos WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
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
        $this->query = "INSERT INTO enderecos ";
        $this->query .= "(logradouro, numero, bairro, cep, cidade_id, status, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:logradouro, :numero, :bairro, :cep, :cidade_id, :status, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':logradouro', $endereco->logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':numero', $endereco->numero, PDO::PARAM_STR);
        $this->statement->bindParam(':bairro', $endereco->bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':cep', $endereco->cep, PDO::PARAM_STR);
        $this->statement->bindParam(':cidade_id', $endereco->cidade_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $endereco->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':status', $endereco->status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO enderecos ";
        $this->query .= "(logradouro, numero, bairro, cep, cidade_id, status, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:logradouro, :numero, :bairro, :cep, :cidade_id, :status, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':logradouro', $endereco->logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':numero', $endereco->numero, PDO::PARAM_STR);
        $this->statement->bindParam(':bairro', $endereco->bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':cep', $endereco->cep, PDO::PARAM_STR);
        $this->statement->bindParam(':cidade_id', $endereco->cidade_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $endereco->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':status', $endereco->status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, c.id AS cidade_id, c.nome AS cidade_nome,es.id as estado_id, es.sigla as estado_sigla, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM enderecos AS e ";
        $this->query .= "INNER JOIN cidades AS c ON (c.id=e.cidade_id) ";
        $this->query .= "INNER JOIN estados AS es ON (es.id=c.estado_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (u.id=e.usuario_id) ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND e.id=:id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelEndereco $endereco = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, c.id AS cidade_id, c.nome AS cidade_nome,es.id as estado_id, es.sigla as estado_sigla, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM enderecos AS e ";
        $this->query .= "INNER JOIN cidades AS c ON (c.id=e.cidade_id) ";
        $this->query .= "INNER JOIN estados AS es ON (es.id=c.estado_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (u.id=e.usuario_id) ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND e.logradouro LIKE '%$endereco->logradouro%' ";
        //$this->query .= "AND e.cidade_id LIKE '%$endereco->cidade_id%';";
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
        $this->query .= "e.*, c.id, c.nome, c.sigla, u.id, u.nome ";
        $this->query .= "FROM enderecos AS e ";
        $this->query .= "INNER JOIN estados AS es ON (e.estado_id=c.id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (e.usuario_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.status = 1;";
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
        $this->query = "UPDATE enderecos SET ";
        $this->query .= "logradouro=:logradouro, ";
        $this->query .= "numero=:numero, ";
        $this->query .= "bairro=:bairro, ";
        $this->query .= "cep=:cep, ";
        $this->query .= "cidade_id=:cidade_id, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':logradouro', $endereco->logradouro, PDO::PARAM_STR);
        $this->statement->bindParam(':numero', $endereco->numero, PDO::PARAM_STR);
        $this->statement->bindParam(':bairro', $endereco->bairro, PDO::PARAM_STR);
        $this->statement->bindParam(':cep', $endereco->cep, PDO::PARAM_STR);
        $this->statement->bindParam(':cidade_id', $endereco->cidade_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $endereco->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $endereco->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEndereco $endereco = null) {
        if (!is_object($endereco)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE enderecos SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $endereco->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $endereco->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
