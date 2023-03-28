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
        <form action="<?php echo server_url('?page=ControllerUser&option=editUser'); ?>" enctype="multipart/form-data" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Perfil do Usuário</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="id" type="hidden" value="<?php echo $user->id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite seu nome..." value="<?php echo $user->nome; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Email de Acesso:</label><br>
                        <input class="form-control" name="login" type="email" placeholder="Digite seu email..." value="<?php echo $user->login; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Senha:</label><br>
                        <input class="form-control" id="senha" name="senha" placeholder="Digite sua senha..." type="password" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Confirmar Senha:</label><br>
                        <input class="form-control" id="confirma_senha" name="senha" placeholder="Confirm sua senha..." type="password" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Foto Perfil:</label><br>
                        <input accept="image/*" class="form-control-file" name="imagem" placeholder="Imagem do perfil..." type="file">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split" id="editar_perfil" disabled>
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerSystem&option=welcome'); ?>" type="submit">
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