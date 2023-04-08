<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOUsuarioGrupo extends GenericDAO {

    public function deleteBatchByNotExistsArray(ModelUsuarioGrupo $usuarioGrupo = null) {
        if (!is_object($usuarioGrupo)) {
            throw new Exception("Dados incompletos");
        }
        try {
            $this->query = "DELETE ug.* FROM usuarios_grupos AS ug ";
            $this->query .= "INNER JOIN usuarios_grupos AS ug2 ON ug2.usuario_id = ug.usuario_id AND ug2.grupo_id=ug.grupo_id ";
            $this->query .= "WHERE ug.status = 1 ";
            $this->query .= "AND ug.grupo_id = :grupo_id "; 
            if($usuarioGrupo->ids_usuarios)
                $this->query .= "AND ug.usuario_id NOT IN ($usuarioGrupo->ids_usuarios) ";
            $this->query .= "AND ug2.status = 1 ";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":grupo_id", $usuarioGrupo->grupo_id, PDO::PARAM_INT);
            print_r($usuarioGrupo);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function saveBatch(array $modelUsuariosGrupo){
        if (!is_array($modelUsuariosGrupo)) {
            throw new Exception("Lista de permissões não é válida");
        }
        try {
            $this->query = "INSERT INTO usuarios_grupos ";
            $this->query .= "(grupo_id, usuario_id, status, usuario) ";
            $this->query .= "VALUES ";
            $this->query .= "(:grupo_id, :usuario_id, :status, :usuario);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            foreach ($modelUsuariosGrupo as $cada_usuario) {
                $this->statement->execute(array(':grupo_id'=>$cada_usuario->grupo_id, ':usuario_id'=>$cada_usuario->usuario_id, ':status'=>$cada_usuario->status, ':usuario'=>$cada_usuario->usuario));
            }
        } catch (Exception $erro) {
            // print_r($erro);
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function selectObjectsByContainsObject(ModelUsuarioGrupo $usuarioGrupo = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM usuarios_grupos ";
        $this->query .= "WHERE ";
        $this->query .= "descricao LIKE '%$usuarioGrupo->descricao%';";
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
        $this->query = "SELECT ug.* FROM usuarios_grupos AS ug WHERE ug.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelUsuarioGrupo $usuarioGrupo = null) {
        if (!is_object($usuarioGrupo)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE usuarios_grupos SET ";
        $this->query .= "menu_item_id=:menu_item_id, ";
        $this->query .= "usuario=:usuario ";
        $this->query .= "status=:status, ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':descricao', $usuarioGrupo->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':nome', $usuarioGrupo->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':menu_item_id', $usuarioGrupo->menu_item_id, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario', $usuarioGrupo->usuario, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $usuarioGrupo->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelUsuarioGrupo $usuarioGrupo = null) {
        if (!is_object($usuarioGrupo)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE usuarios_grupos SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario=:usuario ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $usuarioGrupo->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario', $usuarioGrupo->usuario, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $usuarioGrupo->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
