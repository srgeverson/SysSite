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
        <form action="<?php echo server_url('?page=ControllerTest&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Teste</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="test_id" type="hidden" value="<?php echo $test->id; ?>">
                    </div>
                    <div class="form-group was-validated">
                        <label class="text-primary">Nome de teste:</label><br>
                        <input class="form-control" name="test_name" type="text" placeholder="Digite o nome..." value="<?php echo $test->name; ?>" required>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerTest&option=listar'); ?>" type="submit">
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