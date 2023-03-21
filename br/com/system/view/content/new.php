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
        <form action="<?php echo server_url('?page=ControllerContent&option=save'); ?>" enctype="multipart/form-data" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Adicionar Conteúdo</h4>
                <div class="card-body">
                    <div class="form-group was-validated">
                        <label class="text-primary">Componente:</label><br>
                        <input class="form-control" name="conte_component" type="text" placeholder="Digite um nome do component..." required>
                        <div class="invalid-feedback">
                            Este é um campo chave utilizado internamente pelo sistema
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Título:</label><br>
                        <input class="form-control" name="conte_title" type="text" placeholder="Digite um título...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Subtítulo:</label><br>
                        <input class="form-control" name="conte_subtitle" type="text" placeholder="Digite um subtítulo...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Imagem:</label><br>
                        <input class="form-control-file" name="conte_image" placeholder="Imagem..." type="file">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Link:</label><br>
                        <input class="form-control" name="conte_link" type="text" placeholder="Cole o link aqui...">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Texto:</label><br>
                        <textarea class="form-control" name="conte_text" placeholder="Texto para o conteúdo..." ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Página:</label><br>
                        <select name="conte_fk_page_pk_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($pages as $each_page) {
                                echo '<option value="', $each_page->page_pk_id, '">', $each_page->page_name, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerContent&option=listar'); ?>">
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