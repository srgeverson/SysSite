<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("dao/DAOPermissao.php");
include_once server_path("dao/DAOGrupo.php");
include_once server_path("dao/DAOGrupoPermissao.php");
include_once server_path("dao/DAOUser.php");
include_once server_path("dao/DAOUsuarioGrupo.php");
include_once server_path("model/ModelPermissao.php");
include_once server_path("model/ModelGrupo.php");
include_once server_path("model/ModelGrupoPermissao.php");
include_once server_path("model/ModelUser.php");
include_once server_path("model/ModelUsuarioGrupo.php");

class ControllerGrupo {

    private $info;
    private $daoPermissao;
    private $daoGrupo;
    private $daoGrupoPermissao;
    private $daoUser;
    private $daoUsuarioGrupo;
    private $usuarioAutenticado;

    function __construct($pemissoes = array()) {
        $this->info = 'default=default';
        $this->daoPermissao = new DAOPermissao();
        $this->daoGrupo = new DAOGrupo();
        $this->daoGrupoPermissao = new DAOGrupoPermissao();
        $this->daoUser = new DAOUser();
        $this->daoUsuarioGrupo = new DAOUsuarioGrupo();
        global $user_logged;
        $this->usuarioAutenticado = $user_logged;
    }

    public function adicionarPermissoes(){
        if (HelperController::authotity()) {

            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['grupo_id']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;

            $ids_permissoes = $_POST['permissao_id'];

            $permissoesDoGrupo = array();

            foreach ($ids_permissoes as $permissao){
                $autority = new ModelPermissao();
                $autority->id = $permissao;
                $autority->status = $grupo->status;
                $autority->usuario_id = $this->usuarioAutenticado->id;

                $permissaoGrupo = new ModelGrupoPermissao();
                $permissaoGrupo->grupo_id = $grupo->id;
                $permissaoGrupo->permissao_id = $autority->id;
                $permissaoGrupo->usuario_id = $this->usuarioAutenticado->id;
                $permissaoGrupo->status = $autority->status;
                array_push($permissoesDoGrupo,$permissaoGrupo);
            }
            try {
                $this->daoGrupoPermissao->saveBatch($permissoesDoGrupo);
                $this->info = "success=grupo_granted_updated";
            } catch (Exception $erro) {
                print_r($erro);
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function adicionarUsuarios(){
        if (HelperController::authotity()) {

            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['grupo_id']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;

            $ids_usuarios = $_POST['usuario_id'];

            $usuariosDoGrupo = array();

            foreach ($ids_usuarios as $usuario){
                $user = new ModelUser();
                $user->id = $usuario;
                $user->status = $grupo->status;
                $user->usuario_id = $this->usuarioAutenticado->id;

                $usuarioGrupo = new ModelUsuarioGrupo();
                $usuarioGrupo->grupo_id = $grupo->id;
                $usuarioGrupo->usuario_id = $user->id;
                $usuarioGrupo->usuario = $this->usuarioAutenticado->id;
                $usuarioGrupo->status = $user->status;
                array_push($usuariosDoGrupo,$usuarioGrupo);
            }
            try {
                $this->daoUsuarioGrupo->saveBatch($usuariosDoGrupo);
                $this->info = "success=grupo_granted_updated";
            } catch (Exception $erro) {
                // print_r($erro);
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function delete() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
            }
            try {
                $grupoDePermissoes = $this->daoGrupoPermissao->selectObjectsByContainsFkGrupo($id);
                $grupoDeUsuarios = $this->daoUsuarioGrupo->selectObjectsByContainsFkGrupo($id);
                if (empty($grupoDePermissoes) && empty($grupoDeUsuarios)) {
                    if (!$this->daoGrupo->delete($id)) {
                        $this->info = 'warning=grupo_not_exists';
                        $this->listar();
                    }
                    $this->info = "success=grupo_deleted";
                } else {
                    $this->info = "warning=grupo_in_use";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function disable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = false;
                try {
                    if (($this->daoGrupo->selectObjectById($id)) === null) {
                        $this->info = 'warning=grupo_not_exists';
                    } else {
                        $grupo = new ModelGrupo();
                        $grupo->id = $id;
                        $grupo->status = $status;
                        $grupo->usuario_id = $this->usuarioAutenticado->id;
                        $this->daoGrupo->updateStatus($grupo);
                        $this->info = 'success=grupo_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=grupo_uninformed';
            }
            $this->listar();
        }
    }

    public function desvincularPermissao() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
                $this->listar();
            }
            try {
                $grupo = $this->daoGrupo->selectObjectById($id);
                if (!isset($grupo)) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
                $permissoesDoGrupo = $this->daoPermissao->selectObjectsPermissoesByFKGrupo($grupo->id);
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($grupo == false) {
                $this->info = "warning=grupo_not_found";
            }
            include_once server_path('view/grupo/permissao/remove_permissao.php');
        }
    }

    public function desvincularUsuario() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
                $this->listar();
            }
            try {
                $grupo = $this->daoGrupo->selectObjectById($id);
                if (!isset($grupo)) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
                $usuariosDoGrupo = $this->daoUser->selectObjectsUsuariosByFKGrupo($grupo->id);
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($grupo == false) {
                $this->info = "warning=grupo_not_found";
            }
            include_once server_path('view/grupo/usuario/remove_usuario.php');
        }
    }

    public function edit() {
        if (HelperController::authotity()) {
            $id = $_GET['id'];
            if (!isset($id)) {
                $this->info = 'warning=grupo_uninformed';
                $this->listar();
            }
            try {
                $grupo = $this->daoGrupo->selectObjectById($id);
                if (!isset($grupo)) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($grupo == false) {
                $this->info = "warning=grupo_not_found";
            }
            include_once server_path('view/grupo/edit.php');
        }
    }

    public function enable() {
        if (HelperController::authotity()) {
            $id = strip_tags($_GET['id']);
            if (isset($id)) {
                $status = true;
                try {
                    if (($this->daoGrupo->selectObjectById($id)) === null) {
                        $this->info = 'warning=grupo_not_exists';
                    } else {
                        $grupo = new ModelGrupo();
                        $grupo->id = $id;
                        $grupo->status = $status;
                        $grupo->usuario_id = $this->usuarioAutenticado->id;
                        $this->daoGrupo->updateStatus($grupo);
                        $this->info = 'success=grupo_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=grupo_uninformed';
            }
            $this->listar();
        }
    }

    public function listar() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->nome = strip_tags($_POST['nome']);
            $grupo->todos = strip_tags($_POST['todos']);
            if ($grupo->nome || $grupo->todos) {
                try {
                    $grupos = $this->daoGrupo->selectObjectsByContainsObject($grupo);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            }
            if (isset($this->info)) {
                HelperController::valid_messages($this->info);
            }
            include_once server_path('view/grupo/list.php');
        }
    }

    public function listarPermissoesGrupo($id = null){
        try {
            //if ($this->usuarioAutenticado === null)
            //return $this->usuarioAutenticado;
            // return $id;
            return $this->daoPermissao->selectObjectsPermissoesByNotFKGrupo($id);
            // return $this->daoGrupo->selectObjectsEnabled();
            //else
            //    http_response_code(401);
            //code...
        } catch (Exception $erro) {
            http_response_code(500);
            return $erro;
        }
    }

    public function listarUsuariosGrupo($id = null){
        try {
            //if ($this->usuarioAutenticado === null)
            //return $this->usuarioAutenticado;
            // return $id;
            return $this->daoUser->selectObjectsUsuariosByNotFKGrupo($id);
            // return $this->daoGrupo->selectObjectsEnabled();
            //else
            //    http_response_code(401);
            //code...
        } catch (Exception $erro) {
            http_response_code(500);
            return $erro;
        }
    }

    public function novo() {
        if (HelperController::authotity()) {
            include_once server_path('view/grupo/new.php');
        }
    }

    public function removerPermissoes(){
        if (HelperController::authotity()) {

            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['id']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;

            $ids_permissoes = $_POST['permissao_id'];

            $permissaoGrupo = new ModelGrupoPermissao();
            $permissaoGrupo->grupo_id = $grupo->id;
            $permissaoGrupo->usuario_id = $this->usuarioAutenticado->id;
            $permissaoGrupo->status = $autority->status;
            $permissaoGrupo->ids_permissoes = join(",", $ids_permissoes);

            try {
               $this->daoGrupoPermissao->deleteBatchByNotExistsArray($permissaoGrupo);
                $this->info = "success=grupo_granted_updated";
            } catch (Exception $erro) {
                //print_r($erro);
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function removerUsuarios(){
        if (HelperController::authotity()) {

            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['id']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;

            $ids_usuarios = $_POST['usuario_id'];

            $usuarioGrupo = new ModelUsuarioGrupo();
            $usuarioGrupo->grupo_id = $grupo->id;
            $usuarioGrupo->usuario = $this->usuarioAutenticado->id;
            $usuarioGrupo->status = $autority->status;
            $usuarioGrupo->ids_usuarios = join(",", $ids_usuarios);

            try {
                $this->daoUsuarioGrupo->deleteBatchByNotExistsArray($usuarioGrupo);
                $this->info = "success=grupo_granted_updated";
            } catch (Exception $erro) {
                //print_r($erro);
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function save() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->nome = strip_tags($_POST['nome']);
            $grupo->status = true;
            $grupo->usuario_id = $this->usuarioAutenticado->id;
            $existente = $this->daoGrupo->selectObjectsByNameUnique($grupo->nome);
            if (empty($existente)) {
                try {
                    $this->daoGrupo->save($grupo);
                    $this->info = "success=grupo_created";
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->listar();
            } else {
                $this->info = "warning=grupo_already_registered";
                HelperController::valid_messages($this->info);
                $this->novo();
            }
        }
    }

    public function update() {
        if (HelperController::authotity()) {
            $grupo = new ModelGrupo();
            $grupo->id = strip_tags($_POST['id']);;
            $grupo->nome =strip_tags($_POST['nome']);
            $grupo->usuario_id = $this->usuarioAutenticado->id;
            if (!$grupo->id) {
                $this->info = 'warning=grupo_uninformed';
            }

            try {
                $this->daoGrupo->update($grupo);
                if ($grupo == null) {
                    $this->info = 'warning=grupo_not_exists';
                    $this->listar();
                }
                $this->info = 'success=grupo_updated';
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->listar();
        }
    }

    public function vincularPermissao() {
        if (HelperController::authotity()) {
            try {
                $grupos = $this->daoGrupo->selectObjectsEnabled();
            } catch (Exception $erro) {
                print_r($erro);
            }
            include_once server_path('view/grupo/permissao/add_permissao.php');
        }
    }

    public function vincularUsuario() {
        if (HelperController::authotity()) {
            try {
                $grupos = $this->daoGrupo->selectObjectsEnabled();
            } catch (Exception $erro) {
                print_r($erro);
            }
            include_once server_path('view/grupo/usuario/add_usuario.php');
        }
    }

}
