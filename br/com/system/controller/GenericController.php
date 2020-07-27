<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path('br/com/system/controller/ControllerSystem.php');

class GenericController {

    public static function authotity() {
        if (!isset($_SESSION['usuario'])) {
            $controllerPage = new ControllerPage();
            $controllerPage->home('error=permission_denied');
            return false;
        } else {
            return true;
        }
    }

    private static function dictionary($msg) {
        if (isset($GLOBALS['dictionary'][$msg])) {
            return $GLOBALS['dictionary'][$msg];
        } else {
            return $msg;
        }
    }

    public static function filter() {
        if (!isset($_GET['page']) || !isset($_GET['option'])) {
            return false;
        } else {
            $classe = ucfirst($_GET['page']);
            $metodo = $_GET['option'];
            include_once server_path("br/com/system/controller/$classe.php");
            $objeto = new $classe();
            $objeto->$metodo();
            return true;
        }
    }

    public static function redirect() {
        if (!isset($_SESSION['usuario'])) {
            ControllerSystem::principal('error=permission_denied');
        }
    }

    public static function valid_messages($msg) {
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
            }
            $alert_text = GenericController::dictionary($info);
            include server_path('br/com/system/view/system/alert.php');
        }
    }

}
