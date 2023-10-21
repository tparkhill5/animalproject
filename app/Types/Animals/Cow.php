<?php

namespace App\Types\Animals;

use App\Types\Sounds\Moo;

class Cow extends RealAnimal
{
    public function __construct()
    {
        parent::__construct(new Moo);
    }
}
