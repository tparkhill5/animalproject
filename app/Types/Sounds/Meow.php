<?php

namespace App\Types\Sounds;

use App\Traits\Sounds\IsCalm;
use App\Traits\Sounds\IsQuiet;

class Meow extends Sound
{
    use IsCalm, IsQuiet;

    protected string $value = 'meow';
}
