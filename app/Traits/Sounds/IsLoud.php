<?php

namespace App\Traits\Sounds;

trait IsLoud
{
    protected function punctuate(string $in): string
    {
        return sprintf('%s!', $in);
    }
}
