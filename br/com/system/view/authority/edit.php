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
        <form action="<?php echo server_url('?page=ControllerAuthority&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Permissão</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="auth_pk_id" type="hidden" value="<?php echo $authority->auth_pk_id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="auth_description" type="text" placeholder="Digite uma descrição..." value="<?php echo $authority->auth_description; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Tela:</label><br>
                        <input class="form-control" name="auth_screen" type="text" placeholder="Digite um nome para a tela..." value="<?php echo $authority->auth_screen; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Função:</label><br>
                        <textarea class="form-control" name="auth_function" placeholder="Uma breve descrição sobre a tela..." required><?php echo $authority->auth_function; ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Alterar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerAuthority&option=listar'); ?>" type="submit">
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