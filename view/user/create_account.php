<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
$(document).ready(function () {
  
    $("input[name='cpf']").keyup(function(e){
        //console.log(e.target.value);
    });

    $("#confirma_senha_sem_email").keyup(function () {
        let CPF = $("input[name='cpf']").val();
        if (validarCPF(CPF) === true && CPF !== '') {
            $('#salvar_novo_usuario_sem_senha').removeAttr("disabled");
        } else {
            $('#salvar_novo_usuario_sem_senha').attr('disabled', '');
        }
    });
});
</script>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerUser&option=submit'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Solicitação de Acesso</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Seu Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite seu nome..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">E-mail para Login:</label><br>
                        <input class="form-control" name="login" type="email" placeholder="Digite seu email..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">CPF:</label><br>
                        <input class="form-control is-valid" name="cpf" type="text" placeholder="Digite um cpf...">
                        <div class="valid-feedback">
                            Esta informação é utilizado internamente pelo sistema, só utilizada quando usuário funcionário.
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split" id="salvar_novo_usuario_sem_senha">
                                <span class="icon text-white-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Enviar Dados</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerUser&option=authenticate'); ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-window-close"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>