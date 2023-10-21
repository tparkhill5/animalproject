<?php

namespace App\Traits\Sounds;

trait IsStrong
{
    protected function capitalize(string $in): string
    {
        return ucfirst($in);
    }
}
