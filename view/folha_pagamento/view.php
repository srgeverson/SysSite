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
        <div class="card h-100">
            <h4 class="card-header text-primary">Visualizar Folha de Pagamento</h4>
            <div class="card-body">
                <div class="form-group">
                    <label class="text-primary">Código:</label><br>
                    <input class="form-control" name="fopa_pk_id" type="number" value="<?php echo $folhaPagamento->fopa_pk_id; ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="text-primary">Competência:</label><br>
                    <input class="form-control" name="fopa_competencia"  placeholder="Digite a competência no formato mês/ano..." type="text"  value="<?php echo $folhaPagamento->fopa_competencia; ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="text-primary">Nome do Arquivo:</label><br>
                    <input class="form-control" name="fopa_arquivo" placeholder="Selecione o arquivo..." type="text" value="<?php echo $folhaPagamento->fopa_nome_arquivo; ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="text-primary">Funcionário:</label><br>
                    <select id="mySelect" name="fopa_fk_funcionario_pk_id" class="selectpicker form-control" data-live-search="true" disabled>
                        <option value="<?php echo $folhaPagamento->fopa_fk_funcionario_pk_id; ?>" > <?php echo $folhaPagamento->nome; ?></option>;
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-primary">Contra Cheque:</label><br>
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <a  class="btn btn-info btn-icon-split" href="<?php echo $folhaPagamento->fopa_caminho_arquivo; ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                                <span class="text">Baixar Arquivo</span>
                            </a>
                        </div>
                        <div class="input-group">
                            <!--
                            Descomentar após a implementação desta funcção
                            <a  class="btn btn-secondary btn-icon-split folha_pagamento_visualizar" href="#<?php server_url('?page=ControllerFolhaPagamento&option=downloadFile&fopa_pk_id=' . $folhaPagamento->fopa_pk_id); ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                                <span class="text">Visualizar Arquivo</span>
                            </a>
                            -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                    <div class="input-group">
                        <?php
                        global $user_logged;
                        if ($user_logged->user_fk_permissao_pk_id != 3) {
                            echo '<a  class="btn btn-warning btn-icon-split" href="' . server_url('?page=ControllerFolhaPagamento&option=edit&fopa_pk_id=') . $folhaPagamento->fopa_pk_id . '">';
                            echo '<span class = "icon text-white-50">';
                            echo '<i class = "fas fa-edit"></i>';
                            echo '</span>';
                            echo '<span class = "text">Editar</span>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <div class="input-group">
                        <a  class="btn btn-success btn-icon-split" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=listar'); ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>
<br>