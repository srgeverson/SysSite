<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
                        <label class="text-primary">E-mail:</label><br>
                        <input class="form-control" name="login" type="email" placeholder="Digite um email..." value=""  required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Grupo/Perfil:</label><br>
                        <select name="user_fk_authority_pk_id" class="form-control" required>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->descricao; ?></option>
                            <?php
                            foreach ($authorities as $each_authority) {
                                echo '<option value="', $each_authority->id, '">', $each_authority->descricao, '</option>';
                            }
                            ?>
                        </select>
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
                            <button class="btn btn-primary btn-icon-split" id="salvar_novo_usuario_com_senha" disabled>
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