<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Sobre
        <small>
            <?php
            $parameter = new ControllerParameter();
            echo $parameter->getProperty('sobre_titulo');
            ?>
        </small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo server_url('?page=ControllerPage&option=home'); ?>">Página Inicial</a>
        </li>
        <li class="breadcrumb-item active">Sobre</li>
    </ol>

    <!-- Intro Content -->
    <?php
    if (count($modern_business)) {
        echo '<div class="row">';
        foreach ($modern_business as $each_modern_business) {
            echo '<div class="col-lg-6">';
            echo '<img class="img-fluid rounded mb-4" src="', isset($each_modern_business->cont_image) ? server_url('br/com/system/uploads/content/' . $each_modern_business->cont_image) : server_url('br/com/system/assets/img/img_not_found.png'), '" alt = "', $each_modern_business->cont_title, '">';
            echo '</div>';
            echo '<div class="col-lg-6">';
            echo '<h2>', $each_modern_business->cont_title, '</h2>';
            echo '<p>', $each_modern_business->cont_text, '</p>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->

    <!-- Team Members -->
    <?php
    if (count($our_team)) {
        echo '<h2>Nosso Time</h2>';
        echo '<div class="row">';
        foreach ($our_team as $each_our_team) {
            echo '<div class="col-lg-4 mb-4">';
            echo ' <div class="card h-100 text-center">';
            echo '<img class = "img-fluid" src="', isset($each_our_team->cont_image) ? server_url('br/com/system/uploads/content/' . $each_our_team->cont_image) : server_url('br/com/system/assets/img/img_not_found.png'), '" alt = "', $each_our_team->cont_title, '">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">', $each_our_team->cont_title, '</h4>';
            echo '<h6 class="card-subtitle mb-2 text-muted">', $each_our_team->cont_subtitle, '</h6>';
            echo '<p class="card-text">', $each_our_team->cont_text, '</p>';
            echo '</div>';
            echo '<div class="card-footer">';
            echo '<a href="', isset($each_our_team->cont_link) ? $each_our_team->cont_link : '#', '">Saiba mais...</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->

    <!-- Our Customers -->
    <?php
    if (count($our_customers)) {
        echo '<h2>Nossos Clientes</h2>';
        echo '<div class="row">';
        foreach ($our_customers as $each_our_customer) {
            echo '<div class="col-lg-2 col-sm-4 mb-4">';
            echo '<img class = "img-fluid" src="', isset($each_our_customer->cont_image) ? server_url('br/com/system/uploads/content/' . $each_our_customer->cont_image) : server_url('br/com/system/assets/img/img_not_found.png'), '" alt = "', $each_our_customer->cont_title, '">';
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->
</div>
<!-- /.container -->
