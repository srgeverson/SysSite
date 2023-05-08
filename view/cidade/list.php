<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerCidade&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Cidades</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerCidade&option=novo'); ?>" class="btn btn-primary btn-icon-split btn">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="nome" value="<?php echo $cidade->nome; ?>">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div>
                    <?php echo isset($cidade->todos) ? 'checked' : ''; ?>
                        <input type="checkbox" name="todos" <?php echo $cidade->todos ? 'checked' : ''; ?>>
                        <span>Todos</span>
                    </div> 
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div class="input-group">
                        <button class="btn btn-success btn-icon-split btn">
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
            if (!isset($cidadees)) {
                echo '<h2>Use o filtro para ver as cidades cadastradas</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Estado</th>';
                echo '<th>Usuário Cadastrou/Alterou</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($cidadees as $each_cidade) {
                    echo '<tr>';
                    echo '<td>', $each_cidade->id, '</td>';
                    echo '<td>', $each_cidade->nome, '</td>';
                    echo '<td>', $each_cidade->estado_nome, '</td>';
                    echo '<td>', $each_cidade->usuario_nome, '</td>';
                    echo '<td>';
                    if ($each_cidade->status == true) {
                        echo '<a title="Desenable dados!" href="', server_url('?page=ControllerCidade&option=disable&id=' . $each_cidade->id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Editar dados!" href="', server_url('?page=ControllerCidade&option=edit&id=' . $each_cidade->id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                        echo '<i class="fas fa-edit"></i>';
                        echo '</a>';
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerCidade&option=enable&id=' . $each_cidade->id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                        echo '<a title="Excluir dados!" href="', server_url('?page=ControllerCidade&option=delete&id=' . $each_cidade->id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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
                echo '<th>Estado</th>';
                echo '<th>Usuário Cadastrou/Alterou</th>';
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