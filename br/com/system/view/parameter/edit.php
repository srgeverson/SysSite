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
        <form action="<?php echo server_url('?page=ControllerParameter&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Parâmetro</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="para_pk_id" type="hidden" value="<?php echo $authority->para_pk_id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="para_key" type="text" placeholder="Digite um nome único..." value="<?php echo $authority->para_description; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Tela:</label><br>
                        <input class="form-control" name="para_value" type="text" placeholder="Digite um valor..." value="<?php echo $authority->para_screen; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Função:</label><br>
                        <textarea class="form-control" name="para_description" placeholder="Uma breve descrição sobre o parâmetro..." required><?php echo $authority->para_function; ?></textarea>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerParameter&option=list'); ?>" type="submit">
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