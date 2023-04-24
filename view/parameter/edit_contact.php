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
        <form action="<?php echo server_url('?page=ControllerContato&option=submit'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Configurações de Contato</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="id" type="hidden" value="<?php echo $contato->id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="descricao" type="text" placeholder="Digite uma descrição..." value="<?php echo $contato->descricao; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Telefone:</label><br>
                        <input class="form-control" name="telefone" id="phone" type="text" placeholder="Digite o telefone..." value="<?php echo $contato->telefone; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Celular:</label><br>
                        <input class="form-control" name="celular" id="cell" type="text" placeholder="Digite o celular..." value="<?php echo $contato->celular; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Whatsapp:</label><br>
                        <input class="form-control" name="whatsapp" id="whatsapp" type="text" placeholder="Digite o whatsapp..."value="<?php echo $contato->whatsapp; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">E-mail:</label><br>
                        <input class="form-control" name="email" type="email" placeholder="Digite o email..." value="<?php echo $contato->email; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Facebook:</label><br>
                        <input class="form-control" name="facebook" type="text" placeholder="Digite o facebook..." value="<?php echo $contato->facebook; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Instagram:</label><br>
                        <input class="form-control" name="instagram" type="text" placeholder="Digite o instagram..." value="<?php echo $contato->instagram; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Obeservação:</label><br>
                        <textarea class="form-control" name="observacao" placeholder="Uma breve descrição sobre a tela..." required><?php echo $contato->observacao; ?></textarea>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerContato&option=listar'); ?>" type="submit">
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