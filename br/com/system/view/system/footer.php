<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container">
    <p class="m-0 text-center text-white">
        Copyright &copy; 
        <?php
        $parameter = new ControllerParameter();
        echo $parameter->getProperty('nome_fantazia');
        ?>
    </p>
</div>