// MINHA FUNÇÕES DE CONFIMAÇÃO
$(document).ready(function () {
    //TELA DE LISTAR PERMISSÕES
    $(document).on('click', '.authority_buscar', function () {
        let item_selecionado = $(this).closest('tr');
        let coluna_id = item_selecionado.children()[0];
        let acao = '?page=ControllerAtualizacao&option=excluir&atua_pk_id=';
        console.log($(coluna_id).html());

        $('#info_object_title').html('Em desenvolvimento...!');
        $('#info_object_content').html('Tela em fase de desenvolvimento...');
        $('#info_object_button').addClass('btn-info btn-lg');
        $('#info_object_button').attr('href', acao + $(coluna_id).html());
        $('#info_object_icon').addClass('fa-info');
        $('#info_object').modal('show');

        $(document).on('click', '#info_object_button', function () {
            console.log($('#info_object_button').html());
        });
    });
    //Tela de visualizar a folha de pagamento
    $(document).on('click', '#folha_pagamento_visualizar', function () {
        //Testes
        console.log('Ops....');

        $('#info_object_title').html('Em desenvolvimento...!');
        $('#info_object_content').html('Tela em indisponível no momeno...');
        $('#info_object_button').addClass('btn-info btn-lg');
        $('#info_object_icon').addClass('fa-info');
        $('#info_object').modal('show');
    });
});

