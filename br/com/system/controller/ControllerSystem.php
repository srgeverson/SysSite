<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("br/com/system/model/ModelContact.php");

class ControllerSystem {

    private $info;

    function __construct() {
        $this->info = 'default=default';
    }

    public function contact_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/contact.php');
    }

    public function folha_pagamento_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/page/pages/contact.php');
    }  
    
    public function funcionario_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
    }

    public function parameter_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/user/default.php');
    }

    public function user_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        GenericController::valid_messages($msg);
        include_once server_path('br/com/system/view/user/authenticate.php');
    }

    public function welcome($msg = null) {
        if (GenericController::authotity()) {
            if (!isset($msg)) {
                $msg = $this->info;
            }
            GenericController::valid_messages($msg);
            include_once server_path('br/com/system/view/system/welcome.php');
        }
    }

}
