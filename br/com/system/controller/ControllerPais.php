<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOPais.php");
include_once server_path("br/com/system/model/ModelPais.php");

class ControllerPais {

    private $info;
    private $daoPais;

    function __construct() {
        $this->info = 'default=default';
        $this->daoPais = new DAOPais();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $pais_pk_id = strip_tags($_GET['pais_pk_id']);
            if (!isset($pais_pk_id)) {
                $this->info = 'warning=pais_uninformed';
            }
            try {
                $this->daoPais->delete($pais_pk_id);
                $this->info = "success=pais_deleted";
                $this->list();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $pais_pk_id = strip_tags($_GET['pais_pk_id']);
            if (isset($pais_pk_id)) {
                $pais_status = false;
                try {
                    if (($this->daoPais->selectObjectById($pais_pk_id)) === null) {
                        $this->info = 'warning=pais_not_exists';
                    } else {
                        $pais = new ModelPais();
                        $pais->pais_pk_id = $pais_pk_id;
                        $pais->pais_status = $pais_status;

                        $this->daoPais->updateStatus($pais);
                        $this->info = 'success=pais_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=pais_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $pais_pk_id = $_GET['pais_pk_id'];
            if (!isset($pais_pk_id)) {
                $this->info = 'warning=pais_uninformed';
                $this->list();
            }
            try {
                $pais = $this->daoPais->selectObjectById($pais_pk_id);
                if (!isset($pais)) {
                    $this->info = 'warning=pais_not_exists';
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($pais == false) {
                $this->info = "warning=pais_not_found";
            }
            include_once server_path('br/com/system/view/pais/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $pais_pk_id = strip_tags($_GET['pais_pk_id']);
            if (isset($pais_pk_id)) {
                $pais_status = true;
                try {
                    if (($this->daoPais->selectObjectById($pais_pk_id)) === null) {
                        $this->info = 'warning=pais_not_exists';
                    } else {
                        $pais = new ModelPais();
                        $pais->pais_pk_id = $pais_pk_id;
                        $pais->pais_status = $pais_status;

                        $this->daoPais->updateStatus($pais);
                        $this->info = 'success=pais_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=pais_uninformed';
            }
            $this->list();
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['pais_nome'])) {
                $pais = new ModelPais();
                $pais->pais_nome = strip_tags($_POST['pais_nome']);
                try {
                    $paises = $this->daoPais->selectObjectsByContainsObject($pais);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/pais/list.php');
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/pais/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $pais_nome = strip_tags($_POST['pais_nome']);
            $pais_sigla = strip_tags($_POST['pais_sigla']);
            $pais_status = true;
            global $user_logged;
            $pais_fk_user_pk_id = $user_logged->user_pk_id;

            $pais = new ModelPais();
            $pais->pais_nome = $pais_nome;
            $pais->pais_sigla = $pais_sigla;
            $pais->pais_status = $pais_status;
            $pais->pais_fk_user_pk_id = $pais_fk_user_pk_id;
            try {
                $daoPais = new DAOPais();
                $daoPais->save($pais);
                $this->info = "success=pais_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $pais_pk_id = strip_tags($_POST['pais_pk_id']);
                if (!isset($pais_pk_id)) {
                    $this->info = 'warning=pais_uninformed';
                }
                $pais_nome = strip_tags($_POST['pais_nome']);
                $pais_sigla = strip_tags($_POST['pais_sigla']);
                global $user_logged;
                $pais_fk_user_pk_id = $user_logged->user_pk_id;

                $pais = new ModelPais();
                $pais->pais_pk_id = $pais_pk_id;
                $pais->pais_nome = $pais_nome;
                $pais->pais_sigla = $pais_sigla;
                $pais->pais_fk_user_pk_id = $pais_fk_user_pk_id;

                try {
                    $this->daoPais->update($pais);
                    if ($pais == null) {
                        $this->info = 'warning=pais_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=pais_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

}
