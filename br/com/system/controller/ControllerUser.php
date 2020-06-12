<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOUser.php");
include_once server_path("br/com/system/model/ModelUser.php");
include_once server_path("br/com/system/model/ModelContact.php");

class ControllerUser {

    private $info = 'default=default';
    private $controller_system;

    function __construct() {
        $this->controller_system = new ControllerSystem();
    }

    public function authenticate() {
        include_once server_path('br/com/system/view/user/authenticate.php');
    }

    public function createAccount() {
        include_once server_path('br/com/system/view/user/create_account.php');
    }

    public function delete() {
        if (GenericController::authotity()) {

            echo json_encode(array("name" => "John", "time" => "2pm"));

            //$user_pk_id = strip_tags($_POST['user_pk_id']);
            /*           if (!isset($user_pk_id)) {
              $this->info = 'warning=user_uninformed';
              }
              try {
              DAOUser::delete($user_pk_id);
              if ($user == null) {
              $this->info = 'warning=user_not_exists';
              $this->listar();
              }
              $this->info = "success=user_deleted";
              } catch (Exception $erro) {
              $this->info = "error=" . $erro->getMessage();
              }
              $this->listar(); */
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->info = 'warning=user_uninformed';
            }
            $atua_status = false;

            try {
                $objeto_verificado = DAOUser::selectObjectById($user_pk_id);
                if ($objeto_verificado == null) {
                    $this->info = 'warning=user_not_exists';
                    $this->listar();
                }

                $user = new ModelUser();
                $user->user_pk_id = $user_pk_id;
                $user->atua_status = $atua_status;

                DAOUser::updateStatus($user);
                $this->info = 'success=user_disabled';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $user_pk_id = $_GET['user_pk_id'];
            if (!isset($user_pk_id)) {
                $this->info = 'warning=user_uninformed';
                $this->listar();
            }
            try {
                $user = DAOUser::selectObjectById($user_pk_id);
                if ($user == null) {
                    $this->info = 'warning=user_not_exists';
                    $this->listar();
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
                $this->controller_system->welcome('warning=user_uninformed');
            }
            try {
                $dao_user = new DAOUser();
                $user = $dao_user->selectObjectById($user_pk_id);

                if ($user == false) {
                    $this->controller_system->welcome('error=user_not_found');
                } else {
                    include_once server_path('br/com/system/view/user/profile.php');
                }
            } catch (Exception $erro) {
                $this->controller_system->welcome('error=' . $erro->getMessage());
            }
        }
    }

    public function editUser() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_POST['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->controller_system->welcome('warning=user_uninformed');
            }
            $user_name = strip_tags($_POST['user_name']);
            $user_password = password_hash(strip_tags($_POST['user_password']), PASSWORD_BCRYPT);
            $user_image = $_FILES['user_image']['name'];
            $uploaddir = server_path('br/com/system/uploads/user/');
            $uploadfile = $uploaddir . $user_image;
            $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);

