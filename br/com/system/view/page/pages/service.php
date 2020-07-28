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
    <h1 class="mt-4 mb-3">Nossos
        <small>
            <?php
            $parameter = new ControllerParameter();
            echo $parameter->getProperty('servicos_titulo');
            ?></small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo server_url('?page=ControllerPage&option=home'); ?>">Página Inicial</a>
        </li>
        <li class="breadcrumb-item active">Serviços</li>
    </ol>

    <!-- Image Header -->
    <?php
    if (count($destaques_servicos)) {
        foreach ($destaques_servicos as $each_destaques_servicos) {
            echo '<img class="img-fluid rounded mb-4" src="', isset($each_destaques_servicos->conte_image) ? server_url('br/com/system/uploads/content/' . $each_destaques_servicos->conte_image) : server_url('br/com/system/assets/img/1200x300.png'), '" alt = "', $each_destaques_servicos->conte_title, '" alt="', $each_destaques_servicos->conte_title, '">';
        }
    }
    ?>

    <!-- Marketing Icons Section -->
        <?php
    if (count($nossos_servicos)) {
        echo '<h1 class="my-4">Serviços</h1>';
        echo '<div class="row">';
            foreach ($nossos_servicos as $each_nossos_servicos) {
                echo '<div class="col-lg-4 mb-4">';
                    echo '<div class="card h-100">';
                        echo '<h4 class="card-header">', $each_nossos_servicos->conte_title, '</h4>';
                            echo '<div class="card-body">';
                                 echo '<p>', $each_nossos_servicos->conte_text, '</p>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                                echo '<a href="', isset($each_nossos_servicos->conte_link) ? $each_nossos_servicos->conte_link : '#', '" class="btn btn-primary">Saiba mais</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
        }
        echo '</div>';
    }
    ?>
    <!-- /.row -->

</div>
<!-- /.container -->