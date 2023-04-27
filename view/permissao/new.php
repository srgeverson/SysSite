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
        <form action="<?php echo server_url('?page=ControllerPemissao&option=save'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Cadastrar Permissão</h4>
                <div class="card-body">
                    <div class="form-group was-validated">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite um nome para a tela..."  required>
                        <div class="invalid-feedback">
                            Este é um campo chave utilizado internamente pelo sistema e deve ser unico.
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="descricao" type="text" placeholder="Digite uma descrição..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Item de Menu:</label><br>
                        <select name="menu_item_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($menuItens as $each_menu_item) {
                                echo '<option value="', $each_menu_item->id, '"', $each_menu_item->id === $endereco->cidade_id ? 'selected' : '', '>', $each_menu_item->nome, '</option>';
                            }
                            ?>
                        </select>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerPemissao&option=listar'); ?>" type="submit">
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