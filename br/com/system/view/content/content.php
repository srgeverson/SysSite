<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">
            <span>Conteúdo da Página-> <?php echo $page->page_name; ?></span>
        </h3>
        <hr>
        <div class="form-group row">
            <div class="col-sm-2 mb-2 mb-sm-0">
                <div class="input-group input-group-lg">
                    <span class="input-group-text">Código</span>
                    <input class="form-control" type="text" value="<?php echo $content->cont_fk_page_pk_id; ?>" disabled>
                </div>
            </div>
        </div>
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
                    echo '<th>Opções</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($contents as $each_content) {
                        echo '<tr>';
                        echo '<td>', $each_content->cont_pk_id, '</td>';
                        echo '<td>', $each_content->cont_component, '</td>';
                        echo '<td>', $each_content->cont_title, '</td>';
                        echo '<td>', $each_content->cont_subtitle, '</td>';
                        echo '<td>', $each_content->cont_text, '</td>';
                        echo '<td>';
                        if ($each_content->cont_status == true) {
                            echo '<a title="Desenable dados!" href="', server_url('?page=ControllerContent&option=disable&cont_pk_id=' . $each_content->cont_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-times-circle"></i>';
                            echo '</a>';
                        } else {
                            echo '<a title="Editar dados!" href="', server_url('?page=ControllerContent&option=edit&cont_pk_id=' . $each_content->cont_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                            echo '<i class="fas fa-edit"></i>';
                            echo '</a>';
                            echo '<a title="Ativar dados!" href="', server_url('?page=ControllerContent&option=enable&cont_pk_id=' . $each_content->cont_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                            echo '<i class="fas fa-check-circle"></i>';
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