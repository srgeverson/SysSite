<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/controller/ControllerFolhaPagamento.php");
include_once server_path("br/com/system/controller/ControllerFuncionarioUser.php");
$controllerFuncionarioUser = new ControllerFuncionarioUser();
global $user_logged;
?>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="
        <?php
        global $user_logged;
        echo server_url($user_logged->user_fk_authority_pk_id == 3 ? '?page=ControllerFuncionario&option=update&user_fk_authority_pk_id=' . $user_logged->id : '?page=ControllerFuncionario&option=update&user_fk_authority_pk_id=' . 0);
        ?>" method="post">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-dados-pessoais-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Dados Pessoais</a>
                    <a class="nav-item nav-link" id="nav-contato-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Contato</a>
                    <a class="nav-item nav-link" id="nav-endereco-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Endereço</a>
                </div>
            </nav>  
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-dados-pessoais-tab">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="func_pk_id" type="hidden" value="<?php echo $funcionario->func_pk_id; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Nome*:</label><br>
                                <input class="form-control" name="func_nome" type="text" placeholder="Digite o nome completo..." value="<?php echo $funcionario->func_nome; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">CPF*:</label><br>
                                <input class="form-control" id="cpf" name="func_cpf" type="text" placeholder="Digite o CPF..."  value="<?php echo $funcionario->func_cpf; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">RG*:</label><br>
                                <input class="form-control" name="func_rg" type="text" placeholder="Digite o RG..."  value="<?php echo $funcionario->func_rg; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">PIS:</label><br>
                                <input class="form-control" name="func_pis" type="text" placeholder="Digite o PIS/PASEP..."  value="<?php echo $funcionario->func_pis; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Data Nascimento*:</label><br>
                                <input class="form-control" name="func_data_nascimento" type="date" placeholder="Digite a data de nascimento..."  value="<?php echo $funcionario->func_data_nascimento; ?>" required>
                            </div>
                            <div class="form-group">
                                <?php
                                if ($user_logged->user_fk_authority_pk_id != 3) {
                                    echo '<label class="text-primary">Usuário:</label><br>';
                                    echo '<select id="mySelect" name="id" class="selectpicker form-control" data-live-search="true" required>';
                                    echo '<option value="', $funcionario->id, '">', $funcionario->login, '</option>';
                                    foreach ($users as $each_user) {
                                        echo '<option value="', $each_user->id, '">', $each_user->login, '</option>';
                                    }
                                    echo '</select>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-contato-tab">
                    <div class="card h-100">   
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="func_fk_contact_pk_id" type="hidden" value="<?php echo $funcionario->func_fk_contact_pk_id; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Descrição:</label><br>
                                <input class="form-control" name="cont_description" type="tel" placeholder="Digite uma descrição..." value="<?php echo $funcionario->cont_description; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Telefone:</label><br>
                                <input class="form-control" name="cont_phone" id="phone" type="tel" placeholder="Digite o telefone..." value="<?php echo $funcionario->cont_phone; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Celular:</label><br>
                                <input class="form-control" name="cont_cell_phone" id="cell" type="tel" placeholder="Digite o celular..." value="<?php echo $funcionario->cont_cell_phone; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Whatsapp:</label><br>
                                <input class="form-control" name="cont_whatsapp" id="whatsapp" type="tel" placeholder="Digite o whatsapp..."value="<?php echo $funcionario->cont_whatsapp; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">E-mail:</label><br>
                                <input class="form-control" name="cont_email" type="email" placeholder="Digite o email..." value="<?php echo $funcionario->cont_email; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Facebook:</label><br>
                                <input class="form-control" name="cont_facebook" type="text" placeholder="Digite o facebook..." value="<?php echo $funcionario->cont_facebook; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Instagram:</label><br>
                                <input class="form-control" name="cont_instagram" type="text" placeholder="Digite o instagram..." value="<?php echo $funcionario->cont_instagram; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Obeservação:</label><br>
                                <textarea class="form-control" name="cont_text" placeholder="Uma breve descrição sobre a tela..." required><?php echo $funcionario->cont_text; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-endereco-tab">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="func_fk_endereco_pk_id" type="hidden" value="<?php echo $funcionario->func_fk_endereco_pk_id; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Logradouro:</label><br>
                                <input class="form-control" name="logradouro" type="text" placeholder="Digite uma descrição..." value="<?php echo $funcionario->logradouro; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Número:</label><br>
                                <input class="form-control" name="numero" id="phone" type="text" placeholder="Digite o número/casa/apt/bloco..." value="<?php echo $funcionario->numero; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Bairro:</label><br>
                                <input class="form-control" name="bairro" id="cell" type="text" placeholder="Digite o barirro..." value="<?php echo $funcionario->bairro; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">CEP:</label><br>
                                <input class="form-control" name="cep" id="cep" type="text" placeholder="Digite o CEP..." value="<?php echo $funcionario->cep; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Cidade:</label><br>
                                <input class="form-control" name="cidade_id" id="whatsapp" type="text" placeholder="Digite o cidade..."value="<?php echo $funcionario->cidade_id; ?>">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Estado:</label><br>
                                <select name="estado_id" class="form-control" required>
                                    <option value="<?php echo $estadoUFAtual->id; ?>"><?php echo $estadoUFAtual->nome; ?></option>
                                    <?php
                                    foreach ($estados as $each_estado) {
                                        echo '<option value="', $each_estado->id, '">', $each_estado->nome, '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>   
                        <div class="card-footer">
                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                                <div class="input-group">
                                    <button class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Alterar</span>
                                    </button>
                                </div>
                                <div class="input-group">
                                    <a  class="btn btn-danger btn-icon-split" href="<?php
                                    echo server_url($user_logged->user_fk_authority_pk_id == 3 ? '?page=ControllerSystem&option=welcome' : '?page=ControllerFuncionario&option=listar');
                                    ?>" type="submit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-window-close"></i>
                                        </span>
                                        <span class="text">Cancelar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>
<br>
