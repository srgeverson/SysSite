/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    //MASCARA DO CPF
    $("input[name='cpf']").mask('000.000.000-00', { reverse: true });
    //MASCARA DO CPF
    $("#cnpj").mask('00.000.000/0000-00', { reverse: true });
    //MASCARA CEP
    $("input[name='cep']").mask('00.000-000', { reverse: true });
    //MASCARA DO TELEFONE
    $("input[name='telefone']").mask('(00)0000-0000');
    //MASCARA DO CELULAR
    $("input[name='celular']").mask('(00)00000-0000');
    //MASCARA DO WHATSAPP
    $("#whatsapp").mask('(00)00000-0000');
    //MASCARA PARA COMPETÊNCIA
    $("#competencia").mask('00/0000', { reverse: true });
    //MASCARA PARA MOEDA
    $('.moeda').mask('###0.00', { reverse: true });
    //MASCARA PARA QUANTIDADE EM METROS
    $('.metro').mask('###0.00', { reverse: true });
    //MASCARA PARA QUANTIDADE EM KILOGRAMAS
    $('.kilo').mask('###0.000', { reverse: true });
    //TRANSFORMAR TEXTO EM CAIXA ALTA
    var $camposTexto = $(".texto");
    $camposTexto.keypress(function () {
        $camposTexto.keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });
    });
    var $camposObsercoes = $("textarea");
    $camposObsercoes.keypress(function () {
        $camposObsercoes.keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });
    });
});
