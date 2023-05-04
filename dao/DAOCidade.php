<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOCidade extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM cidades WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelCidade $cidade = null) {
        if (!is_object($cidade)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO cidades ";
        $this->query .= "(codigo, nome, status, estado_id, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:codigo, :nome, :status, :estado_id, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':codigo', $cidade->codigo, PDO::PARAM_INT);
        $this->statement->bindParam(':nome', $cidade->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $cidade->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':estado_id', $cidade->estado_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $cidade->usuario_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelCidade $cidade = null) {
        if (!is_object($cidade)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO cidades ";
        $this->query .= "(codigo, nome, status, estado_id, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:codigo, :nome, :status, :estado_id, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':codigo', $cidade->codigo, PDO::PARAM_STR);
        $this->statement->bindParam(':nome', $cidade->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $cidade->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':estado_id', $cidade->estado_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $cidade->usuario_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT ";
        $this->query .= "c.*, e.nome as estado_nome, u.nome as usuario_nome ";
        $this->query .= "FROM cidades AS c ";
        $this->query .= "INNER JOIN estados AS e ON (e.id=c.estado_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (u.id=c.usuario_id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelCidade $cidade = null) {
        $this->query = "SELECT ";
        $this->query .= "c.*, e.nome as estado_nome, u.nome as usuario_nome ";
        $this->query .= "FROM cidades AS c ";
        $this->query .= "INNER JOIN estados AS e ON (e.id=c.estado_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (u.id=c.usuario_id) ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND c.nome LIKE '%$cidade->nome%' ";
        //$this->query .= "AND e.estado_id LIKE '%$cidade->estado_id%';";
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
        $this->query .= "FROM cidades AS e ";
        $this->query .= "INNER JOIN estados AS es ON (e.estado_id=es.id) ";
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

    public function selectObjectsEnabledWithEstados() {
        $this->query = "SELECT ";
        $this->query .= "c.id, concat(c.nome, ' - ', e.sigla) as nome ";
        $this->query .= "FROM cidades AS c ";
        $this->query .= "INNER JOIN estados AS e ON (e.id=c.estado_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (u.id=c.usuario_id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelCidade $cidade = null) {
        if (!is_object($cidade)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE cidades SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "codigo=:codigo, ";
        $this->query .= "estado_id=:estado_id, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $cidade->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':codigo', $cidade->codigo, PDO::PARAM_STR);
        $this->statement->bindParam(':estado_id', $cidade->estado_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $cidade->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $cidade->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelCidade $cidade = null) {
        if (!is_object($cidade)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE cidades SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $cidade->status, PDO::PARAM_BOOL);        
        $this->statement->bindParam(':usuario_id', $cidade->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $cidade->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
