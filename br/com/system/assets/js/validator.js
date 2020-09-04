/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// MINHA FUNÇÕES DE VALIDAÇÃo
$(document).ready(function () {
    //Validando a senha digitada
    $("#confirma_senha").keyup(function () {
        if (($('#confirma_senha').val() === $('#senha').val()) && $('#confirma_senha').val() != '') {
            $('#editar_perfil').removeAttr("disabled");
        } else {
            $('#editar_perfil').attr('disabled', '');
        }
    });
    $("#cpf").focus(function () {
        console.log($('#cpf').val());
    });
    //Validando CPF
    $("#cpf").focusout(function () {
        var conteudoCPF = $('#cpf').val();
        var Soma;
        var Resto;
        Soma = 0;

        conteudoCPF = conteudoCPF.replace('.', '');//Remove o 1º ponto
        conteudoCPF = conteudoCPF.replace('.', '');//Remove o 1º ponto
        conteudoCPF = conteudoCPF.replace('-', '');//Remove o hífen

        if (conteudoCPF != "00000000000") {
            for (i = 1; i <= 9; i++) {
                Soma = Soma + parseInt(conteudoCPF.substring(i - 1, i)) * (11 - i);
            }
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) {
                Resto = 0;
            }
            if (Resto != parseInt(conteudoCPF.substring(9, 10))) {
                $('#resultado_cpf').html('*CPF Inválido.');
                $('#salvar_dados').attr('disabled', '');
            } else {
                Soma = 0;
                for (i = 1; i <= 10; i++) {
                    Soma = Soma + parseInt(conteudoCPF.substring(i - 1, i)) * (12 - i);
                }
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11)) {
                    Resto = 0;
                }
                if (Resto != parseInt(conteudoCPF.substring(10, 11))) {
                    $('#resultado_cpf').html('*CPF Inválido.');
                    $('#salvar_dados').attr('disabled', '');
                } else {
                    $('#salvar_dados').removeAttr("disabled");
                    $('#resultado_cpf').html('');
                }
            }
        } else {
            $('#resultado_cpf').html('*CPF Inválido.');
            $('#salvar_dados').attr('disabled', '');
        }
    });
});

