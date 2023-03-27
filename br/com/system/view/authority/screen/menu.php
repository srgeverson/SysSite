<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/controller/ControllerMenu.php");
echo '<div class="collapse navbar-collapse" id="navbarResponsive">';
    echo '<ul class="navbar-nav ml-auto">';
    // echo 'Ops';
        $controllerMenu = new ControllerMenu();
        $menus = $controllerMenu->listEnableds();
        //print_r($menus);
        foreach ($menus as $each_menu) {
            echo '<li class="nav-item dropdown no-arrow">';
            echo '  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            if ($each_menu->nome == 'Perfil'){
                if (isset($each_menu->imagem))
                    echo '<img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="' . server_url('br/com/system/uploads/user/') . $each_menu->imagem . '">';
                else
                    echo '<img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="' . server_url('br/com/system/uploads/user/not_found.png') . '">';
            }else{
                   echo '<i class="' . $each_menu->icone . '"></i>';
                   echo '      <span>' . $each_menu->nome . '</span>';
            }
            echo '  </a>';
            echo '  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">';

            foreach ($each_menu->itens as $each_item) {
                $url = str_replace('usuario_logado_user_pk_id', $user_logged->user_pk_id, $each_item->url);
                echo '<a class="dropdown-item" href="', server_url($url), '">';
                echo '  <i class = "' . $each_item->icone . '"></i>';
                echo $each_item->nome;
                echo '</a>';
                echo '<div class="dropdown-divider"></div>';
            }

            echo '  </div>';
            echo '</li>';
        }
        
        $pages_enableds = null;
        if (!empty($pages_enableds)) {
            echo '<li class="nav-item dropdown no-arrow">';
            echo '  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            echo '      <i class="fas fa-sliders-h fa-fw"></i>';
            echo '      <span>Site</span>';
            echo '  </a>';
            echo '  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">';

            $i = 0; //rever essa variável
            foreach ($pages_enableds as $each_item) {
                echo '<a class="dropdown-item" href="', server_url("?page=ControllerContent&option=filterByPage" . '&conte_fk_page_pk_id=' . $each_item->page_pk_id), '">';
                echo '  <i class = "fas fa-', $each_item->page_icon, ' fa-sm fa-fw mr-2 text-gray-400"></i>';
                echo $each_item->page_label;
                echo '</a>';
                if (count($pages_enableds) > 1 && $i < count($pages_enableds) - 1) {
                    echo '<div class="dropdown-divider"></div>';
                }
                $i++;
            }

            echo '  </div>';
            echo '</li>';
        }
    echo '</ul>';
echo '</div>';
?>