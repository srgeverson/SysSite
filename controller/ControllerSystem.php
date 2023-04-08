<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path("model/ModelContact.php");

class ControllerSystem {

    private $info;

    function __construct() {
        $this->info = 'default=default';
    }

    public function contact_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/page/pages/contact.php');
    }

    public function folha_pagamento_info($msg = null) {
        if (!isset($msg)) {
            $msg = $this->info;
        }
        HelperController::valid_messages($msg);
        include_once server_path('view/page/pages/contact.php');
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
