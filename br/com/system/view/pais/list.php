<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerPais&option=listar'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Países</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerPais&option=novo'); ?>" class="btn btn-primary btn-icon-split btn">
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
                        <input class="form-control" type="text" name="nome" value="<?php echo $pais->nome; ?>">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div>
                    <?php echo isset($pais->todos) ? 'checked' : ''; ?>
                        <input type="checkbox" name="todos" <?php echo $pais->todos ? 'checked' : ''; ?>>
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
            if (!isset($paises)) {
                echo '<h2>Use o filtro para ver os países cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Sigla</th>';
                echo '<th>Usuário Cadastrou/Alterou</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($paises as $each_pais) {
                    echo '<tr>';
                    echo '<td>', $each_pais->id, '</td>';
                    echo '<td>', $each_pais->nome, '</td>';
                    echo '<td>', $each_pais->sigla, '</td>';
                    echo '<td>', $each_pais->usuario_nome, '</td>';
                    echo '<td>';
                    if ($each_pais->status == true) {
                        echo '<a title="Desenable dados!" href="', server_url('?page=ControllerPais&option=disable&id=' . $each_pais->id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Editar dados!" href="', server_url('?page=ControllerPais&option=edit&id=' . $each_pais->id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                        echo '<i class="fas fa-edit"></i>';
                        echo '</a>';
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerPais&option=enable&id=' . $each_pais->id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                        echo '<a title="Excluir dados!" href="', server_url('?page=ControllerPais&option=delete&id=' . $each_pais->id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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