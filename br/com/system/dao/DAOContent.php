<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOContent extends GenericDAO {

    public function delete($cont_pk_id = 0) {
        try {
            $this->query = "DELETE FROM content WHERE cont_pk_id=:cont_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":cont_pk_id", $cont_pk_id, PDO::PARAM_INT);
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
        $this->query .= "(cont_component, cont_title, cont_subtitle, cont_text, cont_image, cont_link, cont_fk_user_pk_id, cont_fk_page_pk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:cont_component, :cont_title, :cont_subtitle, :cont_text, :cont_image, :cont_link, :cont_fk_user_pk_id, :cont_fk_page_pk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_component', $content->cont_component, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_title', $content->cont_title, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_subtitle', $content->cont_subtitle, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_text', $content->cont_text, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_image', $content->cont_image, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_link', $content->cont_link, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_fk_user_pk_id', $content->cont_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':cont_fk_page_pk_id', $content->cont_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function select() {
        $this->query = "SELECT * FROM content;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectById($cont_pk_id = 0) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.user_pk_id, u.user_pk_id ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.cont_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.cont_fk_user_pk_id = u.user_pk_id) ";
        $this->query .= "WHERE cont_pk_id=:cont_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":cont_pk_id", $cont_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsObject(ModelContent $content = null) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.user_pk_id, u.user_name ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.cont_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.cont_fk_user_pk_id = u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.cont_component LIKE '%$content->cont_component%' AND ";
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
        $this->query .= "INNER JOIN page AS p ON (c.cont_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.cont_fk_user_pk_id = u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.cont_status = 1 AND ";
        $this->query .= "c.cont_fk_page_pk_id = :cont_fk_page_pk_id AND ";
        $this->query .= "c.cont_component = :cont_component;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":cont_fk_page_pk_id", $content->cont_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(":cont_component", $content->cont_component, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectContentByContainsObject(ModelContent $content = null) {
        $this->query = "SELECT ";
        $this->query .= "c.*, p.page_pk_id, p.page_name, u.user_pk_id, u.user_name ";
        $this->query .= "FROM content AS c ";
        $this->query .= "INNER JOIN page AS p ON (c.cont_fk_page_pk_id = p.page_pk_id) ";
        $this->query .= "INNER JOIN user AS u ON (c.cont_fk_user_pk_id = u.user_pk_id) ";
        $this->query .= "WHERE ";
        $this->query .= "c.cont_fk_page_pk_id = :cont_fk_page_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":cont_fk_page_pk_id", $content->cont_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($cont_name = null) {
        $this->query = "SELECT * FROM content WHERE cont_name = :cont_name AND cont_status = :cont_status LIMIT 1;";
        $cont_status = true;
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":cont_name", $cont_name, PDO::PARAM_STR);
        $this->statement->bindParam(":cont_status", $cont_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelContent $content = null) {
        $this->query = "SELECT * FROM content WHERE cont_name=:cont_name LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":cont_name", $content->cont_name, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT p.* FROM content AS p WHERE p.cont_status = 1;";
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
        $this->query .= "cont_component=:cont_component, ";
        $this->query .= "cont_title=:cont_title, ";
        $this->query .= "cont_subtitle=:cont_subtitle, ";
        $this->query .= "cont_text=:cont_text, ";
        $this->query .= "cont_image=:cont_image, ";
        $this->query .= "cont_link=:cont_link, ";
        $this->query .= "cont_fk_user_pk_id=:cont_fk_user_pk_id, ";
        $this->query .= "cont_fk_page_pk_id=:cont_fk_page_pk_id ";
        $this->query .= " WHERE cont_pk_id=:cont_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_component', $content->cont_component, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_title', $content->cont_title, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_subtitle', $content->cont_subtitle, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_text', $content->cont_text, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_image', $content->cont_image, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_link', $content->cont_link, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_fk_user_pk_id', $content->cont_fk_user_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':cont_fk_page_pk_id', $content->cont_fk_page_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':cont_pk_id', $content->cont_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelContent $content = null) {
        if (!is_object($content)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE content SET ";
        $this->query .= "cont_status=:cont_status ";
        $this->query .= "WHERE cont_pk_id=:cont_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_status', $content->cont_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':cont_pk_id', $content->cont_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
