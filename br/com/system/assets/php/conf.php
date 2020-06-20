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
    'content_created' => "Conteúdo da página criado com sucesso.",
    'content_enabled' => "Conteúdo da página habilitado com sucesso.",
    'content_deleted' => "Conteúdo da página apagado com sucesso.",
    'content_disabled' => "Conteúdo da página desabilitado com sucesso.",
    'content_not_found' => "Conteúdo da página não encontrado.",
    'content_updated' => "Conteúdo da página atualizado com sucesso.",
    'content_uninformed' => "Conteúdo da página não informado.",
    'content_updated' => "Conteúdo da página atualizado com sucesso.",
    'page_created' => "Página criada com sucesso.",
    'page_enabled' => "Página habilitada com sucesso.",
    'page_deleted' => "Página apagada com sucesso.",
    'page_disabled' => "Página desabilitada com sucesso.",
    'page_updated' => "Página atualizada com sucesso.",
    'page_uninformed' => "Página não informada.",
    'page_updated' => "Página atualizada com sucesso.",
    'permission_created' => "Permissão criada com sucesso.",
    'permission_denied' => "Usuário não está autenticado ou não possui permissão.",
    'parameter_already_registered' => "Já existe um parâmetro com essa chave.",
    'parameter_created' => "Parâmetro cadastrado com sucesso.",
    'parameter_disabled' => "Parâmetro desabilitado com sucesso.",
    'parameter_deleted' => "Parâmetro excluídoo com sucesso.",
    'parameter_enabled' => "Parâmetro habilitado com sucesso.",
    'parameter_updated' => "Parâmetro atualizado com sucesso.",
    'parameter_uninformed' => "Parâmetro não informado.",
    'user_already_registered' => "Já existe um usuário cadastrado com esse email, tente outro email.",
    'user_created' => "Usuário criado com sucesso.",
    'user_deleted' => "Usuário excluído com sucesso.",
    'user_disabled' => "Usuário desabilitado com sucesso.",
    'user_incorrect_password' => "Senha incorreta.",
    'user_enabled' => "Usuário habilitado com sucesso.",
    'user_logged' => "Login efetuado com sucesso.",
    'user_logout' => "Sessão finalizada com sucesso.",
    'user_not_allowed' => "Usuário não permitido .",
    'user_not_found' => "Usuário não encontrado.",
    'user_not_exists' => "Usuário inexistente.",
    'user_profile_edit' => "Perfil atualizado com sucesso.",
    'user_password_reseted' => "Senha gerada e enviada por e-mail com sucesso.",
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
