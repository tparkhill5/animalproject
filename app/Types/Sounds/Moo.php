<?php

namespace App\Types\Sounds;

use App\Traits\Sounds\IsCalm;
use App\Traits\Sounds\IsStrong;

class Moo extends Sound
{
    use IsCalm, IsStrong;

    protected string $value = 'moo';
}
