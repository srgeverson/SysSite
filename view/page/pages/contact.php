<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    function teste(){
        $.ajax({
                type: "GET",
                url: "?page=ControllerContato&option=teste",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Content-type", "application/json; charset=utf-8");
                },
                contentType: "application/json; charset=utf-8",
                dataType: "html",
                success: function (data, status) {
                   console.log(data);
                },
                error: function (xhr, msg, e) {
                   console.log(xhr);
                   console.log(msg);
                   console.log(e);
                    
                    alert("Não foi possível validar o usuário");
                    //javascript: window.history.go(-1);
                }
            });
        // $('.preco').focusout(function () {
            // var dados = $(this).closest('form').serialize();
            // $.ajax({
            //     url: '?page=ControllerContato&option=teste',
            //     data: {
            //         email:$('[name="email"]')
            //     },
            //     dataType: "html",
            //     type: "POST",
            //     success: function (data) {
                    
            //         alert('Ops');
            //     },
            //     error:function(a,b,c){
            //         alert('erro');
            //         console.log(a);
            //         console.log(b);
            //         console.log(c);

            //     }
            // });
//  });
    }
</script>
<!-- Page Content -->
<div class="container">
<!-- <button onclick="teste()" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-paper-plane"></i></span><span class="text">Enviar</span></button> -->
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Nosso
        <small>
            <?php
            $parameter = new ControllerParameter();
            echo $parameter->getProperty('contato_titulo');
            ?>
        </small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo server_url('?page=ControllerPage&option=home'); ?>">Página Inicial</a>
        </li>
        <li class="breadcrumb-item active">Contato</li>
    </ol>

    <!-- Content Row -->
    <div class="row">
    <?php
    if (count($our_contatos)) {
        foreach ($our_contatos as $each_contato) {
//            if (isset($each_contato->conte_link)) {
//                echo '<div class="col-lg-8 mb-4">';
//                echo '<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="', $each_contato->conte_link, '"></iframe>';
//                echo '</div>';
//            }

            echo '<div class="col-lg-8 mb-4">';
            echo '<h3>Contate-nos através de um email</h3>';
            echo '<form action="', server_url('?page=ControllerContato&option=submit'), '" method="post">';
            echo '<div class="control-group form-group">';
            echo '<div class="controls">';
            echo '<label>Nome Completo:</label>';
            echo '<input class="form-control" name="descricao" placeholder="Preencha com seu nome." type="text" required>';
            echo '</div>';
            echo '<div class="controls">';
            echo '<label>Celular:</label>';
            echo '<input class="form-control"  name="celular" placeholder="Preencha com seu telefone/celular." type="tel"  required>';
            echo '</div>';
            echo '<div class="controls">';
            echo '<label>Email:</label>';
            echo '<input class="form-control"  name="email" placeholder="Preencha com seu email." type="email" required>';
            echo '</div>';
            echo '<div class="control-group form-group">';
            echo '<div class="controls">';
            echo '<label>Messagem:</label>';
            echo '<textarea class="form-control" cols="100" maxlength="999" name="observacao" placeholder="Escreva sua menssagem aqui..." rows="10"  style="resize:none" required></textarea>';
            echo '</div>';
            echo '</div>';
            echo ' <button class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-paper-plane"></i></span><span class="text">Enviar</span></button>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
            echo '<div class="col-lg-4 mb-4">';
            echo '<h3>', $each_contato->conte_title, '</h3>';
            echo '<p>', $each_contato->conte_text, '</p>';
            echo '<p>';
            echo 'Endereço: ', $endereco->logradouro . ' N° ', $endereco->logradouro, ',<br>';
            echo 'Bairro: ', $endereco->bairro . ', CEP: ', $endereco->cep, '<br>';
            echo 'UF: ', $endereco->sigla, '<br>';
            echo '</p>';
            echo '<p>';
            echo '<abbr title="Nosso telefone">Telefone</abbr>: ', $contato->telefene, '<br>';
            echo '<abbr title="Nosso Celular">Celular</abbr>: ', $contato->celular, '<br>';
            echo '<abbr title="Nosso E-mail">E-mail</abbr>: ', $contato->email, '<br>';
            echo '</p>';
            echo '<p>';
            echo '<a href="https://www.instagram.com/', $contato->facebook, '" class="btn btn-primary btn-circle btn-lg" style="margin:5px">';
            echo '<i class="fab fa-facebook-f"></i>';
            echo '</a>';
            echo '<a href="https://www.instagram.com/', $contato->instagram, '/" class="btn btn-primary btn-circle btn-lg" style="margin:5px">';
            echo '<i class="fab fa-instagram"></i>';
            echo '</a>';
            echo '<a href="https://web.whatsapp.com/send?phone=', $contato->whatsapp, '&text=" class="btn btn-primary btn-circle btn-lg" style="margin:5px">';
            echo '<i class="fab fa-whatsapp"></i>';
            echo '</a>';
            echo '<a href="mailto:', $contato->email, '" class="btn btn-primary btn-circle btn-lg" style="margin:5px">';
            echo '<i class="fas fa-envelope"></i>';
            echo '</a>';
            echo '</p>';
            echo '</div>';
        }
    }
    ?>
    </div>
    <!-- Contact Form -->
</div>
<!-- /.container -->
