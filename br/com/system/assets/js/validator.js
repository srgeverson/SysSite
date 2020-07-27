/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// MINHA FUNÇÕES DE VALIDAÇÃo
$(document).ready(function () {
    $("#confirma_senha").keyup(function () {
        if (($('#confirma_senha').val() === $('#senha').val()) && $('#confirma_senha').val() != '') {
            $('#editar_perfil').removeAttr("disabled");
        } else {
            $('#editar_perfil').attr('disabled', '');
        }
    });
});

