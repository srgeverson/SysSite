<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerMenuItem&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Itens de Menu</span>
            </h3>
            <hr>
            <div class="form-group row">
            <div class="col-sm-3 mb-3 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="nome" value="<?php echo $menuItem->nome ?>">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Descrição</span>
                        <input class="form-control" type="text" name="descricao" value="<?php echo $menuItem->descricao ?>">
                    </div>
                </div>
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Menu</span>
                        <select name="menu_id" class="form-control">
                            <option></option>
                            <?php
                            foreach ($menus as $each_menu) {
                                echo '<option value="', $each_menu->id, '"', $each_menu->id === $menuItem->menu_id ? 'selected' : '', '>', $each_menu->nome, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div>
                        <input type="checkbox" name="todos" <?php echo $menuItem->todos ? 'checked' : ''; ?>>
                        <span>Todos</span>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerMenuItem&option=novo'); ?>" class="btn btn-primary btn-icon-split">
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
            if (!isset($menuItens)) {
                echo '<h2>Use o filtro para ver os itens de menu cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Descrição</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($menuItens as $each_menuItem) {
                    echo '<tr>';
                    echo '<td>', $each_menuItem->id, '</td>';
                    echo '<td>', $each_menuItem->nome, '</td>';
                    echo '<td>', $each_menuItem->descricao, '</td>';
                    echo '<td>';
                    if ($each_menuItem->status == true) {
                        echo '<a title="Desativar dados!" href="', server_url('?page=ControllerMenuItem&option=disable&id=' . $each_menuItem->id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        if (($each_menuItem->id != 1)) {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerMenuItem&option=edit&id=' . $each_menuItem->id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerMenuItem&option=enable&id=' . $each_menuItem->id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
                            echo '</a>';
                        }
                        //Ocultando o botão de exclusão para todos usuários exceto o do grupo TI
                        if ($menuItem == 1) {
                            echo '<a title="Excluir dados!" href="', server_url('?page=ControllerMenuItem&option=delete&id=' . $each_menuItem->id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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
                echo '<th>Nome</th>';
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