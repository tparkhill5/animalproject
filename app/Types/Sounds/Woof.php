<?php

namespace App\Types\Sounds;

use App\Traits\Sounds\IsLoud;
use App\Traits\Sounds\IsStrong;

class Woof extends Sound
{
    use IsLoud, IsStrong;

    protected string $value = 'woof';
}
