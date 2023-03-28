<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerEndereco&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Endereços</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerEndereco&option=novo'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Logradouro</span>
                        <input class="form-control" type="text" name="ende_logradouro">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Cidade</span>
                        <input class="form-control" type="text" name="ende_cidade">
                    </div>
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <button class="btn btn-success btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-search"></i>
                            </span>
                            <span class="text">Filtrar</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            if (!isset($enderecos)) {
                echo '<h2>Use o filtro para ver os endereços cadastradas</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Logragouro</th>';
                echo '<th>Cidade</th>';
                echo '<th>UF</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($enderecos as $each_endereco) {
                    echo '<tr>';
                    echo '<td>', $each_endereco->ende_pk_id, '</td>';
                    echo '<td>', $each_endereco->ende_logradouro, ' N° ', $each_endereco->ende_numero, ', ', $each_endereco->ende_bairro, ', CEP: ', $each_endereco->ende_cep, '</td>';
                    echo '<td>', $each_endereco->ende_cidade, '</td>';
                    echo '<td>', $each_endereco->sigla, '</td>';
                    echo '<td>';
                    if ($each_endereco->ende_status == true) {
                        echo '<a title="Desenable dados!" href="', server_url('?page=ControllerEndereco&option=disable&ende_pk_id=' . $each_endereco->ende_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Editar dados!" href="', server_url('?page=ControllerEndereco&option=edit&ende_pk_id=' . $each_endereco->ende_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                        echo '<i class="fas fa-edit"></i>';
                        echo '</a>';
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerEndereco&option=enable&ende_pk_id=' . $each_endereco->ende_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                        echo '<a title="Excluir dados!" href="', server_url('?page=ControllerEndereco&option=delete&ende_pk_id=' . $each_endereco->ende_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                        echo '<i class="fas fa-trash"></i>';
                        echo '</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tfoot>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Descrição</th>';
                echo '<th>Celular</th>';
                echo '<th>Telefone</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</tfoot>';
                echo '</tbody>';
                echo '</table>';
            }
            ?>
        </div>
    </div>
</div>