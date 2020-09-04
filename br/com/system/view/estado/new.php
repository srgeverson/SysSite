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
        <form action="<?php echo server_url('?page=ControllerEstado&option=save'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Cadastrar País</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="esta_nome" type="text" placeholder="Digite um nome..." required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Sigla:</label><br>
                        <input class="form-control" name="esta_sigla" type="text" placeholder="Digite uma sigla..."  required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">País:</label><br>
                        <select name="esta_fk_pais_pk_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($paises as $each_pais) {
                                echo '<option value="', $each_pais->pais_pk_id, '">', $each_pais->pais_nome, '</option>';
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerEstado&option=listar'); ?>">
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