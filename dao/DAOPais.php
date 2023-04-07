<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOPais extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM paises WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
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
        $this->query = "INSERT INTO paises ";
        $this->query .= "(nome, status, sigla, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :status, :sigla, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $pais->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $pais->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':sigla', $pais->sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $pais->usuario_id, PDO::PARAM_STR);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM paises WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelPais $pais = null) {
        $this->query = "SELECT ";
        $this->query .= "p.*, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM paises AS p ";
        $this->query .= "INNER JOIN usuarios AS u ON (p.usuario_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.nome LIKE '%$pais->nome%';";
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
        $this->query = "SELECT p.* FROM paises AS p WHERE p.status = 1;";
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
        $this->query = "UPDATE paises SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "sigla=:sigla, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $pais->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':sigla', $pais->sigla, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $pais->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $pais->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelPais $pais = null) {
        if (!is_object($pais)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE paises SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $pais->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $pais->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
