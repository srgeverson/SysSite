<?php
/**
 *
 * @author geverson
 */
class ResponseDTO {

    private $data = [];

    public function __construct() {
        
    }

    public function __set($indice, $valor) {
        $this->data[$indice] = $valor;
    }

    public function &__get($indice) {
        return $this->data[$indice];
    }

    public function getJSONEncode() {
        return json_encode(get_object_vars($this));
    }
    
}
