<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/controller/ControllerFuncionarioUser.php");
$controllerFuncionarioUser = new ControllerFuncionarioUser();
global $user_logged;
if (($controllerFuncionarioUser->searchByFkUser($user_logged->id) == false) && ($user_logged->user_fk_authority_pk_id == 3)) {
    $controllerSystem = new ControllerSystem();
    $controllerSystem->funcionario_info('warning=funcionario_not_associated');
}
?>
<div class="jumbotron">
    <h2>Bem vindo!</h2>
    <hr>
    <p><?php echo $user_logged->usuario_id;?>
    </p>
    <a class="btn btn-primary" href="#">Saiba mais...</a>
</div>