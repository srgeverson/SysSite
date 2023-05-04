<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("controller/ControllerMenu.php");
include_once server_path("controller/ControllerFolhaPagamento.php");
echo '<div class="collapse navbar-collapse" id="navbarResponsive">';
    echo '<ul class="navbar-nav ml-auto">';
    // echo 'Ops';
        $controllerMenu = new ControllerMenu();
        $menus = $controllerMenu->listMenuVinculadosAoUsuario($user_logged->id);
        // print_r($menus);
        foreach ($menus as $each_menu) {
            echo '<li class="nav-item dropdown no-arrow">';
            echo '  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            if ($each_menu->nome == 'Perfil' && $each_menu->id == 1){
                if (isset($user_logged->imagem))
                    echo '<img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="' . server_url('uploads/user/') . $user_logged->imagem . '">';
                else
                    echo '<img class="img-profile rounded-circle" style="width: 30px; height: 30px" src="' . server_url('uploads/user/not_found.png') . '">';
            } else if($each_menu->nome == 'Contra-cheque' /*&& $each_menu->id == 5*/){
                $listaFolhaPagamento = array();
                $funcionario = null;
                if (isset($funcionario)) {
                    $controllerFolhaPagamento = new ControllerFolhaPagamento();
                    $listaFolhaPagamento = $controllerFolhaPagamento->listEnabledsByFuncionario(isset($funcionario->id) ? $funcionario->id : 0);
                }
                echo '<i class="' . $each_menu->icone . '"></i>';
                if (isset($funcionario->id)) {
                    echo '<span class="badge badge-danger badge-counter">', count($listaFolhaPagamento), '</span>';
                }
                echo '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">';
                echo '<h6 class="dropdown-header">' . $each_menu->descricao . '</h6>';
            } else {
                echo '<i class="' . $each_menu->icone . '"></i>';
                echo '      <span>' . $each_menu->nome . '</span>';
            }
            echo '  </a>';
            echo '  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">';

            foreach ($each_menu->itens as $each_item) {
                $url =  null;
                $url = str_replace('usuario_logado_id', $user_logged->id, $each_item->url);
                if($each_menu->nome == 'Contra-cheque'/*$each_menu->id == 5 && $each_item->id == 16*/){
                    echo $each_item->id;
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
                        echo '<h2>' . $each_item->titulo . '1.</h2>';
                        echo '</a>';
                    }
                    if (isset($funcionario->id)) {
                        echo '<a class="' . $each_item->icone . '" href="', server_url($url), '"> ' . $each_item->nome . '</a>';
                    }
                    echo 'ops';
                } else {
                    echo '<a class="dropdown-item" href="', server_url($url), '">';
                    echo '  <i class = "' . $each_item->icone . '"></i>';
                    echo $each_item->nome;
                    echo '</a>';
                    echo '<div class="dropdown-divider"></div>';
                }
            }

            echo '  </div>';
            echo '</li>';
        }
    echo '</ul>';
echo '</div>';
?>