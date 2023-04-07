<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOTest extends GenericDAO {

    public function delete($id = "") {
        $this->query = "DELETE FROM tests WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":id", $id, PDO::PARAM_STR);
        $this->statement->execute();

        return true;
    }

    public function save(ModelTest $test = null) {
        try {
            if (!is_object($test)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO tests ";
            $this->query .= "(name, status) ";
            $this->query .= "VALUES ";
            $this->query .= "(:name, :status);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':name', $test->name, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $test->status, PDO::PARAM_BOOL);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function selectObjectById($id = "") {
        $this->query = "SELECT ";
        $this->query .= "t.* ";
        $this->query .= "FROM tests AS t ";
        $this->query .= "WHERE t.id = :id LIMIT 1;";
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

    public function selectObjectsByContainsObjetc(ModelTest $test = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM tests AS t ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= " AND t.name LIKE '%$test->name%' ";

        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByName($name = "") {
        $this->query = "SELECT ";
        $this->query .= "t.* ";
        $this->query .= "FROM tests AS t ";
        $this->query .= "WHERE t.name = :name LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':name', $name, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function update(ModelTest $test = null) {
        if (!is_object($test)) {
            throw new Exception("Dados incompletos");
        }

        $this->query = "UPDATE tests SET ";
        $this->query .= "name=:name ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':name', $test->name, PDO::PARAM_STR);
        $this->statement->bindParam(':id', $test->id, PDO::PARAM_INT);
        $this->statement->execute();

        return true;
    }

    public function updateStatus(ModelTest $test = null) {
        if (!is_object($test)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE tests SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $test->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $test->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
