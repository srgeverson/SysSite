<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<header>
    <?php
    if (count($slide_apresentacao)) {
        if (count($slide_apresentacao)) {
            echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
            $i = 0;
            echo '<ol class="carousel-indicators">';
            foreach ($slide_apresentacao as $each_slide_apresentacao) {
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="', $i, '" class="', $i == 0 ? 'active' : '', '"></li>';
                $i++;
            }
            echo '</ol>';
            echo '<div class="carousel-inner" role="listbox">';
            $i = 0;
            foreach ($slide_apresentacao as $each_slide_apresentacao) {
                echo '<div class="carousel-item ', $i == 0 ? 'active' : '', '" style="background-image: url(', isset($each_slide_apresentacao->conte_image) ? server_url('br/com/system/uploads/content/' . $each_slide_apresentacao->conte_image) : server_url('br/com/system/assets/img/1900x1080.png'), '">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h3>', $each_slide_apresentacao->conte_title, '</h3>';
                echo '<p>', $each_slide_apresentacao->conte_subtitle, '</p>';
                echo '</div>';
                echo '</div>';
                $i++;
            }
            echo '</div>';
            echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">Previous</span>';
            echo '</a>';
            echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">Next</span>';
            echo '</a>';
            echo '</div>';
        }
    }
    ?>
</header>
<!-- Page Content -->
<div class="container">
    <?php
    if (count($nossos_destaques)) {
        echo '<h1 class="my-4">Nossos Destaques</h1>';
        echo '<div class="row">';
        foreach ($nossos_destaques as $each_nossos_destaques) {
            echo '<div class="col-lg-4 col-sm-6 portfolio-item">';
                    echo '<div class="card h-100">';
                            echo '<a href="#"><img class="card-img-top" src="', isset($each_slide_apresentacao->conte_image) ? server_url('br/com/system/uploads/content/' . $each_slide_apresentacao->conte_image) : server_url('br/com/system/assets/img/700x400.png'), '" alt=""></a>';
                            echo '<div class="card-body">';
                                    echo '<h4 class="card-title">';
                                    echo '<a href="', isset($each_nossos_destaques->conte_link) ? $each_nossos_destaques->conte_link : '#', '" class="btn btn-primary">', $each_nossos_destaques->conte_title, '</a>';
                                    echo '</h4>';
                                    echo '<p>', $each_nossos_destaques->conte_text, '</p>';
                            echo '</div>';
                    echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->
    <?php
    if (count($outros_destaques)) {
        echo '<h1 class="my-4">Outros Destaques</h1>';
        echo '<div class="row">';
        foreach ($outros_destaques as $each_outros_destaques) {
            echo '<div class="col-lg-4 mb-4">';
                    echo '<div class="card h-100">';
                        echo '<h4 class="card-header">', $each_outros_destaques->conte_title, '</h4>';
                            echo '<div class="card-body">';
                                echo '<p>', $each_outros_destaques->conte_text, '</p>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                                echo '<a href="', isset($each_outros_destaques->conte_link) ? $each_outros_destaques->conte_link : '#', '" class="btn btn-primary">Saiba mais</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->
    <hr>
    <!-- /.row -->
</div>