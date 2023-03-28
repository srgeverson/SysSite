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
        <form action="<?php echo server_url('?page=ControllerEndereco&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Endereço</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="ende_pk_id" type="hidden" value="<?php echo $endereco->ende_pk_id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Logradouro:</label><br>
                        <input class="form-control" name="ende_logradouro" type="text" placeholder="Digite uma descrição..." value="<?php echo $endereco->ende_logradouro; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Número:</label><br>
                        <input class="form-control" name="ende_numero" id="phone" type="text" placeholder="Digite o número/casa/apt/bloco..." value="<?php echo $endereco->ende_numero; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Bairro:</label><br>
                        <input class="form-control" name="ende_bairro" id="cell" type="text" placeholder="Digite o barirro..." value="<?php echo $endereco->ende_bairro; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">CEP:</label><br>
                        <input class="form-control" name="ende_cep" id="cell" type="text" placeholder="Digite o CEP..." value="<?php echo $endereco->ende_cep; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Cidade:</label><br>
                        <input class="form-control" name="ende_cidade" id="whatsapp" type="text" placeholder="Digite o cidade..."value="<?php echo $endereco->ende_cidade; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Estado:</label><br>
                        <select name="ende_fk_estado_pk_id" class="form-control" required>
                            <option value="<?php echo $endereco->ende_fk_estado_pk_id; ?>"><?php echo $endereco->nome; ?></option>
                            <?php
                            foreach ($estados as $each_estado) {
                                echo '<option value="', $each_estado->id, '">', $each_estado->nome, '</option>';
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
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Alterar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerEndereco&option=listar'); ?>" type="submit">
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