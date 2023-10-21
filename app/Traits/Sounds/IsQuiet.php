<?php

namespace App\Traits\Sounds;

trait IsQuiet
{
    protected function capitalize(string $in): string
    {
        return strtolower($in);
    }
}
