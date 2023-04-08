<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("controller/ControllerFolhaPagamento.php");
include_once server_path("controller/ControllerFuncionarioUser.php");
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
        echo server_url($user_logged->user_fk_authority_pk_id == 3 ? '?page=ControllerFuncionario&option=save&user_fk_authority_pk_id=' . $user_logged->id : '?page=ControllerFuncionario&option=save&user_fk_authority_pk_id=' . 0);
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
                                <label class="text-primary">Nome*:</label><br>
                                <input class="form-control" name="func_nome" type="text" placeholder="Digite o nome completo..." required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">CPF*:</label><br>
                                <input class="form-control" id="cpf" name="func_cpf" type="text" placeholder="Digite o CPF..."  required>
                                <p class="help-block text-danger text-bold" id="resultado_cpf"></p>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">RG*:</label><br>
                                <input class="form-control" name="func_rg" type="text" placeholder="Digite o RG..."  required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">PIS:</label><br>
                                <input class="form-control" name="func_pis" type="text" placeholder="Digite o PIS/PASEP..." >
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Data Nascimento*:</label><br>
                                <input class="form-control" name="func_data_nascimento" type="date" placeholder="Digite a data de nascimento..."  required>
                            </div>
                            <div class="form-group">
                                <?php
                                if ($user_logged->user_fk_authority_pk_id != 3) {
                                    echo '<label class="text-primary">Usuário:</label><br>';
                                    echo '<select id="mySelect" name="id" class="selectpicker form-control" data-live-search="true" required>';
                                    echo '<option></option>';
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
                                <label class="text-primary">Descrição:</label><br>
                                <input class="form-control" name="cont_description" type="text" placeholder="Digite uma descrição..." required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Telefone:</label><br>
                                <input class="form-control" name="cont_phone" id="phone" type="tel" placeholder="Digite o telefone no formato (999)99999-99999...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Celular:</label><br>
                                <input class="form-control" name="cont_cell_phone" id="cell" type="tel" placeholder="Digite o celular no formato (999)99999-99999...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Whatsapp:</label><br>
                                <input class="form-control" name="cont_whatsapp" id="whatsapp" type="tel" placeholder="Digite o whatsapp  no formato (999)99999-99999...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">E-mail:</label><br>
                                <input class="form-control" name="cont_email" type="email" placeholder="Digite o email...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Facebook:</label><br>
                                <input class="form-control" name="cont_facebook" type="text" placeholder="Digite o facebook...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Instagram:</label><br>
                                <input class="form-control" name="cont_instagram" type="text" placeholder="Digite o instagram...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Obeservação:</label><br>
                                <textarea class="form-control" name="cont_text" placeholder="Uma breve descrição sobre a tela..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-endereco-tab">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-primary">Logradouro:</label><br>
                                <input class="form-control" name="logradouro" type="text" placeholder="Digite o logradouro..." required>
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Número:</label><br>
                                <input class="form-control" name="numero" type="text" placeholder="Digite o número/bloco/casa/apt...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Bairro:</label><br>
                                <input class="form-control" name="bairro" type="text" placeholder="Digite o celular...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">CEP:</label><br>
                                <input class="form-control" name="cep" id="cep" type="tel" placeholder="Digite o CEP...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Cidade:</label><br>
                                <input class="form-control" name="cidade_id" type="text" placeholder="Digite a cidade...">
                            </div>
                            <div class="form-group">
                                <label class="text-primary">Estado:</label><br>
                                <select  id="estados" name="estado_id" class="selectpicker form-control" data-live-search="true" required>
                                    <option></option>
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
                                    <button class="btn btn-primary btn-icon-split" disabled id="salvar_dados">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text">Salvar</span>
                                    </button>
                                </div>
                                <div class="input-group">
                                    <a  class="btn btn-danger btn-icon-split" href="<?php
                                    $funcionario = $controllerFuncionarioUser->searchByFkUser($user_logged->id);
                                    echo server_url($funcionario != false ? '?page=ControllerSystem&option=welcome' : '?page=ControllerFuncionario&option=listar');
                                    ?>">
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