<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerContent&option=submit'); ?>" enctype="multipart/form-data" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Personalizar Conteúdo</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="cont_pk_id" type="hidden" value="<?php echo $content->cont_pk_id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Componente:</label><br>
                        <input class="form-control" name="cont_component" placeholder="Digite um nome do component..." type="text"  value="<?php echo $content->cont_component; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Título:</label><br>
                        <input class="form-control" name="cont_title" placeholder="Digite um título..." type="text" value="<?php echo $content->cont_title; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Subtítulo:</label><br>
                        <input class="form-control" name="cont_subtitle" type="text" placeholder="Digite um subtítulo..." value="<?php echo $content->cont_subtitle; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Imagem:</label><br>
                        <input class="form-control-file" name="cont_image" placeholder="Imagem..." type="file">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Link:</label><br>
                        <input class="form-control" name="cont_link" type="text" placeholder="Cole o link aqui..." value="<?php echo $content->cont_subtitle; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Texto:</label><br>
                        <textarea class="form-control" name="cont_text" placeholder="Texto para o conteúdo..." ><?php echo $content->cont_text; ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Alterar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerContent&option=filterByPage&cont_fk_page_pk_id=' . $content->cont_fk_page_pk_id); ?>" type="submit">
                                <span class="icon text-white-50">
                                    <i class="fas fa-window-close"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>