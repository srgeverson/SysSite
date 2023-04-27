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
        $this->query .= "INNER JOIN usuarios AS u ON (l.usuario_id = u.id) ";
        $this->query .= "WHERE 1 = 1";
        if($log->nome_tabela)
            $this->query .= " AND l.nome_tabela = '$log->nome_tabela'";
        if($log->id_tabela)
            $this->query .= " AND l.id_tabela = '$log->id_tabela'";
        if($log->usuario_id)
            $this->query .= " AND l.usuario_id = '$log->usuario_id'";
        if($log->operacao)
            $this->query .= " AND l.operacao = '$log->operacao'";
        if($log->campo_modificado)
            $this->query .= " AND l.campo_modificado = '$log->campo_modificado'";
        if($log->valor_antigo)
            $this->query .= " AND l.valor_antigo = '$log->valor_antigo'";
        if($log->valor_atual)
            $this->query .= " AND l.valor_atual = '$log->valor_atual'";
        if($log->data_operacao)
            $this->query .= " AND CAST(l.data_operacao AS DATE) = CAST('$log->data_operacao'AS DATE);";
        
        //return $this->query;
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
