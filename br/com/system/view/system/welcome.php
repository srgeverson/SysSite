<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/controller/ControllerFuncionario.php");
$controllerFuncionario = new ControllerFuncionario();
global $user_logged;
if ($controllerFuncionario->searchByFkUser($user_logged->user_pk_id) === null) {
    $controllerSystem = new ControllerSystem();
    $controllerSystem->funcionario_info('warning=funcionario_not_associated');
}
?>
<div class="jumbotron">
    <h2>Bem vindo!</h2>
    <hr>
    <p><?php echo $user_logged->auth_function;?>
    </p>
    <a class="btn btn-primary" href="#">Saiba mais...</a>
</div>