<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOPage extends GenericDAO {

    public function delete($page_pk_id = 0) {
        try {
            $this->query = "DELETE FROM page WHERE page_pk_id=:page_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":page_pk_id", $page_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelPage $page = null) {
        if (!is_object($page)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO page ";
        $this->query .= "(page_name, page_description, page_icon, page_label, page_status, page_fk_user_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:page_name, :page_description, :page_icon, :page_label, :page_status, :page_fk_user_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':page_name', $page->page_name, PDO::PARAM_STR);
        $this->statement->bindParam(':page_description', $page->page_description, PDO::PARAM_STR);
        $this->statement->bindParam(':page_icon', $page->page_icon, PDO::PARAM_STR);
        $this->statement->bindParam(':page_label', $page->page_label, PDO::PARAM_STR);
        $this->statement->bindParam(':page_status', $page->page_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':page_fk_user_pk_id', $page->page_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($page_pk_id = 0) {
        $this->query = "SELECT * FROM page WHERE page_pk_id=:page_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":page_pk_id", $page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelPage $page = null) {
        $this->query = "SELECT ";
        $this->query .= "p.*, u.user_pk_id, u.user_name ";
        $this->query .= "FROM page AS p ";
        $this->query .= "INNER JOIN user AS u ON (p.page_fk_user_pk_id = u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "p.page_name LIKE '%$page->page_name%' AND ";
        $this->query .= "p.page_description LIKE '%$page->page_description%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($page_name = null) {
        $this->query = "SELECT * FROM page WHERE page_name = :page_name AND page_status = :page_status LIMIT 1;";
        $page_status = true;
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":page_name", $page_name, PDO::PARAM_STR);
        $this->statement->bindParam(":page_status", $page_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelPage $page = null) {
        $this->query = "SELECT * FROM page WHERE page_name=:page_name LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":page_name", $page->page_name, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT p.* FROM page AS p WHERE p.page_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelPage $page = null) {
        if (!is_object($page)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE page SET ";
        $this->query .= "page_name=:page_name, ";
        $this->query .= "page_description=:page_description, ";
        $this->query .= "page_icon=:page_icon, ";
        $this->query .= "page_label=:page_label, ";
        $this->query .= "page_fk_user_pk_id=:page_fk_user_pk_id ";
        $this->query .= " WHERE page_pk_id=:page_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':page_name', $page->page_name, PDO::PARAM_STR);
        $this->statement->bindParam(':page_description', $page->page_description, PDO::PARAM_STR);
        $this->statement->bindParam(':page_icon', $page->page_icon, PDO::PARAM_STR);
        $this->statement->bindParam(':page_label', $page->page_label, PDO::PARAM_STR);
        $this->statement->bindParam(':page_fk_user_pk_id', $page->page_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':page_pk_id', $page->page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelPage $page = null) {
        if (!is_object($page)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE page SET ";
        $this->query .= "page_status=:page_status ";
        $this->query .= "WHERE page_pk_id=:page_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':page_status', $page->page_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':page_pk_id', $page->page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
