<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerPemissao&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Permissões</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Descrição</span>
                        <input class="form-control" type="text" name="descricao" value="<?php echo $permissao->descricao ?>">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div>
                        <input type="checkbox" name="todos" <?php echo $permissao->todos ? 'checked' : ''; ?>>
                        <span>Todos</span>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerPemissao&option=novo'); ?>" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div class="input-group">
                        <button class="btn btn-success btn-icon-split">
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
            if (!isset($authorities)) {
                echo '<h2>Use o filtro para ver as permissões cadastradas</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Descrição</th>';
                echo '<th>Item de Menu</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($authorities as $each_permissao) {
                    echo '<tr>';
                    echo '<td>', $each_permissao->id, '</td>';
                    echo '<td>', $each_permissao->nome, '</td>';
                    echo '<td>', $each_permissao->descricao, '</td>';
                    echo '<td>', $each_permissao->menu_item_nome, '</td>';
                    echo '<td>';
                    if ($each_permissao->status == true) {
                        echo '<a title="Desativar dados!" href="', server_url('?page=ControllerPemissao&option=disable&id=' . $each_permissao->id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        if (($each_permissao->id != 1)) {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerPemissao&option=edit&id=' . $each_permissao->id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerPemissao&option=enable&id=' . $each_permissao->id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
                            echo '</a>';
                        }
                        //Ocultando o botão de exclusão para todos usuários exceto o do grupo TI
                        if ($permissao == 1) {
                            echo '<a title="Excluir dados!" href="', server_url('?page=ControllerPemissao&option=delete&id=' . $each_permissao->id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                            echo '<i class="fas fa-trash"></i>';
                            echo '</a>';
                        }
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tfoot>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Descrição</th>';
                echo '<th>Tela</th>';
                echo '<th>Função</th>';
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