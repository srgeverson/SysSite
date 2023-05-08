<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
$(document).ready(function () {
    $('.btn-proximo').click(function(){
        $('.nav-tabs > .active').next('a').trigger('click');
    });
    
    $('.btn-voltar').click(function(){
        $('.nav-tabs > .active').prev('a').trigger('click');
    });

    $("select[name='usuario_cpf']").change(function(e){
        let id = e.target.value;
        if (id != null && id != '') {
            $.ajax({
                type: "GET",
                url: "<?php echo server_url('handler?endpoint=buscar-usuario&id=');?>" + id ,
                dataType: "json",
                success: function(data){
                    let usuario = data.data;
                    $("input[name='nome']").val(usuario.usuario.nome);
                    $("input[name='email']").val(usuario.usuario.login);
                    if(validarCPF(usuario.usuario.cpf) === false){
                        $('#resultado_cpf').html('*CPF Inválido.');
                        $('#salvar_dados').attr('disabled');
                    } else {
                        $("input[name='cpf']").val(usuario.usuario.cpf);
                        $('#salvar_dados').removeAttr("disabled");
                        $('#resultado_cpf').html('');
                    }
                    $("textarea[name='observacao']").val('Funcionário vinculado a usuário existente');
                    $("input[name='descricao']").val('Funcionário vinculado a usuário existente');
                },
                error: function(a, b, c){
                    //console.log('Erro durante o preenhemento das permissões');
                }
            });
        }
    });

    $("input[name='cpf']").change(function(e){
        $("input[name='nome']").val('');
        $("input[name='email']").val('');
        $("select[name='usuario_cpf']").val('').trigger('change');
        $("select[name='usuario_cpf']").removeAttr('required');
        $("textarea[name='observacao']").val('Funcionário vinculado a usuário novo');
        $("input[name='descricao']").val('Funcionário vinculado a usuário novo');
    });

    $("input[name='cpf']").keyup(function () {
        let CPF = $("input[name='cpf']").val();
        if(validarCPF(CPF) === false){
            $('#resultado_cpf').html('*CPF Inválido.');
            $('#salvar_dados').attr('disabled');
        } else {
            $('#salvar_dados').removeAttr("disabled");
            $('#resultado_cpf').html('');
        }
    });
});

