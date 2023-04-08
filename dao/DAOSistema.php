<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOSistema extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM sistemas WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
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
        try {
            $this->query = "INSERT INTO sistemas ";
            $this->query .= "(descricao, nome, status, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:descricao, :nome, :status, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':descricao', $authority->descricao, PDO::PARAM_STR);
            $this->statement->bindParam(':nome', $authority->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $authority->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            // print_r($erro);
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM sistemas WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelAuthority $authority = null) {
        $this->query = "SELECT ";
        $this->query .= "s.* ";
        $this->query .= "FROM sistemas AS s ";
        $this->query .= "INNER JOIN usuarios AS u ON  u.id = s.sistema_id ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND s.descricao LIKE '%$authority->descricao%';";
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
        $this->query = "SELECT * FROM sistemas WHERE nome=:nome LIMIT 1;";
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
        $this->query = "SELECT p.* FROM sistemas AS p WHERE p.status = 1;";
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
        $this->query = "UPDATE sistemas SET ";
        $this->query .= "descricao=:descricao, ";
        $this->query .= "nome=:nome, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $authority->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':nome', $authority->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':menu_item_id', $authority->menu_item_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $authority->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelAuthority $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE sistemas SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $authority->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $authority->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
