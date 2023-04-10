<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('dao/GenericDAO.php');

class DAOLog extends GenericDAO {

    public function selectObjectsByContainsObject(ModelLog $log = null) {
        $this->query = "SELECT ";
        $this->query .= "l.* ";
        $this->query .= "FROM logs AS l ";
        $this->query .= "INNER JOIN usuarios AS u ON (l.usuario_id=u.id) ";
        // $this->query .= "WHERE ";
        // $this->query .= "l.nome LIKE '%$log->nome%' AND ";
        // $this->query .= "p.nome LIKE '%$estado->pais_nome%';";
        if($modelLog->nome_tabela)
            $this->query .= " AND l.nome_tabela = '$modelLog->nome_tabela'";
        if($modelLog->id_tabela)
            $this->query .= " AND l.id_tabela = '$modelLog->id_tabela'";
        if($modelLog->usuario_id)
            $this->query .= " AND l.usuario_id = '$modelLog->usuario_id'";
        if($modelLog->operacao)
            $this->query .= " AND l.operacao = '$modelLog->operacao'";
        if($modelLog->campo_modificado)
            $this->query .= " AND l.campo_modificado = '$modelLog->campo_modificado'";
        if($modelLog->valor_antigo)
            $this->query .= " AND l.valor_antigo = '$modelLog->valor_antigo'";
        if($modelLog->valor_atual)
            $this->query .= " AND l.valor_atual = '$modelLog->valor_atual'";
        if($modelLog->data_operacao)
            $this->query .= " AND l.data_operacao = '$modelLog->data_operacao';";
        try {
            $conexao = $this->getInstance();
            $this->statement = $conexao->prepare($this->query);
            $this->statement->execute();
        } catch (Exception $erro) {
            throw new Exception($erro->getMessage());
        }
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
}
