<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControllerGeneric {

    public function authotity() {
        if (!isset($_SESSION['usuario'])) {
            // $controllerPage = new ControllerPage();
            // $controllerPage->home('error=permission_denied');
            // echo 'Ops';
            // redirect(server_url('?page=ControllerPage&option=home'));
            return false;
        } else {
            return true;
        }
    }

    private function dictionary($msg) {
        if (isset($GLOBALS['dictionary'][$msg])) {
            return $GLOBALS['dictionary'][$msg];
        } else {
            return $msg;
        }
    }

    public function filter() {
        if (!isset($_GET['page']) || !isset($_GET['option'])) {
            return false;
        } else {
            $classe = ucfirst($_GET['page']);
            $metodo = $_GET['option'];
            echo $metodo;
            include_once server_path("controller/$classe.php");
            $objeto = new $classe();
           // if($this->authotity() || strstr('authenticate;home', $metodo))
                $objeto->$metodo();
            return true;
        }
    }

    public function valid_messages($msg) {
        if ($msg != 'default=default') {
            list($type, $info) = explode("=", $msg);
            switch ($type) {
                case "error":
                    $alert_class = "danger";
                    $alert_icon = "exclamation-triangle";
                    break;
                case "success":
                    $alert_class = "info";
                    $alert_icon = "info-circle";
                    break;
                case "warning":
                    $alert_class = "warning";
                    $alert_icon = "exclamation-triangle";
                    break;
                default:
                    $alert_class = "danger";
                    $alert_icon = "exclamation-triangle";
                    break;
            }
            $alert_text = $this->dictionary($info);
            include server_path('view/system/alert.php');
        }
    }

}