</script>
<br>
<div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <form action=" <?php echo server_url('?page=ControllerFuncionario&option=save'); ?>" method="post">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-dados-pessoais-tab" data-toggle="tab" href="#nav-dados-pessoais" role="tab" aria-controls="nav-dados-pessoais" aria-selected="true">Dados Pessoais</a>
                    <a class="nav-item nav-link" id="nav-contato-tab" data-toggle="tab" href="#nav-contato" role="tab" aria-controls="nav-contato" aria-selected="false">Contato</a>
                    <a class="nav-item nav-link" id="nav-endereco-tab" data-toggle="tab" href="#nav-endereco" role="tab" aria-controls="nav-contato" aria-selected="false">Endereço</a>
                </div>
            </nav>  
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-dados-pessoais" role="tabpanel" aria-labelledby="nav-dados-pessoais-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-primary">Usuário:</label><br>
                                <select name="usuario_cpf" class="selectpicker form-control" data-live-search="true" required>
                                    <option></option>
                                <?php
                                    foreach ($funcionario->usuarios as $usuario) {
                                        echo '<option value="', $usuario->id, '">', $usuario->login, '</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group was-validated">
                                <label class="text-primary">CPF:</label><br>
                                <input class="form-control" name="cpf" type="text" placeholder="Digite o CPF..."  required>
                                <p class="help-block text-danger text-bold" id="resultado_cpf"></p>
                                <div class="invalid-feedback">
                                    Campo obrigatório
                                </div>
                            </div>
                            <div class="form-group was-validated">
                                <label class="text-primary">Nome:</label><br>
                                <input class="form-control" name="nome" type="text" placeholder="Digite o nome completo..." required>
                                <div class="invalid-feedback">
                                    Campo obrigatório
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">RG:</label><br>
                                <input class="form-control" name="rg" type="text" placeholder="Digite o RG...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">PIS:</label><br>
                                <input class="form-control" name="pis" type="text" placeholder="Digite o PIS/PASEP..." >
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Data Nascimento:</label><br>
                                <input class="form-control" name="data_nascimento" type="date" placeholder="Digite a data de nascimento...">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar com grupos de botões">
                                <div class="input-group">
                                    <a class="btn btn-primary btn-icon-split btn-proximo">
                                        <span class="text text-white-50">Próximo</span>
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contato" role="tabpanel" aria-labelledby="nav-contato-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-primary">Descrição:</label><br>
                                <input class="form-control" name="descricao" type="text" placeholder="Digite uma descrição...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Telefone:</label><br>
                                <input class="form-control" name="telefone" type="tel" placeholder="Digite o telefone no formato (99)99999-99999...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Celular:</label><br>
                                <input class="form-control" name="celular" type="tel" placeholder="Digite o celular no formato (99)99999-99999...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Whatsapp:</label><br>
                                <input class="form-control" name="whatsapp" type="tel" placeholder="Digite o whatsapp  no formato (99)99999-99999...">
                            </div>
                            <div class="form-group was-validated">
                                <label class="text-primary">E-mail:</label><br>
                                <input class="form-control" name="email" type="email" placeholder="Digite o email..."  required>
                                <div class="invalid-feedback">
                                    Campo obrigatório
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Facebook:</label><br>
                                <input class="form-control" name="facebook" type="text" placeholder="Digite o facebook...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Instagram:</label><br>
                                <input class="form-control" name="instagram" type="text" placeholder="Digite o instagram...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Obeservação:</label><br>
                                <textarea class="form-control" name="observacao" placeholder="Uma breve descrição sobre a tela..."></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                                <div class="input-group">
                                    <a class="btn btn-primary btn-icon-split btn-voltar">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-arrow-left"></i>
                                        </span>
                                        <span class="text text-white-50">Voltar</span>
                                    </a>
                                </div>
                                <div class="input-group">
                                    <a class="btn btn-primary btn-icon-split btn-proximo">
                                        <span class="text text-white-50">Próximo</span>
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-endereco" role="tabpanel" aria-labelledby="nav-endereco-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-primary">Logradouro:</label><br>
                                <input class="form-control" name="logradouro" type="text" placeholder="Digite o logradouro...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Número:</label><br>
                                <input class="form-control" name="numero" type="text" placeholder="Digite o número/bloco/casa/apt...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Bairro:</label><br>
                                <input class="form-control" name="bairro" type="text" placeholder="Digite o celular...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">CEP:</label><br>
                                <input class="form-control" name="cep" id="cep" type="tel" placeholder="Digite o CEP...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Cidade:</label><br>
                                <select name="cidade_id" class="form-control">
                                    <option></option>
                                    <?php
                                    foreach ($funcionario->cidades as $each_cidade) {
                                        echo '<option value="', $each_cidade->id, '">', $each_cidade->nome, '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                                <div class="input-group">
                                    <a class="btn btn-primary btn-icon-split btn-voltar">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-arrow-left"></i>
                                        </span>
                                        <span class="text text-white-50">Voltar</span>
                                    </a>
                                </div>
                                <div class="input-group">
                                    <button class="btn btn-primary btn-icon-split" disabled id="salvar_dados">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text">Salvar</span>
                                    </button>
                                </div>
                                <div class="input-group">
                                    <a  class="btn btn-danger btn-icon-split" href="<?php
                                    echo server_url($funcionario->administrador ? '?page=ControllerFuncionario&option=listar' : '?page=ControllerSystem&option=welcome');
                                    ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-window-close"></i>
                                        </span>
                                        <span class="text">Cancelar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </form>
    </div>
    <div class="col-3">
    </div>
</div>
<br>
