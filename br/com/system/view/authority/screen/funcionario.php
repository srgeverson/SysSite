<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/controller/ControllerFolhaPagamento.php");
include_once server_path("br/com/system/controller/ControllerFuncionario.php");
$controllerFuncionario = new ControllerFuncionario();
global $user_logged;
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            
            <!-- Nav Item - Messages -->
            <?php
            if ($controllerFuncionario->searchByFkUser($user_logged->user_pk_id) !== null) {
                $controllerFolhaPagamento = new ControllerFolhaPagamento();
                echo '<li class="nav-item dropdown no-arrow mx-1">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo '<i class="fas fa-envelope fa-fw"></i>';
                        echo '<span class="badge badge-danger badge-counter">7</span>';
                        //echo '<a class="nav-link" href="', server_url("?page=ControllerFolhaPagamento&option=" . $controllerFuncionario->fopa_pk_id), '">';
                        //echo 'teste';
                    echo '</a>';
                    echo '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">';
                        echo '<h6 class="dropdown-header">Caixa de Menssagens</h6>';
                            echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                                echo '<div class="mr-3">';
                                    echo '<div class="icon-circle bg-warning">';
                                        echo '<i class="fas fa-exclamation-triangle text-white"></i>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div>';
                                echo '<div class="small text-gray-500">December 2, 2019</div>';
                                    echo 'Spending Alert: Weve noticed unusually high spending for your account.';
                                echo '</div>';
                            echo '</a>';
                        echo '<a class="dropdown-item text-center small text-gray-500" href="', server_url("?page=ControllerFolhaPagamento&option=filterByFuncionario&funf_pk_id=" . $controllerFuncionario->fopa_pk_id), '">Visualizar todas menssagens</a>';
                    echo '</div>';
                echo '</li>';
            }
            ?>
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
</div>