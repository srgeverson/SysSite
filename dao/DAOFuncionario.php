<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOFuncionario extends GenericDAO {

    public function delete($id = null) {
        try {
            $this->query = "DELETE FROM funcionarios WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionarios ";
        $this->query .= "(nome, cpf, rg, pis, data_nascimento, status, contato_id, endereco_id, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :cpf, :rg, :pis, :data_nascimento, :status, :contato_id, :endereco_id, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $funcionario->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':cpf', $funcionario->cpf, PDO::PARAM_STR);
        $this->statement->bindParam(':rg', $funcionario->rg, PDO::PARAM_STR);
        $this->statement->bindParam(':pis', $funcionario->pis, PDO::PARAM_STR);
        $this->statement->bindParam(':data_nascimento', $funcionario->data_nascimento, PDO::PARAM_STR);
        $this->statement->bindParam(':contato_id', $funcionario->contato_id, PDO::PARAM_INT);
        $this->statement->bindParam(':endereco_id', $funcionario->endereco_id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $funcionario->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':status', $funcionario->status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return true;
    }

    public function saveAndReturnPkId(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO funcionarios ";
        $this->query .= "(nome, cpf, rg, pis, data_nascimento, status, contato_id, endereco_id, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :cpf, :rg, :pis, :data_nascimento, :status, :contato_id, :endereco_id, :usuario_id);";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $funcionario->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':cpf', $funcionario->cpf, PDO::PARAM_STR);
            $this->statement->bindParam(':rg', $funcionario->rg, PDO::PARAM_STR);
            $this->statement->bindParam(':pis', $funcionario->pis, PDO::PARAM_STR);
            $this->statement->bindParam(':data_nascimento', $funcionario->data_nascimento, $funcionario->data_nascimento ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $this->statement->bindParam(':contato_id', $funcionario->contato_id, PDO::PARAM_INT);
            $this->statement->bindParam(':endereco_id', $funcionario->endereco_id, PDO::PARAM_INT);
            $this->statement->bindParam(':usuario_id', $funcionario->usuario_id, PDO::PARAM_INT);
            $this->statement->bindParam(':status', $funcionario->status, PDO::PARAM_BOOL);
            $this->statement->execute();
            return $conexao->lastInsertId();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
    }

    public function selectObjectByCPF($cpf = null) {
        $this->query = "SELECT ";
        $this->query .= "f.* ";
        $this->query .= "FROM funcionarios AS f ";
        $this->query .= "INNER JOIN enderecos AS e ON (f.endereco_id=e.id) ";
        $this->query .= "INNER JOIN contatos AS c ON (f.contato_id=c.id) ";
        $this->query .= "INNER JOIN usuarios AS fu ON (fu.cpf=f.cpf) ";
        $this->query .= "LEFT JOIN usuarios AS u ON (u.id=u.usuario_id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.cpf=:cpf LIMIT 1;";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $this->statement->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
    }

    public function selectObjectById($id = null) {
        $this->query = "SELECT ";
        $this->query .= "f.* ";
        $this->query .= "FROM funcionarios AS f ";
        $this->query .= "INNER JOIN enderecos AS e ON (f.endereco_id=e.id) ";
        $this->query .= "INNER JOIN contatos AS c ON (f.contato_id=c.id) ";
        $this->query .= "INNER JOIN usuarios AS fu ON (fu.cpf=f.cpf) ";
        $this->query .= "LEFT JOIN usuarios AS u ON (u.id=f.usuario_id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.id=:id LIMIT 1;";
        
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

    public function selectObjectsByContainsObject(ModelFuncionario $funcionario = null) {
        $this->query = "SELECT ";
        $this->query .= "f.* ";
        $this->query .= "FROM funcionarios AS f ";
        $this->query .= "INNER JOIN enderecos AS e ON (f.endereco_id=e.id) ";
        $this->query .= "INNER JOIN contatos AS c ON (f.contato_id=c.id) ";
        $this->query .= "INNER JOIN usuarios AS uf ON (f.cpf=uf.cpf) ";
        $this->query .= "LEFT JOIN usuarios AS u ON (f.usuario_id=u.id) ";
        $this->query .= "WHERE 1 = 1 ";
        if($funcionario->nome)
            $this->query .= " AND f.nome LIKE '%$funcionario->nome%' ";
        if($funcionario->cpf)
            $this->query .= " AND f.cpf LIKE '%$funcionario->cpf%' ";
        if($funcionario->rg)
            $this->query .= " AND f.rg LIKE '%$funcionario->rg%';";
        //echo($this->query);
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
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM funcionarios AS f ";
        $this->query .= "INNER JOIN contatos AS c ON (f.contato_id=c.id) ";
        $this->query .= "INNER JOIN usuarios AS u ON (f.usuario_id=u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "f.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionarios SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "cpf=:cpf, ";
        $this->query .= "rg=:rg, ";
        $this->query .= "pis=:pis, ";
        $this->query .= "data_nascimento=:data_nascimento, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $funcionario->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':cpf', $funcionario->cpf, PDO::PARAM_STR);
        $this->statement->bindParam(':rg', $funcionario->rg, PDO::PARAM_STR);
        $this->statement->bindParam(':pis', $funcionario->pis, PDO::PARAM_STR);
        $this->statement->bindParam(':data_nascimento', $funcionario->data_nascimento, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $funcionario->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $funcionario->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelFuncionario $funcionario = null) {
        if (!is_object($funcionario)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE funcionarios SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $funcionario->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $funcionario->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $funcionario->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
