<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once server_path('model/GenericModel.php');

/**
 *
 * @author geverson
 */
class ModelMenuItem implements \br\com\system\model\generic\GenericModel {

    private $atributos = [];

    public function __construct() {
        
    }

    public function __set($indice, $valor) {
        $this->atributos[$indice] = $valor;
    }

    public function &__get($indice) {
        return $this->atributos[$indice];
    }

}
