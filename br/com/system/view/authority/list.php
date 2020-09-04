<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerAuthority&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Permissões</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerAuthority&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Descrição</span>
                        <input class="form-control" type="text" name="auth_description">
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
            if (!isset($authorities)) {
                echo '<h2>Use o filtro para ver as permissões cadastradas</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Descrição</th>';
                echo '<th>Tela</th>';
                echo '<th>Função</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($authorities as $each_authority) {
                    echo '<tr>';
                    echo '<td>', $each_authority->auth_pk_id, '</td>';
                    echo '<td>', $each_authority->auth_description, '</td>';
                    echo '<td>', $each_authority->auth_screen, '</td>';
                    echo '<td>', $each_authority->auth_function, '</td>';
                    echo '<td>';
                    if ($each_authority->auth_status == true) {
                        echo '<a title="Desativar dados!" href="', server_url('?page=ControllerAuthority&option=disable&auth_pk_id=' . $each_authority->auth_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        if (($each_authority->auth_pk_id != 1)) {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerAuthority&option=edit&auth_pk_id=' . $each_authority->auth_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerAuthority&option=enable&auth_pk_id=' . $each_authority->auth_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
                            echo '</a>';
                        }
                        //Ocultando o botão de exclusão para todos usuários exceto o do grupo TI
                        if ($permissao == 1) {
                            echo '<a title="Excluir dados!" href="', server_url('?page=ControllerAuthority&option=delete&auth_pk_id=' . $each_authority->auth_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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