<?php

// namespace Modulo\Model\entity

namespace Application\Model\Entity;

Class Cliente {

    private $nombre;
    private $codigo;

    public function __construct() {
        //
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function __toString() {

        return "{" . $this->nombre . "," . $this->codigo . "}";
    }

}

?>
