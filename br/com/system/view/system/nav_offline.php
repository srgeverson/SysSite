<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a class="navbar-brand" href="<?php echo server_url('?page=ControllerPage&option=home'); ?>">
    <?php
    $parameter = new ControllerParameter();
    echo $parameter->getProperty('nome_apelido');
    ?>
</a>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo server_url('?page=ControllerPage&option=service'); ?>">Serviços</a>
        </li>   
        <li class="nav-item">
            <a class="nav-link" href="<?php echo server_url('?page=ControllerPage&option=contact'); ?>">Contato</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo server_url('?page=ControllerPage&option=about'); ?>">Sobre</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo server_url('?page=ControllerUser&option=authenticate'); ?>">Área Restrita</a>
        </li>
    </ul>
</div>
