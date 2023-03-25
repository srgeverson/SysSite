<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/";

$GLOBALS['dictionary'] = array(
    'authority_created' => "Permissão cadastrada com sucesso.",
    'authority_deleted' => "Permissão removida com sucesso.",
    'authority_disabled' => "Permissão desabilitada.",
    'authority_enabled' => "Permissão halitada.",
    'authority_in_use' => "Não é possível remover essa permissão, pois a mesma está em uso, recomendamos que desabilite-a.",
    'authority_not_exists' => "Permissão inexistente.",
    'authority_updated' => "Permissão atualizada com sucesso.",
    'authority_uninformed' => "Permissão não informada.",
    'contact_created' => "Contato criado com sucesso.",
    'contact_enabled' => "Contato habilitado com sucesso.",
    'contact_deleted' => "Contato apagado com sucesso.",
    'contact_disabled' => "Contato desabilitado com sucesso.",
    'contact_not_found' => "Contato não encontrado.",
    'contact_not_send_email' => "E-mail não enviado.",
    'contact_updated' => "Contato atualizado com sucesso.",
    'contact_uninformed' => "Contato não informado.",
    'contact_updated' => "Contato atualizado com sucesso.",
    'content_created' => "Conteúdo da página criado com sucesso.",
    'content_enabled' => "Conteúdo da página habilitado com sucesso.",
    'content_deleted' => "Conteúdo da página apagado com sucesso.",
    'content_disabled' => "Conteúdo da página desabilitado com sucesso.",
    'content_not_found' => "Conteúdo da página não encontrado.",
    'content_updated' => "Conteúdo da página atualizado com sucesso.",
    'content_uninformed' => "Conteúdo da página não informado.",
    'content_updated' => "Conteúdo da página atualizado com sucesso.",
    'endereco_created' => "Endereço criado com sucesso.",
    'endereco_enabled' => "Endereço habilitado com sucesso.",
    'endereco_deleted' => "Endereço apagado com sucesso.",
    'endereco_disabled' => "Endereço desabilitado com sucesso.",
    'endereco_not_found' => "Endereço não encontrado.",
    'endereco_updated' => "Endereço atualizado com sucesso.",
    'endereco_uninformed' => "Endereço não informado.",
    'endereco_updated' => "Endereço atualizado com sucesso.",
    'estado_created' => "Estado criado com sucesso.",
    'estado_enabled' => "Estado habilitado com sucesso.",
    'estado_deleted' => "Estado apagado com sucesso.",
    'estado_disabled' => "Estado desabilitado com sucesso.",
    'estado_not_found' => "Estado não encontrado.",
    'estado_updated' => "Estado atualizado com sucesso.",
    'estado_uninformed' => "Estado não informado.",
    'estado_updated' => "Estado atualizado com sucesso.",
    'folha_pagamento_created' => "Folha de pagamento adicionada com sucesso.",
    'folha_pagamento_enabled' => "Folha de pagamento habilitada com sucesso.",
    'folha_pagamento_deleted' => "Folha de pagamento apagada com sucesso.",
    'folha_pagamento_disabled' => "Folha de pagamento desabilitada com sucesso.",
    'folha_pagamento_not_found' => "Folha de pagamento não encontrada.",
    'folha_pagamento_not_deleted' => "Folha de pagamento não apagada.",
    'folha_pagamento_updated' => "Folha de pagamento atualizada com sucesso.",
    'folha_pagamento_uninformed' => "Folha de pagamento não informada.",
    'folha_pagamento_updated' => "Folha de pagamento atualizada com sucesso.",
    'funcionario_created' => "Funcionário cadastrado com sucesso.",
    'funcionario_enabled' => "Funcionário habilitado com sucesso.",
    'funcionario_deleted' => "Funcionário apagado com sucesso.",
    'funcionario_disabled' => "Funcionário desabilitado com sucesso.",
    'funcionario_not_found' => "Funcionário não encontrado.",
    'funcionario_not_associated' => "Não existe dados associado a este usuário. Aguarde se seu cadastro for recente ou entre em contato com o responsável.",
    'funcionario_updated' => "Funcionário alterado com sucesso.",
    'funcionario_uninformed' => "Funcionário não informado.",
    'funcionario_updated' => "Funcionário atualizado com sucesso.",
    'page_created' => "Página criada com sucesso.",
    'page_enabled' => "Página habilitada com sucesso.",
    'page_deleted' => "Página apagada com sucesso.",
    'page_disabled' => "Página desabilitada com sucesso.",
    'page_updated' => "Página atualizada com sucesso.",
    'page_uninformed' => "Página não informada.",
    'page_updated' => "Página atualizada com sucesso.",
    'pais_created' => "País criado com sucesso.",
    'pais_enabled' => "País habilitado com sucesso.",
    'pais_deleted' => "País apagado com sucesso.",
    'pais_disabled' => "País desabilitado com sucesso.",
    'pais_not_found' => "País não encontrado.",
    'pais_updated' => "País atualizado com sucesso.",
    'pais_uninformed' => "País não informado.",
    'pais_updated' => "País atualizado com sucesso.",
    'permission_created' => "Permissão criada com sucesso.",
    'permission_denied' => "Usuário não está autenticado ou não possui permissão.",
    'parameter_already_registered' => "Já existe um parâmetro com essa chave.",
    'parameter_created' => "Parâmetro cadastrado com sucesso.",
    'parameter_disabled' => "Parâmetro desabilitado com sucesso.",
    'parameter_deleted' => "Parâmetro excluídoo com sucesso.",
    'parameter_enabled' => "Parâmetro habilitado com sucesso.",
    'parameter_updated' => "Parâmetro atualizado com sucesso.",
    'parameter_uninformed' => "Parâmetro não informado.",
    'test_already_registered' => "Já existe um teste com essa chave.",
    'test_created' => "Teste cadastrado com sucesso.",
    'test_disabled' => "Teste desabilitado com sucesso.",
    'test_deleted' => "Teste excluídoo com sucesso.",
    'test_enabled' => "Teste habilitado com sucesso.",
    'test_updated' => "Teste atualizado com sucesso.",
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
