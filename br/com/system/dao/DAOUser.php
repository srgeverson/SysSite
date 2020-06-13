<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('br/com/system/dao/GenericDAO.php');

class DAOUser extends GenericDAO {

    public function createOtherUser(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO user ";
            $this->query .= "(user_name, user_login, user_password, user_status, user_fk_authority_pk_id) ";
            $this->query .= "VALUES ";
            $this->query .= "(:user_name, :user_login, :user_password, :user_status, :user_fk_authority_pk_id);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':user_name', $user->user_name, PDO::PARAM_STR);
            $this->statement->bindParam(':user_login', $user->user_login, PDO::PARAM_STR);
            $this->statement->bindParam(':user_password', $user->user_password, PDO::PARAM_STR);
            $this->statement->bindParam(':user_status', $user->user_status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':user_fk_authority_pk_id', $user->user_fk_authority_pk_id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function delete($user_pk_id = "") {
        $this->query = "DELETE FROM user WHERE user_pk_id=:user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":user_pk_id", $user_pk_id, PDO::PARAM_STR);
        $this->statement->execute();

        return true;
    }

    public function save(ModelUser $user = null) {
        try {
            if (!is_object($user)) {
                throw new Exception("Dados incompletos");
            }
            $this->query = "INSERT INTO user ";
            $this->query .= "(user_name, user_login, user_password, user_status, user_image) ";
            $this->query .= "VALUES ";
            $this->query .= "(:user_name, :user_login, :user_password, :user_status, :user_image);";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':user_name', $user->user_name, PDO::PARAM_STR);
            $this->statement->bindParam(':user_login', $user->user_login, PDO::PARAM_STR);
            $this->statement->bindParam(':user_login', $user->user_password, PDO::PARAM_STR);
            $this->statement->bindParam(':user_status', $user->user_status, PDO::PARAM_BOOL);
            $this->statement->bindParam(':user_image', $user->user_image, PDO::PARAM_STR);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function select() {
        $this->query = "SELECT ";
        $this->query .= "u.* ";
        $this->query .= "FROM ";
        $this->query .= "user AS u;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectLogAccess($user_pk_id = null) {
        $this->query = "SELECT ";
        $this->query .= "* ";
        $this->query .= "FROM user AS u ";
        $this->query .= "RIGHT JOIN log_user AS lu ON (u.user_pk_id = lu.lusua_id_tabela) ";
        $this->query .= "WHERE u.user_pk_id = :user_pk_id AND lu.lusua_o_que_modificou = 'Data Ultimo Acesso';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_pk_id', $user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectById($user_pk_id = "") {
        $this->query = "SELECT ";
        $this->query .= "u.* ";
        $this->query .= "FROM user AS u ";
        $this->query .= "WHERE u.user_pk_id = :user_pk_id LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":user_pk_id", $user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectCountObjectsByFKAuthority($user_fk_authority_pk_id = null) {
        $this->query = "SELECT ";
        $this->query .= "COUNT(*) user_quantidade ";
        $this->query .= "FROM user AS u ";
        $this->query .= "WHERE u.user_fk_authority_pk_id = :user_fk_authority_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_fk_authority_pk_id', $user_fk_authority_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByName($user_login = "") {
        $this->query = "SELECT ";
        $this->query .= "u.*, a.* ";
        $this->query .= "FROM user AS u ";
        $this->query .= "INNER JOIN authority AS a ON u.user_fk_authority_pk_id = a.auth_pk_id ";
        $this->query .= "WHERE u.user_login = :user_login LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_login', $user_login, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function update(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }

        $this->query = "UPDATE user SET ";
        $this->query .= "user_name=:user_name, ";
        $this->query .= "user_login=:user_login, ";
        $this->query .= "user_password=:user_password, ";
        $this->query .= "user_image=:user_image, ";
        $this->query .= "user_fk_authority_pk_id=:user_fk_authority_pk_id ";
        $this->query .= "WHERE user_pk_id=:user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_name', $user->user_name, PDO::PARAM_STR);
        $this->statement->bindParam(':user_login', $user->user_login, PDO::PARAM_STR);
        $this->statement->bindParam(':user_password', $user->user_password, PDO::PARAM_STR);
        $this->statement->bindParam(':user_image', $user->user_image, PDO::PARAM_STR);
        $this->statement->bindParam(':user_fk_authority_pk_id', $user->user_fk_authority_pk_id, PDO::PARAM_INT);
        $this->statement->bindParam(':user_pk_id', $user->user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();

        return true;
    }

    public function update_user(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }

        $this->query = "UPDATE user SET ";
        $this->query .= "user_name=:user_name, ";
        $this->query .= "user_password=:user_password, ";
        $this->query .= "user_image=:user_image ";
        $this->query .= "WHERE user_pk_id=:user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_name', $user->user_name, PDO::PARAM_STR);
        $this->statement->bindParam(':user_password', $user->user_password, PDO::PARAM_STR);
        $this->statement->bindParam(':user_image', $user->user_image, PDO::PARAM_STR);
        $this->statement->bindParam(':user_pk_id', $user->user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();

        return true;
    }

    public function updateStatus(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE user SET ";
        $this->query .= "user_status=:user_status ";
        $this->query .= "WHERE user_pk_id=:user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_status', $user->user_status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':user_pk_id', $user->user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function updateLastAccess(ModelUser $user = null) {
        if (!is_object($user)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE user SET ";
        $this->query .= "user_last_login=:user_last_login ";
        $this->query .= "WHERE user_pk_id=:user_pk_id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':user_last_login', $user->user_last_login, PDO::PARAM_STR);
        $this->statement->bindParam(':user_pk_id', $user->user_pk_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
