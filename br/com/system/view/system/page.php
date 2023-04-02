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

        <!-- Custom fonts for this template-->
        <link href="<?php echo server_url('br/com/system/assets/vendor/fontawesome-free-6.4.0/css/') . 'all.min.css'; ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'fonts.css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i'; ?>" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'sb-admin-2.css'; ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo server_url('br/com/system/assets/css/') . 'modern-business.css'; ?>" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link href="<?php echo server_url('br/com/system/assets/vendor/bootstrap/select/css/') . 'bootstrap-select.css'; ?>" rel="stylesheet" type="text/css">

        <!-- datapiker CSS -->
        <link href="<?php echo server_url('br/com/system/assets/vendor/bootstrap/datepicker/css/') . 'datepicker.css'; ?>" rel="stylesheet" type="text/css">

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
    <body id="page-top">
        <!-- Menu -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <?php
                $controllerPage = new ControllerPage();
                $pages_enableds = $controllerPage->listEnableds();

                foreach ($pages_enableds as $each_page) {
                    if ($each_page->page_name === 'home') {
                        echo '<a  class="navbar-brand" href="', server_url("?page=ControllerPage&option=" . $each_page->page_name), '">';
                        $parameter = new ControllerParameter();
                        echo $parameter->getProperty('nome_fantazia');
                        echo '</a>';
                    }
                }
                ?>
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
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
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery/') . 'jquery.mask.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/js/') . 'bootstrap.bundle.min.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'jqBootstrapValidation.js'; ?>"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'sb-admin-2.js'; ?>"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo server_url('br/com/system/assets/vendor/jquery-easing/') . 'jquery.easing.min.js'; ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'jquery.dataTables.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/vendor/datatables/') . 'dataTables.bootstrap4.min.js'; ?>"></script>

        <!-- Minhas funções-->
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'functions.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'info.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'masks.js'; ?>"></script>
        <script src="<?php echo server_url('br/com/system/assets/js/') . 'validator.js'; ?>"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/select/js/') . 'bootstrap-select.js'; ?>"></script>

        <!-- Datepicker bootstrap -->
        <script src="<?php echo server_url('br/com/system/assets/vendor/bootstrap/datepicker/js/') . 'bootstrap-datepicker.js'; ?>"></script>
        <script>
            function uploadImagem(){
                $('#envio-teste').submit(function(e){
                    e.preventDefault();
                    //Receber os dados
                    $form = $(this);				
                    var formdata = new FormData($form[0]);
				
                    //Criar a conexao com o servidor
                    var request = new XMLHttpRequest();
				
                    //Progresso do Upload
                    request.upload.addEventListener('progress', function (e) {
                        var percent = Math.round(e.loaded / e.total * 100);
                        $form.find('.progress-bar').width(percent + '%').html(percent + '%');
                    });
				
                    //Upload completo limpar a barra de progresso
                    request.addEventListener('load', function(e){
                        $form.find('.progress-bar').addClass('progress-bar-success').html('upload completo...');
                        //Atualizar a página após o upload completo
                        setTimeout("window.open(self.location, '_self');", 1000);
                    });
				
                    //Arquivo responsável em fazer o upload da imagem
                    request.open('post', '?page=ControllerTest&option=uploadImagem');
                    request.send(formdata);
                });
            }
            $('#cont_phone').on('click', function (e) {
                e.preventDefault();
                navigator.clipboard.writeText($('#chave_pix').val());
                $('#liveToast').toast('show');
            });
        </script>
    </body>
</html>