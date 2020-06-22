<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <?php
        $controllerPage = new ControllerPage();
        $pages_enableds = $controllerPage->listEnableds();
        
        foreach ($pages_enableds as $each_page) {
            if ($each_page->page_name !== 'home') {
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="', server_url("?page=ControllerPage&option=" . $each_page->page_name), '">';
                echo $each_page->page_label;
                echo '</a>';
                echo '</li>';
            }
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo server_url('?page=ControllerUser&option=authenticate'); ?>">Área Restrita</a>
        </li>
    </ul>
</div>
