<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("controller/ControllerUser.php");
include_once server_path("controller/ControllerSystem.php");
include_once server_path("dao/DAOCidade.php");
include_once server_path("dao/DAOContato.php");
include_once server_path("dao/DAOEndereco.php");
include_once server_path("dao/DAOFuncionario.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("dao/DAOUsuarioGrupo.php");
include_once server_path("model/ModelContato.php");
include_once server_path("model/ModelEndereco.php");
include_once server_path("model/ModelEstado.php");
include_once server_path("model/ModelFuncionario.php");
include_once server_path("model/ModelFuncionarioUser.php");

class ControllerFuncionario {

    private $daoCidade;
    private $daoContato;
    private $daoEndereco;
    private $daoFuncionario;
    private $daoUser;
    private $daoUsuarioGrupo;
    private $info;
    private $pemissoes;
    private $usuarioAutenticado;
    private $mensagens;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoCidade = new DAOCidade();
        $this->daoContato = new DAOContato();
        $this->daoEndereco = new DAOEndereco();
        $this->daoFuncionario = new DAOFuncionario();
        $this->daoUser = new DAOUser();
        $this->daoUsuarioGrupo = new DAOUsuarioGrupo();
        $this->pemissoes = $pemissoes;
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
        $this->mensagens = array();
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=funcionario_uninformed';
                $this->listar();
            } else {
                $funcionario = $this->daoFuncionario->selectObjectById($id);
                    try {
                        $this->daoFuncionario->delete($funcionario->id);
                        array_push($this->mensagens, "funcionario_deleted");
                        $this->info = "success=funcionario_deleted";
                        try {
                            $this->daoContato->delete($funcionario->contato_id);
                            array_push($this->mensagens, "contato_deleted");
                            try {
                                $this->daoEndereco->delete($funcionario->endereco_id);
                                array_push($this->mensagens, "endereco_deleted");
                                $this->listar();
                            } catch (Exception $erro) {
                                $this->info = "error=Endereço: " . $erro->getMessage();
                                $this->listar();
                            }
                        } catch (Exception $erro) {
                            $this->info = "error=Contato: " . $erro->getMessage();
                            $this->listar();
                        }
                    } catch (Exception $erro) {
                        $this->info = "error=Funcionário: " . $erro->getMessage();
                        $this->listar();
                    }
            }
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    $existente = $this->daoFuncionario->selectObjectById($id);
                    if ($existente === null)
                        $this->info = 'warning=funcionario_not_exists';
                    else {
                        $funcionario = new ModelFuncionario();
                        $funcionario->id = $id;
                        $funcionario->status = $status;
                        $funcionario->usuario_id = $this->usuarioAutenticado->id;

                        $this->daoFuncionario->updateStatus($funcionario);
                        $this->info = 'success=funcionario_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=funcionario_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $funcionario = new ModelFuncionario();
            $funcionario->id = strip_tags($_GET['id']);
            if (!$funcionario->id) {
                $this->info = 'warning=funcionario_uninformed';
                $this->listar();
            }
            try {
                $funcionario = $this->daoFuncionario->selectObjectById($funcionario->id);
                $funcionario->cidades = $this->daoCidade->selectObjectsEnabledWithEstados();
                $funcionario->usuarios = $this->daoUser->selectObjectsNotExistsFuncionarioExceptCPF($funcionario->cpf);
                $temPermissao = $this->daoUsuarioGrupo->selectAllowedPermission($this->usuarioAutenticado->id);
                $funcionario->administrador = $temPermissao->temPermissao;
                $funcionario->contato = $this->daoContato->selectObjectById($funcionario->contato_id);
                $funcionario->endereco = $this->daoEndereco->selectObjectById($funcionario->endereco_id);
                if (!isset($funcionario)) {
                    $this->info = 'warning=funcionario_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($funcionario == false) {
                $this->info = "warning=funcionario_not_found";
            }
            include_once server_path('view/funcionario/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoFuncionario->selectObjectById($id)) === null) {
                        $this->info = 'warning=funcionario_not_exists';
                    } else {
                        $funcionario = new ModelFuncionario();
                        $funcionario->id = $id;
                        $funcionario->status = $status;
                        $funcionario->usuario_id = $this->usuarioAutenticado->id;

                        $this->daoFuncionario->updateStatus($funcionario);
                        $this->info = 'success=funcionario_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=funcionario_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $funcionario = new ModelFuncionario();
            $funcionario->nome = strip_tags($_POST['nome']);
            $funcionario->cpf = strip_tags($_POST['cpf']);
            $funcionario->rg = strip_tags($_POST['rg']);
            $funcionario->todos = strip_tags($_POST['todos']);
            $funcionario = HelperController::validar_permissoes($this->pemissoes,  $funcionario);
            if ($funcionario->nome || $funcionario->cpf || $funcionario->rg || $funcionario->todos) {
                try {
                    $funcionarios = $this->daoFuncionario->selectObjectsByContainsObject($funcionario);
                    $permissao = $this->usuarioAutenticado->user_fk_permissao_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info, $this->mensagens);
            }
            include_once server_path('view/funcionario/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $funcionario = new ModelFuncionario();
            $funcionario->cidades = $this->daoCidade->selectObjectsEnabledWithEstados();
            $funcionario->usuarios = $this->daoUser->selectObjectsNotExistsFuncionario();
            $temPermissao = $this->daoUsuarioGrupo->selectAllowedPermission($this->usuarioAutenticado->id);
            $funcionario->administrador = $temPermissao->temPermissao;
            include_once server_path('view/funcionario/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            //Contato
            $contato = new ModelContato();
            $contato->descricao = strip_tags($_POST['descricao']);
            $contato->telefone = strip_tags($_POST['telefone']);
            $contato->celular = strip_tags($_POST['celular']);
            $contato->whatsapp = strip_tags($_POST['whatsapp']);
            $contato->email = strip_tags($_POST['email']);
            $contato->facebook = strip_tags($_POST['facebook']);
            $contato->instagram = strip_tags($_POST['instagram']);
            $contato->observacao = strip_tags($_POST['observacao']);
            $contato->status = true;
            $contato->usuario_id = $this->usuarioAutenticado->id;

            //Endereço
            $endereco = new ModelEndereco();
            $endereco->logradouro = strip_tags($_POST['logradouro']);
            $endereco->numero = strip_tags($_POST['numero']);
            $endereco->bairro = strip_tags($_POST['bairro']);
            $endereco->cep = strip_tags($_POST['cep']);
            $endereco->cidade_id = strip_tags($_POST['cidade_id']);
            $endereco->usuario_id = $this->usuarioAutenticado->id;
            $endereco->status = true;

            //DAOs
            $daoContato = new DAOContato();
            $daoEndereco = new DAOEndereco();

            //Funcionário
            try {
                $contato_id = $daoContato->saveAndReturnPkId($contato);
            } catch (Exception $erro) {
                // print_r($erro);
                $this->info = "error=Contato: " . $erro->getMessage();
            }
            try {
                $endereco_id = $daoEndereco->saveAndReturnPkId($endereco);
            } catch (Exception $erro) {
                // print_r($erro);
                $this->info = "error=Endereço: " . $erro->getMessage();
            }
            $funcionario = new ModelFuncionario();
            $funcionario->nome = strip_tags($_POST['nome']);
            $funcionario->cpf = strip_tags($_POST['cpf']);
            $funcionario->rg = strip_tags($_POST['rg']);
            $funcionario->pis = strip_tags($_POST['pis']);
            $funcionario->data_nascimento = strip_tags($_POST['data_nascimento']);
            $funcionario->contato_id = $contato_id;
            $funcionario->endereco_id = $endereco_id;
            $funcionario->usuario_id = $this->usuarioAutenticado->id;
            $funcionario->usuario_cpf = strip_tags($_POST['usuario_cpf']);
            $funcionario->status = true;

            $usuario = new ModelUser();
            $usuario->login = $contato->email;
            $usuario->nome = $funcionario->nome;
            $usuario->cpf = $funcionario->cpf;
            $usuario->status = $funcionario->status;

            $emailExixtente = $this->daoUser->selectObjectByName($usuario->login);
            if(!$funcionario->usuario_cpf){
                try {
                    $cpfExixtente = $this->daoUser->selectObjectByCPF($usuario->cpf); 
                    if(!empty($cpfExixtente) || $emailExixtente){
                        $this->info = "warning=user_already_registered";
                        HelperController::valid_messages($this->info);
                        return $this->novo();
                    } else 
                        $usuario->id = $this->daoUser->saveAndReturnId($usuario);
                } catch (Exception $erro) {
                    // print_r($erro);
                    $this->info = "error=Usuário: " . $erro->getMessage();
                    $this->listar();
                }
            }
            $grupo = new ModelGrupo();
            $grupo->id = 4;//Funcionário
            $grupo->status = $user->status;
            $grupo->usuario_id = $this->usuarioAutenticado->id;
            $usuariosDoGrupo = array();
            //Grupo de permissão para usuário
            $usuarioGrupo = new ModelUsuarioGrupo();
            $usuarioGrupo->grupo_id = $grupo->id;
            $usuarioGrupo->usuario_id = $usuario->id ? $usuario->id : $emailExixtente->id;
            $usuarioGrupo->usuario = $this->usuarioAutenticado->id;
            $usuarioGrupo->status = $usuario->status;
            $grupoVinculadoAoUsuario = $this->daoUsuarioGrupo->selectObjectsByContainsFkUsuarioAndFkGrupo($usuarioGrupo->usuario_id,  $grupo->id);
            if(!$grupoVinculadoAoUsuario){
                array_push($usuariosDoGrupo,$usuarioGrupo);
                $this->daoUsuarioGrupo->saveBatch($usuariosDoGrupo);
            }

            try {
               $id = $this->daoFuncionario->saveAndReturnPkId($funcionario);
                $this->listar();
            } catch (Exception $erro) {
                // print_r($erro);
                $this->info = "error=" . $erro->getMessage();
                $this->listar();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            //Funcionário
            $funcionario = new ModelFuncionario();
            $funcionario->id = strip_tags($_POST['id']);
            $funcionario->nome = strip_tags($_POST['nome']);
            $funcionario->cpf = strip_tags($_POST['cpf']);
            $funcionario->rg = strip_tags($_POST['rg']);
            $funcionario->pis = strip_tags($_POST['pis']);
            $funcionario->data_nascimento = strip_tags($_POST['data_nascimento']);
            $funcionario->contato_id = strip_tags($_POST['contato_id']);
            $funcionario->endereco_id = strip_tags($_POST['endereco_id']);
            $funcionario->usuario_id = $this->usuarioAutenticado->id;
            $funcionario->status = true;
            $temPermissao = $this->daoUsuarioGrupo->selectAllowedPermission($this->usuarioAutenticado->id);
            $funcionario->administrador = $temPermissao->temPermissao;

            if (!$funcionario->id)
                $this->info = 'warning=funcionario_uninformed';
            else {
                //Contato
                $contato = new ModelContato();
                $contato->id = $funcionario->contato_id;
                $contato->descricao = strip_tags($_POST['descricao']);
                $contato->telefone = strip_tags($_POST['telefone']);
                $contato->celular = strip_tags($_POST['celular']);
                $contato->whatsapp = strip_tags($_POST['whatsapp']);
                $contato->email = strip_tags($_POST['email']);
                $contato->facebook = strip_tags($_POST['facebook']);
                $contato->instagram = strip_tags($_POST['instagram']);
                $contato->observacao = strip_tags($_POST['observacao']);
                $contato->status = $funcionario->status;
                $contato->usuario_id = $funcionario->usuario_id;

                //Endereço
                $endereco = new ModelEndereco();
                $endereco->id = $funcionario->endereco_id;
                $endereco->logradouro = strip_tags($_POST['logradouro']);
                $endereco->numero = strip_tags($_POST['numero']);
                $endereco->bairro = strip_tags($_POST['bairro']);
                $endereco->cep = strip_tags($_POST['cep']);
                $endereco->cidade_id = strip_tags($_POST['cidade_id']);
                $endereco->estado_id = strip_tags($_POST['estado_id']);
                $endereco->status = $funcionario->status;
                $endereco->usuario_id =  $funcionario->usuario_id;
                //Tratando exceção do contato
                try {
                    $this->daoContato->update($contato);
                    //Tratando exceção do endereço
                    try {
                        $this->daoEndereco->update($endereco);
                        //Tratando exceção do funcionário
                        try {
                            $this->daoFuncionario->update($funcionario);
                            if ($funcionario->administrador) 
                                $this->info = "success=funcionario_updated";
                        } catch (Exception $erro) {
                            if ($user_fk_permissao_pk_id == 0) 
                                $this->info = "error=" . $erro->getMessage();
                            else 
                                $this->info = "error=" . $erro->getMessage();
                        }
                    } catch (Exception $erro) {
                        if ($user_fk_permissao_pk_id == 0)
                            $this->info = "error=Endereço: " . $erro->getMessage();
                        else
                            $this->info = "error=" . $erro->getMessage();
                    }
                } catch (Exception $erro) {
                    if ($funcionario->administrador) 
                        $this->info = "error=Contato: " . $erro->getMessage();
                     else 
                        $this->info = "error=" . $erro->getMessage();
                } finally {
                    if ($funcionario->administrador) 
                        return $this->listar();
                    else {
                        $controlerSystem = new ControllerSystem();
                        return $controlerSystem->welcome($this->info);
                    }
                }
            }
        }
    }

}
