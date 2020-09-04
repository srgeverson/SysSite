<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOEstado.php");
include_once server_path("br/com/system/dao/DAOPais.php");
include_once server_path("br/com/system/model/ModelEstado.php");

class ControllerEstado {

    private $info;
    private $controllerSystem;
    private $daoEstado;

    function __construct() {
        $this->info = 'default=default';
        $this->controllerSystem = new ControllerSystem();
        $this->daoEstado = new DAOEstado();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $esta_pk_id = strip_tags($_GET['esta_pk_id']);
            if (!isset($esta_pk_id)) {
                $this->info = 'warning=estado_uninformed';
            }
            try {
                $this->daoEstado->delete($esta_pk_id);
                $this->info = "success=estado_deleted";
                $this->listar();
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $esta_pk_id = strip_tags($_GET['esta_pk_id']);
            if (isset($esta_pk_id)) {
                $esta_status = false;
                try {
                    if (($this->daoEstado->selectObjectById($esta_pk_id)) === null) {
                        $this->info = "warning=estado_not_exists";
                    } else {
                        $estado = new ModelEstado();
                        $estado->esta_pk_id = $esta_pk_id;
                        $estado->esta_status = $esta_status;

                        $this->daoEstado->updateStatus($estado);
                        $this->info = "success=estado_disabled";
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = "warning=estado_uninformed";
            }
            $this->listar();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $esta_pk_id = $_GET['esta_pk_id'];
            if (!isset($esta_pk_id)) {
                $this->info = 'warning=estado_uninformed';
                $this->listar();
            }
            try {
                $estado = $this->daoEstado->selectObjectById($esta_pk_id);
                $daoPais = new DAOPais();
                $paises = $daoPais->selectObjectsEnabled();
                if (!isset($estado)) {
                    $this->info = 'warning=estado_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($estado == false) {
                $this->info = "warning=estado_not_found";
            }
            include_once server_path('br/com/system/view/estado/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $esta_pk_id = strip_tags($_GET['esta_pk_id']);
            if (isset($esta_pk_id)) {
                $esta_status = true;
                try {
                    if (($this->daoEstado->selectObjectById($esta_pk_id)) === null) {
                        $this->info = 'warning=estado_not_exists';
                    } else {
                        $estado = new ModelEstado();
                        $estado->esta_pk_id = $esta_pk_id;
                        $estado->esta_status = $esta_status;

                        $this->daoEstado->updateStatus($estado);
                        $this->info = 'success=estado_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=estado_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (GenericController::authotity()) {
            if (isset($_POST['esta_nome']) && isset($_POST['pais_nome'])) {
                $estado = new ModelEstado();
                $estado->esta_nome = strip_tags($_POST['esta_nome']);
                if (strip_tags($_POST['pais_nome']) !== 'Todas') {
                    $estado->pais_nome = strip_tags($_POST['pais_nome']);
                } else {
                    $estado->pais_nome = '';
                }
                try {
                    $estados = $this->daoEstado->selectObjectsByContainsObject($estado);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            $daoPais = new DAOPais();
            $paises = $daoPais->selectObjectsEnabled();
            include_once server_path('br/com/system/view/estado/list.php');
        }
    }

    public function novo() {
        if (GenericController::authotity()) {
            $daoPais = new DAOPais();
            $paises = $daoPais->selectObjectsEnabled();
            include_once server_path('br/com/system/view/estado/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $esta_nome = strip_tags($_POST['esta_nome']);
            $esta_sigla = strip_tags($_POST['esta_sigla']);
            $esta_status = true;
            $esta_fk_pais_pk_id = strip_tags($_POST['esta_fk_pais_pk_id']);
            global $user_logged;
            $esta_fk_user_pk_id = $user_logged->user_pk_id;

            $estado = new ModelEstado();
            $estado->esta_nome = $esta_nome;
            $estado->esta_sigla = $esta_sigla;
            $estado->esta_status = $esta_status;
            $estado->esta_fk_pais_pk_id = $esta_fk_pais_pk_id;
            $estado->esta_fk_user_pk_id = $esta_fk_user_pk_id;
            try {
                $this->daoEstado->save($estado);
                $this->info = "success=estado_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $esta_pk_id = strip_tags($_POST['esta_pk_id']);
                if (!isset($esta_pk_id)) {
                    $this->info = 'warning=estado_uninformed';
                }
                $esta_nome = strip_tags($_POST['esta_nome']);
                $esta_sigla = strip_tags($_POST['esta_sigla']);
                $esta_fk_pais_pk_id = strip_tags($_POST['esta_fk_pais_pk_id']);
                global $user_logged;
                $esta_fk_user_pk_id = $user_logged->user_pk_id;

                $estado = new ModelEstado();
                $estado->esta_pk_id = $esta_pk_id;
                $estado->esta_nome = $esta_nome;
                $estado->esta_sigla = $esta_sigla;
                $estado->esta_fk_pais_pk_id = $esta_fk_pais_pk_id;
                $estado->esta_fk_user_pk_id = $esta_fk_user_pk_id;

                try {
                    $this->daoEstado->update($estado);
                    if ($estado == null) {
                        $this->info = 'warning=estado_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=estado_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

}
