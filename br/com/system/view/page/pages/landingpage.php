<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <?php
            include_once '../br/com/system/assets/php/conf.php';
            include_once '../br/com/system/controller/HelperController.php';
            include_once '../br/com/system/controller/ControllerParameter.php';
            include_once '../br/com/system/controller/ControllerPage.php';
            $parameter = new ControllerParameter();
            $icone = $parameter->getProperty('icone_site');
            echo '<meta name="author" content="', $parameter->getProperty('autor_site'),'">';
            echo '<meta name="description" content="', $parameter->getProperty('nome_fantazia'), '">';
            echo '<title>';
            echo $parameter->getProperty('titulo_site');
            echo '</title>';
            //Icone da página
            echo '<link rel="icon" href="', $icone != 'Vazio/Desabilitado' ? server_url('br/com/system/uploads/parameter/') . $icone : '', '">';
            ?>

        <link href=" <?php echo server_url('br/com/system/assets/css/') . 'styles.css'; ?>" rel="stylesheet" />
        <!-- Custom fonts for this template-->
        <link href="<?php echo server_url('br/com/system/assets/vendor/fontawesome-free-6.4.0/css/') . 'all.min.css'; ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'fonts.css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i'; ?>" rel="stylesheet">

        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $parameter->getProperty('google_analytics'); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '<?php echo $parameter->getProperty('google_analytics'); ?>');
        </script>
    </head>
    <body>
        <!-- Background Video-->
        <!-- <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"> -->
            <!-- <source src="<?php //echo server_url('br/com/system/assets/video/') . 'bg.mp4'; ?>" type="video/mp4" /> -->
            <img class="bg-img" src="<?php echo server_url('br/com/system/assets/img/') . 'bg-mobile-fallback.jpg'; ?>" alt="imgage" />
        <!-- </video> -->
        <!-- Masthead-->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-5 px-lg-0">
                    <h1 class="fst-italic lh-1 mb-4">Aguiar Silva Advogados</h1>
                    <p class="mb-5">Com um compromisso forte com a ética, transparência e excelência em nosso trabalho, oferecemos serviços em diversas áreas do Direito, incluindo imobiliaria, previdenciário, cível e trabalhista. </p>
                    <div class="row input-group-newsletter">
                        <div class="col-auto"><a class="btn btn-primary" href="<?php echo server_url('/');?>" target="_blank">Ir para nosso site</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Social Icons-->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark btn-lg m-3" href="#!"><i class="fab fa-twitter"></i>twitter</a>
                <a class="btn btn-dark btn-lg m-3" href="#!"><i class="fab fa-facebook-f"></i>facebook</a>
                <a class="btn btn-dark btn-lg m-3" href="#!"><i class="fab fa-instagram"></i>instagram</a>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery/') . 'jquery.min.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery/') . 'jquery.mask.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/js/') . 'bootstrap.bundle.min.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'jqBootstrapValidation.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'sb-forms-0.4.1.js'; ?>"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery-easing/') . 'jquery.easing.min.js'; ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'jquery.dataTables.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'dataTables.bootstrap4.min.js'; ?>"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/select/js/') . 'bootstrap-select.js'; ?>"></script>

        <!-- Datepicker bootstrap -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/datepicker/js/') . 'bootstrap-datepicker.js'; ?>"></script>

        <!-- Minhas funções-->
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'functions.js'; ?>"></script>
    </body>
</html>