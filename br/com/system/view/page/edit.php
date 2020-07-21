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
        <form action="<?php echo server_url('?page=ControllerPage&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Página</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="page_pk_id" type="hidden" value="<?php echo $page->page_pk_id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Nome da Página:</label><br>
                        <input class="form-control" name="page_name" type="text" placeholder="Digite um nome..." value="<?php echo $page->page_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <textarea class="form-control" name="page_description" placeholder="Uma breve descrição sobre da página..." required><?php echo $page->page_description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Icone:</label><br>
                        <input class="form-control" name="page_icon" type="text" placeholder="Digite um nome..." value="<?php echo $page->page_icon; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="page_label" type="text" placeholder="Digite um nome..." value="<?php echo $page->page_label; ?>" required>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerPage&option=list'); ?>" type="submit">
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