<?php
ob_start();
include_once './assets/php/conf.php';
include_once './controller/HelperController.php';
include_once './controller/ControllerParameter.php';
include_once './controller/ControllerPage.php';

$parameter = new ControllerParameter();
ini_set('display_errors', $parameter->getProperty('mostrar_error'));

$tempo = $parameter->getProperty('tempo_sessao_site');
session_cache_expire( $tempo == 'Vazio/Desabilitado' ? 60 : $tempo);
session_start();

$landingpage = $parameter->getProperty('landing_page');
if($landingpage != 'Vazio/Desabilitado' && !is_dir('./' . $landingpage)){
    mkdir('./' . $landingpage);
    copy( './view/page/pages/landingpage.php', './' . $landingpage . '/index.php' ) && unlink( './view/page/pages/landingpage.php' );
}

if (isset($_SESSION['usuario'])) {
    $user_logged = $_SESSION['usuario'];
}

function access() {
    global $user_logged;
    if (!isset($user_logged)) {
        include_once server_path("view/system/access.php");
    } else {
        include_once server_path("view/usuario/logon.php");
    }
}

function footer() {
    include_once server_path("view/system/footer.php");
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
            include_once server_path("view/system/welcome.php");
        }
    }
}

function navbar() {
    global $user_logged;
    if (!isset($user_logged)) {
        include_once server_path("view/system/nav_offline.php");
    } else {
        include_once server_path("view/authority/screen/menu.php");
        // include_once server_path("view/authority/screen/" . $user_logged->auth_screen);
    }
}

include_once 'view/system/page.php';

ob_end_flush();