            try {
                $dao_user = new DAOUser();
                if ($dao_user->selectObjectById($user_pk_id) == false) {
                    $this->controller_system->welcome('warning=user_not_exists');
                } else {
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile)) {
                            $user = new ModelUser();
                            $user->user_pk_id = $user_pk_id;
                            $user->user_name = $user_name;
                            $user->user_password = $user_password;
                            $user->user_image = $user_image;
                            $dao_user->update_user($user);
                            $this->controller_system->welcome('success=user_profile_edit');
                        }
                    } else {
                        echo '<script>alert("Formato de imagem não aceito!")</script>';
                        redirect("javascript:window.history.go(-1)");
                    }
                }
            } catch (Exception $erro) {
                $this->controller_system->welcome('error=' . $erro->getMessage());
            }
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $user_pk_id = strip_tags($_GET['user_pk_id']);
            if (!isset($user_pk_id)) {
                $this->info = 'warning=user_uninformed';
                $this->listar();
            }
            $atua_status = true;

            $objeto_verificado = DAOUser::selectObjectById($user_pk_id);
            if ($objeto_verificado == null) {
                $this->info = 'warning=user_not_exists';
                $this->listar();
            }

            $user = new ModelUser();
            $user->user_pk_id = $user_pk_id;
            $user->atua_status = $atua_status;
            try {
                DAOUser::updateStatus($user);
                $this->info = 'success=user_enabled';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            try {
                $data_atual = date('Y-m-d');
                $users = DAOUser::select();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
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
            $user_dao = new DAOUser();
            $user_logged = $user_dao->selectObjectByName($user_login);
            if (isset($user_logged)) {
                if ($user_login == $user_logged->user_login && $user_logged->user_status == 1) {
                    if (!password_verify($user_password, $user_logged->user_password)) {
                        $this->controller_system->user_info('error=user_incorrect_password');
                    } else {
                        $user_logging = new ModelUser();
                        $user_logging->user_pk_id = $user_logged->user_pk_id;
                        $user_logging->user_last_login = date('Y-m-d H:i:s');
                        $user_dao->updateLastAccess($user_logging);
                        $_SESSION['usuario'] = $user_logged;

                        $controller_system = new ControllerSystem();
                        $controller_system->welcome('success=user_logged');
                        redirect(server_url('?page=ControllerSystem&option=welcome'));
                    }
                } else {
                    $this->controller_system->user_info('error=user_not_allowed');
                }
            }
        } catch (Exception $erro) {
            $this->controller_system->user_info("error=" . $erro->getMessage());
        }
    }

    public function logout() {
        if (GenericController::authotity()) {
            session_destroy();
            $this->info = 'success=user_logout';
            $controller_system = new ControllerSystem();
            $controller_system->home($this->info);
            redirect(server_url('?page=ControllerSystem&option=home'));
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/user/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            try {
                $user_name = strip_tags($_POST['user_name']);
                $user_login = strip_tags($_POST['user_login']);
                $user_password = password_hash(strip_tags($_POST['user_password']), PASSWORD_BCRYPT);
                $user_password = true;
                $user_fk_authority_pk_id = strip_tags($_POST['user_fk_authority_pk_id']);
                $user_image = $_FILES['user_image']['name'];
                $uploaddir = server_path('br/com/system/uploads/user/');
                $uploadfile = $uploaddir . $user_image;
                $extensao = pathinfo($uploadfile, PATHINFO_EXTENSION);
                if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                    if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile)) {
                        $user = new ModelUser();
                        $user->user_name = $user_name;
                        $user->user_password = $user_password;
                        $user->user_password = $user_password;
                        $user->user_fk_authority_pk_id = $user_fk_authority_pk_id;
                        $user->user_image = $user_image;
                        DAOUsuario::save($user);
                    }
                } else {
                    echo '<script>alert("Formato de imagem não aceito!")</script>';
                    redirect("javascript:window.history.go(-1)");
                }
                self::listar();
            } catch (Exception $erro) {
                self::$info = "error=" . $erro->getMessage();
            }
        }
    }

    public function submit() {
        $user_name = strip_tags($_POST['user_name']); //nome do usuário
        $user_login = strip_tags($_POST['user_login']);//email para acesso
        $password = random_int(100000, 99999999); //senha aleatoria
        $user_password = password_hash($password, PASSWORD_BCRYPT);
        $user_status = true; // usuário ativo
        $user_fk_authority_pk_id = 3; //permissão de funcionário

        //Enviando email para acesso ao sistema
        $contact = new ModelContact();
        $contact->cont_descricao = $user_name;
        $contact->cont_email = $user_login;
        $contact->cont_texto = 'Senha Provisória: ' . $password;
        
        if ($this->controller_system->send_email($contact)) {
            $user = new ModelUser();
            $user->user_name = $user_name;
            $user->user_login = $user_login;
            $user->user_password = $user_password;
            $user->user_status = $user_status;
            $user->user_fk_authority_pk_id = $user_fk_authority_pk_id;
            try {
                $dao_user = new DAOUser();
                $dao_user->createOtherUser($user);
                include_once server_path('br/com/system/view/user/success.php');
            } catch (Exception $erro) {
                $this->controller_system->user_info("error=" . $erro->getMessage());
            }
        } else {
            $this->controller_system->user_info("error=contact_not_send_email");
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

                $user = new ModelUser();
                $user->user_pk_id = $user_pk_id;
                $user->user_name = $user_name;
                $user->user_login = $user_login;

                try {
                    DAOUser::update($user);
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

}
