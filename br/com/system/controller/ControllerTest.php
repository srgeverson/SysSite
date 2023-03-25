<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOParameter.php");
include_once server_path("br/com/system/dao/DAOTest.php");
include_once server_path("br/com/system/model/ModelParameter.php");
include_once server_path("br/com/system/model/ModelTest.php");

class ControllerTest {

    private $info;
    private $controllerSystem;
    private $daoParameter;
    private $daoTest;
    private $teste;
    private $usuarioAutenticado;

    function __construct() {
        $this->info = 'default=default';
        $this->controllerSystem = new ControllerSystem();
        $this->daoTest = new DAOTest();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
        $this->daoParameter = new DAOParameter();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $test_id = strip_tags($_GET['test_id']);
            if (!isset($test_id)) {
                $this->info = 'warning=test_uninformed';
            } else {
                $test = $this->daoTest->selectObjectById($test_id);
                if ($test->test_image != null || $test->test_image != '') {
                    unlink(server_path('br/com/system/uploads/test/' . $test->test_image));
                }
                try {
                    $this->daoTest->delete($test_id);
                    $this->info = "success=test_deleted";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            $this->listar();
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $test_id = strip_tags($_GET['test_id']);
            if (isset($test_id)) {
                try {
                    if (($this->daoTest->selectObjectById($test_id)) === null) {
                        $this->info = "warning=test_not_exists";
                    } else {
                        $test = new ModelTest();
                        $test->id = $test_id;
                        $test->status = false;

                        $this->daoTest->updateStatus($test);
                        $this->info = "success=test_disabled";
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = "warning=test_uninformed";
            }
            $this->listar();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $test_id = $_GET['test_id'];
            if (!isset($test_id)) {
                $this->info = 'warning=test_uninformed';
                $this->listar();
            }
            try {
                $test = $this->daoTest->selectObjectById($test_id);
                if (!isset($test)) {
                    $this->info = 'warning=test_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($test == false) {
                $this->info = "warning=test_not_found";
            }
            include_once server_path('br/com/system/view/test/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $test_id = strip_tags($_GET['test_id']);
            if (isset($test_id)) {
                try {
                    if (($this->daoTest->selectObjectById($test_id)) === null) {
                        $this->info = 'warning=test_not_exists';
                    } else {
                        $test = new ModelTest();
                        $test->id = $test_id;
                        $test->status = true;

                        $this->daoTest->updateStatus($test);
                        $this->info = 'success=test_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=test_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (GenericController::authotity()) {
            $test_name = strip_tags($_POST['test_name']);
            if (isset($test_name)) {
                $test = new ModelTest();
                $test->name = $test_name;
                try {
                    $tests = $this->daoTest->selectObjectsByContainsObjetc($test);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                GenericController::valid_messages($this->info);
            }
            include_once server_path('br/com/system/view/test/list.php');
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/test/new.php');
        }
    }

    public function new_ajax() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/test/new_ajax.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $name = strip_tags($_POST['test_name']); //nome do usuário

            $test = new ModelTest();
            $test->name = $name;
            $test->status = true;
            try {
                $this->daoTest->save($test);
                $this->info = "success=test_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $test_id = strip_tags($_POST['test_id']);
                if (!isset($test_id)) {
                    $this->info = 'warning=test_uninformed';
                }
                $test_name = strip_tags($_POST['test_name']);

                $test = new ModelTest();
                $test->id = $test_id;
                $test->name = $test_name;

                try {
                    $this->daoTest->update($test);
                    if ($test == null) {
                        $this->info = 'warning=test_not_exists';
                        $this->listar();
                    }
                    $this->info = 'success=test_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            }
        }
    }

    public function uploadImagem(){
        $nome_arquivo = $_FILES['test_name']['name'];
        $arquivo = $_FILES["test_name"]['tmp_name'];
        
        if (isset($arquivo) && isset($nome_arquivo) ){
            $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            $uploaddir = server_path($pasta_aplicacao);
            $novo_nome = uniqid(time()) . '.' . $extensao;
            $uploadfile = $uploaddir . $novo_nome;
            if (validateImages($extensao)) {
                if(move_uploaded_file($arquivo, $uploadfile)){
                    try {
                        $test = new ModelTest();
                        $test->name = $nome_arquivo;
                        $test->status = true;
                        $this->daoTest->save($test);
                        $this->info = "success=test_created";
                        $this->listar();
                    } catch (Exception $erro) {
                        $this->info = "error=" . $erro->getMessage();
                    }
                }
            } else {
                echo '<script>alert("Formato de imagem não aceito!")</script>';
                redirect("javascript:window.history.go(-1)");
            }
        }
        
        // header('Content-Type: application/json');
        //return json_encode($test);
    }

    public function teste(){
        try{
            $parameter = $this->daoParameter->selectObjectByKey('teste_ambiente_sistema');
            if (boolval($parameter->para_value) === true) {
                echo 'Ops...' . "\n";
                print_r($_ENV);
                //echo getenv('SENHA')."\n";
            } else
                GenericController::authotity();
        } catch (Exception $erro) {
            $this->info = "error=" . $erro->getMessage();
        }
    }
}
