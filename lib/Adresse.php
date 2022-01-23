<?php

class Adresse
{
    public $numero;
    public $rue;
    public $ville;
    public $codePostal;
    public $id;

    public function __construct($id, $numero, $rue, $codePostal, $ville)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
    }
}
