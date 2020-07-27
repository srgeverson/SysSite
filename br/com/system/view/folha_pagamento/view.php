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
        <iframe src="https://docs.google.com/gview?url=<?php echo $folhaPagamento->fopa_arquivo; ?>&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>
        <a href="<?php echo $folhaPagamento->fopa_arquivo; ?>">teste</a>
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerFolhaPagamento&option=update'); ?>" method="post">
            <div class="card h-100">
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="fopa_pk_id" type="number" value="<?php echo $folhaPagamento->fopa_pk_id; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Competência:</label><br>
                        <input class="form-control" name="fopa_competencia"  placeholder="Digite a competência no formato mês/ano..." type="text"  value="<?php echo $folhaPagamento->fopa_pk_id; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Arquivo:</label><br>
                        <input class="form-control" name="fopa_arquivo" placeholder="Selecione o arquivo..." type="file" value="<?php echo $folhaPagamento->fopa_arquivo; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Caminho do Arquivo:</label><br>
                        <input class="form-control" name="fopa_caminho_arquivo" placeholder="Digite o caminho do arquivo..." type="text" value="<?php echo $folhaPagamento->fopa_caminho_arquivo; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Funcionário:</label><br>
                        <select id="mySelect" name="fopa_fk_funcionario_pk_id" class="selectpicker form-control" data-live-search="true" disabled>
                            <option value="<?php echo $folhaPagamento->fopa_fk_funcionario_pk_id; ?>" > <?php echo $folhaPagamento->func_nome; ?></option>;
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <a  class="btn btn-warning btn-icon-split" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=edit&fopa_pk_id=') . $folhaPagamento->fopa_pk_id; ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-success btn-icon-split" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=list'); ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Voltar</span>
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
<br>