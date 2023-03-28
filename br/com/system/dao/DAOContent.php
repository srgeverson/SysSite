<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOContent extends GenericDAO {

    public function delete($conte_pk_id = 0) {
        try {
            $this->query = "DELETE FROM content WHERE conte_pk_id=:conte_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":conte_pk_id", $conte_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelContent $content = null) {
        if (!is_object($content)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO content ";
        $this->query .= "(conte_component, conte_title, conte_subtitle, conte_text, conte_image, conte_link, conte_fk_id, conte_fk_page_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:conte_component, :conte_title, :conte_subtitle, :conte_text, :conte_image, :conte_link, :conte_fk_id, :conte_fk_page_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':conte_component', $content->conte_component, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_title', $content->conte_title, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_subtitle', $content->conte_subtitle, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_text', $content->conte_text, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_image', $content->conte_image, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_link', $content->conte_link, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_fk_id', $content->conte_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':conte_fk_page_pk_id', $content->conte_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($conte_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.id, u.id ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.conte_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.conte_fk_id = u.id) ";
        $this->query .= "WHERE conte_pk_id=:conte_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":conte_pk_id", $conte_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelContent $content = null) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.id, u.nome ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.conte_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.conte_fk_id = u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.conte_component LIKE '%$content->conte_component%' AND ";
        $this->query .= "p.page_name LIKE '%$content->page_name%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsByObject(ModelContent $content = null) {
        $this->query = "SELECT ";
        $this->query .= "c.* ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.conte_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.conte_fk_id = u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.conte_status = 1 AND ";
        $this->query .= "c.conte_fk_page_pk_id = :conte_fk_page_pk_id AND ";
        $this->query .= "c.conte_component = :conte_component;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":conte_fk_page_pk_id", $content->conte_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(":conte_component", $content->conte_component, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectContentByContainsObject(ModelContent $content = null) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.id, u.nome ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.conte_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.conte_fk_id = u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.conte_fk_page_pk_id = :conte_fk_page_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":conte_fk_page_pk_id", $content->conte_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($conte_name = null) {
        $this->query = "SELECT * FROM content WHERE conte_name = :conte_name AND conte_status = :conte_status LIMIT 1;";
        $conte_status = true;
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":conte_name", $conte_name, PDO::PARAM_STR);
        $this->statement->bindParam(":conte_status", $conte_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelContent $content = null) {
        $this->query = "SELECT * FROM content WHERE conte_name=:conte_name LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":conte_name", $content->conte_name, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT p.* FROM content AS p WHERE p.conte_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelContent $content = null) {
        if (!is_object($content)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE content SET ";
        $this->query .= "conte_component=:conte_component, ";
        $this->query .= "conte_title=:conte_title, ";
        $this->query .= "conte_subtitle=:conte_subtitle, ";
        $this->query .= "conte_text=:conte_text, ";
        $this->query .= "conte_image=:conte_image, ";
        $this->query .= "conte_link=:conte_link, ";
        $this->query .= "conte_fk_id=:conte_fk_id, ";
        $this->query .= "conte_fk_page_pk_id=:conte_fk_page_pk_id ";
        $this->query .= " WHERE conte_pk_id=:conte_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':conte_component', $content->conte_component, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_title', $content->conte_title, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_subtitle', $content->conte_subtitle, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_text', $content->conte_text, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_image', $content->conte_image, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_link', $content->conte_link, PDO::PARAM_STR);
        $this->statement->bindParam(':conte_fk_id', $content->conte_fk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':conte_fk_page_pk_id', $content->conte_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':conte_pk_id', $content->conte_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelContent $content = null) {
        if (!is_object($content)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE content SET ";
        $this->query .= "conte_status=:conte_status ";
        $this->query .= "WHERE conte_pk_id=:conte_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':conte_status', $content->conte_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':conte_pk_id', $content->conte_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
