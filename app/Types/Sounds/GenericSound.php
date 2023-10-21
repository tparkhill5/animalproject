<?php

namespace App\Types\Sounds;

use App\Traits\Sounds\IsCalm;
use App\Traits\Sounds\IsQuiet;

class GenericSound extends Sound
{
    use IsCalm, IsQuiet;

    public function __construct(
        protected string $value
    ) {
    }
}
