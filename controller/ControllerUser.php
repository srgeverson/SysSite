<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOAuthority.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("controller/ControllerContact.php");
include_once server_path("model/ModelUser.php");
include_once server_path("model/ModelContact.php");
include_once server_path("dao/DAOParameter.php");
include_once server_path("model/ModelParameter.php");
//Para versões do PHP 5.x
//include_once server_path("assets/php/random_compat/lib/random.php");

class ControllerUser {

    private $info;
    private $controllerSystem;
    private $daoUser;
    private $usuarioAutenticado;
    private $daoParameter;

    function __construct() {
        $this->info = 'default=default';
        $this->controllerSystem = new ControllerSystem();
        $this->daoUser = new DAOUser();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
        $this->daoParameter = new DAOParameter();
    }

    public function authenticate() {
        include_once server_path('view/user/authenticate.php');
    }

    public function createAccount() {
        include_once server_path('view/user/create_account.php');
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=user_uninformed';
            } else {
                $user = $this->daoUser->selectObjectById($id);
                if ($user->imagem != null || $user->imagem != '') {
                    unlink(server_path('uploads/user/' . $user->imagem));
                }
                try {
                    $this->daoUser->delete($id);
                    $this->info = "success=user_deleted";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    if (($this->daoUser->selectObjectById($id)) === null) {
                        $this->info = "warning=user_not_exists";
                    } else {
                        $user = new ModelUser();
                        $user->id = $id;
                        $user->status = $status;
                        global $user_logged;
                        $user->usuario_id = $user_logged->id;

                        $this->daoUser->updateStatus($user);
                        $this->info = "success=user_disabled";
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = "warning=user_uninformed";
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=user_uninformed';
                $this->listar();
            }
            try {
                $user = $this->daoUser->selectObjectById($id);
                //$daoAuthority = new DAOAuthority();
                //$authorities = $daoAuthority->selectObjectsEnabled();
                if (!isset($user)) {
                    $this->info = 'warning=user_not_exists';
                    $this->listar();
                    if($this->daoParameter->verificaConfiguracaoDeEmail())
                        $user->enviar_senha_por_email = true;
                    else{
                        HelperController::valid_messages("warning=server_email_undefined");
                        $user->enviar_senha_por_email = false;
                    }
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($user == false) {
                $this->info = "warning=user_not_found";
            }
            include_once server_path('view/user/edit.php');
        }
    }

    public function editProfile() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->controllerSystem->welcome('warning=user_uninformed');
            }
            try {
                $user = $this->daoUser->selectObjectById($id);

                if ($user == false) {
                    $this->controllerSystem->welcome('error=user_not_found');
                } else {
                    include_once server_path('view/user/profile.php');
                }
            } catch (Exception $erro) {
                $this->controllerSystem->welcome('error=' . $erro->getMessage());
            }
        }
    }

    public function editUser() {
        if (HelperController::authotity()) {
            $id = strip_tags($_POST['id']);
            if (!isset($id)) {
                $this->controllerSystem->welcome('warning=user_uninformed');
            }
            $nome = strip_tags($_POST['nome']);
            $senha = password_hash(strip_tags($_POST['senha']), PASSWORD_BCRYPT);

            $imagem = $_FILES['imagem']['name'];
            $extensao = pathinfo($imagem, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            $uploaddir = server_path('uploads/user/');
            $novo_nome = uniqid(time()) . '.' . $extensao;
            $uploadfile = $uploaddir . $novo_nome;


            $userUpdated = $this->daoUser->selectObjectById($id);
            if ($userUpdated == false) {
                $this->controllerSystem->welcome('warning=user_not_exists');
            } else {
                if ($imagem !== "") {
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile)) {
                            if ($userUpdated->imagem !== "" || $userUpdated->imagem !== null &&  $userUpdated->imagem !== "not_found.png") {
                                unlink(server_path('uploads/user/' . $userUpdated->imagem));
                            }
                        }
                    } else {
                        echo '<script>alert("Formato de imagem não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                } else {
                    $novo_nome = $userUpdated->imagem;
                }
                try {
                    $user = new ModelUser();
                    $user->id = $id;
                    $user->nome = $nome;
                    $user->senha = $senha;
                    $user->imagem = $novo_nome;
                    global $user_logged;
                    $user->usuario_id = $user_logged->id;
                    $this->daoUser->update_user($user);
                    //$user_logged = $user;
                    //$_SESSION['usuario'] = $user_logged;
                    $this->controllerSystem->welcome('success=user_profile_edit');
                } catch (Exception $erro) {
                    $this->controllerSystem->welcome('error=' . $erro->getMessage());
                }
            }
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoUser->selectObjectById($id)) === null) {
                        $this->info = 'warning=user_not_exists';
                    } else {
                        $user = new ModelUser();
                        $user->id = $id;
                        $user->status = $status;
                        global $user_logged;
                        $user->usuario_id = $user_logged->id;

                        $this->daoUser->updateStatus($user);
                        $this->info = 'success=user_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=user_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $filterUser = new ModelUser();
            $filterUser->nome = strip_tags($_POST['nome_usuario']);
            $filterUser->login = strip_tags($_POST['login_usuario']);
            $filterUser->todos = strip_tags($_POST['todos']);
            if ($filterUser->nome != null || $filterUser->login != null || $filterUser->todos) {
                try {
                    $users = $this->daoUser->selectObjectsByContainsObjetc($filterUser);
                    $permissao = $this->usuarioAutenticado->user_fk_authority_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/user/list.php');
        }
    }

    public function selectObjectsNotInFuncionarioUser() {
        return $this->daoUser->selectObjectsNotInFuncionarioUser();
    }

    public function logon() {
        $login = strip_tags($_POST['login']);
        $senha = strip_tags($_POST['senha']);
        try {
            $user_logged = $this->daoUser->selectObjectByName($login);
            if ($user_logged !== false) {
                if ($user_logged->status == true) {
                    if (!password_verify($senha, $user_logged->senha)) {
                        $this->controllerSystem->user_info('error=user_incorrect_password');
                    } else {
                        $user_logging = new ModelUser();
                        $user_logging->id = $user_logged->id;
                        $user_logging->ultimo_acesso = date('Y-m-d H:i:s');
                        $this->daoUser->updateLastAccess($user_logging);
                        $_SESSION['usuario'] = $user_logged;

                        redirect(server_url('?page=ControllerSystem&option=welcome'));
                    }
                } else {
                    $this->controllerSystem->user_info('error=user_not_allowed');
                }
            } else {
                $this->controllerSystem->user_info('error=user_not_exists');
            }
        } catch (Exception $erro) {
            $this->controllerSystem->user_info("error=" . $erro->getMessage());
        }
    }

    public function logout() {
        if (HelperController::authotity()) {
            session_destroy();
            $this->info = 'success=user_logout';
            $controllerPage = new ControllerPage();
            $this->controllerSystem->user_info($this->info);
            redirect(server_url('?page=ControllerUser&option=authenticate'));
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            $user = new ModelUser();
            if($this->daoParameter->verificaConfiguracaoDeEmail())
                $user->enviar_senha_por_email = true;
            else
                $user->enviar_senha_por_email = false;
            include_once server_path('view/user/new.php');
        }
    }

    public function reset() {
        $id = strip_tags($_GET['id']); //Códifo do usuário
        if($this->daoParameter->verificaConfiguracaoDeEmail())
            $user->enviar_senha_por_email = true;
        else{
            HelperController::valid_messages("warning=server_email_undefined");
            redirect(server_url('?page=ControllerUser&option=edit&id='. $id));
        }
        $password = random_int(100000, 99999999); //senha aleatoria
        $senha = password_hash($password, PASSWORD_BCRYPT);

        try {
            $user = new ModelUser();
            $user->id = $id;
            $user->senha = $senha;
            global $user_logged;
            $user->usuario_id = $user_logged->id;

            $user_updated = $this->daoUser->selectObjectById($id);
            //Enviando email para acesso ao sistema
            $contact = new ModelContact();
            $contact->cont_descricao = $user_updated->nome;
            $contact->cont_email = $user_updated->login;
            $contact->cont_texto = 'Senha Provisória: ' . $password;

            $controllerContact = new ControllerContact();

            if ($controllerContact->send_email($contact)) {
                $this->daoUser->updatePassword($user);
                $this->info = "success=senha_reseted";
            } else {
                $this->info = "error=contact_not_send_email";
            }
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
        $this->listar();
    }

    public function save() {
        if (HelperController::authotity()) {
            $user = new ModelUser();
            $user->nome = strip_tags($_POST['nome']);
            $user->login = strip_tags($_POST['login']);
            $user->senha = strip_tags($_POST['senha']);
            $user->status = true;

            try {
                $user_atual = $this->daoUser->selectObjectByName($user->login);
                if (!$user_atual) {
                    $user->senha = password_hash($user->senha, PASSWORD_BCRYPT);
                    if($user->senha){
                        $this->daoUser->createOtherUser($user);
                        $this->info = "success=user_created";
                    }else{
                        $password = random_int(100000, 99999999); //senha aleatoria
                        $user->senha = password_hash($password, PASSWORD_BCRYPT);
                        //Enviando email para acesso ao sistema
                        $contact = new ModelContact();
                        $contact->cont_descricao = $nome;
                        $contact->cont_email = $login;
                        $contact->cont_texto = 'Senha Provisória: ' . $password;
                        $controllerContact = new ControllerContact();
                        if ($controllerContact->send_email($contact)) {
                            $this->daoUser->createOtherUser($user);
                            $this->info = "success=user_created";
                        } else {
                            $this->info = "error=contact_not_send_email";
                        }
                    }
                } else {
                    $this->info = "warning=user_already_registered";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function submit() {
        $nome = strip_tags($_POST['nome']); //nome do usuário
        $login = strip_tags($_POST['login']); //email para acesso
        $password = random_int(100000, 99999999); //senha aleatoria
        $senha = password_hash($password, PASSWORD_BCRYPT);
        $status = true; // usuário ativo
        //Consultando módulo do sistema para cadastro de usuário padrão
        $parameter = $this->daoParameter->selectObjectByKey('modulos_sistema');
        if (!isset($parameter->para_value)) {
            $user_fk_authority_pk_id = null;
        } else {
            $user_fk_authority_pk_id = $parameter->para_value;
        }
        
        //Enviando email para acesso ao sistema
        $contact = new ModelContact();
        $contact->cont_descricao = $nome;
        $contact->cont_email = $login;
        $contact->cont_texto = 'Senha Provisória: ' . $password;

        $user = new ModelUser();
        $user->nome = $nome;
        $user->login = $login;
        $user->senha = $senha;
        $user->status = $status;
        global $user_logged;
        $user->usuario_id = $user_logged->id;
        try {
            if (!isset($this->daoUser->selectObjectByName($login)->login)) {
                $controllerContact = new ControllerContact();
                if ($controllerContact->send_email($contact)) {
                    $this->daoUser->createOtherUser($user);
                    include_once server_path('view/user/success.php');
                } else {
                    $this->controllerSystem->user_info("error=contact_not_send_email");
                }
            } else {
                $this->controllerSystem->user_info("warning=user_already_registered");
            }
        } catch (Exception $erro) {
            $this->controllerSystem->user_info("error=" . $erro->getMessage());
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            
            $user = new ModelUser();
            $user->id = strip_tags($_POST['id']);
            $user->nome = strip_tags($_POST['nome']);
            $user->login = strip_tags($_POST['login']);
            $user->senha = strip_tags($_POST['senha']);
            $status = true;
            global $user_logged;
            $user->usuario_id = $user_logged->id;
            if (!isset($user->id)) {
                $this->info = 'warning=user_uninformed';
            }
            if($user->senha){
                $user->senha = password_hash($user->senha, PASSWORD_BCRYPT);
            }
            try {
                $this->daoUser->update($user);
                if ($user == null) {
                    $this->info = 'warning=user_not_exists';
                    $this->listar();
                }
                $this->info = 'success=user_updated';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
           $this->listar();
        }
    }

}
