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
        <form action="<?php echo server_url('?page=ControllerContact&option=save'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Cadastrar Contato</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="cont_description" type="text" placeholder="Digite uma descrição..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Telefone:</label><br>
                        <input class="form-control" name="cont_phone" id="phone" type="text" placeholder="Digite o telefone...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Celular:</label><br>
                        <input class="form-control" name="cont_cell_phone" id="cell" type="text" placeholder="Digite o celular...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Whatsapp:</label><br>
                        <input class="form-control" name="cont_whatsapp" id="whatsapp" type="text" placeholder="Digite o whatsapp...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">E-mail:</label><br>
                        <input class="form-control" name="cont_email" type="email" placeholder="Digite o email...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Facebook:</label><br>
                        <input class="form-control" name="cont_facebook" type="text" placeholder="Digite o facebook...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Instagram:</label><br>
                        <input class="form-control" name="cont_instagram" type="text" placeholder="Digite o instagram...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Obeservação:</label><br>
                        <textarea class="form-control" name="cont_text" placeholder="Uma breve descrição sobre a tela..." required></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerContact&option=list'); ?>" type="submit">
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