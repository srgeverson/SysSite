<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container">
    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
            <strong class="mr-auto">Informativo</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="toast-body">
            Chave pix copiada.
            </div>
        </div>
    </div>
    <?php
    if (count($our_contacts)) {
        foreach ($our_contacts as $each_contact) {
            echo '<div class="row justify-content-center">';
            echo '<input type="hidden" id="chave_pix" value="', $contact->cont_phone, '" />';
            echo '<img class="img-profile rounded-circle" style="width: 20rem; height: 10rem; padding: 10px;" src="', server_url('br/com/system/assets/img/logo.png'), '">';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#22bf9b;border:0;" href="#" data-toggle="modal" data-target="#qrCodePix"><i class="fab fa-pix"></i> PIX</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a id="cont_phone" class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#22bf9b;border:0;" href="#"><i class="fas fa-copy"></i> Copiar Chave PIX</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#2dd54d;border:0;" href="https://web.whatsapp.com/send?phone=', $contact->cont_whatsapp, '&text=', $contact->cont_whatsapp_msg, '"><i class="fab fa-whatsapp"></i> Whatsapp</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#ff0092;border:0;" href="https://www.instagram.com/', $contact->cont_instagram ,'"><i class="fab fa-instagram"></i> Instagram</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#1d9bf0;border:0;" href="https://twitter.com/', $contact->cont_twitter ,'"><i class="fab fa-twitter"></i> Twitter</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#1877f2;border:0;" href="https://www.facebook.com/', $contact->cont_facebook ,'"><i class="fab fa-facebook-f"></i> Facebook</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#1acffc;border:0;" href="mailto:', $contact->cont_email, '"><i class="fas fa-envelope"></i> E-mail</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#3c6cb6;border:0;" href="tel:+55', $contact->cont_phone, '"><i class="fas fa-phone"></i> Telefone</a>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
            echo '<a class="btn btn-primary btn-lg m-3" style="border-radius:100rem;background-color:#ea4335;border:0;" href="', isset($endereco->ende_link_maps) ? $endereco->ende_link_maps : '#', '"><i class="fas fa-location-dot"></i> Nossa Localização</a>';
            echo '</div>';
            echo '</div>';
            break;
        }
    }
    ?>
</div>
<div class="modal fade" id="qrCodePix" tabindex="-1" aria-labelledby="qrCodePixLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodePixLabel">Leia o QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top" src="<?php echo server_url('br/com/system/assets/img/qr_code.png');?>">
                </div>
            </div>
        </div>
    </div>
</div>
