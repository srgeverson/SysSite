<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerContent&option=list'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Conteúdos</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-2 mb-2 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerContent&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Página</span>
                        <select name="page_name" class="form-control form-control-lg" required>
                            <option>Todas</option>
                            <?php
                            foreach ($pages as $each_page) {
                                echo '<option value="', $each_page->page_name, '">', $each_page->page_name, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Componente</span>
                        <input class="form-control" type="text" name="conte_component">
                    </div>
                </div>
                <div class="col-sm-2 mb-2 mb-sm-0">
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
        <div class="card-body">
            <div class="table-responsive">
                <?php
                if (!isset($contents)) {
                    echo '<h2>Use o filtro para ver os conteúdos cadastrados</h2>';
                } else {
                    echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Código</th>';
                    echo '<th>Componente</th>';
                    echo '<th>Título</th>';
                    echo '<th>Subtítulo</th>';
                    echo '<th>Texto</th>';
                    echo '<th>Página</th>';
                    echo '<th>Opções</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($contents as $each_content) {
                        echo '<tr>';
                        echo '<td>', $each_content->conte_pk_id, '</td>';
                        echo '<td>', $each_content->conte_component, '</td>';
                        echo '<td>', $each_content->conte_title, '</td>';
                        echo '<td>', $each_content->conte_subtitle, '</td>';
                        echo '<td>', $each_content->conte_text, '</td>';
                        echo '<td>', $each_content->page_name, '</td>';
                        echo '<td>';
                        if ($each_content->conte_status == true) {
                            echo '<a title="Desenable dados!" href="', server_url('?page=ControllerContent&option=disable&conte_pk_id=' . $each_content->conte_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-times-circle"></i>';
                            echo '</a>';
                        } else {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerContent&option=edit&conte_pk_id=' . $each_content->conte_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerContent&option=enable&conte_pk_id=' . $each_content->conte_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
                            echo '</a>';
                            echo '<a title="Excluir dados!" href="', server_url('?page=ControllerContent&option=delete&conte_pk_id=' . $each_content->conte_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                            echo '<i class="fas fa-trash"></i>';
                            echo '</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '<tfoot>';
                    echo '<tr>';
                    echo '<th>Código</th>';
                    echo '<th>Componente</th>';
                    echo '<th>Título</th>';
                    echo '<th>Subtítulo</th>';
                    echo '<th>Texto</th>';
                    echo '<th>Página</th>';
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