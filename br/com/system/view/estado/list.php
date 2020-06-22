<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerEstado&option=list'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Estados</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-4">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerEstado&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" type="text" name="esta_nome">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">País</span>
                        <select class="form-control form-control-lg" name="pais_nome">
                            <option>Todas</option>
                            <?php
                            foreach ($paises as $each_pais) {
                                echo '<option value="', $each_pais->pais_nome, '">', $each_pais->pais_nome, '</option>';
                            }
                            ?>
                        </select>
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
            if (!isset($estados)) {
                echo '<h2>Use o filtro para ver os estados cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>Sigla</th>';
                echo '<th>Pais</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($estados as $each_estado) {
                    echo '<tr>';
                    echo '<td>', $each_estado->esta_pk_id, '</td>';
                    echo '<td>', $each_estado->esta_nome, '</td>';
                    echo '<td>', $each_estado->esta_sigla, '</td>';
                    echo '<td>', $each_estado->pais_nome, '</td>';
                    echo '<td>';
                    if ($each_estado->esta_status == true) {
                        echo '<a title="Desabilitar dados!" href="', server_url('?page=ControllerEstado&option=disable&esta_pk_id=' . $each_estado->esta_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Editar dados!" href="', server_url('?page=ControllerEstado&option=edit&esta_pk_id=' . $each_estado->esta_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                        echo '<i class="fas fa-edit"></i>';
                        echo '</a>';
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerEstado&option=enable&esta_pk_id=' . $each_estado->esta_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                        echo '<a title="Excluir dados!" href="', server_url('?page=ControllerEstado&option=delete&esta_pk_id=' . $each_estado->esta_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
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
                echo '<th>Sigla</th>';
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