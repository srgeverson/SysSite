<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOContato extends GenericDAO {

    public function delete($id = null) {
        try {
            $this->query = "DELETE FROM contatos WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelContato $contato = null) {
        if (!is_object($contato)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO contatos ";
        $this->query .= "(descricao, telefone, celular, whatsapp, email, facebook, instagram, observacao, status) ";
        $this->query .= "VALUES ";
        $this->query .= "(:descricao, :telefone, :celular, :whatsapp, :email, :facebook, :instagram, :observacao, :status);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $contato->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':telefone', $contato->telefone, PDO::PARAM_STR);
        $this->statement->bindParam(':celular', $contato->celular, PDO::PARAM_STR);
        $this->statement->bindParam(':whatsapp', $contato->whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $contato->email, PDO::PARAM_STR);
        $this->statement->bindParam(':facebook', $contato->facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':instagram', $contato->instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':observacao', $contato->observacao, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $contato->status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelContato $contato = null) {
        if (!is_object($contato)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO contatos ";
        $this->query .= "(descricao, telefone, celular, whatsapp, email, facebook, instagram, observacao, status, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:descricao, :telefone, :celular, :whatsapp, :email, :facebook, :instagram, :observacao, :status, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $contato->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':telefone', $contato->telefone, PDO::PARAM_STR);
        $this->statement->bindParam(':celular', $contato->celular, PDO::PARAM_STR);
        $this->statement->bindParam(':whatsapp', $contato->whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $contato->email, PDO::PARAM_STR);
        $this->statement->bindParam(':facebook', $contato->facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':instagram', $contato->instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':observacao', $contato->observacao, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $contato->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $contato->usuario_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $conexao->lastInsertId();
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM contatos WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelContato $contato = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM contatos ";
        $this->query .= "WHERE ";
        $this->query .= "descricao LIKE '%$contato->descricao%' AND ";
        $this->query .= "celular LIKE '%$contato->celular%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelContato $contato = null) {
        if (!is_object($contato)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE contatos SET ";
        $this->query .= "descricao=:descricao, ";
        $this->query .= "telefone=:telefone, ";
        $this->query .= "celular=:celular, ";
        $this->query .= "whatsapp=:whatsapp, ";
        $this->query .= "email=:email, ";
        $this->query .= "facebook=:facebook, ";
        $this->query .= "instagram=:instagram, ";
        $this->query .= "observacao=:observacao, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $contato->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':telefone', $contato->telefone, PDO::PARAM_STR);
        $this->statement->bindParam(':celular', $contato->celular, PDO::PARAM_STR);
        $this->statement->bindParam(':whatsapp', $contato->whatsapp, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $contato->email, PDO::PARAM_STR);
        $this->statement->bindParam(':facebook', $contato->facebook, PDO::PARAM_STR);
        $this->statement->bindParam(':instagram', $contato->instagram, PDO::PARAM_STR);
        $this->statement->bindParam(':observacao', $contato->observacao, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $contato->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $contato->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelContato $contato = null) {
        if (!is_object($contato)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE contatos SET ";
        $this->query .= "status=:status ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $contato->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':id', $contato->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
