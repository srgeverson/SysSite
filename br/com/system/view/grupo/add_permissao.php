<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
$(document).ready(function () {
    
    $("button[name='adicionar_permissao']").prop('disabled', true);

    $("select[name='grupo_id']").change(function(e){
        let id = e.target.value;
        $.ajax({
            type: "GET",
            url: `/handler?endpoint=listar-permissoes-grupo&id=${id}`,
            dataType: "json",
            success: function(data){
                let dados = data.data.permissoes.map((item, index) => {
                    return { id: item.id, text: item.nome }
                });
            preencherSelect(dados, $("select[name='permissao_id[]']"), id)
            },
            error: function(a,b,c){
                //console.log('Erro durante o preenhemento das permissões');
            }
        });
	});
    
    $("select[name='permissao_id[]']").change(function(e){
        $("button[name='adicionar_permissao']").prop('disabled', $("select[name='permissao_id[]']").find(":selected").val() === undefined);
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
        <form action="<?php echo server_url('?page=ControllerGrupo&option=adicionarPermissoes'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Vincular Permissões a Grupo</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Grupo:</label><br>
                        <select name="grupo_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($grupos as $each_grupo) {
                                echo '<option value="', $each_grupo->id, '"', '>', $each_grupo->nome, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Permissões:</label><br>
                        <select name="permissao_id[]" class="form-control selectpicker" multiple data-actions-box="true" required>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button name="adicionar_permissao" class="btn btn-primary btn-icon-split">
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