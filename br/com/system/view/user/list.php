<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerUser&option=list'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Usuários</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="user_name">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">E-mail</span>
                        <input class="form-control" type="text" name="user_login">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Permissões</span>
                        <select name="user_fk_authority_pk_id" class="form-control form-control-lg" required>
                            <option>Todas</option>
                            <?php
                            foreach ($authorities as $each_authority) {
                                echo '<option value="', $each_authority->auth_pk_id, '">', $each_authority->auth_description, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-4">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerUser&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
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
            if (!isset($users)) {
                echo '<h2>Use o filtro para ver os usuários cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Login</th>';
                echo '<th>Função</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($users as $each_user) {
                    echo '<tr>';
                    echo '<td>', $each_user->user_pk_id, '</td>';
                    echo '<td>', $each_user->user_name, '</td>';
                    echo '<td>', $each_user->user_login, '</td>';
                    echo '<td>', $each_user->auth_description, '</td>';
                    echo '<td>';
                    echo '<a title="Editar dados!" href="', server_url('?page=ControllerUser&option=edit&user_pk_id=' . $each_user->user_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                    echo '<i class="fas fa-edit"></i>';
                    echo '</a>';
                    if ($each_user->user_status == true) {
                        echo '<a title="Desenable dados!" href="', server_url('?page=ControllerUser&option=disable&user_pk_id=' . $each_user->user_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerUser&option=enable&user_pk_id=' . $each_user->user_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                    }
                    echo '<a title="Excluir dados!" href="', server_url('?page=ControllerUser&option=delete&user_pk_id=' . $each_user->user_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                    echo '<i class="fas fa-trash"></i>';
                    echo '</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tfoot>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Login</th>';
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