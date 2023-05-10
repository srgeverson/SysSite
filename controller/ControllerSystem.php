<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("dao/DAOParameter.php");
include_once server_path("model/ModelContato.php");
include_once server_path("model/ModelParameter.php");
include_once server_path("controller/ControllerContato.php");

class ControllerSystem {

    private $info;
    private $daoParameter;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoParameter = new DAOParameter();
    }

    public function contato_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/page/pages/contato.php');
    }
    
    public function editarConfiguracaoEmail(){
        if (HelperController::authotity()) {
            try {
                $parameters = $this->daoParameter->selectConfiguracaoEmail();
                $this->info = "success=cidade_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                include_once server_path('view/system/email.php');
            }
        }
    }

    public function folha_pagamento_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/page/pages/contato.php');
    }  
    
    public function funcionario_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
    }

    public function parameter_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/page/pages/default.php');
    }

    public function salvarConfiguracaoEmail(){
        if (HelperController::authotity()) {
            try {
                $id = strip_tags($_GET['id']);
                if (!isset($id)) {
                    $this->info = 'warning=cidade_uninformed';
                }
                $this->daoCidade->delete($id);
                $this->info = "success=cidade_deleted";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            } finally {
                //HelperController::valid_messages("warning=server_email_undefined");
                return $this->welcome('success=parameter_email_setup');
            }
        }
    }

    public function testarConfiguracaoEmail(){
        $controller = new ControllerContato();
        $contato = new ModelContato();
        $contato->descricao = 'Ops.. testando';
        $contato->email = 'geversonjosedesouza@gmail.com';
        $contato->observacaoo = 'Testando envio de email';
        //$parameters = $this->daoParameter->selectConfiguracaoEmail();
        if($controller->send_email_smtp($contato)){
            $this->info = 'success=sent_email';
        } else {
            $this->info = 'warning=not_sent_email';
        }
        
        //$controller->send_email_smtp($contato);
        HelperController::valid_messages($this->info);
        return $this->editarConfiguracaoEmail();
    }

    public function user_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/user/authenticate.php');
    }

    public function welcome($msg = null) {
        if (HelperController::authotity()) {
            if (!isset($msg)) {
                $msg = $this->info;
            }
            HelperController::valid_messages($msg);
            include_once server_path('view/system/welcome.php');
        }
    }

}
