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
        echo 'Olá <b>' . $contato->descricao .
        '</b> em breve você receberá um email confirmando seu contado, em breve retornaremos o contato.';
        ?>
    </p>
    <a class="btn btn-primary" href="<?php echo server_url('?page=ControllerPage&option=contato'); ?>">Voltar...</a>
</div>