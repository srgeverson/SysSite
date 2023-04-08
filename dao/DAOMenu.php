<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOMenu extends GenericDAO {

    public function delete($id = 0) {
        try {
            $this->query = "DELETE FROM menus WHERE id=:id;";
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(":id", $id, PDO::PARAM_INT);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return true;
    }

    public function save(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "INSERT INTO menus ";
        $this->query .= "(nome, descricao, icone, image, url, class, status, sistema_id, usuario_id) ";
        $this->query .= "VALUES ";
        $this->query .= "(:nome, :descricao, :icone, :image, :url, :class, :status, :sistema_id, :usuario_id);";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':nome', $menu->nome, PDO::PARAM_STR);
        $this->statement->bindParam(':descricao', $menu->descricao, PDO::PARAM_STR);
        $this->statement->bindParam(':icone', $menu->icone, PDO::PARAM_STR);
        $this->statement->bindParam(':image', $menu->image, PDO::PARAM_STR);
        $this->statement->bindParam(':url', $menu->url, PDO::PARAM_STR);
        $this->statement->bindParam(':class', $menu->class, PDO::PARAM_STR);
        $this->statement->bindParam(':status', $menu->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $menu->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':sistema_id', $menu->sistema_id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

    public function selectObjectById($id = 0) {
        $this->query = "SELECT * FROM menus WHERE id=:id LIMIT 1;";
        //echo $this->query;
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

    public function selectObjectsByContainsObject(ModelMenu $menus = null) {
        $this->query = "SELECT ";
        $this->query .= "m.*, u.id AS usuario_id, u.nome AS usuario_nome ";
        $this->query .= "FROM menus AS m  ";
        $this->query .= "INNER JOIN usuarios AS u ON (m.usuario_id = u.id) ";
        $this->query .= "WHERE ";
        $this->query .= "m.nome LIKE '%$menu->nome%' AND ";
        $this->query .= "m.descricao LIKE '%$menu->descricao%';";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectByKey($nome = null) {
        $this->query = "SELECT * FROM menus WHERE nome = :nome AND status = :status LIMIT 1;";
        $status = true;
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":nome", $nome, PDO::PARAM_STR);
        $this->statement->bindParam(":status", $status, PDO::PARAM_BOOL);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectByObject(ModelMenu $menus = null) {
        $this->query = "SELECT * FROM menus WHERE nome=:nome LIMIT 1;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(":nome", $menu->nome, PDO::PARAM_STR);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function selectObjectsEnabled() {
        $this->query = "SELECT m.* FROM menus AS m  WHERE m.status = 1 AND m.sistema_id = 1 ORDER BY id DESC;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectObjectsVinculadosAoUsuario($id = null) {
        $this->query = "";
        $this->query .= "SELECT ";
        $this->query .= "    m.id, m.nome, m.descricao,m.status,m.class, m.url,m.image,m.icone,m.sistema_id ";
        $this->query .= "FROM menus AS m  ";
        $this->query .= "INNER JOIN menu_itens AS mi ON mi.menu_id = m.id ";
        $this->query .= "INNER JOIN permissoes AS p ON p.menu_item_id = mi.id ";
        $this->query .= "INNER JOIN grupos_permissoes AS gp ON gp.permissao_id = p.id ";
        $this->query .= "INNER JOIN usuarios_grupos AS ug ON ug.grupo_id = gp.grupo_id ";
        $this->query .= "WHERE ";
        $this->query .= "    1 = 1 ";
        $this->query .= "    AND m.status = 1 ";
        $this->query .= "    AND m.sistema_id = 1 ";
        $this->query .= "    AND ug.usuario_id = :usuario_id ";
        $this->query .= "GROUP BY ";
        $this->query .= "    m.id, m.nome, m.descricao,m.status,m.class, m.url,m.image,m.icone,m.sistema_id ";
        $this->query .= "ORDER BY m.id DESC;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':usuario_id', $id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menus SET ";
        $this->query .= "nome=:nome, ";
        $this->query .= "descricao=:descricao, ";
        if($menu->icone)
            $this->query .= "icone=:icone, ";
        $this->query .= "class=:class, ";
        $this->query .= "url=:url, ";
        $this->query .= "image=:image, ";
        $this->query .= "sistema_id=:sistema_id, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= " WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->bindParam(':nome', $menu->nome, PDO::PARAM_STR);
            $this->statement->bindParam(':descricao', $menu->descricao, PDO::PARAM_STR);
            if($menu->icone)
                $this->statement->bindParam(':icone', $menu->icone, PDO::PARAM_STR);
            $this->statement->bindParam(':class', $menu->class, PDO::PARAM_STR);
            $this->statement->bindParam(':url', $menu->url, PDO::PARAM_STR);
            $this->statement->bindParam(':image', $menu->image, PDO::PARAM_STR);
            $this->statement->bindParam(':sistema_id', $menu->sistema_id, PDO::PARAM_INT);
            $this->statement->bindParam(':usuario_id', $menu->usuario_id, PDO::PARAM_INT);
            $this->statement->bindParam(':id', $menu->id, PDO::PARAM_INT);
            $this->statement->execute();
            } catch (Exception $erro) {
                print_r($erro);
                throw new Exception($erro->getMessage());
            }
        return true;
    }

    public function updateStatus(ModelMenu $menu = null) {
        if (!is_object($menu)) {
            throw new Exception("Dados incompletos");
        }
        $this->query = "UPDATE menus SET ";
        $this->query .= "status=:status, ";
        $this->query .= "usuario_id=:usuario_id ";
        $this->query .= "WHERE id=:id;";
        try {
            $conexao = $this->getInstance();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        $this->statement = $conexao->prepare($this->query);
        $this->statement->bindParam(':status', $menu->status, PDO::PARAM_BOOL);
        $this->statement->bindParam(':usuario_id', $menu->usuario_id, PDO::PARAM_INT);
        $this->statement->bindParam(':id', $menu->id, PDO::PARAM_INT);
        $this->statement->execute();
        return true;
    }

}
