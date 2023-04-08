<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
$(document).ready(function () {
    
    $("button[name='adicionar_usuario']").prop('disabled', true);
    
    $("select[name='usuario_id[]']").change(function(e){
        $("button[name='adicionar_usuario']").prop('disabled', false);
    });

    function preencherSelect(dados, combo, hidden = null){
        combo.empty();
        if (dados.length > 0) {
            dados.forEach(d => {
                combo.append($("<option />").val(d.id).text(d.text));
            });
        };
        combo.prop("disabled", dados.length == 0);
        combo.selectpicker("refresh");
    }
});
</script>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerGrupo&option=removerUsuarios'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Desvincular Usuários de Grupo</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="id" type="hidden" value="<?php echo $grupo->id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Grupo:</label><br>
                        <input class="form-control" name="nome" type="text" value="<?php echo $grupo->nome; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Permissões:</label><br>
                        <select name="usuario_id[]" class="form-control selectpicker" multiple data-live-search="true" data-actions-box="true">
                            <?php
                                foreach ($usuariosDoGrupo as $each_usuario) {
                                    echo '<option value="', $each_usuario->id, '"', ' selected>', $each_usuario->nome, '</option>';
                                }
                            ?>    
                    </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button name="adicionar_usuario" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerGrupo&option=listar'); ?>">
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