<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this franze file, choose Tools | Templates
and open the franze in the editor.
-->
<?php
ob_start();
ini_set('display_errors', 1);
include_once './br/com/system/assets/php/conf.php';
include_once './br/com/system/controller/GenericController.php';
include_once './br/com/system/controller/ControllerParameter.php';
include_once './br/com/system/controller/ControllerPage.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $user_logged = $_SESSION['usuario'];
}

function access() {
    global $user_logged;
    if (!isset($user_logged)) {
        include_once server_path("br/com/system/view/system/access.php");
    } else {
        include_once server_path("br/com/system/view/usuario/logon.php");
    }
}

function footer() {
    include_once server_path("br/com/system/view/system/footer.php");
}

function main() {
    global $user_logged;
    if (!GenericController::filter()) {
        if (!isset($user_logged)) {
            $controllerPage = new ControllerPage();
            $pages_enableds = $controllerPage->listEnableds();
            foreach ($pages_enableds as $each_page) {
                
                if (count($pages_enableds) && $each_page->page_name === 'home') {
                    redirect(server_url('?page=ControllerPage&option=home'));
                } else {
                    redirect(server_url('?page=ControllerUser&option=authenticate'));
                }
            }
        } else {
            include_once server_path("br/com/system/view/system/welcome.php");
        }
    }
}

function navbar() {
    global $user_logged;
    if (!isset($user_logged)) {
        include_once server_path("br/com/system/view/system/nav_offline.php");
    } else {
        include_once server_path("br/com/system/view/authority/screen/" . $user_logged->auth_screen);
    }
}

include_once 'br/com/system/view/system/page.php';

ob_end_flush();
