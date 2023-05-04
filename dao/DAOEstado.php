<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOEstado extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM estados WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
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
        $this->query = "INSERT INTO estados ";
        $this->query .= "(nome, sigla, pais_id, usuario_id, status) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :sigla,  :pais_id, :usuario_id, :status);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $estado->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':sigla', $estado->sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_id', $estado->pais_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $estado->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':status', $estado->status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT ";
        $this->query .= "e.*, e.id AS pais_id, e.nome AS pais_nome, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM estados AS e ";
        $this->query .= "INNER JOIN paises AS p ON (p.id=e.pais_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (e.usuario_id=u.id) ";
        $this->query .= "WHERE e.id=:id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelEstado $estado = null) {
        $this->query = "SELECT ";
        $this->query .= "e.*, e.id AS pais_id, e.nome AS pais_nome, u.id AS usuario_id, u.nome usuario_nome ";
        $this->query .= "FROM estados AS e ";
        $this->query .= "INNER JOIN paises AS p ON (p.id=e.pais_id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (e.usuario_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "e.nome LIKE '%$estado->nome%' AND ";
        $this->query .= "e.nome LIKE '%$estado->pais_nome%';";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT e.* FROM estados AS e WHERE e.status = 1;";
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
        $this->query = "UPDATE estados SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "sigla=:sigla, ";
        $this->query .= "pais_id=:pais_id, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $estado->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':sigla', $estado->sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':pais_id', $estado->pais_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $estado->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $estado->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelEstado $estado = null) {
        if (!is_object($estado)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE estados SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $estado->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $estado->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
