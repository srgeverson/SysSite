<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="jumbotron">
    <h2>Bem vindo!</h2>
    <hr>
    <p>
        <?php
        global $user_logged;
        echo $user_logged->auth_function; ?>
    </p>
    <a class="btn btn-primary" href="#">Saiba mais...</a>
</div>