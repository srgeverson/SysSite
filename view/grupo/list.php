<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerGrupo&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Grupos</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="nome" value="<?php echo $grupo->nome ?>">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div>
                        <input type="checkbox" name="todos" <?php echo $grupo->todos ? 'checked' : ''; ?>>
                        <span>Todos</span>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerGrupo&option=novo'); ?>" class="btn btn-primary btn-icon-split">
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
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  class="btn btn-secondary btn-icon-split" href="<?php echo server_url('?page=ControllerGrupo&option=vincularPermissao'); ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-down-up-lock"></i>
                            </span>
                            <span class="text">Vincular Permissão</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div class="input-group">
                        <a  class="btn btn-info btn-icon-split" href="<?php echo server_url('?page=ControllerGrupo&option=vincularUsuario'); ?>">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-users-between-lines"></i>
                            </span>
                            <span class="text">Vincular Usuário</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            if (!isset($grupos)) {
                echo '<h2>Use o filtro para ver os grupos cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($grupos as $each_grupo) {
                    echo '<tr>';
                    echo '<td>', $each_grupo->id, '</td>';
                    echo '<td>', $each_grupo->nome, '</td>';
                    echo '<td>';
                    if ($each_grupo->status == true) {
                        echo '<a title="Desativar dados!" href="', server_url('?page=ControllerGrupo&option=disable&id=' . $each_grupo->id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                        echo '<a title="Desvincular Permissão!" href="', server_url('?page=ControllerGrupo&option=desvincularPermissao&id=' . $each_grupo->id), '" class="btn btn-secondary btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-arrow-down-up-lock"></i>';
                        echo '</a>';
                        echo '<a title="Desvincular Usuario!" href="', server_url('?page=ControllerGrupo&option=desvincularUsuario&id=' . $each_grupo->id), '" class="btn btn-info btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fa-solid fa-users-between-lines"></i>';
                        echo '</a>';
                    } else {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerGrupo&option=edit&id=' . $each_grupo->id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerGrupo&option=enable&id=' . $each_grupo->id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
                            echo '</a>';
                            echo '<a title="Excluir dados!" href="', server_url('?page=ControllerGrupo&option=delete&id=' . $each_grupo->id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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