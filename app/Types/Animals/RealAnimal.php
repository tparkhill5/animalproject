<?php

namespace App\Types\Animals;

use App\Types\Sounds\Sound;

class RealAnimal extends Animal
{
    public function __construct(
        protected readonly Sound $sound,
    ) {
    }

    public function says(): string
    {
        return $this->sound->get();
    }
}
