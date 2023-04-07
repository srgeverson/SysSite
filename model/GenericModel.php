<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace br\com\system\model\generic;

/**
 *
 * @author geverson
 */
interface GenericModel {

//put your code here
    public function __construct();

    public function __set($indice, $valor);

    public function &__get($indice);
}
