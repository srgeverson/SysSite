<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOGrupo extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM grupos WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelGrupo $grupo = null) {
        if (!is_object($grupo)) {
            throw new Exception("Dados incompletos");
        }
        try {
            $this->query = "INSERT INTO grupos ";
            $this->query .= "(nome, status, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:nome, :status, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $grupo->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $grupo->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':usuario_id', $grupo->usuario_id, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            // print_r($erro);
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM grupos WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelGrupo $grupo = null) {
        $this->query = "SELECT ";
        $this->query .= "g.*, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM grupos AS g ";
        $this->query .= "INNER JOIN usuarios AS u ON  u.id = g.usuario_id ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND g.nome LIKE '%$grupo->nome%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsByNameUnique($nome = null) {
        $this->query = "SELECT * FROM grupos WHERE nome=:nome LIMIT 1;";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT g.* FROM grupos AS g WHERE g.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelGrupo $grupo = null) {
        if (!is_object($grupo)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE grupos SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $grupo->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $grupo->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $grupo->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelGrupo $grupo = null) {
        if (!is_object($grupo)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE grupos SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $grupo->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $grupo->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $grupo->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
