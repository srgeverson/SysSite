<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="jumbotron">
    <h2>Boas vindas!</h2>
    <hr>
    <p>
        <?php
        echo 'Olá <b>' . $user->user_name .
        '</b> em breve você receberá um email com sua senha provisória, recomendamos que no seu primeiro acesso troque sua senha.';
        ?>
    </p>
    <a class="btn btn-primary" href="<?php echo server_url('?page=ControllerUser&option=authenticate'); ?>">Acesse a área de login...</a>
</div>