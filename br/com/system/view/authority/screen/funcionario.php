<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/controller/ControllerFolhaPagamento.php");
include_once server_path("br/com/system/controller/ControllerFuncionarioUser.php");
$controllerFuncionarioUser = new ControllerFuncionarioUser();
global $user_logged;
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Messages -->
            <?php
            $funcionario = $controllerFuncionarioUser->searchByFkUser($user_logged->user_pk_id);
            if (isset($funcionario)) {
                $controllerFolhaPagamento = new ControllerFolhaPagamento();
                $listaFolhaPagamento = $controllerFolhaPagamento->listEnabledsByFuncionario(isset($funcionario->func_pk_id) ? $funcionario->func_pk_id : 0);
                echo '<li class="nav-item dropdown no-arrow mx-1">';
                echo '<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo '<i class="fas fa-envelope fa-fw"></i>';
                if (isset($funcionario->func_pk_id)) {
                    echo '<span class="badge badge-danger badge-counter">', count($listaFolhaPagamento), '</span>';
                }
                echo '</a>';
                echo '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">';
                echo '<h6 class="dropdown-header">Caixa de Menssagens</h6>';
                if (count($listaFolhaPagamento) > 0) {
                    for ($index = 0; $index < count($listaFolhaPagamento); $index++) {
                        echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                        echo '<div class="mr-3">';
                        echo '<div class="icon-circle bg-info">';
                        echo '<i class="fas fa-exclamation-triangle text-white"></i>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div>';
                        echo '<div class="small text-gray-500">Não visualizado</div>';
                        echo 'Competência: ' . $listaFolhaPagamento[$index]->fopa_competencia;
                        echo '</div>';
                        echo '</a>';
                        if ($index == 3) {
                            $index = count($listaFolhaPagamento);
                        }
                    }
                } else {
                    echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                    echo '<h2>Não existe folha de pagamento lançado.</h2>';
                    echo '</a>';
                }
                if (isset($funcionario->func_pk_id)) {
                    echo '<a class="dropdown-item text-center small text-gray-500" href="', server_url("?page=ControllerFolhaPagamento&option=listar"), '">Todas folhas de pagamento</a>';
                }
                echo '</div>';
                echo '</li>';
            }
            ?>
            <!-- Perfil-->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="<?php echo isset($user_logged->user_image) ? server_url('br/com/system/uploads/user/' . $user_logged->user_image) : server_url('br/com/system/uploads/user/not_found.png'); ?>">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo server_url("?page=ControllerUser&option=editProfile&user_pk_id=" . $user_logged->user_pk_id); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php
                    echo server_url($funcionario == false ? '?page=ControllerFuncionario&option=novo' : '?page=ControllerFuncionario&option=edit&func_pk_id=' . $funcionario->func_pk_id);
                    ?>">
                        <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                        Dados Profissionais
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo server_url('?page=ControllerSystem&option=welcome'); ?>">
                        <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Boas vindas
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo server_url('?page=ControllerUser&option=logout'); ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Sair
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>