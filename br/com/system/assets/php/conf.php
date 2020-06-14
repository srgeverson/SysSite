<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/system/";
$GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/system/";

$GLOBALS['dictionary'] = array(
    'authority_created' => "Permissão cadastrada com sucesso.",
    'authotity_deleted' => "Permissão removida com sucesso.",
    'authority_disabled' => "Permissão desabilitada.",
    'authority_enabled' => "Permissão halitada.",
    'authotity_in_use' => "Não é possível remover essa permissão, pois a mesma está em uso, recomendamos que desabilite-a.",
    'authotity_not_exists' => "Permissão inexistente.",
    'authority_updated' => "Permissão atualizada com sucesso.",
    'authority_uninformed' => "Permissão não informada.",
    'contact_not_send_email' => "E-mail não enviado.",
    'permission_denied' => "Usuário não autenticado ou não possui permissão.",
    'user_already_registered' => "Já existe um usuário cadastrado com esse email, tente outro email.",
    'user_created' => "Usuário criado com sucesso.",
    'user_deleted' => "Usuário excluído com sucesso.",
    'user_incorrect_password' => "Senha incorreta.",
    'user_logged' => "Login efetuado com sucesso.",
    'user_logout' => "Sessão finalizada com sucesso.",
    'user_not_allowed' => "Usuário não permitido .",
    'user_not_found' => "Usuário não encontrado.",
    'user_not_exists' => "Usuário inexistente.",
    'user_profile_edit' => "Perfil atualizado com sucesso.",
    'user_updated' => "Usuário atualizado com sucesso.",
    'user_uninformed' => "Usuário não informado."
);

function server_path($caminho = "") {
    return $GLOBALS['base_server'] . $caminho;
}

function server_url($caminho = "") {
    return $GLOBALS['base_url'] . $caminho;
}

function redirect($caminho = "") {
    echo '<script>';
    echo "location.href='$caminho';";
    echo '</script>';
}
