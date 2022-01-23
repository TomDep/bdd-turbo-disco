<?php

class NumeroTelephone
{
    public $id;
    public $numero;

    public function __construct($id, $numero) {
        $this->id = $id;
        $this->numero = $numero;
    }
}