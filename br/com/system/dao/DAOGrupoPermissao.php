<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOGrupoPermissao extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM grupos_permissoes WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function deleteBatchByNotExistsArray(ModelGrupoPermissao $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        try {
            $this->query = "DELETE gp.* FROM grupos_permissoes AS gp ";
            $this->query .= "INNER JOIN grupos_permissoes AS gp2 ON gp2.permissao_id = gp.permissao_id AND gp2.grupo_id=gp.grupo_id ";
            $this->query .= "WHERE gp.status = 1 ";
            $this->query .= "AND gp.grupo_id = :grupo_id "; 
            if(!empty($authority->ids_permissoes))
                $this->query .= "AND gp.permissao_id NOT IN ($authority->ids_permissoes) ";
            $this->query .= "AND gp2.status = 1 ";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":grupo_id", $authority->grupo_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }
    public function save(ModelGrupoPermissao $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        try {
            $this->query = "INSERT INTO grupos_permissoes ";
            $this->query .= "(descricao, nome, status, menu_item_id, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:descricao, :nome, :status, :menu_item_id, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':descricao', $authority->descricao, PDO::PARAM_STR);
            $this->statement->bindParam(':nome', $authority->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $authority->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':menu_item_id', $authority->menu_item_id, PDO::PARAM_STR);
            $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            // print_r($erro);
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function saveBatch(array $modelPermissoesGrupo){
        if (!is_array($modelPermissoesGrupo)) {
            throw new Exception("Lista de permissões não é válida");
        }
       
        try {
            $this->query = "INSERT INTO grupos_permissoes ";
            $this->query .= "(grupo_id, permissao_id, status, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:grupo_id, :permissao_id, :status, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            foreach ($modelPermissoesGrupo as $cada_permissao) {
                $this->statement->execute(array(':grupo_id'=>$cada_permissao->grupo_id, ':permissao_id'=>$cada_permissao->permissao_id, ':status'=>$cada_permissao->status, ':usuario_id'=>$cada_permissao->usuario_id));
            }
        } catch (Exception $erro) {
            // print_r($erro);
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM grupos_permissoes WHERE id=:id LIMIT 1;";
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

    public function selectObjectsByContainsObject(ModelGrupoPermissao $authority = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM grupos_permissoes ";
        $this->query .= "WHERE ";
        $this->query .= "descricao LIKE '%$authority->descricao%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsByContainsFkPermissao($permissao_id = null) {
        $this->query = "SELECT ";
        $this->query .= "gp.* ";
        $this->query .= "FROM grupos_permissoes AS gp ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND gp.permissao_id =:permissao_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":permissao_id", $permissao_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT gp.* FROM grupos_permissoes AS gp WHERE gp.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelGrupoPermissao $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE grupos_permissoes SET ";
        $this->query .= "menu_item_id=:menu_item_id, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "status=:status, ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $authority->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':nome', $authority->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':menu_item_id', $authority->menu_item_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $authority->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelGrupoPermissao $authority = null) {
        if (!is_object($authority)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE grupos_permissoes SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $authority->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $authority->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $authority->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
