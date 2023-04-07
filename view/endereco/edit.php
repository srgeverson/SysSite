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
                        <input class="form-control" name="id" type="hidden" value="<?php echo $endereco->id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Logradouro:</label><br>
                        <input class="form-control" name="logradouro" type="text" placeholder="Digite uma descrição..." value="<?php echo $endereco->logradouro; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Número:</label><br>
                        <input class="form-control" name="numero" id="text" type="text" placeholder="Digite o número/casa/apt/bloco..." value="<?php echo $endereco->numero; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Bairro:</label><br>
                        <input class="form-control" name="bairro" type="text" placeholder="Digite o barirro..." value="<?php echo $endereco->bairro; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">CEP:</label><br>
                        <input class="form-control" name="cep" id="cep" type="text" placeholder="Digite o CEP..." value="<?php echo $endereco->cep; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Cidade:</label><br>
                        <select name="cidade_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($cidades as $each_cidade) {
                                echo '<option value="', $each_cidade->id, '"', $each_cidade->id === $endereco->cidade_id ? 'selected' : '', '>', $each_cidade->nome, '</option>';
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