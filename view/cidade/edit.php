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
        <form action="<?php echo server_url('?page=ControllerCidade&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar País</h4>
                <div class="card-body">
                    <input class="form-control" name="id" type="hidden" value="<?php echo $cidade->id; ?>">
                    <div class="form-group was-validated">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite uma descrição..." value="<?php echo $cidade->nome; ?>" required>
                        <div class="invalid-feedback">
                            Campo obrigatório
                        </div>
                    </div>
                    <div class="form-group was-validated">
                        <label class="text-primary">Código:</label><br>
                        <input class="form-control" name="codigo" type="number" placeholder="Digite o código IBGE..." value="<?php echo $cidade->codigo; ?>" required>
                        <div class="invalid-feedback">
                            Campo obrigatório
                        </div>
                    </div>
                    <div class="form-group was-validated">
                        <label class="text-primary">Estado:</label><br>
                        <select name="estado_id" class="selectpicker form-control" data-live-search="true" required>
                            <option></option>
                        <?php
                            foreach ($cidade->estados as $estado) {
                                echo '<option value="', $estado->id, '"', $estado->id === $cidade->estado_id ? 'selected' : '', '>', $estado->nome, '</option>';
                            }
                        ?>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatório
                        </div>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerCidade&option=listar'); ?>" type="submit">
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