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
        <form action="<?php echo server_url('?page=ControllerUser&option=logon'); ?>" id="login-form" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Área de Login</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary" for="username">Usuário:</label><br>
                        <input class="form-control" id="username" name="login" type="email" placeholder="Digite seu email..." required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-primary">Senha:</label><br>
                        <input class="form-control" id="password" name="senha" placeholder="Digite sua senha..." type="password" required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-lock-open"></i>
                                </span>
                                <span class="text">Entrar</span>
                            </button>
                        </div>
                        <div class="input-group">
                        <?php
                            if($page->enviar_senha_por_email !== false){
                                echo '<a  class="btn btn-success btn-icon-split" href="', server_url('?page=ControllerUser&option=createAccount'), '" type="submit">';
                                echo '<span class="icon text-white-50">';
                                echo '<i class="fas fa-user-plus"></i>';
                                echo '</span>';
                                echo '<span class="text">Cadastre-se</span>';
                                echo '</a>';
                            }
                        ?>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>