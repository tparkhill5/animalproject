<?php

namespace App\Types\Animals;

use App\Types\Sounds\Meow;

class Cat extends RealAnimal
{
    public function __construct()
    {
        parent::__construct(new Meow);
    }
}
