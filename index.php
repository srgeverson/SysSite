<?php
ob_start();
include_once './br/com/system/assets/php/conf.php';
include_once './br/com/system/controller/HelperController.php';
include_once './br/com/system/controller/ControllerParameter.php';
include_once './br/com/system/controller/ControllerPage.php';

$parameter = new ControllerParameter();
ini_set('display_errors', $parameter->getProperty('mostrar_error'));

session_cache_expire($parameter->getProperty('tempo_sessao_site') != '' ? $parameter->getProperty('mostrar_error') : 60);
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
    if (!HelperController::filter()) {
        if (!isset($user_logged)) {
            $controllerPage = new ControllerPage();
            $pages_enableds = $controllerPage->listEnableds();
            foreach ($pages_enableds as $each_page) {
                if (count($pages_enableds) && $each_page->page_name === 'home') {
                    redirect(server_url('?page=ControllerPage&option=home'));
                }
            }
            redirect(server_url('?page=ControllerUser&option=authenticate'));
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
        include_once server_path("br/com/system/view/authority/screen/menu.php");
        // include_once server_path("br/com/system/view/authority/screen/" . $user_logged->auth_screen);
    }
}

include_once 'br/com/system/view/system/page.php';

ob_end_flush();
