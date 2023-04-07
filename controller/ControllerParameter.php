<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOParameter.php");
include_once server_path("model/ModelParameter.php");

class ControllerParameter {

    private $info;
    private $daoParameter;
    private $controllerSystem;
    private $usuarioAutenticado;

    function __construct() {
        $this->info = 'default=default';
        $this->daoParameter = new DAOParameter();
        $this->controllerSystem = new ControllerSystem();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function delete() {
        if (HelperController::authotity()) {
            $para_pk_id = strip_tags($_GET['param_pk_id']);
            if (!isset($para_pk_id)) {
                $this->info = 'warning=parameter_uninformed';
            }
            try {
                $this->daoParameter->delete($para_pk_id);
                $this->info = "success=parameter_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $para_pk_id = strip_tags($_GET['param_pk_id']);
            if (isset($para_pk_id)) {
                $para_status = false;
                try {
                    if (($this->daoParameter->selectObjectById($para_pk_id)) === null) {
                        $this->info = 'warning=parameter_not_exists';
                    } else {
                        $parameter = new ModelParameter();
                        $parameter->para_pk_id = $para_pk_id;
                        $parameter->para_status = $para_status;

                        $this->daoParameter->updateStatus($parameter);
                        $this->info = 'success=parameter_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=parameter_uninformed';
            }
            $this->listar();
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $para_pk_id = $_GET['param_pk_id'];
            if (!isset($para_pk_id)) {
                $this->info = 'warning=parameter_uninformed';
                $this->listar();
            }
            try {
                $parameter = $this->daoParameter->selectObjectById($para_pk_id);
                if (!isset($parameter)) {
                    $this->info = 'warning=parameter_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($parameter == false) {
                $this->info = "warning=parameter_not_found";
            }
            include_once server_path('view/parameter/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $para_pk_id = strip_tags($_GET['param_pk_id']);
            if (isset($para_pk_id)) {
                $para_status = true;
                try {
                    if (($this->daoParameter->selectObjectById($para_pk_id)) === null) {
                        $this->info = 'warning=parameter_not_exists';
                    } else {
                        $parameter = new ModelParameter();
                        $parameter->para_pk_id = $para_pk_id;
                        $parameter->para_status = $para_status;

                        $this->daoParameter->updateStatus($parameter);
                        $this->info = 'success=parameter_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=parameter_uninformed';
            }
            $this->listar();
        }
    }

    public function getProperty($key = null) {
        try {
            $parameter = $this->daoParameter->selectObjectByKey($key);
            if (!isset($parameter->para_value)) {
                return "Vazio/Desabilitado";
            } else {
                return $parameter->para_value;
            }
        } catch (Exception $erro) {
            $this->controllerSystem->parameter_info("error=" . $erro->getMessage());
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            if (isset($_POST['para_key']) && isset($_POST['para_value'])) {
                try {
                    $parameter = new ModelParameter();
                    $parameter->para_key = strip_tags($_POST['para_key']);
                    $parameter->para_value = strip_tags($_POST['para_value']);
                    $parameters = $this->daoParameter->selectObjectsByContainsObject($parameter);
                    $permissao = $this->usuarioAutenticado->user_fk_authority_pk_id;
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/parameter/list.php');
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/parameter/new.php');
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $para_key = strip_tags($_POST['para_key']);
            $para_value = strip_tags($_POST['para_value']);
            $para_description = strip_tags($_POST['para_description']);
            $para_status = false;
            global $user_logged;
            $para_fk_id = $user_logged->id;
            $parameter = new ModelParameter();
            $parameter->para_key = $para_key;
            $parameter->para_status = $para_status;
            $parameter->para_value = $para_value;
            $parameter->para_description = $para_description;
            $parameter->para_fk_id = $para_fk_id;

            try {
                if (!isset($this->daoParameter->selectObjectByObject($parameter)->para_key)) {
                    $this->daoParameter->save($parameter);
                    $this->info = "success=parameter_created";
                } else {
                    $this->info = "warning=parameter_already_registered";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            if (HelperController::authotity()) {
                $para_pk_id = strip_tags($_POST['para_pk_id']);
                if (!isset($para_pk_id)) {
                    $this->info = 'warning=parameter_uninformed';
                }
                $para_value = strip_tags($_POST['para_value']);
                $para_description = strip_tags($_POST['para_description']);

                $parameter = new ModelParameter();
                $parameter->para_pk_id = $para_pk_id;
                $parameter->para_value = $para_value;
                $parameter->para_description = $para_description;

                try {
                    if ($parameter == null) {
                        $this->info = 'warning=parameter_not_exists';
                        $this->listar();
                    }
                    $this->daoParameter->update($parameter);
                    $this->info = 'success=parameter_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
