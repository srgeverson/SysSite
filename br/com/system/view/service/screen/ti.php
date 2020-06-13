<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<a class="navbar-brand" href="<?php echo server_url('?page=ControllerSystem&option=welcome'); ?>">Template</a>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <!-- Site-->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sliders-h fa-fw"></i>
                <span>Site</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerHome&option=list"); ?>">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                    Página Inicial
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerContact&option=list"); ?>">
                    <i class="fas fa-address-book fa-sm fa-fw mr-2 text-gray-400"></i>
                    Contato
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerService&option=list"); ?>">
                    <i class="fas fa-concierge-bell fa-sm fa-fw mr-2 text-gray-400"></i>
                    Serviços
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerAbout&option=list"); ?>">
                    <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                    Sobre
                </a>
            </div>
        </li>
        <!-- Sistema-->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs fa-fw"></i>
                <span>Sistema</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerAuthority&option=list"); ?>">
                    <i class="fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                    Permissões
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo server_url("?page=ControllerUser&option=list"); ?>">
                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                    Usuários
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
                <a class="dropdown-item" href="<?php echo server_url('?page=ControllerUser&option=logout'); ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</div>

