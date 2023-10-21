<?php

namespace App\Types\Animals;

use App\Types\Sounds\Woof;

class Dog extends RealAnimal
{
    public function __construct()
    {
        parent::__construct(new Woof);
    }
}
