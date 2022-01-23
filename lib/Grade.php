<?php

class Grade
{
    public $min;
    public $max;
    public $intitule;
    public $id;

    public function __construct($id, $intitule, $min, $max)
    {
        $this->min = $min;
        $this->max = $max;
        $this->intitule = $intitule;
        $this->id = $id;
    }
}