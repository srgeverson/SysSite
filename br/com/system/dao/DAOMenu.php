<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOMenu extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM menu WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO menu ";
        $this->query .= "(nome, descricao, icone, imagem, status, sistema_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :descricao, :icone, :imagem, :status, :sistema_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $menu->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':descricao', $menu->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':icone', $menu->icone, PDO::PARAM_STR);
        $this->statement->bindParam(':imagem', $menu->imagem, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $menu->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':sistema_id', $menu->sistema_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM menu WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelMenu $menu = null) {
        $this->query = "SELECT ";
        $this->query .= "m.*, u.user_pk_id, u.user_name ";
        $this->query .= "FROM menu AS m  ";
        $this->query .= "INNER JOIN user AS u ON (m.sistema_id = u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "m.nome LIKE '%$menu->nome%' AND ";
        $this->query .= "m.descricao LIKE '%$menu->descricao%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($nome = null) {
        $this->query = "SELECT * FROM menu WHERE nome = :nome AND status = :status LIMIT 1;";
        $status = true;
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":nome", $nome, PDO::PARAM_STR);
        $this->statement->bindParam(":status", $status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelMenu $menu = null) {
        $this->query = "SELECT * FROM menu WHERE nome=:nome LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":nome", $menu->nome, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT m.* FROM menu AS m  WHERE m.status = 1 AND m.sistema_id = 1 ORDER BY id DESC;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menu SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "descricao=:descricao, ";
        $this->query .= "icone=:icone, ";
        $this->query .= "imagem=:imagem, ";
        $this->query .= "sistema_id=:sistema_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $menu->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':descricao', $menu->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':icone', $menu->icone, PDO::PARAM_STR);
        $this->statement->bindParam(':imagem', $menu->imagem, PDO::PARAM_STR);
        $this->statement->bindParam(':sistema_id', $menu->sistema_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $menu->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menu SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $menu->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $menu->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
