<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOContact extends GenericDAO {

    public function delete($cont_pk_id = 0) {
        try {
            $this->query = "DELETE FROM contact WHERE cont_pk_id=:cont_pk_id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":cont_pk_id", $cont_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelContact $contact = null) {
        if (!is_object($contact)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO contact ";
        $this->query .= "(cont_description, cont_phone, cont_cell_phone, cont_whatsapp, cont_email, cont_facebook, cont_instagram, cont_text, cont_status) ";
        $this->query .= "VALUES ";
        $this->query .= "(:cont_description, :cont_phone, :cont_cell_phone, :cont_whatsapp, :cont_email, :cont_facebook, :cont_instagram, :cont_text, :cont_status);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_description', $contact->cont_description, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_phone', $contact->cont_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_cell_phone', $contact->cont_cell_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_whatsapp', $contact->cont_whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_email', $contact->cont_email, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_facebook', $contact->cont_facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_instagram', $contact->cont_instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_text', $contact->cont_text, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_status', $contact->cont_status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelContact $contact = null) {
        if (!is_object($contact)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO contact ";
        $this->query .= "(cont_description, cont_phone, cont_cell_phone, cont_whatsapp, cont_email, cont_facebook, cont_instagram, cont_text, cont_status, cont_fk_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:cont_description, :cont_phone, :cont_cell_phone, :cont_whatsapp, :cont_email, :cont_facebook, :cont_instagram, :cont_text, :cont_status, :cont_fk_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_description', $contact->cont_description, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_phone', $contact->cont_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_cell_phone', $contact->cont_cell_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_whatsapp', $contact->cont_whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_email', $contact->cont_email, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_facebook', $contact->cont_facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_instagram', $contact->cont_instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_text', $contact->cont_text, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_status', $contact->cont_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':cont_fk_id', $contact->cont_fk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($cont_pk_id = 0) {
        $this->query = "SELECT * FROM contact WHERE cont_pk_id=:cont_pk_id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelContact $contact = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM contact ";
        $this->query .= "WHERE ";
        $this->query .= "cont_description LIKE '%$contact->cont_description%' AND ";
        $this->query .= "cont_cell_phone LIKE '%$contact->cont_cell_phone%';";
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
        $this->query = "SELECT p.* FROM contact AS p WHERE p.cont_status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelContact $contact = null) {
        if (!is_object($contact)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE contact SET ";
        $this->query .= "cont_description=:cont_description, ";
        $this->query .= "cont_phone=:cont_phone, ";
        $this->query .= "cont_cell_phone=:cont_cell_phone, ";
        $this->query .= "cont_whatsapp=:cont_whatsapp, ";
        $this->query .= "cont_email=:cont_email, ";
        $this->query .= "cont_facebook=:cont_facebook, ";
        $this->query .= "cont_instagram=:cont_instagram, ";
        $this->query .= "cont_text=:cont_text ";
        $this->query .= " WHERE cont_pk_id=:cont_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_description', $contact->cont_description, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_phone', $contact->cont_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_cell_phone', $contact->cont_cell_phone, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_whatsapp', $contact->cont_whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_email', $contact->cont_email, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_facebook', $contact->cont_facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_instagram', $contact->cont_instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_text', $contact->cont_text, PDO::PARAM_STR);
        $this->statement->bindParam(':cont_pk_id', $contact->cont_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelContact $contact = null) {
        if (!is_object($contact)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE contact SET ";
        $this->query .= "cont_status=:cont_status ";
        $this->query .= "WHERE cont_pk_id=:cont_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cont_status', $contact->cont_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':cont_pk_id', $contact->cont_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
