<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path('controller/ControllerSystem.php');
include_once server_path('dao/DAOPermissao.php');

class HelperController {

    public static function authotity() {
        $nome_sessao = session_name();
        if(isset($_SESSION['usuario']) && !isset($_COOKIE[$nome_sessao])){
            $controllerPage = new ControllerPage();
            $controllerPage->home('warning=access_expired');
            return false;
        } else if (!isset($_SESSION['usuario'])) {
            $controllerPage = new ControllerPage();
            $controllerPage->home('warning=permission_denied');
            return false;
        } else 
            return true;
    }

    private static function dictionary($msg) {
        if (isset($GLOBALS['dictionary'][$msg])) {
            return $GLOBALS['dictionary'][$msg];
        } else {
            return $msg;
        }
    }

    public static function filter() {
        $pemissoes = array();
        if (!isset($_GET['page']) || !isset($_GET['option'])) {
            return false;
        } else {
            $classe = ucfirst($_GET['page']);
            $metodo = $_GET['option'];
            global $user_logged;
            if(isset($user_logged)){
                $daoPermissao = new DAOPermissao();
                $pemissoes = $daoPermissao->selectObjectsPermissoesByMenuItemAndUsuario($classe, $user_logged->id);
                //kkkkk
                //var_dump($pemissoes);
            }
            include_once server_path("controller/$classe.php");
            $objeto = new $classe($pemissoes);
            $objeto->$metodo();
            return true;
        }
    }

    public static function redirect() {
        if (!isset($_SESSION['usuario'])) {
            ControllerSystem::principal('error=permission_denied');
        }
    }

    public static function valid_messages($msg, $messages = array()) {
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
            $alert_text = HelperController::dictionary($info);
            $message_text = join(",", $messages);
            include server_path('view/system/alert.php');
        }
    }

    public static function validar_permissoes($pemissoes = array(), object $objeto = null) {
        foreach ($pemissoes as $pemissao) {
            // if(count($pemissoes) === 1 && strpos(strtolower($pemissao->nome), strtolower('Cadastrar/Listar/Excluir/Alterar'))){
            //     $objeto->cadastrar = true;
            //     $objeto->listar = true;
            //     //$objeto->excluir = true;
            //     $objeto->alterar = true;
            //     break;
            // } else {
            // }
            if(strpos(strtolower($pemissao->nome), strtolower('Cadastrar')))
                $objeto->cadastrar = true;
            if(strpos(strtolower($pemissao->nome), strtolower('Listar')))
                $objeto->listar = true;
            if(strpos(strtolower($pemissao->nome), strtolower('Excluir')))
                $objeto->excluir = true;
            if(strpos(strtolower($pemissao->nome), strtolower('Alterar')))
                $objeto->alterar = true;
        }
        return $objeto; 
    }

    public static function validar_sessao($tempo = 60){
        $nome_sessao = session_name();
        if(isset($_COOKIE[$nome_sessao]))
            setcookie($nome_sessao, $_COOKIE[$nome_sessao], time() + $tempo, '/');
    }
}
