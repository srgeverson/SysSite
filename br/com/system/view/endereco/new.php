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
        <form action="<?php echo server_url('?page=ControllerEndereco&option=save'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Cadastrar Endereço</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Logradouro:</label><br>
                        <input class="form-control" name="logradouro" type="text" placeholder="Digite o logradouro..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Número:</label><br>
                        <input class="form-control" name="numero" type="text" placeholder="Digite o número/bloco/casa/apt...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Bairro:</label><br>
                        <input class="form-control" name="bairro" type="text" placeholder="Digite o celular...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">CEP:</label><br>
                        <input class="form-control" name="cep" id="cep" type="text" placeholder="Digite o CEP...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Cidade:</label><br>
                        <select name="cidade_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($cidades as $each_cidade) {
                                echo '<option value="', $each_cidade->id, '">', $each_cidade->nome, '</option>';
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