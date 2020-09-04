<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerFuncionario&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Funcionários</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="func_nome">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">CPF</span>
                        <input class="form-control" id="cpf" type="text" name="func_cpf">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">RG</span>
                        <input class="form-control" type="text" name="func_rg">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-4">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerFuncionario&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
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
            if (!isset($funcionarios)) {
                echo '<h2>Use o filtro para ver os funcionários cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>CPF</th>';
                echo '<th>RG</th>';
                echo '<th>Data Nascimento</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($funcionarios as $each_funcionario) {
                    echo '<tr>';
                    echo '<td>', $each_funcionario->func_pk_id, '</td>';
                    echo '<td>', $each_funcionario->func_nome, '</td>';
                    echo '<td>', $each_funcionario->func_cpf, '</td>';
                    echo '<td>', $each_funcionario->func_rg, '</td>';
                    $data = new DateTime($each_funcionario->func_data_nascimento);
                    echo '<td>', $data->format('d-m-Y'), '</td>';
                    echo '<td>';
                    echo '<a title="Editar dados!" href="', server_url('?page=ControllerFuncionario&option=edit&func_pk_id=' . $each_funcionario->func_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                    echo '<i class="fas fa-edit"></i>';
                    echo '</a>';
                    if ($each_funcionario->func_status) {
                        echo '<a title="Desabilitar dados!" href="', server_url('?page=ControllerFuncionario&option=disable&func_pk_id=' . $each_funcionario->func_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerFuncionario&option=enable&func_pk_id=' . $each_funcionario->func_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                    }
                    if ($permissao == 1) {
                        echo '<a title="Excluir dados!" href="', server_url('?page=ControllerFuncionario&option=delete&func_pk_id=' . $each_funcionario->func_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                        echo '<i class="fas fa-trash"></i>';
                        echo '</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tfoot>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>CPF</th>';
                echo '<th>RG</th>';
                echo '<th>Data Nascimento</th>';
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