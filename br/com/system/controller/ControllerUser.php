<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOAuthority.php");
include_once server_path("br/com/system/dao/DAOUser.php");
include_once server_path("br/com/system/controller/ControllerContact.php");
include_once server_path("br/com/system/model/ModelUser.php");
include_once server_path("br/com/system/model/ModelContact.php");

class ControllerUser {

    private $info;
    private $controllerSystem;
    private $daoUser;

    function __construct() {
        $this->info = 'default=default';
        $this->controllerSystem = new ControllerSystem();
        $this->daoUser = new DAOUser();
    }

    public function authenticate() {
        include_once server_path('br/com/system/view/user/authenticate.php');
    }

    public function createAccount() {
        include_once server_path('br/com/system/view/user/create_account.php');
    }

    public function delete() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->info = 'warning=user_uninformed';
            } else {
                $user = $this->daoUser->selectObjectById($user_pk_id);
                if (unlink(server_path('br/com/system/uploads/user/' . $user->user_image))) {
                    try {
                        $this->daoUser->delete($user_pk_id);
                        $this->info = "success=user_deleted";
                    } catch (Exception $erro) {
                        $this->info = "error=" . $erro->getMessage();
                    }
                } else {
                    $this->info = "error=user_image_not_deleted";
                }
            }
            $this->list();
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (isset($user_pk_id)) {
                $user_status = false;
                try {
                    if (($this->daoUser->selectObjectById($user_pk_id)) === null) {
                        $this->info = "warning=user_not_exists";
                    } else {
                        $user = new ModelUser();
                        $user->user_pk_id = $user_pk_id;
                        $user->user_status = $user_status;

                        $this->daoUser->updateStatus($user);
                        $this->info = "success=user_disabled";
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = "warning=user_uninformed";
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $user_pk_id = $_GET['user_pk_id'];
            if (!isset($user_pk_id)) {
                $this->info = 'warning=user_uninformed';
                $this->list();
            }
            try {
                $user = $this->daoUser->selectObjectById($user_pk_id);
                $daoAuthority = new DAOAuthority();
                $authorities = $daoAuthority->selectObjectsEnabled();
                if (!isset($user)) {
                    $this->info = 'warning=user_not_exists';
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($user == false) {
                $this->info = "warning=user_not_found";
            }
            include_once server_path('br/com/system/view/user/edit.php');
        }
    }

    public function editProfile() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->controllerSystem->welcome('warning=user_uninformed');
            }
            try {
                $user = $this->daoUser->selectObjectById($user_pk_id);

                if ($user == false) {
                    $this->controllerSystem->welcome('error=user_not_found');
                } else {
                    include_once server_path('br/com/system/view/user/profile.php');
                }
            } catch (Exception $erro) {
                $this->controllerSystem->welcome('error=' . $erro->getMessage());
            }
        }
    }

    public function editUser() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_POST['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->controllerSystem->welcome('warning=user_uninformed');
            }
            $user_name = strip_tags($_POST['user_name']);
            $user_password = password_hash(strip_tags($_POST['user_password']), PASSWORD_BCRYPT);

            $user_image = $_FILES['user_image']['name'];
            $extensao = pathinfo($user_image, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            $uploaddir = server_path('br/com/system/uploads/user/');
            $novo_nome = uniqid(time()) . '.' . $extensao;
            $uploadfile = $uploaddir . $novo_nome;

            try {
                $userUpdated = $this->daoUser->selectObjectById($user_pk_id);
                if ($userUpdated == false) {
                    $this->controllerSystem->welcome('warning=user_not_exists');
                } else {
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile)) {
                            if (unlink(server_path('br/com/system/uploads/user/' . $userUpdated->user_image))) {
                                $user = new ModelUser();
                                $user->user_pk_id = $user_pk_id;
                                $user->user_name = $user_name;
                                $user->user_password = $user_password;
                                $user->user_image = $novo_nome;
                                $this->daoUser->update_user($user);
                                $this->controllerSystem->welcome('success=user_profile_edit');
                            } else {
                                $this->info = "error=user_image_not_deleted";
                            }
                        }
                    } else {
                        echo '<script>alert("Formato de imagem não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                }
            } catch (Exception $erro) {
                $this->controllerSystem->welcome('error=' . $erro->getMessage());
            }
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (isset($user_pk_id)) {
                $user_status = true;
                try {
                    if (($this->daoUser->selectObjectById($user_pk_id)) === null) {
                        $this->info = 'warning=user_not_exists';
                    } else {
                        $user = new ModelUser();
                        $user->user_pk_id = $user_pk_id;
                        $user->user_status = $user_status;

                        $this->daoUser->updateStatus($user);
                        $this->info = 'success=user_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=user_uninformed';
            }
            $this->list();
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['user_name']) && isset($_POST['user_login']) && isset($_POST['user_fk_authority_pk_id'])) {
                $user = new ModelUser();
                $user->user_name = strip_tags($_POST['user_name']);
                $user->user_login = strip_tags($_POST['user_login']);
                if (strip_tags($_POST['user_fk_authority_pk_id']) !== 'Todas') {
                    $user->user_fk_authority_pk_id = strip_tags($_POST['user_fk_authority_pk_id']);
                } else {
                    $user->user_fk_authority_pk_id = '';
                }
                try {
                    $users = $this->daoUser->selectObjectsByContainsObjetc($user);
                    $daoAuthority = new DAOAuthority();
                    $authorities = $daoAuthority->selectObjectsEnabled();
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/user/list.php');
        }
    }

    public function logon() {
        $user_login = strip_tags($_POST['user_login']);
        $user_password = strip_tags($_POST['user_password']);
        try {
            $user_logged = $this->daoUser->selectObjectByName($user_login);
            if ($user_logged !== false) {
                if ($user_logged->user_status == true) {
                    if (!password_verify($user_password, $user_logged->user_password)) {
                        $this->controllerSystem->user_info('error=user_incorrect_password');
                    } else {
                        $user_logging = new ModelUser();
                        $user_logging->user_pk_id = $user_logged->user_pk_id;
                        $user_logging->user_last_login = date('Y-m-d H:i:s');
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
        if (GenericController::authotity()) {
            session_destroy();
            $this->info = 'success=user_logout';
            $controllerPage = new ControllerPage();
            $this->controllerSystem->user_info($this->info);
            redirect(server_url('?page=ControllerUser&option=authenticate'));
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            $daoAuthority = new DAOAuthority();
            $authorities = $daoAuthority->selectObjectsEnabled();
            include_once server_path('br/com/system/view/user/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $user_name = strip_tags($_POST['user_name']); //nome do usuário
            $user_login = strip_tags($_POST['user_login']); //email para acesso
            $password = random_int(100000, 99999999); //senha aleatoria
            $user_password = password_hash($password, PASSWORD_BCRYPT);
            $user_status = true; // usuário ativo
            $user_fk_authority_pk_id = strip_tags($_POST['user_fk_authority_pk_id']);
            //Enviando email para acesso ao sistema
            $contact = new ModelContact();
            $contact->cont_descricao = $user_name;
            $contact->cont_email = $user_login;
            $contact->cont_texto = 'Senha Provisória: ' . $password;


            $user = new ModelUser();
            $user->user_name = $user_name;
            $user->user_login = $user_login;
            $user->user_password = $user_password;
            $user->user_status = $user_status;
            $user->user_fk_authority_pk_id = $user_fk_authority_pk_id;
            try {
                if (!isset($this->daoUser->selectObjectByName($user_login)->user_login)) {
                    $this->daoUser->createOtherUser($user);
                    if ($this->controllerSystem->send_email($contact)) {
                        $this->info = "success=user_created";
                    } else {
                        $this->info = "error=contact_not_send_email";
                    }
                } else {
                    $this->info = "warning=user_already_registered";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function reset() {
        $user_pk_id = strip_tags($_GET['user_pk_id']); //Códifo do usuário
        $password = random_int(100000, 99999999); //senha aleatoria
        $user_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $user = new ModelUser();
            $user->user_pk_id = $user_pk_id;
            $user->user_password = $user_password;

            $user_updated = $this->daoUser->selectObjectById($user_pk_id);
            //Enviando email para acesso ao sistema
            $contact = new ModelContact();
            $contact->cont_descricao = $user_updated->user_name;
            $contact->cont_email = $user_updated->user_login;
            $contact->cont_texto = 'Senha Provisória: ' . $password;

            $controllerContact = new ControllerContact();

            if ($controllerContact->send_email($contact)) {
                $this->daoUser->updatePassword($user);
                $this->info = "success=user_password_reseted";
            } else {
                $this->info = "error=contact_not_send_email";
            }
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
        $this->list();
    }

    public function submit() {
        $user_name = strip_tags($_POST['user_name']); //nome do usuário
        $user_login = strip_tags($_POST['user_login']); //email para acesso
        $password = random_int(100000, 99999999); //senha aleatoria
        $user_password = password_hash($password, PASSWORD_BCRYPT);
        $user_status = true; // usuário ativo
        $user_fk_authority_pk_id = 3; //permissão de funcionário
        //Enviando email para acesso ao sistema
        $contact = new ModelContact();
        $contact->cont_descricao = $user_name;
        $contact->cont_email = $user_login;
        $contact->cont_texto = 'Senha Provisória: ' . $password;


        $user = new ModelUser();
        $user->user_name = $user_name;
        $user->user_login = $user_login;
        $user->user_password = $user_password;
        $user->user_status = $user_status;
        $user->user_fk_authority_pk_id = $user_fk_authority_pk_id;
        try {
            if (!isset($this->daoUser->selectObjectByName($user_login)->user_login)) {
                $controllerContact = new ControllerContact();
                if ($controllerContact->send_email($contact)) {
                    $this->daoUser->createOtherUser($user);
                    include_once server_path('br/com/system/view/user/success.php');
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
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $user_pk_id = strip_tags($_POST['user_pk_id']);
                if (!isset($user_pk_id)) {
                    $this->info = 'warning=user_uninformed';
                }
                $user_name = strip_tags($_POST['user_name']);
                $user_login = strip_tags($_POST['user_login']);
                $user_fk_authority_pk_id = strip_tags($_POST['user_fk_authority_pk_id']);

                $user = new ModelUser();
                $user->user_pk_id = $user_pk_id;
                $user->user_name = $user_name;
                $user->user_login = $user_login;
                $user->user_fk_authority_pk_id = $user_fk_authority_pk_id;

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
                $this->list();
            }
        }
    }

}
