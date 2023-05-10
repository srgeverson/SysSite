<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
$(document).ready(function () {
    
    $("input[name='adicionar_usuario']").prop('disabled', true);
    
});
function enviarEmail(e) {
    // e.preventDefault();
    try {
        Email.send({
            Host : "smtp.zoho.com",
            Username : "paulistensetecnologia@zohomail.com",
            Password : "@G182534",
            To : "paulistensetecnologia@zohomail.com",
            From : "paulistensetecnologia@zohomail.com",
            Subject : "This is the subject",
            Body : "And this is the body"
        }).then(
            message => alert(message)
        );
        // Email.send(
        //     "paulistensetecnologia@zohomail.com",
        //     "paulistensetecnologia@zohomail.com",
        //     "This is a subject",
        //     "this is the body",
        //     "smtp.zoho.com",
        //     "paulistensetecnologia@zohomail.com",
        //     "@G182534"
        //     );
            
        alert('ops e-mail enviado...');
        } catch (error) {
        alert('ops e-mail com erro...');
            
        }
}
</script>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerSystem&option=testarConfiguracaoEmail'); ?>" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Teste de E-mail</h4>
                <div class="card-body">
                    <?php
                        foreach ($parameters as $parameter) {
                            echo '<div class="form-group">';
                            echo '<label class="text-primary">', $parameter->para_key, ':</label><br>';
                            echo '<input class="form-control" name="', $parameter->para_key, '" type="text" value="', $parameter->para_value, '">';
                            echo '</div>';
                        }
                    ?>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Teste</span>
                            </button>
                        </div>
                        <!-- <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div> -->
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerGrupo&option=listar'); ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-window-close"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>