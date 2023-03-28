<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOMenuItem extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM menu_itens WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelMenuItem $menuItem = null) {
        if (!is_object($menuItem)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO menuItem ";
        $this->query .= "(nome, descricao, icone, imagem, status, sistema_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :descricao, :icone, :imagem, :status, :sistema_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $menuItem->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':descricao', $menuItem->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':icone', $menuItem->icone, PDO::PARAM_STR);
        $this->statement->bindParam(':imagem', $menuItem->imagem, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $menuItem->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':sistema_id', $menuItem->sistema_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM menu_itens WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelMenuItem $menuItem = null) {
        $this->query = "SELECT ";
        $this->query .= "mi.*, u.id, u.nome ";
        $this->query .= "FROM menu_itens AS mi  ";
        $this->query .= "INNER JOIN user AS u ON (mi.sistema_id = u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "mi.nome LIKE '%$menuItem->nome%' AND ";
        $this->query .= "mi.descricao LIKE '%$menuItem->descricao%';";
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
        $this->query = "SELECT * FROM menuItem WHERE nome = :nome AND status = :status LIMIT 1;";
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

    public function selectObjectByObject(ModelMenuItem $menuItem = null) {
        $this->query = "SELECT * FROM menuItem WHERE nome=:nome LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":nome", $menuItem->nome, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT mi.* FROM menu_itens AS mi  WHERE mi.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabledAndFkMenu($menu_id = null) {
        $this->query = "SELECT mi.* FROM menu_itens AS mi  WHERE mi.status = 1 AND menu_id=:menu_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":menu_id", $menu_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function update(ModelMenuItem $menuItem = null) {
        if (!is_object($menuItem)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menuItem SET ";
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
        $this->statement->bindParam(':nome', $menuItem->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':descricao', $menuItem->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':icone', $menuItem->icone, PDO::PARAM_STR);
        $this->statement->bindParam(':imagem', $menuItem->imagem, PDO::PARAM_STR);
        $this->statement->bindParam(':sistema_id', $menuItem->sistema_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $menuItem->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelMenuItem $menuItem = null) {
        if (!is_object($menuItem)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menuItem SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $menuItem->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $menuItem->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
