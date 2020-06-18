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
        <meta name="author" content="Geverson Souza">
        <?php
        $parameter = new ControllerParameter();
        echo '<meta name="description" content="', $parameter->getProperty('titulo_site'), '">';
        echo '<title title="', $parameter->getProperty('titulo_site'), '">';
        echo $parameter->getProperty('titulo_site');
        echo '</title>';
        //Icone da página
        echo '<link rel = "icon" href = "', server_url('br/com/system/uploads/parameter/') . $parameter->getProperty('icone_site'), '">';
        ?>
        <!-- Custom fonts for this template-->
        <link href="<?php echo server_url('br/com/system/assets/vendor/fontawesome-free/css/') . 'all.min.css'; ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'fonts.css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i'; ?>" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'sb-admin-2.css'; ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'modern-business.css'; ?>" rel="stylesheet">
    </head>
    <body id="page-top">
        <!-- Menu -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <?php navbar(); ?>
            </div>
        </nav>
        <!-- Centro da página -->
        <?php main(); ?>
        <!-- Rodapé -->
        <footer class="py-5 bg-dark">
            <?php footer(); ?>
        </footer>
        <!-- Menssagens a ser exibida nas quequisições Ajax-->
        <?php
        include_once server_path("br/com/system/view/system/info.php");
        ?>
        <!-- Botão para ir ao topo da página-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery/') . 'jquery.min.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/js/') . 'bootstrap.bundle.min.js'; ?>"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'sb-admin-2.js'; ?>"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery-easing/') . 'jquery.easing.min.js'; ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'jquery.dataTables.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'dataTables.bootstrap4.min.js'; ?>"></script>

        <!-- Minhas funções-->
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'validator.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'functions.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'info.js'; ?>"></script>
    </body>
</html>