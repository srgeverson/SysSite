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
        if (($('#confirma_senha_sem_email').val() === $('#senha_sem_email').val()) && $('#confirma_senha_sem_email').val() != '') {
            $('#salvar_novo_usuario_com_senha').removeAttr("disabled");
        } else {
            $('#salvar_novo_usuario_com_senha').attr('disabled', '');
        }
    });
});
</script>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerUser&option=save'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Cadastrar Usuário</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite um nome..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">CPF:</label><br>
                        <input class="form-control is-valid" id="cpf" name="cpf" type="text" placeholder="Digite um cpf...">
                        <div class="valid-feedback">
                            Esta informação é utilizado internamente pelo sistema, só utilizada quando usuário funcionário.
                        </div>
                    </div>
                    <div class="form-group was-validated">
                        <label class="text-primary">E-mail:</label><br>
                        <input class="form-control" name="login" type="email" placeholder="Digite um email..." value=""  required>
                        <div class="invalid-feedback">
                            Este é um campo chave utilizado internamente pelo sistema e deve ser unico.
                        </div>
                    </div>
                    <?php
                    if($user->enviar_senha_por_email !== true){
                        echo '<div class="form-group">';
                        echo '<label class="text-primary">Senha:</label><br>';
                        echo '<input class="form-control" id="senha_sem_email" name="senha" placeholder="Digite sua senha..." type="password" required>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="text-primary">Confirmar Senha:</label><br>';
                        echo '<input class="form-control" id="confirma_senha_sem_email" name="senha" placeholder="Confirm sua senha..." type="password" required>';
                        echo '</div>';
                    }
                ?>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split" id="salvar_novo_usuario_com_senha">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerUser&option=listar'); ?>">
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