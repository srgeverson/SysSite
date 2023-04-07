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
        <form action="<?php echo server_url('?page=ControllerMenuItem&option=update'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Alterar Menu</h4>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" name="id" type="hidden" value="<?php echo $menuItem->id; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Nome:</label><br>
                        <input class="form-control" name="nome" type="text" placeholder="Digite um nome para a permissão..." value="<?php echo $menuItem->nome; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Descrição:</label><br>
                        <input class="form-control" name="descricao" type="text" placeholder="Digite uma descrição..." value="<?php echo $menuItem->descricao; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Título:</label><br>
                        <input class="form-control" name="titulo" type="text" placeholder="Digite um título..." value="<?php echo $menuItem->titulo; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Class CSS:</label><br>
                        <input class="form-control" name="class" type="text" placeholder="Digite uma Class CSS..." value="<?php echo $menuItem->class; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="text-primary">URL/EndPoint:</label><br>
                        <input class="form-control" name="url" type="text" placeholder="Digite uma URL/EndPoint..."  value="<?php echo $menuItem->url; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Imagem:</label><br>
                        <input class="form-control" name="image" type="file" placeholder="Digite uma URL/EndPoint..."  value="<?php echo $menuItem->image; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Ícone:</label><br>
                        <input class="form-control" name="icone" type="text" placeholder="Digite uma URL/EndPoint..." value="<?php echo $menuItem->icone; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Menu:</label><br>
                        <select name="menu_id" class="form-control" required>
                            <option></option>
                            <?php
                            foreach ($menus as $each_menu) {
                                echo '<option value="', $each_menu->id, '"', $each_menu->id === $menuItem->menu_id ? 'selected' : '', '>', $each_menu->nome, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Sub Menu:</label><br>
                        <select name="menu_item_id" class="form-control">
                            <option></option>
                            <?php
                            foreach ($submenus as $each_menuItem) {
                                echo '<option value="', $each_menuItem->id, '"', $each_menuItem->id === $menuItem->menu_item_id ? 'selected' : '', '>', $each_menuItem->nome, '</option>';
                            }
                            ?>
                        </select>
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
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerMenuItem&option=listar'); ?>" type="submit">
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