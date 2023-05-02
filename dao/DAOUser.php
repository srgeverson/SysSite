<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOUser extends GenericDAO {

    public function createOtherUser(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO usuarios ";
            $this->query .= "(nome, cpf, login, senha, status, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:nome, :login, :senha, :status, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':cpf', $user->cpf, PDO::PARAM_STR);
            $this->statement->bindParam(':login', $user->login, PDO::PARAM_STR);
            $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $user->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function createOtherUserAndReturnId(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO usuarios ";
            $this->query .= "(nome, cpf, login, senha, status, usuario_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:nome, :login, :senha, :status, :usuario_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':cpf', $user->cpf, PDO::PARAM_STR);
            $this->statement->bindParam(':login', $user->login, PDO::PARAM_STR);
            $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $user->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_INT);
            $this->statement->execute();
            return $conexao->lastInsertId();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
    }

    public function delete($id = null) {
        $this->query = "DELETE FROM usuarios WHERE id=:id;";
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

    public function save(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO usuarios ";
            $this->query .= "(nome, cpf, login, senha, status, imagem) ";
            $this->query .= "VALUES ";
            $this->query .= "(:nome, :cpf, :login, :senha, :status, :imagem);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':cpf', isst($user->cpf) ? $user->cpf : null, PDO::PARAM_STR);
            $this->statement->bindParam(':login', $user->login, PDO::PARAM_STR);
            $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $user->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':imagem', $user->imagem, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function saveAndReturnId(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO usuarios ";
            $this->query .= "(nome, cpf, login, senha, status, imagem) ";
            $this->query .= "VALUES ";
            $this->query .= "(:nome, :cpf, :login, :senha, :status, :imagem);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':cpf', $user->cpf, PDO::PARAM_STR);
            $this->statement->bindParam(':login', $user->login, PDO::PARAM_STR);
            $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
            $this->statement->bindParam(':status', $user->status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':imagem', $user->imagem, PDO::PARAM_STR);
            $this->statement->execute();
            return $conexao->lastInsertId();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
    }

    public function selectObjectById($id = "") {
        $this->query = "SELECT u.* ";
        //kkkkk
        //$this->query .= "u.*, a.id, a.descricao ";
        $this->query .= "FROM usuarios AS u ";
        //kkkkk
        //$this->query .= "INNER JOIN permissao AS a ON (u.user_fk_permissao_pk_id = a.id) ";
        $this->query .= "WHERE u.id = :id LIMIT 1;";
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

    public function selectObjectsByContainsObjetc(ModelUser $user = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM usuarios AS u ";
        //$this->query .= "INNER JOIN permissao AS a ON (u.user_fk_permissao_pk_id = a.id) ";
        $this->query .= "WHERE 1 = 1 ";
        $this->query .= "AND u.nome LIKE '%$user->nome%' ";
        $this->query .= "AND u.login LIKE '%$user->login%' ";
        //$this->query .= "u.user_fk_permissao_pk_id LIKE '%$user->user_fk_permissao_pk_id%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectCountObjectsByFKAuthority($user_fk_permissao_pk_id = null) {
        $this->query = "SELECT ";
        $this->query .= "u.id, u.nome ";
        $this->query .= "FROM usuarios AS u ";
        //$this->query .= "WHERE u.user_fk_permissao_pk_id = :user_fk_permissao_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        //$this->statement->bindParam(':user_fk_permissao_pk_id', $user_fk_permissao_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByName($login = "") {
        $this->query = "SELECT u.* ";
        //$this->query .= "u.*, a.* ";
        $this->query .= "FROM usuarios AS u ";
        //$this->query .= "INNER JOIN permissao AS a ON u.user_fk_permissao_pk_id = a.id ";
        $this->query .= "WHERE u.login = :login LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':login', $login, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByCPF($cpf = "") {
        $this->query = "SELECT u.* ";
        //$this->query .= "u.*, a.* ";
        $this->query .= "FROM usuarios AS u ";
        //$this->query .= "INNER JOIN permissao AS a ON u.user_fk_permissao_pk_id = a.id ";
        $this->query .= "WHERE u.cpf = :cpf LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsNotInFuncionarioUser() {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM usuarios AS u ";
        $this->query .= "WHERE ";
        $this->query .= "u.id NOT IN (SELECT fu.fuus_fk_id FROM funcionario_user AS fu) AND ";
        $this->query .= "u.id <> 1 AND ";
        $this->query .= "u.status = 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsNotExistsFuncionario() {
        $this->query = "SELECT u.* FROM usuarios AS u WHERE u.status = 1 AND  NOT EXISTS (SELECT 1 FROM funcionarios AS f WHERE f.cpf = u.cpf);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsUsuariosByFKGrupo($grupo_id = null) {
        $this->query = "SELECT u.* FROM usuarios AS u ";
        $this->query .= "WHERE u.status = 1 ";
        $this->query .= "AND EXISTS(SELECT 1 FROM usuarios_grupos AS ug WHERE ug.status =  1 AND ug.usuario_id = u.id AND ug.grupo_id = :grupo_id) ";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":grupo_id", $grupo_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsUsuariosByNotFKGrupo($grupo_id = null) {
        $this->query = "SELECT u.* FROM usuarios AS u ";
        $this->query .= "WHERE u.status = 1 ";
        $this->query .= "AND NOT EXISTS(SELECT 1 FROM usuarios_grupos AS ug WHERE ug.status =  1 AND ug.usuario_id = u.id AND ug.grupo_id = :grupo_id) ";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":grupo_id", $grupo_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }

        $this->query = "UPDATE usuarios SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "login=:login, ";
       if($user->senha)
            $this->query .= "senha=:senha, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':login', $user->login, PDO::PARAM_STR);
       if($user->senha)
            $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $user->id, PDO::PARAM_INT);
        $this->statement->execute();

        return true;
    }

    public function update_user(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }

        $this->query = "UPDATE usuarios SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "senha=:senha, ";
        $this->query .= "imagem=:imagem, ";        
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $user->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
        $this->statement->bindParam(':imagem', $user->imagem, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_STR);
        $this->statement->bindParam(':id', $user->id, PDO::PARAM_INT);
        $this->statement->execute();

        return true;
    }

    public function updatePassword(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE usuarios SET ";
        $this->query .= "senha=:senha, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':senha', $user->senha, PDO::PARAM_STR);
        $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_STR);
        $this->statement->bindParam(':id', $user->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateStatus(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE usuarios SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $user->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $user->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateLastAccess(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE usuarios SET ";
        $this->query .= "ultimo_acesso=:ultimo_acesso, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':ultimo_acesso', $user->ultimo_acesso, PDO::PARAM_STR);
        $this->statement->bindParam(':id', $user->id, PDO::PARAM_INT);
        $this->statement->bindParam(':usuario_id', $user->usuario_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
