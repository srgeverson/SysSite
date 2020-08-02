<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <!-- Site-->
        <?php
        $controllerPage = new ControllerPage();
        $pages_enableds = $controllerPage->listEnableds();
        if (!empty($pages_enableds)) {
            echo '<li class="nav-item dropdown no-arrow">';
            echo '  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            echo '      <i class="fas fa-sliders-h fa-fw"></i>';
            echo '      <span>Site</span>';
            echo '  </a>';
            echo '  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">';


            $i = 0; //rever essa variável
            foreach ($pages_enableds as $each_page) {
                echo '<a class="dropdown-item" href="', server_url("?page=ControllerContent&option=filterByPage" . '&cont_fk_page_pk_id=' . $each_page->page_pk_id), '">';
                echo '  <i class = "fas fa-', $each_page->page_icon, ' fa-sm fa-fw mr-2 text-gray-400"></i>';
                echo $each_page->page_label;
                echo '</a>';
                if (count($pages_enableds) > 1 && $i < count($pages_enableds) - 1) {
                    echo '<div class="dropdown-divider"></div>';
                }
                $i++;
            }

            echo '  </div>';
            echo '</li>';
        }
        ?>
        <!-- Processos-->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chalkboard-teacher fa-fw"></i>
                <span>Processos</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerFuncionario&option=list"); ?>">
                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                    Funcionários
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerFolhaPagamento&option=list"); ?>">
                    <i class="fas fa-money-check-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Folha de Pagamento
                </a>
            </div>
        </li>
        <!--Sistema-->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs fa-fw"></i>
                <span>Sistema</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerUser&option=list"); ?>">
                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                    Usuários
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerAuthority&option=list"); ?>">
                    <i class="fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                    Permissões
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerParameter&option=list"); ?>">
                    <i class="fas fa-tasks fa-sm fa-fw mr-2 text-gray-400"></i>
                    Parâmetros
                </a>
            </div>
        </li>
        <!-- Perfil-->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="<?php echo isset($user_logged->user_image) ? server_url('br/com/system/uploads/user/' . $user_logged->user_image) : server_url('br/com/system/assets/img/img_not_found.png'); ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerUser&option=editProfile&user_pk_id=" . $user_logged->user_pk_id); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url('?page=ControllerSystem&option=welcome'); ?>">
                    <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Boas vindas
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url('?page=ControllerUser&option=logout'); ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</div>

