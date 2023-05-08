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
    $("#confirma_senha_sem_email").keyup(function () {
        if (($('#confirma_senha').val() === $('#senha').val()) && $('#confirma_senha').val() != '') {
            $('#editar_perfil').removeAttr("disabled");
        } else {
            $('#editar_perfil').attr('disabled', '');
        }
    });
    //Validando CPF
    $("#cpf").keyup(function () {
        let CPF = $('#cpf').val();
        let soma;
        let resto;
        soma = 0;
        CPF = CPF.replace('.', '');//Remove o 1º ponto
        CPF = CPF.replace('.', '');//Remove o 1º ponto
        CPF = CPF.replace('-', '');//Remove o hífen

        if (CPF != "00000000000") {
            for (i = 1; i <= 9; i++) {
                soma = soma + parseInt(CPF.substring(i - 1, i)) * (11 - i);
            }
            resto = (soma * 10) % 11;
            if ((resto == 10) || (resto == 11)) {
                resto = 0;
            }
            if (resto != parseInt(CPF.substring(9, 10))) {
                $('#resultado_cpf').html('*CPF Inválido.');
                $('#salvar_dados').attr('disabled', '');
            } else {
                soma = 0;
                for (i = 1; i <= 10; i++) {
                    soma = soma + parseInt(CPF.substring(i - 1, i)) * (12 - i);
                }
                resto = (soma * 10) % 11;
                if ((resto == 10) || (resto == 11)) {
                    resto = 0;
                }
                if (resto != parseInt(CPF.substring(10, 11))) {
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

function validarCPF(CPF) {
    let soma;
    let resto;
    soma = 0;
    CPF = CPF.replace('.', '');//Remove o 1º ponto
    CPF = CPF.replace('.', '');//Remove o 1º ponto
    CPF = CPF.replace('-', '');//Remove o hífen

    if (CPF != "00000000000") {
        for (i = 1; i <= 9; i++) 
            soma = soma + parseInt(CPF.substring(i - 1, i)) * (11 - i);

        resto = (soma * 10) % 11;
        if ((resto == 10) || (resto == 11))
            resto = 0;
        if (resto != parseInt(CPF.substring(9, 10)))
            return false;
        else {
            soma = 0;
            for (i = 1; i <= 10; i++) 
                soma = soma + parseInt(CPF.substring(i - 1, i)) * (12 - i);
                
            resto = (soma * 10) % 11;
            if ((resto == 10) || (resto == 11))
                resto = 0;
            if (resto != parseInt(CPF.substring(10, 11)))
                return false;
            else
                return true;
        }
    } else
        return false;
}

